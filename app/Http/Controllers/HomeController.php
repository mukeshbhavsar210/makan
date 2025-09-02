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
use App\Models\VisitedProperty;

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
        $categoryWord = null;

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
        
        $saveCount = [];
        if (Auth::check()) {
            $savedProperties = SavedProperty::where('user_id', Auth::id())
                ->pluck('property_id')
                ->toArray();
            foreach ($properties as $property) {
                $saveCount[$property->id] = in_array($property->id, $savedProperties) ? 1 : 0;
            }
        }
            
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
            'saveCount' => $saveCount,
        ];        

        return view('front.home.results.listings', $data);
    }



    public function show($propertyUrl, Request $request) {
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();    
        $citySelected = $request->filled('city') ? \App\Models\City::where('slug', $request->city)->first() : null;
        $areaSelected = $request->filled('area') ? \App\Models\Area::where('slug', $request->area)->first() : null;
        $selectedAreas = $request->filled('area') ? \App\Models\Area::where('slug', $request->area)->first() : null;
        $categoryWord = null;

        $parts = explode('-', $propertyUrl);

        if(count($parts) < 4){
            abort(404);
        }

        $category = array_shift($parts);   // first = buy
        $citySlug = array_pop($parts);     // last = ahmedabad
        $areaSlug = array_pop($parts);     // second last = chandkheda
        $id = array_pop($parts);           // third last = 44
        $slug = implode('-', $parts);      // remaining = shlok-heights

        // Fetch city & area
        $city = City::where('slug', $citySlug)->firstOrFail();
        $area = Area::where('slug', $areaSlug)->firstOrFail();

        // Fetch property
        $property = Property::with(['city','area','property_images'])
            ->where('id', $id)
            ->where('slug', $slug)
            ->where('category', $category)
            ->where('city_id', $city->id)
            ->where('area_id', $area->id)
            ->firstOrFail();

        // Saved property
        $saveCount = 0;
        if(Auth::check()){
            $saveCount = SavedProperty::where('user_id', Auth::id())
                ->where('property_id', $property->id)
                ->exists() ? 1 : 0;
        }

        // Interested count
        $interestedCount = 0;
        if(Auth::check()){
            $interestedCount = PropertyApplication::where([
                'user_id'=>Auth::id(),
                'property_id'=>$id
            ])->count();
        }

        // Applicants
        $applications = PropertyApplication::where('property_id',$id)->with('user')->get();

        // Related properties
        $relatedProperties = [];
        if($property->related_properties != ''){
            $propertyArray = explode(',',$property->related_properties);
            $relatedProperties = Property::whereIn('id',$propertyArray)
                ->where('status',1)
                ->with('property_images')
                ->get();
        }

        return view('front.home.details.index', compact(
            'property',
            'relatedProperties',
            'saveCount',
            'interestedCount',
            'applications',
            'cities',
            'areas',
            'citySelected',
            'selectedAreas',
            'categoryWord'
        ));
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
        $popertyApplicationCount = PropertyApplication::where([
            'user_id' => Auth::user()->id,
            'property_id' => $id,
        ])->count();

        if($popertyApplicationCount > 0){
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
    public function saveProperty(Request $request) {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }

        $propertyId = $request->property_id;
        $userId = Auth::id();

        $saved = SavedProperty::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->first();

        if ($saved) {
            $saved->delete();
            return response()->json(['status' => 'removed']);
        }

        SavedProperty::create([
            'user_id' => $userId,
            'property_id' => $propertyId,
        ]);

        return response()->json(['status' => 'saved']);
    }






    //VISITED PROPERTY
    public function visitedProperty(Request $request) {
        $id = $request->id;
        $property = Property::find($id);

        if (!$property) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found'
            ]);
        }

        // Check if user already visited this property
        $count = VisitedProperty::where([
            'user_id' => Auth::id(),
            'property_id' => $id,
        ])->count();

        if ($count > 0) {
            return response()->json([
                'status' => false,
                'message' => 'You already visited this property.'
            ]);
        }

        $visit = new VisitedProperty();
        $visit->property_id = $id;
        $visit->user_id = Auth::id();
        $visit->save();

        return response()->json([
            'status' => true,
            'message' => 'You have visited this property.'
        ]);
    }

}
