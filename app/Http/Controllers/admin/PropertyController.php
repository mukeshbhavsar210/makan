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
use App\Models\PropertyDocument;
use App\Models\View;
use App\Models\PropertyType;
use App\Models\SaleType;
use App\Models\SavedJob;
use App\Models\SavedProperty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller {

    public function index(){
        $properties = Property::where('user_id', auth()->id())->with('saleType')->orderBy('created_at','DESC')->paginate(10);        
        $counts = Property::where('user_id', auth()->id())->count();

        return view('admin.property.index', [
            'properties' => $properties,
            'counts' => $counts
        ]);
    }

    //CREATE PROPERTY
    public function create(){
        $data = [];
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('name','ASC')->where('status',1)->get();
        $rooms = Room::orderBy('title','ASC')->where('status',1)->get();        
        $bathrooms = Bathroom::orderBy('title','ASC')->where('status',1)->get();
        $amenities = Amenity::orderBy('title','ASC')->where('status',1)->get();
        $views = View::orderBy('title','ASC')->where('status',1)->get();    
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->where('status',1)->get();
        $saleTypes = SaleType::orderBy('title','ASC')->where('status',1)->get();        
        $categories = Category::orderBy('name','ASC')->get();

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,            
            'builders' => $builders,
            'rooms' => $rooms,
            'bathrooms' => $bathrooms,
            'amenities' => $amenities,
            'views' => $views,
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
            $property->title = $request->title;
            $property->slug = $request->slug;            
            $property->user_id = Auth::user()->id;
            $property->category_id = $request->category;
            $property->room_id = $request->room;  
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->builder_id = $request->builder;           
            $property->sale_type_id = $request->saleType;
            $property->property_type_id = $request->propertyType;
            $property->view_id = $request->view;     
            $property->price = $request->price;
            $property->compare_price = $request->compare_price;            
            $property->description = $request->description;  
            $property->keywords = $request->keywords;
            $property->location = $request->location;
            $property->size = $request->size;
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;  
            $property->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';
            $property->related_facings = (!empty($request->related_facings)) ? implode(',',$request->related_facings) : '';            
            $property->related_amenities = (!empty($request->related_amenities)) ? implode(',',$request->related_amenities) : '';
            $property->bathroom_id = $request->bathroom;
            $property->is_featured = $request->is_featured;
            $property->construction_id = $request->construction;
            $property->age_id = $request->age;
            $property->amenity_id = $request->amenity;
            $property->listed_type_id = $request->listed_type; 
            Log::info('Incoming request data:', $request->all());           
            $property->save();

        if (!empty($request->image_array)) {
            foreach ($request->image_array as $imageData) {
                // $imageData now contains ['id' => temp_image_id, 'label' => 'Main/Bedroom/Elevation']
                $temp_image_id = $imageData['id'] ?? null;
                $label = $imageData['label'] ?? null;

                if ($temp_image_id) {
                    $tempImageInfo = TempImage::find($temp_image_id);
                    if (!$tempImageInfo) {
                        continue; // skip if not found
                    }

                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);

                    $propertyImage = new PropertyImage();
                    $propertyImage->property_id = $property->id;
                    $propertyImage->image = "NULL";
                    $propertyImage->label = $label; // save enum label
                    $propertyImage->save();

                    $imageName = $property->id . '-' . $property->title . '-' . time() . '.' . $ext;
                    $propertyImage->image = $imageName;
                    $propertyImage->save();

                    // Large Image
                    $sourcePath = public_path() . '/temp/' . $tempImageInfo->name;
                    $destPath = public_path() . '/uploads/property/large/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->resize(1300, 731, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($destPath);

                    // Thumbnail
                    $destPath = public_path() . '/uploads/property/small/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->cover(488, 326);
                    $image->save($destPath);
                }
            }
        }


        // if (!empty($request->document_array)) {
        //     foreach ($request->document_array as $temp_document_id) {
        //         $tempDocumentInfo = TempImage::find($temp_document_id);
        //         $extArray = explode('.',$tempDocumentInfo->name);
        //         $ext = last($extArray);

        //         $propertyDocument = new PropertyDocument();
        //         $propertyDocument->property_id = $property->id;
        //         $propertyDocument->image = "NULL";
        //         $propertyDocument->save();

        //         $documentName = $property->id.'-'.$property->title.'-'.time().'.'.$ext;
        //         $propertyDocument->image = $documentName;
        //         $propertyDocument->save();

        //         //Large Image
        //         $sourcePath = public_path().'/temp/'.$tempDocumentInfo->name;
        //         $destPath = public_path().'/uploads/property/documents/'.$documentName;
        //         $manager = new ImageManager(new Driver());
        //         $image = $manager->read($sourcePath);
        //         $image->save($destPath);
        //     }
        // }

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
        $propertyImage = PropertyImage::where('property_id',$property->id)->get()->unique('label');   
        $areas = Area::where('city_id',$property->city_id)->get();        

        //Fetch Related properties
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

        //Fetch Facings
        $relatedFacings = [];
        if ($property->related_facings != '') {
            $facingsArray = explode(',',$property->related_facings);
            $relatedFacings = Amenity::whereIn('id',$facingsArray)->get();
        }

        $data = [];
        $categories = Category::orderBy('name','ASC')->get();
        $saleTypes = SaleType::orderBy('title','ASC')->get();  
        $cities = City::orderBy('name','ASC')->get();
        $areas = Area::orderBy('name','ASC')->get();        
        $builders = Builder::orderBy('name','ASC')->get();
        $rooms = Room::orderBy('title','ASC')->get();        
        $bathrooms = Bathroom::orderBy('title','ASC')->get();        
        $views = View::orderBy('title','ASC')->get();    
        $categories = Category::orderBy('name','ASC')->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->get();

        $data['categories'] = $categories;
        $data['saleTypes'] = $saleTypes;
        $data['propertyTypes'] = $propertyTypes;
        $data['cities'] = $cities;
        $data['areas'] = $areas;
        $data['views'] = $views;
        $data['rooms'] = $rooms;
        $data['bathrooms'] = $bathrooms;
        $data['builders'] = $builders;
        $data['property'] = $property;
        $data['propertyImage'] = $propertyImage;
        $data['relatedProperties'] = $relatedProperties;
        $data['relatedAmenities'] = $relatedAmenities;  
        $data['relatedFacings'] = $relatedFacings;  
        $data['relatedFacings'] = $relatedFacings;

        
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
        $propertyImage = PropertyImage::where('property_id',$property->id)->get();   

        if ($validator->passes()) {
            $property->title = $request->title;
            $property->slug = $request->slug;            
            $property->category_id = $request->category;
            $property->room_id = $request->room;  
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->builder_id = $request->builder;           
            $property->sale_type_id = $request->saleType;
            $property->property_type_id = $request->propertyType;
            $property->view_id = $request->view;     
            $property->price = $request->price;
            $property->compare_price = $request->compare_price;            
            $property->description = $request->description;  
            $property->keywords = $request->keywords;
            $property->location = $request->location;
            $property->size = $request->size;
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;  
            $property->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';
            $property->related_facings = (!empty($request->related_facings)) ? implode(',',$request->related_facings) : '';            
            $property->related_amenities = (!empty($request->related_amenities)) ? implode(',',$request->related_amenities) : '';
            $property->bathroom_id = $request->bathroom;
            $property->is_featured = $request->is_featured;
            $property->construction_id = $request->construction;
            $property->age_id = $request->age;
            $property->amenity_id = $request->amenity;
            $property->listed_type_id = $request->listed_type; 
            $property->status = $request->status;
            $property->save();

            if (!empty($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {
                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);
    
                    $propertyImage = new PropertyImage();
                    $propertyImage->property_id = $property->id;
                    $propertyImage->image = "NULL";
                    $propertyImage->save();
    
                    $imageName = $property->id.'-'.$property->title.'-'.time().'.'.$ext;
                    $propertyImage->image = $imageName;
                    $propertyImage->save();
    
                    //Large Image
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/property/large/'.$imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->resize(1300,731, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($destPath);
    
                    //Generate Thumnail
                    $destPath = public_path().'/uploads/property/small/'.$imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->cover(488,326);
                    $image->save($destPath);
                }
            }

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



    //Similar Rooms 
    public function similar_rooms(Request $request){
        $tempRooms = [];
        if($request->term != ""){
            $rooms = Room::where('title','like','%'.$request->term.'%')->get();
            if ($rooms != null){
                foreach ($rooms as $value){
                    $tempRooms[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempRooms,
            'status' => true,
        ]);
    }


    
    //Similar Rooms 
    public function similar_bathrooms(Request $request){
        $tempBathrooms = [];
        if($request->term != ""){
            $bathrooms = Bathroom::where('title','like','%'.$request->term.'%')->get();
            if ($bathrooms != null){
                foreach ($bathrooms as $value){
                    $tempBathrooms[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempBathrooms,
            'status' => true,
        ]);
    }

    //Similar Facings 
    public function similar_facings(Request $request){
        $tempFacings = [];
        if($request->term != ""){
            $facings = View::where('title','like','%'.$request->term.'%')->get();
            if ($facings != null){
                foreach ($facings as $value){
                    $tempFacings[] = array(
                        'id' => $value->id,
                        'text' => $value->title,
                    );
                }
            }
        }
        return response()->json([
            'tags' => $tempFacings,
            'status' => true,
        ]);
    }



    

    public function removeSavedProperty(Request $request) {
        $savedJob = SavedProperty::where(['id' => $request->id,'user_id' => Auth::user()->id])->first();

        if($savedJob == null) {
            session()->flash('error','Property not found');
            return response()->json([
                'status' => false,
            ]);
        }

        SavedProperty::find($request->id)->delete();
        session()->flash('success','Property removed successfully.');

        return response()->json([
            'status' => true,
        ]);
    }

    //Remove Property
    public function removeProperty(Request $request) {
        $PropertyApplication = PropertyApplication::where([
            'id' => $request->id,
            'user_id' => Auth::id() // ensure it belongs to logged-in user
        ])->first();

        if ($PropertyApplication == null) {
            session()->flash('error','Property interest not found');
            return response()->json([
                'status' => false,
            ]);
        }
        
        $PropertyApplication->delete();

        session()->flash('success','Property interest removed successfully.');
        return response()->json([
            'status' => true,
        ]);
    }



  

    //Saved
    public function savedProperties(Request $request){
        $saved = SavedProperty::where(['user_id' => Auth::user()->id])
                                ->with(['property','property.saleType','property.applications'])
                                ->orderBy('created_at','DESC')->paginate(10);

        $counts = SavedProperty::where('user_id', auth()->id())->count();

        return view('admin.property.saved',[
            'saved' => $saved,
            'counts' => $counts,
        ]);
    }


    //Interested
    public function interested(Request $request){
        $interested = PropertyApplication::where('user_id',Auth::user()->id)
                    ->with(['property','property.saleType','property.applications'])
                    ->orderBy('created_at','DESC')
                    ->paginate(10);

        $counts = PropertyApplication::where('user_id', auth()->id())->count();

        return view('admin.property.interested',[
            'interested' => $interested,
            'counts' => $counts,
        ]);
    }
}
