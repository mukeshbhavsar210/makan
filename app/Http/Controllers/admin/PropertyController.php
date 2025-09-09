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
use App\Models\SavedProperty;
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
            $counts = Property::withCount('visitedUsers')->where('status', 1)->count(); // all active properties
        } else {
            $properties = Property::query()
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->orderBy('created_at','DESC');
            $counts = Property::withCount('visitedUsers')->where('user_id', $user->id)
                ->where('status', 1)
                ->count(); 
        }

        // Search filter
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $properties->where('title', 'like', "%{$keyword}%");
        }

        // Paginate
        $properties = $properties->paginate(10);

        return view('front.property.index', [
            'properties' => $properties,
            'counts' => $counts,
        ]);
    }

    //CREATE PROPERTY
    public function create(){
        $user = auth()->user();

        if ($user->role === 'User' || $user->role === 'Agent' || $user->role === 'Admin') {
            $builders = Builder::orderBy('developer_name','ASC')->get();
            $builder = null;
        } elseif ($user->role === 'Builder') {
            $builders = collect(); 
            $builder = Builder::where('user_id', $user->id)->first();
        } else {
            $builders = collect();
            $builder = null;
        }

        $data = [];
        $user = auth()->user();
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $relatedProperties = Property::where('status',1)->get();   
        
        $data = [ 
            'user' => $user,
            'cities' => $cities,
            'areas' => $areas,            
            'builder' => $builder,
            'builders' => $builders,
            'relatedProperties' => $relatedProperties,
        ];
        return view('front.property.create.index', $data);
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
            $property->category = $request->category;
            $property->sale_types = $request->sale_types;
            $property->furnish_types = $request->furnish_types;
            $property->construction_types = $request->construction_types;
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->description = $request->description;  
            $property->keywords = $request->keywords;
            $property->location = $request->location;            
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;
            $property->towers = $request->towers;
            $property->units = $request->units;
            $property->brokerage = $request->brokerage;            

            $fields = [
                'rooms_json'             => 'rooms',
                'bathrooms_json'         => 'bathrooms',
                'property_types_json'    => 'property_types',
                'amenities_json'         => 'amenities',
                'furnishing_json'        => 'furnishing',
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
                            continue; 
                        }

                        $extArray = explode('.', $tempImageInfo->name);
                        $ext = last($extArray);

                        $propertyImage = new PropertyImage();
                        $propertyImage->property_id = $property->id;
                        $propertyImage->image = "NULL";
                        $propertyImage->label = $label; // save enum label
                        $propertyImage->save();

                        $imageName = $property->slug . '_' .$property->id . '_' . time() . '.' . $ext;
                        $propertyImage->image = $imageName;
                        $propertyImage->save();

                        // Large Image
                        $sourcePath = public_path() . '/temp/' . $tempImageInfo->name;
                        $destPath = public_path() . '/uploads/property/' . $imageName;
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($sourcePath);
                        $image->resize(900, 600, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize(); 
                        });
                        $image->save($destPath);
                        $image->toJpeg(100)->save($destPath);

                        // Thumbnail
                        $destPath = public_path() . '/uploads/property/thumb/' . $imageName;
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($sourcePath);
                        $image->cover(300, 300);
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
        $user = auth()->user();
        $property = Property::find($id);        

        if (empty($property)) {
            return redirect()->route('properties.index')->with('error','Property not found');
        }

        $relatedProperties = Property::where('id', '!=', $property->id)->get();

        //Fetch Product Images
        $propertyImage = PropertyImage::where('property_id',$property->id)->get()->unique('label');   
        $areas = Area::where('city_id',$property->city_id)->get();    
        
        if ($user->role === 'User' || $user->role === 'Agent' || $user->role === 'Admin') {
            $builders = Builder::orderBy('developer_name','ASC')->get();
            $builder = null;
        } elseif ($user->role === 'Builder') {
            $builders = collect(); 
            $builder = Builder::where('user_id', $user->id)->first();
        } else {
            $builders = collect();
            $builder = null;
        }

        $data = [];
        $user = auth()->user();
        $cities = City::orderBy('name','ASC')->get();
        $areas = Area::orderBy('name','ASC')->get();        
        $builders = Builder::orderBy('developer_name','ASC')->get();

        $data['user'] = $user;
        $data['cities'] = $cities;
        $data['areas'] = $areas;
        $data['builders'] = $builders;
        $data['builder'] = $builder;
        $data['property'] = $property;
        $data['propertyImage'] = $propertyImage;
        $data['relatedProperties'] = $relatedProperties; 
    
        return view('front.property.edit.index',$data);
    }



    public function update($id, Request $request) {
        $property = Property::findOrFail($id);
       
        $rules = [
            'title'       => 'required',
            'slug'        => 'required|unique:properties,slug,'.$property->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->passes()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }        

        // update main fields
        $property->fill($request->only([
            'title','slug','residence_types','category','property_types','furnish_types','sale_types','construction_types','rooms','bathrooms',
            'user_id','property_age','facings', 'city_id','area_id','description','keywords','location','rera',
            'year_build','total_area','towers','units','related_properties','amenities','furnishing','possession_date','brokerage','status'            
        ]));

        // Handle builder separately
        if (Auth::user()->role === 'Builder') {
            // Always force logged-in builder
            $builder = Builder::where('user_id', Auth::id())->first();
            if ($builder) {
                $property->builder_id = $builder->id;
            }
        } else {
            // Admin, User, Agent → use selected dropdown value
            if ($request->filled('builder')) {
                $property->builder_id = $request->builder;
            } else {
                $property->builder_id = null; // if none selected
            }
        }

        // handle json fields
        $jsonFields = [
            'rooms_json'              => 'rooms',
            'bathrooms_json'          => 'bathrooms',
            'amenities_json'          => 'amenities',
            'furnishing_json'         => 'furnishing',
            'facings_json'            => 'facings',
            'related_properties_json' => 'related_properties',
        ];
        foreach ($jsonFields as $requestKey => $propertyKey) {
            if ($request->has($requestKey)) {
                $property->$propertyKey = $request->$requestKey;
            }
        }
        $property->save();

        //update image labels
        $labelOrder = [
            'Main'      => 1,
            'Video'     => 2,
            'Elevation' => 3,
            'Bedroom'   => 4,
            'Living'    => 5,
            'Balcony'   => 6,
            'Amenities' => 7,
            'Floor'     => 8,
            'Location'  => 9,
            'Cluster'   => 10,
        ];

        if ($request->has('image_array')) {
            foreach ($request->image_array as $id => $data) {
                $propertyImage = PropertyImage::find($id);
                if ($propertyImage) {
                    $label = $data['label'] ?? null;

                    // Update only this image’s label + order
                    $propertyImage->label = $label;
                    if ($label && isset($labelOrder[$label])) {
                        $propertyImage->order = $labelOrder[$label];
                    }

                    $propertyImage->save();
                }
            }
        }

        $request->session()->flash('success', 'Property updated successfully');

        return response()->json([
            'status'  => true,
            'message' => 'Property updated successfully'
        ]);
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
        
        return view('front.property.saved',[
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

        return view('front.property.interested', [
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
    
}
