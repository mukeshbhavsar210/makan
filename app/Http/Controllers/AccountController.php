<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Builder;
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

        return view('front.layouts.profile', $data);
    }


    public function registration(){
        return view('front.layouts.registration');
    }


    public function update_profile(Request $request) {
        $id = Auth::id();

        // Validation rules
        $rules = [
            'name'   => 'required|min:5|max:30',
            'email'  => 'required|email|unique:users,email,'.$id.',id',
            'mobile' => 'required|digits:10',
            'image' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
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
        $colors = ['#FF5733', '#33B5E5', '#2ECC71', '#9B59B6', '#F39C12', '#E74C3C', '#1ABC9C', '#34495E'];
        $user->avatar_color = $colors[array_rand($colors)];

        // If new profile pic uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $username = Str::slug($request->name);
            $imageName = $id.'-'.$username.'-'.time().'.'.$ext;

            // Save main image
            $image->move(public_path('/uploads/profile/'), $imageName);

            // Create thumbnail
            $sourcePath = public_path('/uploads/profile/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($sourcePath);
            $img->cover(150, 150);
            $img->toPng()->save(public_path('/uploads/profile/thumb/'.$imageName));

            // Delete old profile pic if exists
            if ($user->image) {
                File::delete(public_path('/uploads/profile/thumb/'.$user->image));
                File::delete(public_path('/uploads/profile/thumb/'.$user->image));
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
            'logo'              => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }        

         // Fetch or create builder
        $builder = Builder::firstOrNew(['user_id' => $id]);

        $builder->developer_name     = $request->developer_name;
        $builder->developer_email    = $request->developer_email;
        $builder->developer_landline = $request->developer_landline;
        $builder->developer_mobile   = $request->developer_mobile;
        $builder->developer_whatsapp = $request->developer_whatsapp;
        $builder->address            = $request->address;

        // If new profile pic uploaded
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ext       = $image->getClientOriginalExtension();
            $name      = Str::slug($request->developer_name);
            $imageName = $id.'-'.$name.'-'.time().'.'.$ext;

            // Save original
            $image->move(public_path('/uploads/developer/'), $imageName);

            // Create thumbnail
            $sourcePath = public_path('/uploads/developer/'.$imageName);
            $manager = new ImageManager(Driver::class);
            $img = $manager->read($sourcePath);
            $img->cover(150, 150);
            $img->toJpeg(80)->save(public_path('/uploads/developer/thumb/'.$imageName));

            // Delete old logo if exists
            if ($builder->image) {
                File::delete(public_path('/uploads/developer/'.$builder->image));
                File::delete(public_path('/uploads/developer/thumb/'.$builder->image));
            }

            // Save new logo
            $builder->image = $imageName;
        }

        $builder->user_id = $id;
        $builder->save();

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
            $user->role = $request->role;
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

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['status' => true]);
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
        return view('front.layouts.forgot-password');
    }

    public function processForgotPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $token = Str::random(60);

    \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    \DB::table('password_reset_tokens')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now()
    ]);

    //Send email
    $user = User::where('email', $request->email)->first();
    $mailData = [
        'token' => $token,
        'user' => $user,
        'subject' => 'You have requested to change your password.',
    ];

    Mail::to($request->email)->send(new ResetPasswordEmail($mailData));

    return response()->json([
        'status' => true,
        'message' => 'Reset password email has been sent to your email.'
    ]);
}


    public function resetPassword($tokenString){
        $token = \DB::table('password_reset_tokens')->where('token',$tokenString)->first();

        if($token == null){
            return redirect()->route('front.home')->with('error','Invalid token.');
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