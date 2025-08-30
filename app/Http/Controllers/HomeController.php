<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Builder;
use Illuminate\Support\Facades\Mail;
use App\Models\JobApplication;
use App\Models\PropertyApplication;
use App\Models\SavedProperty;
use App\Models\User;

class HomeController extends Controller {
    public function index(Request $request){        
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();                
        $featuredJobs = Property::where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        $latestJobs = Property::where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        $properties = Property::where('status',1);              

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
            'cities' => $cities,
            'areas' => $areas,
            'properties' => $properties,  
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,            
        ];

        return view('front.home.index', $data);
    }


    public function getAreas($city_id) {
        $areas = Area::where('city_id', $city_id)->get(['id', 'name', 'slug']); 
        return response()->json($areas);
    }
    


    
    public function properties(Request $request) {
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();    
        $users = User::select('id', 'name', 'role')->get();                    
        $cityId = $request->get('city');
        $areaId = $request->get('area');
        $roomIds = $request->get('room', []);
        $properties = Property::with('property_images')->where('status',1);                    
        $citySelected = $request->filled('city') ? \App\Models\City::where('slug', $request->city)->first() : null;
        $areaSelected = $request->filled('area') ? \App\Models\Area::where('slug', $request->area)->first() : null;
        $selectedAreas = $request->filled('area') ? \App\Models\Area::where('slug', $request->area)->first() : null;

        $city = null;
        $areas = collect();
        $area = null;

        if ($request->filled('city')) {
            $city = \App\Models\City::where('slug', strtolower($request->city))->first();
        }

        if ($request->filled('area')) {
            $areaSlugs = (array) $request->area;
            $areas = \App\Models\Area::whereIn('slug', array_map('strtolower', $areaSlugs))->get();
        }

        if ($cityId) {
            $city = City::find($cityId);
        }

        if ($areaId) {
            $area = Area::find($areaId);
        }
        
        $categoryWord = null;

        //Filter using category               
         if (!empty($request->category)) {
            $properties = $properties->where('category', $request->category);
        }

        //Filter using city
        if ($request->city) {
            $city = City::where('slug', strtolower($request->city))->first();
            if ($city) {
                $properties = $properties->where('city_id', $city->id);
            }
        }

        //Filter using areas
        if ($request->filled('area')) {
            $areaSlugs = (array) $request->area; // always treat as array
            $areas = \App\Models\Area::whereIn('slug', array_map('strtolower', $areaSlugs))->pluck('id');

            if ($areas->count() > 0) {
                $properties = $properties->whereIn('area_id', $areas);
            }
        }


        // if ($request->filled('area')) {
        //     if (is_array($request->area)) {
        //         $properties->whereIn('area_id', $request->area);
        //     } else {
        //         $properties->where('area_id', $request->area);
        //     }
        // }

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
        if (!empty($request->property_type) && is_array($request->property_type)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ($request->property_type as $type) {
                    $query->orWhereJsonContains('property_types', strtolower($type));
                }
            });
        }

        //Filter using Room Working
        if (!empty($request->room) && is_array($request->room)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ($request->room as $roomTitle) {
                    $query->orWhereJsonContains('rooms', ['title' => $roomTitle]);
                }
            });
        }

        //Filter using Bathrooms working
        if (!empty($request->bathroom) && is_array($request->bathroom)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ($request->bathroom as $bathroom) {
                    $query->orWhereJsonContains('bathrooms', strtolower($bathroom));
                }
            });
        }


        //Filter using Facings working
        if (!empty($request->facing) && is_array($request->facing)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ($request->facing as $facing) {
                    $query->orWhereJsonContains('facings', strtolower($facing));
                }
            });
        }

        //Filter using Amenities
        if (!empty($request->amenities) && is_array($request->amenities)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ($request->amenities as $amenity) {
                    $query->orWhereJsonContains('amenities', strtolower($amenity));
                }
            });
        }
      

        //Filter using Listed Types working
        // if (!empty($request->listed_type) && is_array($request->listed_type)) {
        //     $properties = $properties->whereIn('listed_type_id', $request->listed_type);
        // } 
       
        //Filter using Sale Types
        if (!empty($request->saletype)) {
            if (is_array($request->saletype)) {
                $properties = $properties->whereIn('sale_types', $request->saletype);
            } else {
                $properties = $properties->where('sale_types', $request->saletype);
            }
        }

        //Filter using Posted By User
        if ($request->filled('posted_by')) {
            $properties = $properties->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->posted_by);
            });
        }
      
        //Filter using Constructions
        if (!empty($request->construction)) {
            if (is_array($request->construction)) {
                $properties = $properties->whereIn('construction_types', $request->construction);
            } else {
                $properties = $properties->where('construction_types', $request->construction);
            }
        }     

        //Filter using Constructions
        if (!empty($request->age)) {
            if (is_array($request->age)) {
                $properties = $properties->whereIn('property_age', $request->age);
            } else {
                $properties = $properties->where('property_age', $request->age);
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
            'cities' => $cities,
            'areas' => $areas,
            'users' => $users,
            'citySelected' => $citySelected,
            'areaSelected' => $areaSelected,
            'selectedAreas' => $selectedAreas,
            'area' => $area,
            'categoryWord' => $categoryWord,
            'savedPropertyIds' => $savedPropertyIds,            
        ];        

        return view('front.home.results.listings', $data);
    }



    public function propertyDetails($id){
        $properties = Property::with('property_images')->first();
        $property = Property::where([
            'id' => $id,
            'status' => 1,
        ])->first();
        
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
        // $relatedAmenities = [];
        // if ($property->related_amenities != '') {
        //     $amenityArray = explode(',',$property->related_amenities);
        //     $relatedAmenities = Amenity::whereIn('id',$amenityArray)->where('status',1)->get();
        // }
       
        //Rooms
        // $relatedFacings = [];
        // if ($property->related_facings != '') {
        //     $facingsArray = explode(',',$property->related_facings);
        //     $relatedFacings = View::whereIn('id',$facingsArray)->where('status',1)->get();
        // }

        $data['property'] = $property;
        $data['relatedProperties'] = $relatedProperties;
        //$data['relatedAmenities'] = $relatedAmenities;
        //$data['relatedFacings'] = $relatedFacings;
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
