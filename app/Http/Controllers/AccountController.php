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
        $developer = Builder::where('user_id', $id)->first();
        $counts = Builder::count();

        $data['user'] = $user;
        $data['builders'] = $builders;
        $data['developer'] = $developer;
        $data['counts'] = $counts;

        return view('admin.account.profile', $data);
    }


    public function registration(){
        return view('front.account.registration');
    }


    public function update_profile(Request $request) {
        $id = Auth::id();

        // Validation rules
        $rules = [
            'name'   => 'required|min:5|max:30',
            'email'  => 'required|email|unique:users,email,'.$id.',id',
            'mobile' => 'required|digits:10',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::find($id);
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile = $request->mobile;
        $user->role = $request->role;

        // If new profile pic uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = $id.'-'.time().'.'.$ext;

            // Save main image
            $image->move(public_path('/profile_pic/'), $imageName);

            // Create thumbnail
            $sourcePath = public_path('/profile_pic/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($sourcePath);
            $img->cover(150, 150);
            $img->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

            // Delete old profile pic if exists
            if ($user->image) {
                File::delete(public_path('/profile_pic/thumb/'.$user->image));
                File::delete(public_path('/profile_pic/'.$user->image));
            }

            $user->image = $imageName;
        }

        $user->save();

        session()->flash('success','Profile updated successfully.');

        return response()->json([
            'status' => true,
            'errors' => []
        ]);
    }




    public function update_builder(Request $request) {
        $id = Auth::id();

        if (!$id) {
            return response()->json([
                'status' => false,
                'errors' => ['auth' => ['User not authenticated']]
            ], 401);
        }

        $rules = [
            'developer_name'     => 'required|string|max:100',
            'developer_email'    => 'required|email',
            'developer_landline' => 'nullable|string|max:20',
            'developer_mobile'   => 'required|string|max:20',
            'developer_whatsapp' => 'nullable|string|max:20',
            'address'            => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = [
            'developer_name'     => $request->developer_name,
            'developer_email'    => $request->developer_email,
            'developer_landline' => $request->developer_landline,
            'developer_mobile'   => $request->developer_mobile,
            'developer_whatsapp' => $request->developer_whatsapp,
            'address'            => $request->address,
        ];

        // 👇 Handle Image Upload
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = $id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/builder/'), $imageName);

            $data['image'] = $imageName;
        }

        // Save builder
        $builder = Builder::updateOrCreate(
            ['user_id' => $id],
            $data
        );

        return response()->json([
            'status'  => true,
            'message' => 'Builder details saved successfully.',
            'builder' => $builder
        ]);
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

    public function update_password(Request $request){
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