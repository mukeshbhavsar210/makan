<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Area;
use App\Models\Amenity;
use App\Models\Builder;
use App\Models\Room;
use App\Models\Bathroom;
use App\Models\PropertyApplication;
use App\Models\View;
use App\Models\PropertyType;
use App\Models\SaleType;
use App\Models\SavedJob;
use App\Models\SavedProperty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropertyController extends Controller {

    public function index(){
        $properties = Property::where('user_id', Auth::user()->id)->with('saleType')->orderBy('created_at','DESC')->paginate(10);        
        return view('admin.property.list', [
            'properties' => $properties
        ]);
    }

    //CREATE PROPERTY
    public function create(){
        $data = [];
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('name','ASC')->where('status',1)->get();
        $bhk = Room::orderBy('name','ASC')->where('status',1)->get();        
        $bath = Bathroom::orderBy('name','ASC')->where('status',1)->get();        
        $facings = View::orderBy('name','ASC')->where('status',1)->get();    
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->where('status',1)->get();
        $saleTypes = SaleType::orderBy('name','ASC')->where('status',1)->get();        
        $categories = Category::orderBy('name','ASC')->get();

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,            
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

    //STORE PROPERTY
    public function store(Request $request){
        $rules = [
            'title' => 'required',            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $property = new Property;
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
            $property->related_amenities = (!empty($request->related_amenities)) ? implode(',',$request->related_amenities) : '';
            $property->builder_id = $request->builder;           
            $property->save();

        if (!empty($request->image_array)) {
            foreach ($request->image_array as $temp_image_id) {
                $tempImageInfo = TempImage::find($temp_image_id);
                $extArray = explode('.',$tempImageInfo->name);
                $ext = last($extArray);

                $productImage = new PropertyImage();
                $productImage->property_id = $property->id;
                $productImage->image = "NULL";
                $productImage->save();

                $imageName = $property->id.'-'.$property->title.'-'.time().'.'.$ext;
                $productImage->image = $imageName;
                $productImage->save();

                //Large Image
                $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                $destPath = public_path().'/uploads/property/large/'.$imageName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($sourcePath);
                $image->resize(1000,600, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save($destPath);

                //Generate Thumnail
                $destPath = public_path().'/uploads/property/small/'.$imageName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($sourcePath);
                $image->cover(300,300);
                $image->save($destPath);
            }
        }

        $request->session()->flash('success','Property added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Property added successfully'
        ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    //EDIT PROPERTY
    public function edit($id, Request $request){
        $property = Property::find($id);        

        if (empty($property)) {
            return redirect()->route('properties.index')->with('error','Property not found');
        }

        //Fetch Product Images
        $propertyImage = PropertyImage::where('property_id',$property->id)->get();   
        $areas = Area::where('city_id',$property->city_id)->get();        

        //Fetch Related products
        $relatedProperties = [];
        if ($property->related_properties != '') {
            $propertyArray = explode(',',$property->related_properties);
            $relatedProperties = Property::whereIn('id',$propertyArray)->get();
        }

        //Fetch Amenities
        $relatedAmenities = [];
        if ($property->related_amenities != '') {
            $amenityArray = explode(',',$property->related_amenities);
            $relatedAmenities = Amenity::whereIn('id',$amenityArray)->get();
        }

        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $saleTypes = SaleType::orderBy('name','ASC')->get();  
        $cities = City::orderBy('name','ASC')->get();
        $areas = Area::orderBy('name','ASC')->get();        
        $builders = Builder::orderBy('name','ASC')->get();
        $room = Room::orderBy('name','ASC')->get();        
        $bathroom = Bathroom::orderBy('name','ASC')->get();        
        $facings = View::orderBy('name','ASC')->get();    
        $categories = Category::orderBy('name','ASC')->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->get();

        $data['categories'] = $categories;
        $data['saleTypes'] = $saleTypes;
        $data['propertyTypes'] = $propertyTypes;
        $data['cities'] = $cities;
        $data['areas'] = $areas;
        $data['facings'] = $facings;
        $data['room'] = $room;
        $data['bathroom'] = $bathroom;
        $data['builders'] = $builders;
        $data['property'] = $property;
        $data['propertyImage'] = $propertyImage;
        $data['relatedProperties'] = $relatedProperties;
        $data['relatedAmenities'] = $relatedAmenities;        

        return view('admin.property.edit',$data);
    }



    public function update($id, Request $request){
        $property = Property::find($id);
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:properties,slug,'.$property->id.',id',
            'price' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
      
        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
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
            $property->related_amenities = (!empty($request->related_amenities)) ? implode(',',$request->related_amenities) : '';
            $property->builder_id = $request->builder;    
            $property->save();

        $request->session()->flash('success','Property updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Property updated successfully'
        ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //DELETE PROPERTY
    public function destroy($id, Request $request){
        $property = Property::find($id);

        if (empty($property)) {
            $request->session()->flash('error','Property not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $propertyImages = PropertyImage::where('property_id',$id)->get();

        if (!empty($propertyImages)) {
            foreach ($propertyImages as $propertyImage) {
                File::delete(public_path('uploads/property/large/'.$propertyImage->image));
                File::delete(public_path('uploads/property/small/'.$propertyImage->image));
            }
            PropertyImage::where('property_id',$id)->delete();
        }
        $property->delete();
        $request->session()->flash('success','Property deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Property deleted successfully',
        ]);
    }



    public function getProducts(Request $request){
        $tempProduct = [];
        if($request->term != ""){
            $properties = Property::where('title','like','%'.$request->term.'%')->get();

            if ($properties != null){
                foreach ($properties as $value){
                    $tempProduct[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempProduct,
            'status' => true,
        ]);
    }


    //Similar Property show 
    public function similar_properties(Request $request){
        $tempProperty = [];
        if($request->term != ""){
            $properties = Property::where('title','like','%'.$request->term.'%')->get();
            if ($properties != null){
                foreach ($properties as $value){
                    $tempProperty[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
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
    public function similar_amenities(Request $request){
        $tempAmenity = [];
        if($request->term != ""){
            $amenities = Amenity::where('title','like','%'.$request->term.'%')->get();
            if ($amenities != null){
                foreach ($amenities as $value){
                    $tempAmenity[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempAmenity,
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
