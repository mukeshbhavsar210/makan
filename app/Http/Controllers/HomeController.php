<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\JobApplication;
use App\Models\PropertyApplication;
use App\Models\SavedProperty;
use App\Models\User;
use App\Models\VisitedProperty;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller {
    public function index(Request $request){        
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();                
        $featuredJobs = Property::where('verification','approved')->orderBy('created_at','DESC')->take(6)->get();
        $latestJobs = Property::where('verification','approved')->orderBy('created_at','DESC')->take(6)->get();
        $properties = Property::where('verification','approved');

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
        $properties = Property::with('property_images')
                    ->orderByRaw("
                        CASE 
                            WHEN plan_id = (SELECT id FROM plans WHERE name = 'Diamond' LIMIT 1) THEN 1
                            WHEN plan_id = (SELECT id FROM plans WHERE name = 'Gold' LIMIT 1) THEN 2
                            ELSE 3
                        END ASC
                    ")
                    ->orderBy('created_at', 'desc')->where('verification','approved');                            
        
        

        if ($request->filled('city')) {
            $city = \App\Models\City::where('slug', strtolower($request->city))->first();
        }

        if ($request->filled('area')) {
            $areaSlugs = (array) $request->area;
            $areas = \App\Models\Area::whereIn('slug', array_map('strtolower', $areaSlugs))->get();
        }

        //Filter using category               
        if (!empty($request->category)) {
            $properties = $properties->where('category', $request->category);
        }

        //Filter using residence_types               
        if (!empty($request->residence_types)) {
            $properties = $properties->where('residence_types', $request->residence_types);
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
        if (!empty($request->property_type)) {
            $properties = $properties->where(function ($query) use ($request) {
                foreach ((array) $request->property_type as $type) {
                    $query->orWhereRaw("FIND_IN_SET(?, property_types)", [strtolower($type)]);
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
                
        // ✅ Apply price filter if present
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $min = (int) $request->price_min;
            $max = (int) $request->price_max;

            $properties->where(function ($query) use ($min, $max) {
                $query->whereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[0].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[1].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[2].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[3].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[4].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[5].price'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[6].price'))"), [$min, $max]);
                    // add more indexes if needed
            });
        }

        // ✅ Apply size filter if present
        if ($request->filled('size_min') && $request->filled('size_max')) {
            $min = (int) $request->size_min;
            $max = (int) $request->size_max;

            $properties->where(function ($query) use ($min, $max) {
                $query->whereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[0].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[1].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[2].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[3].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[4].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[5].size'))"), [$min, $max])
                    ->orWhereBetween(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(rooms, '$[6].size'))"), [$min, $max]);
                    // add more indexes if needed
            });
        }
               
        $savedPropertyIds = [];
        if (Auth::check()) {
            $savedPropertyIds = SavedProperty::where('user_id', Auth::id())
                ->pluck('property_id')
                ->toArray();
        }
        
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
            'savedPropertyIds' => $savedPropertyIds,
            'saveCount' => $saveCount,
            
        ];        

        return view('front.home.results.listings', $data);
    }



    public function details($propertyUrl, Request $request) {  
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();    
        $properties = Property::with('property_images')->get();
        $citySelected = $request->filled('city') ? City::where('slug', $request->city)->first() : null;
        $areaSelected = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
        $selectedAreas = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
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
        $property = Property::with(['city','area','property_details_images' => function ($q) use ($id) {
                        $q->where('property_id', $id)->latest()->take(3);
                    },
            ])
             ->withCount([
                    'property_details_images as total_property_images' => function ($q) use ($id) {
                        $q->where('property_id', $id);
                    }
                ])
            ->where('verification', 'approved')
            ->where('id', $id)
            ->where('slug', $slug)
            ->where('category', $category)
            ->where('city_id', $city->id)
            ->where('area_id', $area->id)
            ->firstOrFail();

        // ✅ Store seen properties in session
        $seen = session()->get('seen_properties', []);
        if (!in_array($property->id, $seen)) {
            $seen[] = $property->id;
            session()->put('seen_properties', $seen);
        }

        $citySelected = $property->city;
        $selectedAreas = $property->area;
        $areaSelected = $property->area;

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
                ->where('verification', 'approved')
                ->with('property_images')
                ->get();
        }

         //Session stored properties
        preg_match('/-(\d+)-/', $propertyUrl, $matches);
        $propertyId = $matches[1] ?? null;
        if(!$propertyId) abort(404);
        $property = Property::with('property_images', 'area', 'city')->findOrFail($propertyId);

        $seenProperties = session('seen_properties', []);

        if(isset($seenProperties[$propertyId])){
            $seenProperties[$propertyId]++;
        } else {
            $seenProperties[$propertyId] = 1;
        }

        session(['seen_properties' => $seenProperties]);

        return view('front.home.details.index', compact(
            'property',
            'properties',
            'relatedProperties',
            'saveCount',
            'interestedCount',
            'applications',
            'cities',
            'areas',
            'citySelected',
            'areaSelected',
            'selectedAreas',
            'categoryWord',            
        ));
    }


    public function userProperties($category, $name, $id, Request $request) {
        $user = User::findOrFail($id);

        // Get only this user's properties
        $properties = Property::where('user_id', $id)->where('category', $category)->with('property_images')->latest()->paginate(12);

        // total property count
        $propertyCount = Property::where('user_id', $id)->where('category', $category)->count();

        // Filters (if you need them later)
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();    
        $citySelected = $request->filled('city') ? City::where('slug', $request->city)->first() : null;
        $areaSelected = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
        $selectedAreas = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
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

        return view('front.home.results.user-listing', compact(
            'user', 
            'properties', 
            'cities',
            'areas',
            'area',
            'citySelected',
            'areaSelected',
            'selectedAreas',
            'categoryWord',
            'propertyCount',
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
