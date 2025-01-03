<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Amenity;
use App\Models\Area;
use App\Models\Bath;
use App\Models\Bathroom;
use App\Models\bhk_type;
use App\Models\Category;
use App\Models\City;
use App\Models\Builder;
use App\Models\Facing;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\Property;
use App\Models\PropertyApplication;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\Room;
use App\Models\SaleType;
use App\Models\SavedJob;
use App\Models\SavedProperty;
use App\Models\TempImage;
use App\Models\User;
use App\Models\View;
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
use Intervention\Image\Facades\Image;

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

    //CREATE PROPERTY
    public function create(){
        $cities = City::orderBy('name','ASC')->where('status',1)->get();
        $areas = Area::orderBy('name','ASC')->where('status',1)->get();
        $amenities = Amenity::orderBy('name','ASC')->where('status',1)->get();
        $builders = Builder::orderBy('name','ASC')->where('status',1)->get();
        $bhk = Room::orderBy('name','ASC')->where('status',1)->get();        
        $bath = Bathroom::orderBy('name','ASC')->where('status',1)->get();        
        $facings = View::orderBy('name','ASC')->where('status',1)->get();    
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertyTypes = PropertyType::orderBy('name','ASC')->where('status',1)->get();
        $saleTypes = SaleType::orderBy('name','ASC')->where('status',1)->get();        

        $data = [ 
            'cities' => $cities,
            'areas' => $areas,
            'amenities' => $amenities,
            'builders' => $builders,
            'bhk' => $bhk,
            'bath' => $bath,
            'facings' => $facings,
            'categories' => $categories,            
            'propertyTypes' => $propertyTypes, 
            'saleTypes' => $saleTypes, 
        ];

        return view('admin.property.create', $data);
    }


    //SAVE PROPERTY
    public function store(Request $request){
        $rules = [
            'title' => 'required|min:5|max:200',            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $property = new Property();
            $property->user_id = Auth::user()->id;
            $property->title = $request->title;            
            $property->slug = $request->slug;            
            $property->sale_type_id = $request->saleType;
            $property->category_id = $request->category;                    
            $property->keywords = $request->keywords;          
            $property->city_id = $request->city;   
            $property->area_id = $request->area;  
            $property->location = $request->location; 
            $property->property_type_id = $request->propertyType;
            $property->room_id = $request->room;            
            $property->bathroom_id = $request->bathroom;
            $property->amenities = $request->amenities;
            $property->price = $request->price;
            $property->compare_price = $request->compare_price;
            $property->developer_id = $request->developer;           
            $property->size = $request->size;
            $property->view_id = $request->view;     
            $property->rera = $request->rera;  
            $property->year_build = $request->year_build;  
            $property->total_area = $request->total_area;  
            $property->description = $request->description;  
            $property->is_featured = $request->is_featured;
            $property->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';                         
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
    
                    $imageName = $property->id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
                    $propertyImage->image = $imageName;
                    $propertyImage->save();
    
                    //Generate Property Thumbnails
                    //Large Image
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/property/large/'.$imageName;
                    $image = Image::make($sourcePath);
                    $image->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->save($destPath);
    
                    //Small Image
                    // $destPath = public_path().'/uploads/property/small/'.$imageName;
                    // $image = Image::make($sourcePath);
                    // $image->fit(300,300);
                    // $image->save($destPath);
                }
            }

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

    public function index(){
        $properties = Property::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        

        // if(Auth::user()->hasRole('admin')) {
        //     $items = Job::orderBy('id','DESC')->with('author')->paginate(5);
        // } else {
        //     $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);        
        // }

        return view('admin.property.list', [
            'properties' => $properties
        ]);
    }

    public function edit(Request $request, $id) {
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $propertytypes = SaleType::orderBy('name','ASC')->where('status',1)->get();

        $property = Property::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();

        if($property == null){
            abort(404);
        }

        return view('admin.property.edit', [
            'categories' => $categories,
            'propertytypes' => $propertytypes,
            'property' => $property,
        ]);
    }


    public function update_property(Request $request, $id){
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
            $job = Property::find($id);
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



    public function delete_property(Request $request){
        $property = Property::where([
            'user_id' => Auth::user()->id,
            'id' => $request->propertyId,
        ])->first();

        if($property == null){
            session()->flash('error','Either property deleted or not found.');
            return response()->json([
                'status' => true
            ]);
        }

        Property::where('id',$request->propertyId)->delete();

        session()->flash('success','Property deleted successfully.');
        return response()->json([
            'status' => true
        ]);
    }

    


    public function myPropertyApplications(){
        $propertyApplications = PropertyApplication::where('user_id',Auth::user()->id)
                            ->with(['property','property.saleType','property.applications'])
                            ->orderBy('created_at','DESC')
                            ->paginate(10);

        return view('admin.property.myPropertyApplications',[
            'propertyApplications' => $propertyApplications,
        ]);
    }



    public function removeProperty(Request $request) {
        $PropertyApplication = PropertyApplication::where([
                                'id' => $request->id,
                                'property_id' => Auth::user()->id]
                            )->first();

        if($PropertyApplication == null) {
            session()->flash('error','Property interest not found');
            return response()->json([
                'status' => false,
            ]);
        }

        PropertyApplication::find($request->id)->delete();

        session()->flash('success','Property interested removed successfully.');
        return response()->json([
            'status' => true,
        ]);
    }

    public function savedProperties(Request $request){
        $savedProperties = SavedProperty::where([
            'user_id' => Auth::user()->id
        ])->with(['property','property.saleType','property.applications'])->orderBy('created_at','DESC')->paginate(10);

        return view('admin.property.saved-jobs',[
            'savedProperties' => $savedProperties,
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


    //Similar Property show 
    public function get_similar_properties(Request $request){
        $tempProperty = [];
        if($request->term != ""){
            $properties = Property::where('title','like','%'.$request->term.'%')->get();
            if ($properties != null){
                foreach ($properties as $property){
                    $tempProperty[] = array(
                        'id' => $property->id,
                        'text' => $property->title,
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
