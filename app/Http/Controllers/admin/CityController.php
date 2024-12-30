<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::orderBy('created_at','DESC')->paginate(10);
        return view('admin.city.list',[
            'cities' => $cities
        ]);
    }

    public function edit($id){
        $city = City::findOrFail($id);
        return view('admin.city.edit',[
            'city' => $city
        ]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:30',            
            'slug' => 'required|min:5|max:30',
        ]);

        if($validator->passes()) {
            $user = City::find($id);
            $user->name = $request->name;
            $user->slug = $request->slug;
            $user->save();

            session()->flash('success','City updated successfully.');

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
