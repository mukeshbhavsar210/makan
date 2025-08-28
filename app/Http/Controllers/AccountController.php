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

class AccountController extends Controller {
    public function index(){
        $id = Auth::user()->id;
        $user = User::where('id',$id)->first();

        $builders = $user->builders()->latest()->paginate(10);
        $counts = Builder::count();

        $data['user'] = $user;
        $data['builders'] = $builders;
        $data['counts'] = $counts;

        return view('admin.account.profile', $data);
    }

    public function registration(){
        return view('front.account.registration');
    }

    public function update(Request $request){
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
                return redirect()->route('properties.index');
            } else {
                return redirect()->route('account.login')->with('error','Either Email/Password Incorrect');
            }

        } else {
            return redirect()->route('account.login')
                             ->withErrors($validator)
                             ->withInput($request->only('email'));
        }
    }

    

   

    public function logout(){
        Auth::logout();
        return redirect()->route('front.home');
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




    //BUILDERS
    public function index_builder(Request $request){
        $properties = Property::with(['builder', 'user'])->whereHas('builder', function($query) {
                        $query->where('role', 'builder');
                    })->latest()->get();

        $builders = Builder::with('properties')->latest();
        $addedProperty = Property::latest();        
        //$properties = Property::orderBy('title','ASC')->get();
        $counts = Builder::count();
        $roles = User::select('role')->distinct()->pluck('role');
       
        if(!empty($request->get('keyword'))){
            $builders = $builders->where('name', 'like', '%'.$request->get('keyword').'%');
        }

        $relatedProperties = [];
        // if ($builders->related_properties != '') {
        //     $propertyArray = explode(',',$builders->related_properties);
        //     $relatedProperties = Builder::whereIn('id',$propertyArray)->where('status',1)->get();
        // }

        $propertiesByRole = [];
            foreach ($roles as $role) {
                $propertiesByRole[$role] = \App\Models\Property::with(['user', 'builder'])
                    ->whereHas('user', function ($q) use ($role) {
                        $q->where('role', $role);
                    })
                    ->get()
                    ->groupBy('builder_id'); // 👈 group properties by builder
            }

        $builders = $builders->paginate(10);

        $data['builders'] = $builders;
        $data['properties'] = $properties;
        $data['addedProperty'] = $addedProperty;
        $data['relatedProperties'] = $relatedProperties;
        $data['counts'] = $counts;
        $data['roles'] = $roles;
        $data['propertiesByRole'] = $propertiesByRole;        
            
            
        return view('admin.builder.list', $data);
    }

    //CREATE
    public function create_builder(){
        $properties = Property::orderBy('title','ASC')->get();
        $data['properties'] = $properties;
        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        return view("admin.builder.create", $data);
    }


    public function store_builder(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $builder = new Builder();
            $builder->name = $request->name;
            $builder->email = $request->email;
            $builder->landline = $request->landline;
            $builder->mobile = $request->mobile;
            $builder->whatsapp = $request->whatsapp;
            $builder->year_estd = $request->year_estd;
            $builder->address = $request->address;
            $builder->property_id = $request->property;     
            $builder->related_properties = (!empty($request->related_properties)) ? implode(',',$request->related_properties) : '';                
            $builder->save();

            // Save image here
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $builder->id.'_'.$builder->name.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/builder/'.$newImageName;
                File::copy($sPath,$dPath);

                // //Generate image thumbnail
                // $dPath = public_path().'/uploads/builder/thumb/'.$newImageName;
                // $img = Image::make($sPath);
                // $img->resize(200, 200);
                // $img->save($dPath);
                // File::copy($sPath,$dPath);

                $builder->logo = $newImageName;
                $builder->save();
            }
            
            $request->session()->flash('success', 'Builder added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Builder added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function edit_builder($builderId, Request $request){
        $builder = Builder::find($builderId);
        if (empty($builder)) {
            return redirect()->route('builders.index');
        }
        return view('admin.builder.edit', compact('builder'));
    }


    public function update_builder($id, Request $request){
        $builder = Builder::find($id);
        if (empty($builder)) {
            $request->session()->flash('error', 'Builder not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'builder not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $builder->name = $request->name;
            $builder->email = $request->email;
            $builder->landline = $request->landline;
            $builder->mobile = $request->mobile;
            $builder->whatsapp = $request->whatsapp;
            $builder->year_estd = $request->year_estd;
            $builder->address = $request->address;
            $builder->property_id = $request->property_id;
            $builder->status = $request->status;             
            $builder->save();

            $request->session()->flash('success', 'builder updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Builder updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy_builder($builderId, Request $request){
        $builder = Builder::find($builderId);

        if(empty($builder)){
            $request->session()->flash('error', 'Builder not found');
            return response()->json([
                'status' => true,
                'message' => 'Builder not found'
            ]);
            return redirect()->route('builders.index');
        }

        //Delete old image
        File::delete(public_path().'/uploads/builder_logo_photo/thumb/'.$builder->image);
        File::delete(public_path().'/uploads/builder_logo_photo/'.$builder->image);

        $builder->delete();

        $request->session()->flash('success', 'Builder deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Builder deleted successfully'
        ]);
    }



}
