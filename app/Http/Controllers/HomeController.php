<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Bathroom;
use App\Models\Category;
use App\Models\Property;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Builder;
use Illuminate\Support\Facades\Mail;
use App\Models\JobApplication;
use App\Models\PropertyType;
use App\Models\Room;
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
        $types = PropertyType::where('status',1)->get();        
        $properties = Property::where('status',1);
        $jobTypes = Builder::where('status',1)->get();

        //Filter using category
        if(!empty($request->category)){
            $properties = $properties->where('category_id',$request->category);
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
                    // ->orWhereHas('saleType', function($q) use ($request) {
                    //     $q->where('name', 'like', '%'.$request->keyword.'%');
                    // });
            });
        }



        //Filter using location
        // if(!empty($request->location)){
        //     $property = $property->where('location',$request->location);            
        // }       

        if(!empty($request->city)){            
            $properties = $properties->where('city_id',$request->city);
        }        

        //Filter using property types
        if (!empty($request->type) && is_array($request->type)) {
            $properties = $properties->whereIn('property_type_id', $request->type);
        }

        //Filter using area
        if (!empty($request->area) && is_array($request->area)) {            
            $properties = $properties->whereIn('area_id', $request->area);
        }
        
        //Filter using area selected
        $areas = Area::query();
        if ($request->has('city') && !empty($request->city)) {
            $areas->where('city_id', $request->city);
        }
        $areas = $areas->get();


        // Filter by area
        if ($request->filled('area')) {
            $properties->where('area_id', $request->area);
        }

        //Filter using Room
        if (!empty($request->room) && is_array($request->room)) {
            $properties = $properties->whereIn('room_id', $request->room);
        }

        //Filter using Bathrooms
        if (!empty($request->bathroom) && is_array($request->bathroom)) {
            $properties = $properties->whereIn('bathroom_id', $request->bathroom);
        }        

        //Filter using job_type
        $jobTypeArray = [];
        if(!empty($request->jobType)){
            $jobTypeArray = explode(',',$request->jobType);
            $properties = $properties->whereIn('related_rooms',$jobTypeArray);
        }        

        // Price slider
        if($request->get('price_max') != '' && $request->get('price_min') != '') {
            if($request->get('price_max') == 100000){
                $properties = $properties->whereBetween('price',[intval($request->get('price_min')),1000000]);
            } else {
                $properties = $properties->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
            }
        }

        if($request->sort == '0'){
            $properties = $properties->orderBy('created_at','ASC');
        } else {
            $properties = $properties->orderBy('created_at','DESC');
        }

        $properties = $properties->paginate(10);
        
        $data = [
            'categories' => $categories,
            'cities' => $cities,
            'areas' => $areas,
            'types' => $types,
            'rooms' => $rooms,
            'bathrooms' => $bathrooms,            
            'jobTypes' => $jobTypes,
            'jobTypeArray' => $jobTypeArray,
            'properties' => $properties,   
        ];

         $data['priceMax'] = (intval($request->get('price_max')) == 0 ? 1000 : $request->get('price_max'));
         $data['priceMin'] = intval($request->get('price_min'));                 
    
        return view('front.propertyMap.index', $data);
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

        $count = 0;
        if(Auth::user()){
            $count = SavedProperty::where([
                'user_id' => Auth::user()->id,
                'property_id' => $id,
            ])->count();
        }

        //Fetch applicants
        $applications = JobApplication::where('property_id',$id)->with('user')->get();

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
        $data['count'] = $count;        

        return view('front.propertyDetails.index',$data);       
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
        $employer_id = $property->user_id;
        $message = 'You can not apply on your job.';

        if($employer_id == Auth::user()->id){
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
            $message = 'You already applied on this job.';
            session()->flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $application = New JobApplication();
        $application->property_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        //Send Notification Email to Employer
        $employer = User::where('id',$employer_id)->first();
        // $mailData = [
        //     'employer' => $employer,
        //     'user' => Auth::user(),
        //     'job' => $job,
        // ];

        //Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        $message = 'You have successfully applied.';
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
