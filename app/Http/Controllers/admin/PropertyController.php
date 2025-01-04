<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Property;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\Amenity;
use App\Models\Area;
use App\Models\Bath;
use App\Models\Bathroom;
use App\Models\bhk_type;
use App\Models\City;
use App\Models\Builder;
use App\Models\Facing;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\PropertyApplication;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\Room;
use App\Models\SaleType;
use App\Models\SavedJob;
use App\Models\SavedProperty;
use App\Models\User;
use App\Models\View;

class PropertyController extends Controller
{

    public function index(){
        $properties = Property::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        

        // if(Auth::user()->hasRole('admin')) {
        //     $items = Job::orderBy('id','DESC')->with('author')->paginate(5);
        // } else {
        //     $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        
        // }

        return view('admin.property.list', [
            'properties' => $properties
        ]);
    }


    //CREATE PROPERTY
    public function create(){
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $amenities = Amenity::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('name','ASC')->where('status',1)->get();
        $bhk = Room::orderBy('name','ASC')->where('status',1)->get();        
        $bath = Bathroom::orderBy('name','ASC')->where('status',1)->get();        
        $facings = View::orderBy('name','ASC')->where('status',1)->get();    
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->where('status',1)->get();
        $saleTypes = SaleType::orderBy('name','ASC')->where('status',1)->get();        

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,
            'amenities' => $amenities,
            'builders' => $builders,
            'bhk' => $bhk,
            'bath' => $bath,
            'facings' => $facings,
            'categories' => $categories,            
            'propertyTypes' => $propertyTypes, 
            'saleTypes' => $saleTypes, 
        ];

        return view('admin.property.create', $data);
    }
    
    //SAVE PROPERTY
    public function store(Request $request){
        $rules = [
            'title' => 'required|min:5|max:200',            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $property = new Property();
            $property->user_id = Auth::user()->id;
            $property->title = $request->title;            
            $property->slug = $request->slug;            
            $property->sale_type_id = $request->saleType;
            $property->category_id = $request->category;                    
            $property->keywords = $request->keywords;          
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->location = $request->location; 
            $property->property_type_id = $request->propertyType;
            $property->room_id = $request->room;            
            $property->bathroom_id = $request->bathroom;
            $property->price = $request->price;
            $property->compare_price = $request->compare_price;            
            $property->size = $request->size;
            $property->view_id = $request->view;     
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;  
            $property->description = $request->description;  
            $property->is_featured = $request->is_featured;
            $property->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';
            $property->amenities = (!empty($request->related_amenities)) ? implode(',',$request->related_amenities) : '';
            $property->builder_id = $request->builder;           
            $property->save();

            // if (!empty($request->image_array)) {
            //     foreach ($request->image_array as $temp_image_id) {
    
            //         $tempImageInfo = TempImage::find($temp_image_id);
            //         $extArray = explode('.',$tempImageInfo->name);
            //         $ext = last($extArray);
    
            //         $propertyImage = new PropertyImage();
            //         $propertyImage->property_id = $property->id;
            //         $propertyImage->image = "NULL";
            //         $propertyImage->save();
    
            //         $imageName = $property->id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
            //         $propertyImage->image = $imageName;
            //         $propertyImage->save();
    
            //         //Generate Property Thumbnails
            //         //Large Image
            //         $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
            //         $destPath = public_path().'/uploads/property/large/'.$imageName;
            //         $image = Image::make($sourcePath);
            //         $image->resize(1000, null, function ($constraint) {
            //             $constraint->aspectRatio();
            //         });
            //         $image->save($destPath);
    
            //         //Small Image
            //         // $destPath = public_path().'/uploads/property/small/'.$imageName;
            //         // $image = Image::make($sourcePath);
            //         // $image->fit(300,300);
            //         // $image->save($destPath);
            //     }
            // }

            session()->flash('success','Property added successfully.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    

    public function edit(Request $request, $id) {
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertytypes = SaleType::orderBy('name','ASC')->where('status',1)->get();

        $property = Property::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        if($property == null){
            abort(404);
        }

        return view('admin.property.edit', [
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'property' => $property,
        ]);
    }


    public function update(Request $request, $id){
        $rules = [
            'title' => 'required|min:5|max:200',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $job = Property::find($id);
            $job->title = $request->title;
            $job->user_id = Auth::user()->id;                        
            $job->save();

            session()->flash('success','Property updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }


    //Delete Property
    public function delete(Request $request){
        $property = Property::where([
            'user_id' => Auth::user()->id,
            'id' => $request->propertyId,
        ])->first();

        if($property == null){
            session()->flash('error','Either property deleted or not found.');
            return response()->json([
                'status' => true
            ]);
        }
        Property::where('id',$request->propertyId)->delete();
        session()->flash('success','Property deleted successfully.');
        return response()->json([
            'status' => true
        ]);
    }


    
    //Similar Property show 
    public function similar_properties(Request $request){
        $tempProperty = [];
        if($request->term != ""){
            $properties = Property::where('title','like','%'.$request->term.'%')->get();
            if ($properties != null){
                foreach ($properties as $property){
                    $tempProperty[] = array(
                        'id' => $property->id,
                        'text' => $property->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempProperty,
            'status' => true,
        ]);
    }


    //Similar Property show 
    public function get_amenities(Request $request){
        $tempAmenities = [];
        if($request->term != ""){
            $amenities = Amenity::where('name','like','%'.$request->term.'%')->get();
            if ($amenities != null){
                foreach ($amenities as $value){
                    $tempAmenities[] = array(
                        'id' => $value->id,
                        'text' => $value->name,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempAmenities,
            'status' => true,
        ]);
    }



    public function savedProperties(Request $request){
        $savedProperties = SavedProperty::where([
            'user_id' => Auth::user()->id
        ])->with(['property','property.saleType','property.applications'])->orderBy('created_at','DESC')->paginate(10);

        return view('admin.property.saved-jobs',[
            'savedProperties' => $savedProperties,
        ]);
    }

    public function removeSavedProperty(Request $request) {
        $savedJob = SavedJob::where([
                                'id' => $request->id,
                                'user_id' => Auth::user()->id]
                            )->first();

        if($savedJob == null) {
            session()->flash('error','Property not found');
            return response()->json([
                'status' => false,
            ]);
        }

        SavedJob::find($request->id)->delete();
        session()->flash('success','Property removed successfully.');

        return response()->json([
            'status' => true,
        ]);
    }

    //Remove Property
    public function removeProperty(Request $request) {
        $PropertyApplication = PropertyApplication::where([
                                'id' => $request->id,
                                'property_id' => Auth::user()->id]
                            )->first();

        if($PropertyApplication == null) {
            session()->flash('error','Property interest not found');
            return response()->json([
                'status' => false,
            ]);
        }
        PropertyApplication::find($request->id)->delete();
        session()->flash('success','Property interested removed successfully.');
        return response()->json([
            'status' => true,
        ]);
    }


    //Property Interested
    public function myPropertyApplications(){
        $propertyApplications = PropertyApplication::where('user_id',Auth::user()->id)
                            ->with(['property','property.saleType','property.applications'])
                            ->orderBy('created_at','DESC')
                            ->paginate(10);

        return view('admin.property.myPropertyApplications',[
            'propertyApplications' => $propertyApplications,
        ]);
    }
}
