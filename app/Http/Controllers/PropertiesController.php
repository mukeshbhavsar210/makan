<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Amenity;
use App\Models\Bath;
use App\Models\bhk_type;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\City;
use App\Models\Developer;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\Property;
use App\Models\SavedProperty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PropertiesController extends Controller
{
    //this method will show Jobs page
    public function index(Request $request){
        $cities = City::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $properties = Property::where('status',1);
        //$bhkTypes = bhk_type::where('status',1)->get();
        //$bathTypes = Bath::where('status',1)->get();
        //$amenityType = Amenity::where('status',1)->get();        
        //$developers = Developer::where('status',1)->get();

        //Filter using keyword
        // if(!empty($request->keyword)){
        //     $property = $property->where(function($query) use ($request){
        //         $query->orWhere('title','like','%'.$request->keyword.'%');
        //         $query->orWhere('keywords','like','%'.$request->keyword.'%');
        //     });
        // }

        //Filter using location
        // if(!empty($request->location)){
        //     $property = $property->where('location',$request->location);            
        // }

        //Filter using city
        if(!empty($request->city)){            
            $properties = $properties->where('city_id',$request->city);
        }

        //Filter using category
        if(!empty($request->category)){
            $properties = $properties->where('category_id',$request->category);
        }

        //Filter using job_type
        $bathTypeArray = [];
        if(!empty($request->bathType)){
            $bathTypeArray = explode(',',$request->bathType);
            $properties = $properties->whereIn('bath_type_id',$bathTypeArray);
        }

        //Filter using job_type
        // $jobTypeArray = [];
        // if(!empty($request->jobType)){
        //     $jobTypeArray = explode(',',$request->jobType);
        //     $property = $property->whereIn('job_type_id',$jobTypeArray);
        // }

        //Filter using job_type
        // $amenityTypeArray = [];
        // if(!empty($request->amenityType)){
        //     $amenityTypeArray = explode(',',$request->amenityType);
        //     $property = $property->whereIn('amenity_id',$amenityTypeArray);
        // }


        $properties = $properties->with('room','bathroom','developer','category','city');

        if($request->sort == '0'){
            $properties = $properties->orderBy('created_at','ASC');
        } else {
            $properties = $properties->orderBy('created_at','DESC');
        }

        $properties = $properties->paginate(10);

        $data = [
            'categories' => $categories,
            'cities' => $cities,
            'properties' => $properties,
            //'bathTypeArray' => $bathTypeArray            
        ];

        return view('front.property.index', $data);
    }

    //This method propertyDetails
    public function propertyDetails($id){
        $property = Property::where([
            'id' => $id,
            'status' => 1,
        ])->with(['room','bathroom','developer','category','city'])->first();
        

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

        return view('front.propertyDetails.index',[ 
            'property' => $property,
            'count' => $count,
            'applications' => $applications 
        ]);
    }

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
            session()->flash('error', 'You already saved this job.');

            return response()->json([
                'status' => false
            ]);
        }

        $savedJob = new SavedProperty;
        $savedJob->property_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        session()->flash('success', 'You have successfully saved this job.');

        return response()->json([
            'status' => true
        ]);
    }
}
