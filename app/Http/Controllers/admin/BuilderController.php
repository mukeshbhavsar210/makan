<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Flash;
use App\Models\Category;
use App\Models\Property;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

class BuilderController extends Controller
{
    public function index(Request $request){
        $builders = Builder::latest();
        $addedProperty = Property::latest();

        if(!empty($request->get('keyword'))){
            $builders = $builders->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $builders = $builders->paginate(10);

        $data['builders'] = $builders;
        $data['addedProperty'] = $addedProperty;

        return view('admin.builder.list', $data);
    }


    public function create(){
        return view('admin.builder.create');
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
            //$builder->property_id = $request->property_id;
            $builder->status = $request->status;            
            $builder->save();

            //Logo
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $builder->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/builder_logo_photo/'.$newImageName;
                File::copy($sPath,$dPath);

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





    public function destroy($builderId, Request $request){
        $builder = Builder::find($builderId);

        if(empty($builder)){
            $request->session()->flash('error', 'Builder not found');
            return response()->json([
                'status' => true,
                'message' => 'Builder not found'
            ]);
            //return redirect()->route('categories.index');
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