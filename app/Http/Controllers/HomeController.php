<?php

namespace App\Http\Controllers;

use App\Models\Age;
use App\Models\Amenity;
use App\Models\Bathroom;
use App\Models\Category;
use App\Models\Property;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Builder;
use App\Models\Construction;
use Illuminate\Support\Facades\Mail;
use App\Models\JobApplication;
use App\Models\ListedType;
use App\Models\PropertyApplication;
use App\Models\PropertyType;
use App\Models\Room;
use App\Models\SaleType;
use App\Models\SavedProperty;
use App\Models\User;
use App\Models\View;

class HomeController extends Controller {
    public function index(Request $request){
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();        
        $newCategories = Category::where('status',1)->orderBy('name','ASC')->get();
        $featuredJobs = Property::where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        //$featuredJobs = Property::where('status',1)->orderBy('created_at','DESC')->with('jobType')->where('isFeatured','Yes')->take(6)->get();
        $latestJobs = Property::where('status',1)->orderBy('created_at','DESC')->with('amenityType')->take(6)->get();
        $types = PropertyType::where('status',1)->get();
        $properties = Property::where('status',1);
        $jobTypes = Builder::where('status',1)->get();        

        //Filter using keyword
        // if(!empty($request->keyword)){
        //     $properties = $properties->where(function($query) use ($request){
        //         $query->orWhere('title','like','%'.$request->keyword.'%');
        //         $query->orWhere('keywords','like','%'.$request->keyword.'%');
        //         $query->orWhere('location','like','%'.$request->keyword.'%');
        //     });
        // }  
        
        //Filter using city
        if(!empty($request->city)){            
            $properties = $properties->where('city_id',$request->city);
        }

         //Filter using area
        if (!empty($request->area) && is_array($request->area)) {            
            $properties = $properties->whereIn('area_id', $request->area);
        }        

        $properties = $properties->paginate(10);

        $data = [
            'categories' => $categories,
            'cities' => $cities,
            'areas' => $areas,
            'types' => $types,
            'jobTypes' => $jobTypes,
            'properties' => $properties,  
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories,
        ];

        return view('front.home.index', $data);
    }


    public function getAreas($city_id) {
        $areas = Area::where('city_id', $city_id)->get();
        return response()->json($areas);
    }
    

    
    public function properties(Request $request) {
        $categories = Category::get();
           
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();
        $rooms = Room::where('status',1)->get();
        $bathrooms = Bathroom::where('status',1)->get();
        $listedTypes = ListedType::where('status',1)->get();
        $saletypes = SaleType::where('status',1)->get();
        $constructions = Construction::where('status',1)->get();
        $facings = View::where('status',1)->get();
        $ages = Age::where('status',1)->get();                           
        $categoryId = $request->get('category');
        $cityId = $request->get('city');
        $areaId = $request->get('area');
        $roomIds = $request->get('room', []);
        $properties = Property::with('amenities')->with('property_images')->where('status',1);        
        $propertyTypes = PropertyType::where('status',1)->get();          
        $citySelected = $request->filled('city') ? \App\Models\City::find($request->city) : null;
        $areaSelected = $request->filled('area') ? \App\Models\Area::find($request->area) : null;

        $room = null;
        if (!empty($roomIds)) {
            $room = Room::find((int) $roomIds[0]); // take only the first selected room
        }

        $city = null;
        $area = null;

        if ($cityId) {
            $city = City::find($cityId);
        }

        if ($areaId) {
            $area = Area::find($areaId);
        }

        // Fetch city/area/category/room details for breadcrumb       
        $room = !empty($request->room) ? Room::find($request->room[0]) : null;

        $categoryWord = null;

        if ($categoryId) {
            $map = [
                21 => 'Sale',
                27 => 'Rent',
            ];
            $categoryWord = $map[$categoryId] ?? null;
        }        

        //Filter using category
        if(!empty($request->category)){
            $properties = $properties->where('category_id',$request->category);
        }

        //Filter using city
        if(!empty($request->city)){            
            $properties = $properties->where('city_id',$request->city);
        }  

        if ($request->filled('area')) {
            if (is_array($request->area)) {
                // Multiple areas (property listing page)
                $properties->whereIn('area_id', $request->area);
            } else {
                // Single area (home page)
                $properties->where('area_id', $request->area);
            }
        }

        // $city = null;
        // if ($request->filled('city')) {
        //     $city = \App\Models\City::find($request->city);
        // }

        //Filter using area selected
        // $areas = Area::query();
        // if ($request->has('city') && !empty($request->city)) {
        //     $areas->where('city_id', $request->city);
        // }
        // $areas = $areas->get();

        //Filter using keyword
        if (!empty($request->keyword)) {
            $properties = $properties->where(function($query) use ($request) {
                $query->orWhere('title', 'like', '%'.$request->keyword.'%')
                    ->orWhere('keywords', 'like', '%'.$request->keyword.'%')
                    ->orWhere('location', 'like', '%'.$request->keyword.'%')
                    ->orWhere('description', 'like', '%'.$request->keyword.'%')
                    ->orWhereHas('builder', function($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->keyword.'%');
                    });
            });
        }

         //Filter using property types working
        if (!empty($request->type) && is_array($request->type)) {
            $properties = $properties->whereIn('property_type_id', $request->type);
        }        

        //Filter using Room Working
        if (!empty($request->room) && is_array($request->room)) {
            $properties = $properties->whereIn('room_id', $request->room);
        }

        //Filter using Bathrooms working
        if (!empty($request->bathroom) && is_array($request->bathroom)) {
            $properties = $properties->whereIn('bathroom_id', $request->bathroom);
        } 

        //Filter using Amenities
        $properties = $properties->with('amenities')->where('status', 1);

        if (!empty($request->amenities)) {
            $amenities = is_array($request->amenities) 
                ? $request->amenities 
                : explode(',', $request->amenities);

            $properties = $properties->whereHas('amenities', function ($q) use ($amenities) {
                $q->whereIn('amenities.id', $amenities);
            });
        }


        //Filter using Listed Types working
        if (!empty($request->listed_type) && is_array($request->listed_type)) {
            $properties = $properties->whereIn('listed_type_id', $request->listed_type);
        } 

        //Filter using Facing working
        if (!empty($request->facing) && is_array($request->facing)) {
            $properties = $properties->whereIn('view_id', $request->facing);
        } 

        //Filter using Sale Types
        if (!empty($request->saletype)) {
            if (is_array($request->saletype)) {
                $properties = $properties->whereIn('sale_type_id', $request->saletype);
            } else {
                $properties = $properties->where('sale_type_id', $request->saletype);
            }
        }

        //Filter using Constructions
        if (!empty($request->construction)) {
            if (is_array($request->construction)) {
                $properties = $properties->whereIn('construction_id', $request->construction);
            } else {
                $properties = $properties->where('construction_id', $request->construction);
            }
        }

        //Filter using Property Age
        if (!empty($request->age)) {
            if (is_array($request->age)) {
                $properties = $properties->whereIn('age_id', $request->age);
            } else {
                $properties = $properties->where('age_id', $request->age);
            }
        }

        // Price slider working
        if($request->get('price_max') != '' && $request->get('price_min') != '') {
            if($request->get('price_max') == 100000000){
                $properties = $properties->whereBetween('price',[intval($request->get('price_min')),1000000]);
            } else {
                $properties = $properties->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
            }
        }

        // Size range working
        if($request->get('size_max') != '' && $request->get('size_min') != '') {
            if($request->get('size_max') == 1000){
                $properties = $properties->whereBetween('size',[intval($request->get('size_min')),1000]);
            } else {
                $properties = $properties->whereBetween('size',[intval($request->get('size_min')),intval($request->get('size_max'))]);
            }
        }        

        //Filter using Status
        // if (!empty($request->status) && is_array($request->status)) {
        //     $properties = $properties->whereIn('status', $request->status);
        // }

        //Filter using job_type
        // $jobTypeArray = [];
        // if(!empty($request->jobType)){
        //     $jobTypeArray = explode(',',$request->jobType);
        //     $properties = $properties->whereIn('related_rooms',$jobTypeArray);
        // }  

        // if($request->sort == '0'){
        //     $properties = $properties->orderBy('created_at','ASC');
        // } else {
        //     $properties = $properties->orderBy('created_at','DESC');
        // }

        //Filter using location
        // if(!empty($request->location)){
        //     $property = $property->where('location',$request->location);            
        // }       

               
        $savedPropertyIds = [];
        if (Auth::check()) {
            $savedPropertyIds = SavedProperty::where('user_id', Auth::id())
                ->pluck('property_id')
                ->toArray();
        }

        $data['priceMax'] = (intval($request->get('price_max')) == 0 ? 1000 : $request->get('price_max'));
        $data['priceMin'] = intval($request->get('price_min'));     
        
        $properties = $properties->paginate(10);       
            
        $data = [
            'properties' => $properties,            
            'categories' => $categories,
            'cities' => $cities,
            'areas' => $areas,
            'propertyTypes' => $propertyTypes,
            'rooms' => $rooms,
            'bathrooms' => $bathrooms,
            'listedTypes' => $listedTypes,
            'saletypes' => $saletypes,
            'constructions' => $constructions,
            'ages' => $ages,
            'facings' => $facings,
            'categoryId' => $categoryId,
            'citySelected' => $citySelected,
            'areaSelected' => $areaSelected,
            'area' => $area,
            'categoryWord' => $categoryWord,
            'room' => $room,
            'savedPropertyIds' => $savedPropertyIds,            
        ];        

        return view('front.home.listings', $data);
    }



    public function propertyDetails($id){
        $properties = Property::with('property_images')->first();
        $property = Property::where([
            'id' => $id,
            'status' => 1,
        ])->with(['room','bathroom','category','city'])->first();
        
        if($property == null){
            abort(404);
        }

        $saveCount = 0;
        if(Auth::user()){
            $saveCount = SavedProperty::where([
                'user_id' => Auth::user()->id,
                'property_id' => $id,
            ])->count();
        }

        $interestedCount = 0;
        if(Auth::user()){
            $interestedCount = PropertyApplication::where([
                'user_id' => Auth::user()->id,
                'property_id' => $id,
            ])->count();
        }

        //Fetch applicants
        $applications = PropertyApplication::where('property_id',$id)->with('user')->get();

        //Related properties
        $relatedProperties = [];
        if ($property->related_properties != '') {
            $propertyArray = explode(',',$property->related_properties);
            $relatedProperties = Property::whereIn('id',$propertyArray)->where('status',1)->with('property_images')->get();
        }
        //Amenities
        $relatedAmenities = [];
        if ($property->related_amenities != '') {
            $amenityArray = explode(',',$property->related_amenities);
            $relatedAmenities = Amenity::whereIn('id',$amenityArray)->where('status',1)->get();
        }
       
        //Rooms
        $relatedFacings = [];
        if ($property->related_facings != '') {
            $facingsArray = explode(',',$property->related_facings);
            $relatedFacings = View::whereIn('id',$facingsArray)->where('status',1)->get();
        }

        $data['property'] = $property;
        $data['relatedProperties'] = $relatedProperties;
        $data['relatedAmenities'] = $relatedAmenities;
        $data['relatedFacings'] = $relatedFacings;
        $data['properties'] = $properties;
        $data['applications'] = $applications;
        $data['saveCount'] = $saveCount; 
        $data['interestedCount'] = $interestedCount; 

        return view('front.home.details.index',$data);       
    }


    //Apply Property
    public function applyProperty(Request $request){
        $id = $request->id;
        $property = Property::where('id',$id)->first();

        //If job not found in database
        $message = 'Property does not exist.';
        if($property == null){
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        //User can not apply on posted own job
        $posted_id = $property->user_id;
        $message = 'You can not apply on your posted property.';

        if($posted_id == Auth::user()->id){
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        //You can not apply more than one time
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'property_id' => $id,
        ])->count();

        if($jobApplicationCount > 0){
            $message = 'You already applied on this property.';
            session()->flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $application = New PropertyApplication();
        $application->property_id = $id;
        $application->user_id = Auth::user()->id;
        $application->posted_id = $posted_id;
        $application->applied_date = now();
        $application->save();

        //Send Notification Email to Employer
        $employer = User::where('id',$posted_id)->first();
        // $mailData = [
        //     'employer' => $employer,
        //     'user' => Auth::user(),
        //     'job' => $job,
        // ];

        //Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        $message = 'You have showing interest in Property.';
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }


    //SAVE PROPERTY
    public function saveProperty(Request $request){
        $id = $request->id;

        $property = Property::find($id);

        if($property == null) {
            $message = 'Property not found';
            session()->flash('error', $message);

            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        //Check if user already saved the job
        $count = SavedProperty::where([
            'user_id' => Auth::user()->id,
            'property_id' => Auth::user()->id,
        ])->count();

        if($count > 0) {
            session()->flash('error', 'You already saved this property.');
            return response()->json([
                'status' => false
            ]);
        }

        $savedJob = new SavedProperty;
        $savedJob->property_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        session()->flash('success', 'You have successfully saved this property.');

        return response()->json([
            'status' => true
        ]);
    }
}
