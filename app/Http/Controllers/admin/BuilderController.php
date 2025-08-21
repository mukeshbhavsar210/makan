<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\TempImage;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

class BuilderController extends Controller {
    public function index(Request $request){
        $builders = Builder::with('properties')->latest();
        $addedProperty = Property::latest();        
        $properties = Property::orderBy('title','ASC')->get();
        $counts = Builder::count();
        $roles = User::select('role')->distinct()->pluck('role');
       
        if(!empty($request->get('keyword'))){
            $builders = $builders->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $relatedProperties = [];
        // if ($builders->related_properties != '') {
        //     $propertyArray = explode(',',$builders->related_properties);
        //     $relatedProperties = Builder::whereIn('id',$propertyArray)->where('status',1)->get();
        // }


        $propertiesByRole = [];
            foreach ($roles as $role) {
                $propertiesByRole[$role] = \App\Models\Property::with(['user', 'builder'])
                    ->whereHas('user', function ($q) use ($role) {
                        $q->where('role', $role);
                    })
                    ->get()
                    ->groupBy('builder_id'); // 👈 group properties by builder
            }

        $builders = $builders->paginate(10);

        $data['builders'] = $builders;
        $data['properties'] = $properties;
        $data['addedProperty'] = $addedProperty;
        $data['relatedProperties'] = $relatedProperties;
        $data['counts'] = $counts;
        $data['roles'] = $roles;
        $data['propertiesByRole'] = $propertiesByRole;
        
    
        return view('admin.builder.list', $data);
    }

    //CREATE
    public function create(){
        $properties = Property::orderBy('title','ASC')->get();
        $data['properties'] = $properties;
        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        return view("admin.builder.create", $data);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $builder = new Builder();
            $builder->name = $request->name;
            $builder->email = $request->email;
            $builder->landline = $request->landline;
            $builder->mobile = $request->mobile;
            $builder->whatsapp = $request->whatsapp;
            $builder->year_estd = $request->year_estd;
            $builder->address = $request->address;
            $builder->property_id = $request->property;     
            $builder->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';                
            $builder->save();

            // Save image here
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $builder->id.'_'.$builder->name.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/builder/'.$newImageName;
                File::copy($sPath,$dPath);

                // //Generate image thumbnail
                // $dPath = public_path().'/uploads/builder/thumb/'.$newImageName;
                // $img = Image::make($sPath);
                // $img->resize(200, 200);
                // $img->save($dPath);
                // File::copy($sPath,$dPath);

                $builder->logo = $newImageName;
                $builder->save();
            }
            
            $request->session()->flash('success', 'Builder added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Builder added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function edit($builderId, Request $request){
        $builder = Builder::find($builderId);
        if (empty($builder)) {
            return redirect()->route('builders.index');
        }
        return view('admin.builder.edit', compact('builder'));
    }


    public function update($id, Request $request){
        $builder = Builder::find($id);
        if (empty($builder)) {
            $request->session()->flash('error', 'Builder not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'builder not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $builder->name = $request->name;
            $builder->email = $request->email;
            $builder->landline = $request->landline;
            $builder->mobile = $request->mobile;
            $builder->whatsapp = $request->whatsapp;
            $builder->year_estd = $request->year_estd;
            $builder->address = $request->address;
            $builder->property_id = $request->property_id;
            $builder->status = $request->status;             
            $builder->save();

            $request->session()->flash('success', 'builder updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Builder updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($builderId, Request $request){
        $builder = Builder::find($builderId);

        if(empty($builder)){
            $request->session()->flash('error', 'Builder not found');
            return response()->json([
                'status' => true,
                'message' => 'Builder not found'
            ]);
            return redirect()->route('builders.index');
        }

        //Delete old image
        File::delete(public_path().'/uploads/builder_logo_photo/thumb/'.$builder->image);
        File::delete(public_path().'/uploads/builder_logo_photo/'.$builder->image);

        $builder->delete();

        $request->session()->flash('success', 'Builder deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Builder deleted successfully'
        ]);
    }




   


    public function updateProfilePic(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required|image',
        ]);

        $id = Auth::user()->id;

        if($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;
            $image->move(public_path('/profile_pic/'), $imageName);

            //Create small thumbnail for Profile pic
            $sourcePath = public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

            //Delete old profile pic
            File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_pic/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Profile Picture updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
