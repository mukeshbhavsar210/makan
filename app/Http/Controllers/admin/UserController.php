<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Workbench\App\Models\User as ModelsUser;

class UserController extends Controller {
    public function index(){
        $users = User::where('role', '!=', 'Admin')->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.users.list',[
            'users' => $users
        ]);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('front.users.edit',[
            'user' => $user
        ]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:30',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'mobile' => 'required|min:10|max:10',
        ]);

        if($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->save();

            session()->flash('success','User information updated successfully.');

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

}
