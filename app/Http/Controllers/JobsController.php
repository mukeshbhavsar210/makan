<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Amenity;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobsController extends Controller
{
    //this method will show Jobs page
    public function index(Request $request){
        $amenityType = Amenity::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();
        $jobs = Job::where('status',1);

        //Filter using keyword
        if(!empty($request->keyword)){
            $jobs = $jobs->where(function($query) use ($request){
                $query->orWhere('title','like','%'.$request->keyword.'%');
                $query->orWhere('keywords','like','%'.$request->keyword.'%');
            });
        }

        //Filter using location
        if(!empty($request->location)){
            $jobs = $jobs->where('location',$request->location);
        }

        //Filter using category
        if(!empty($request->category)){
            $jobs = $jobs->where('category_id',$request->category);
        }


        //Filter using job_type
        $jobTypeArray = [];
        if(!empty($request->jobType)){
            $jobTypeArray = explode(',',$request->jobType);
            $jobs = $jobs->whereIn('job_type_id',$jobTypeArray);
        }

        //Filter using job_type
        $amenityTypeArray = [];
        if(!empty($request->amenityType)){
            $amenityTypeArray = explode(',',$request->amenityType);
            $jobs = $jobs->whereIn('amenity_id',$amenityTypeArray);
        }

        //Filter using experience
        if(!empty($request->experience)){
            $jobs = $jobs->where('experience',$request->experience);
        }


        $jobs = $jobs->with('jobType','amenityType','category');

        if($request->sort == '0'){
            $jobs = $jobs->orderBy('created_at','ASC');
        } else {
            $jobs = $jobs->orderBy('created_at','DESC');
        }

        $jobs = $jobs->paginate(10);

        return view('front.property.index',[
            'categories' => $categories,
            'amenityType' => $amenityType,
            'jobTypes' => $jobTypes,
            'amenityTypeArray' => $amenityTypeArray,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray
        ]);
    }

    //This method propertyDetails
    public function propertyDetails($id){
        $job = Job::where([
            'id' => $id,
            'status' => 1,
        ])->with(['jobType','category'])->first();

        if($job == null){
            abort(404);
        }

        $count = 0;
        if(Auth::user()){
            $count = SavedJob::where([
                'user_id' => Auth::user()->id,
                'job_id' => $id,
            ])->count();
        }

        //Fetch applicants
        $applications = JobApplication::where('job_id',$id)->with('user')->get();

        return view('front.propertyDetails.index',[ 
            'job' => $job,
            'count' => $count,
            'applications' => $applications 
        ]);
    }

    public function applyProperty(Request $request){
        $id = $request->id;
        $job = Job::where('id',$id)->first();

        //If job not found in database
        $message = 'Job does not exist.';
        if($job == null){
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        //User can not apply on posted own job
        $employer_id = $job->user_id;
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
            'job_id' => $id,
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
        $application->job_id = $id;
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

        $job = Job::find($id);

        if($job == null) {
            $message = 'Job not found';
            session()->flash('error', $message);

            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        //Check if user already saved the job
        $count = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => Auth::user()->id,
        ])->count();

        if($count > 0) {
            session()->flash('error', 'You already saved this job.');

            return response()->json([
                'status' => false
            ]);
        }

        $savedJob = new SavedJob;
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();

        session()->flash('success', 'You have successfully saved this job.');

        return response()->json([
            'status' => true
        ]);
    }
}
