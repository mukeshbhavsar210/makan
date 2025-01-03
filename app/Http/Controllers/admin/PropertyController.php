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
    public function index(Request $request){
        $properties = Property::latest('id')->with('property_images');
        if ($request->get('keyword') != ""){
            $properties = $properties->where('title', 'like', '%'.$request->keyword.'%');
        }
        $properties = $properties->paginate();
        $data['properties'] = $properties;
        return view ('admin.properties.list',$data);
    }


    public function create(){
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('name','ASC')->where('status',1)->get();
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

        return view('admin.properties.create', $data);
    }




     //SAVE PROPERTY
     public function store(Request $request){
        dd($request->all());

        // $rules = [
        //     //'title' => 'required|min:5|max:200',            
        // ];

        // $validator = Validator::make($request->all(),$rules);
        // if ($validator->passes()) {
        //     $property = new Property();
        //     //$property->user_id = Auth::user()->id;
        //     $property->title = $request->title;            
        //     // $property->sale_type_id = $request->saleType;
        //     // $property->category_id = $request->category;                    
        //     // $property->keywords = $request->keywords;          
        //     // $property->city_id = $request->city;   
        //     // $property->area_id = $request->area;  
        //     // $property->location = $request->location; 
        //     // $property->property_type_id = $request->propertyType;
        //     // $property->room_id = $request->room;            
        //     // $property->bathroom_id = $request->bathroom;
        //     // $property->amenities = $request->amenities;
        //     // $property->price = $request->price;
        //     // $property->compare_price = $request->compare_price;
        //     // $property->developer_id = $request->developer;           
        //     // $property->size = $request->size;
        //     // $property->view_id = $request->view;                        
        //     // $property->description = $request->description;                           
        //     $property->save();

        //     // if (!empty($request->image_array)) {
        //     //     foreach ($request->image_array as $temp_image_id) {
    
        //     //         $tempImageInfo = TempImage::find($temp_image_id);
        //     //         $extArray = explode('.',$tempImageInfo->name);
        //     //         $ext = last($extArray);
    
        //     //         $propertyImage = new PropertyImage();
        //     //         $propertyImage->property_id = $property->id;
        //     //         $propertyImage->image = "NULL";
        //     //         $propertyImage->save();
    
        //     //         $imageName = $property->id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
        //     //         $propertyImage->image = $imageName;
        //     //         $propertyImage->save();
    
        //     //         //Generate Property Thumbnails
        //     //         //Large Image
        //     //         $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
        //     //         $destPath = public_path().'/uploads/property/large/'.$imageName;
        //     //         $image = Image::make($sourcePath);
        //     //         $image->resize(1000, null, function ($constraint) {
        //     //             $constraint->aspectRatio();
        //     //         });
        //     //         $image->save($destPath);
    
        //     //         //Small Image
        //     //         $destPath = public_path().'/uploads/property/small/'.$imageName;
        //     //         $image = Image::make($sourcePath);
        //     //         $image->fit(300,300);
        //     //         $image->save($destPath);
        //     //     }
        //     // }

        //     session()->flash('success','Property added successfully.');

        //     return response()->json([
        //         'status' => true,
        //         'errors' => [],
        //     ]);

        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'errors' => $validator->errors(),
        //     ]);
        // }
    }
}
