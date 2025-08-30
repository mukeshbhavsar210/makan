<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Area;
use App\Models\Builder;
use App\Models\PropertyApplication;
use App\Models\PropertyDocument;
use App\Models\View;
use App\Models\SavedProperty;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class PropertyController extends Controller {

    public function index(Request $request) {
        $user = auth()->user();

        // Base query
        if ($user->role === 'Admin') {
            $properties = Property::query()
                ->where('status', 1)
                ->orderBy('created_at','DESC');
            $counts = Property::where('status', 1)->count(); // all active properties
        } else {
            $properties = Property::query()
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->orderBy('created_at','DESC');
            $counts = Property::where('user_id', $user->id)
                ->where('status', 1)
                ->count(); // only this user's active properties
        }

        // Search filter
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $properties->where('title', 'like', "%{$keyword}%");
        }

        // Paginate
        $properties = $properties->paginate(10);

        return view('admin.property.index', [
            'properties' => $properties,
            'counts' => $counts,
        ]);
    }


    //CREATE PROPERTY
    public function create(){
        $data = [];
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('developer_name','ASC')->get();
        $relatedProperties = Property::where('status',1)->get();
        $builder = Builder::where('user_id', Auth::id())->first();

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,            
            'builders' => $builders,
            'relatedProperties' => $relatedProperties,

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

            // also check if logged user has a builder profile
            $builder = Builder::where('user_id', Auth::id())->first();
            if ($builder) {
                $property->builder_id = $builder->id;
            }

            $property->title = $request->title;
            $property->slug = $request->slug;            
            $property->category = $request->category;
            $property->sale_types = $request->sale_types;            
            $property->construction_types = $request->construction_types;
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->description = $request->description;  
            $property->keywords = $request->keywords;
            $property->location = $request->location;
            $property->size = $request->size;
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;
            $property->is_featured = $request->is_featured;            
            $property->status = $request->status;  

            $fields = [
                'rooms_json'             => 'rooms',
                'bathrooms_json'         => 'bathrooms',
                'property_types_json'    => 'property_types',
                'amenities_json'         => 'amenities',
                'facings_json'           => 'facings',
                'related_properties_json'=> 'related_properties',
            ];

            foreach ($fields as $requestKey => $propertyKey) {
                $property->$propertyKey = $request->filled($requestKey) 
                    ? $request->$requestKey 
                    : null;
            }
            
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

        $relatedProperties = Property::where('id', '!=', $property->id)->get();

        //Fetch Product Images
        $propertyImage = PropertyImage::where('property_id',$property->id)->get()->unique('label');   
        $areas = Area::where('city_id',$property->city_id)->get();        

        $data = [];
        $cities = City::orderBy('name','ASC')->get();
        $areas = Area::orderBy('name','ASC')->get();        
        $builders = Builder::orderBy('developer_name','ASC')->get();

        $data['cities'] = $cities;
        $data['areas'] = $areas;
        $data['builders'] = $builders;
        $data['property'] = $property;
        $data['propertyImage'] = $propertyImage;
        $data['relatedProperties'] = $relatedProperties; 
    

        return view('admin.property.edit',$data);
    }



    public function update($id, Request $request){
        $property = Property::find($id);
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:properties,slug,'.$property->id.',id',
            'is_featured' => 'required|in:Yes,No',
        ];
      
        $validator = Validator::make($request->all(),$rules);
        $propertyImage = PropertyImage::where('property_id',$property->id)->get();   

        if ($validator->passes()) {
            $property->title = $request->title;
            $property->slug = $request->slug;            
            $property->category = $request->category;
            $property->sale_types = $request->sale_types;
            $property->construction_types = $request->construction_types;
            $property->property_age = $request->property_age;
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->description = $request->description;  
            $property->keywords = $request->keywords;
            $property->location = $request->location;
            $property->size = $request->size;
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;
            $property->is_featured = $request->is_featured;            
            $property->status = $request->status;  

            $fields = [
                'rooms_json'             => 'rooms',
                'bathrooms_json'         => 'bathrooms',
                'property_types_json'    => 'property_types',
                'amenities_json'         => 'amenities',
                'facings_json'           => 'facings',
                'related_properties_json'=> 'related_properties',
            ];

            foreach ($fields as $requestKey => $propertyKey) {
                if ($request->has($requestKey)) {
                    $property->$propertyKey = $request->$requestKey;
                }
            }


            // foreach ($fields as $requestKey => $propertyKey) {
            //     $property->$propertyKey = $request->filled($requestKey) 
            //         ? $request->$requestKey 
            //         : null;
            // }
            
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


    //Remove Saved Property
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

    //Saved Property
    public function savedProperties(Request $request){
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $savedProperties = SavedProperty::query()->orderBy('created_at','DESC');
            $counts = SavedProperty::count();
        } else {
            $savedProperties = SavedProperty::query()->where('user_id', $user->id)->orderBy('created_at','DESC');
            $counts = SavedProperty::where('user_id', $user->id)->count();
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $savedProperties->where('title', 'like', "%{$keyword}%");
        }

        $savedProperties = $savedProperties->paginate(10);
        
        return view('admin.property.saved',[
            'savedProperties' => $savedProperties,
            'counts' => $counts,            
        ]);
    }

    //Interested
    public function interested(Request $request) {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            $interested = PropertyApplication::query()
                            ->with(['property', 'property.applications', 'property.builder'])
                            ->orderBy('created_at','DESC');

            $counts = PropertyApplication::count();
        } else {
            $interested = PropertyApplication::query()
                            ->where('user_id', $user->id)
                            ->with(['property', 'property.applications', 'property.builder'])
                            ->orderBy('created_at','DESC');

            $counts = PropertyApplication::where('user_id', $user->id)->count();
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $interested->where('property_id', 'like', "%{$keyword}%");
        }

        // ✅ apply paginate only once
        $interested = $interested->paginate(10);

        return view('admin.property.interested', [
            'interested' => $interested,
            'counts'     => $counts,            
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

    
}
