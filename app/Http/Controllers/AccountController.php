<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Amenity;
use App\Models\Area;
use App\Models\Bath;
use App\Models\bhk_type;
use App\Models\Category;
use App\Models\City;
use App\Models\Developer;
use App\Models\Facing;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\SaleType;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class AccountController extends Controller
{
    public function registration(){
        return view('front.account.registration');
    }

    public function processRegistration(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required|min:5',
        ]);

        if($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have registed successfully.');

            return response()->json([
                'status' => true,
                'errors'=> []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors'=> $validator->errors(),
            ]);
        }
    }

    public function login(){
        return view('front.layouts.app');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {

            if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password ])){
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error','Either Email/Password Incorrect');
            }

        } else {
            return redirect()->route('account.login')
                             ->withErrors($validator)
                             ->withInput($request->only('email'));
        }
    }

    public function profile(){
        $id = Auth::user()->id;
        $user = User::where('id',$id)->first();

        return view('admin.account.profile',[
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'designation' => 'required|min:5|max:30',
            'mobile' => 'required|min:10|max:10',
        ]);

        if($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success','Profile updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function updateProfilePic(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required|image',
        ]);

        $id = Auth::user()->id;

        if($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;
            $image->move(public_path('/profile_pic/'), $imageName);

            //Create small thumbnail for Profile pic
            $sourcePath = public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
            $image->cover(150, 150);
            $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

            //Delete old profile pic
            File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_pic/'.Auth::user()->image));

            User::where('id',$id)->update(['image' => $imageName]);

            session()->flash('success','Profile Picture updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function createProperty(){
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $amenities = Amenity::orderBy('name','ASC')->where('status',1)->get();
        $developers = Developer::orderBy('name','ASC')->where('status',1)->get();
        $bhk = bhk_type::orderBy('name','ASC')->where('status',1)->get();        
        $bath = Bath::orderBy('name','ASC')->where('status',1)->get();        
        $facings = Facing::orderBy('name','ASC')->where('status',1)->get();    
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->where('status',1)->get();
        $saleTypes = SaleType::orderBy('name','ASC')->where('status',1)->get();        

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,
            'amenities' => $amenities,
            'developers' => $developers,
            'bhk' => $bhk,
            'bath' => $bath,
            'facings' => $facings,
            'categories' => $categories,            
            'propertyTypes' => $propertyTypes, 
            'saleTypes' => $saleTypes, 
        ];

        return view('admin.job.create', $data);
    }



    public function saveProperty(Request $request){
        $rules = [
            'title' => 'required|min:5|max:200',            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $property = new Property();
            $property->user_id = Auth::user()->id;
            $property->title = $request->title;            
            $property->category_id = $request->category;       
            $property->sale_type_id = $request->saleType; 
            $property->city_id = $request->city;   
            $property->area_id = $request->area;   
            $property->developer_id = $request->developer;   
            $property->bhk_type_id = $request->bhk;            
            $property->bath_id = $request->bath;
            $property->facing_id = $request->facing;
            $property->property_type_id = $request->propertyType;
            $property->amenities = $request->amenities;
            $property->description = $request->description;  
            $property->location = $request->location;
            $property->keywords = $request->keywords;            
            $property->size = $request->size;
            $property->price = $request->price;
            $property->compare_price = $request->compare_price;
            $property->location = $request->location;
            $property->save();

            session()->flash('success','Property added successfully.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function myProperties(){
        $properties = Property::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        

        // if(Auth::user()->hasRole('admin')) {
        //     $items = Job::orderBy('id','DESC')->with('author')->paginate(5);
        // } else {
        //     $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        
        // }

        return view('admin.job.my-jobs', [
            'properties' => $properties
        ]);
    }

    public function editProperty(Request $request, $id) {
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $jobtypes = JobType::orderBy('name','ASC')->where('status',1)->get();

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        if($job == null){
            abort(404);
        }

        return view('admin.job.edit', [
            'categories' => $categories,
            'jobtypes' => $jobtypes,
            'job' => $job,
        ]);
    }


    public function updateProperty(Request $request, $id){
        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'vacancy' => 'required|integer',
            'jobtype' => 'required',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $job = Job::find($id);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobtype;
            $job->user_id = Auth::user()->id;            
            $job->location = $request->location;
            $job->description = $request->description;            
            $job->keywords = $request->keywords;            
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->save();

            session()->flash('success','Property updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function deleteProperty(Request $request){

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId,
        ])->first();

        if($job == null){
            session()->flash('error','Either property deleted or not found.');
            return response()->json([
                'status' => true
            ]);
        }

        Job::where('id',$request->jobId)->delete();

        session()->flash('success','Property deleted successfully.');
        return response()->json([
            'status' => true
        ]);
    }

    public function myJobApplications(){
        $jobApplications = JobApplication::where('user_id',Auth::user()->id)
                            ->with(['job','job.jobType','job.applications'])
                            ->orderBy('created_at','DESC')
                            ->paginate(10);

        return view('admin.job.my-job-applications',[
            'jobApplications' => $jobApplications,
        ]);
    }

    public function removeJob(Request $request) {
        $JobApplication = JobApplication::where([
                                'id' => $request->id,
                                'user_id' => Auth::user()->id]
                            )->first();

        if($JobApplication == null) {
            session()->flash('error','Property interest not found');
            return response()->json([
                'status' => false,
            ]);
        }

        JobApplication::find($request->id)->delete();

        session()->flash('success','Property interested removed successfully.');
        return response()->json([
            'status' => true,
        ]);
    }

    public function savedProperties(Request $request){
        $savedJobs = SavedJob::where([
            'user_id' => Auth::user()->id
        ])->with(['job','job.jobType','job.applications'])->orderBy('created_at','DESC')->paginate(10);

        return view('admin.job.saved-jobs',[
            'savedJobs' => $savedJobs,
        ]);
    }


    public function removeSavedProperty(Request $request) {
        $savedJob = SavedJob::where([
                                'id' => $request->id,
                                'user_id' => Auth::user()->id]
                            )->first();

        if($savedJob == null) {
            session()->flash('error','Property not found');
            return response()->json([
                'status' => false,
            ]);
        }

        SavedJob::find($request->id)->delete();
        session()->flash('success','Property removed successfully.');

        return response()->json([
            'status' => true,
        ]);
    }


    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        if(Hash::check($request->old_password, Auth::user()->password) == false){

            session()->flash('error','Your old password is incorrect');
            return response()->json([
                'status' => true,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('success','Password updated successfully');
        return response()->json([
            'status' => true,
        ]);
    }

    public function forgotPassword(){
        return view('front.account.forgot-password');
    }

    public function processforgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.forgotPassword')->withInput()->withErrors($validator);
        }

        $token = Str::random(60);

        \DB::table('password_reset_tokens')->where('email',$request->email)->delete();
        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        //Send email here
        $user = User::where('email',$request->email)->first();
        $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'You have requested to change your password.',
        ];

        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));

        return redirect()->route('account.forgotPassword')->with('success','Reset password email hase been sent to your email');
    }

    public function resetPassword($tokenString){
        $token = \DB::table('password_reset_tokens')->where('token',$tokenString)->first();

        if($token == null){
            return redirect()->route('account.forgotPassword')->with('error','Invalid token.');
        }

        return view('front.account.reset-password', [
            'tokenString' => $tokenString
        ]);
    }

    public function processResetPassword(Request $request){
        $token = \DB::table('password_reset_tokens')->where('token',$request->token)->first();

        if($token == null){
            return redirect()->route('account.forgotPassword')->with('error','Invalid token.');
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.resetPassword', $request->token)->withErrors($validator);
        }

        User::where('email',$token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('account.login')->with('success','You have successfully changed your password');
    }
}
