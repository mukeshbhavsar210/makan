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

    public function create(){
        return view('admin.city.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:cities',
            'slug' => 'required|unique:cities',
        ]);

        if ($validator->passes()) {
            $city = new City();
            $city->name = $request->name;
            $city->slug = $request->slug;
            $city->status = $request->status;
            $city->save();

            $request->session()->flash('success', 'City added successfully');

            return response()->json([
                'status' => true,
                'message' => 'City added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // public function edit($id){
    //     $city = City::findOrFail($id);
    //     return view('admin.city.edit',[
    //         'city' => $city
    //     ]);
    // }

    // public function update($id, Request $request){
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|unique:cities',
    //         'slug' => 'required|unique:cities',
    //     ]);

    //     if($validator->passes()) {
    //         $user = City::find($id);
    //         $user->name = $request->name;
    //         $user->slug = $request->slug;
    //         $user->save();

    //         session()->flash('success','City updated successfully.');

    //         return response()->json([
    //             'status' => true,
    //             'errors' => []
    //         ]);

    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }



    public function edit($cityId, Request $request){
        $city = City::find($cityId);

        if (empty($city)) {
            return redirect()->route('cities.index');
        }

        return view('admin.city.edit', compact('city'));
    }



    public function update($cityId, Request $request){
        $city = City::find($cityId);
        if (empty($city)) {
            $request->session()->flash('error', 'City not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'City not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:city,slug,'.$city->id.',id',
        ]);

        if ($validator->passes()) {
            $city->name = $request->name;
            $city->slug = $request->slug;
            $city->status = $request->status;
            $city->showHome = $request->showHome;
            $city->save();

            $request->session()->flash('success', 'City updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'City updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($cityId, Request $request){
        $city = City::find($cityId);

        if(empty($city)){
            $request->session()->flash('error', 'City not found');
            return response()->json([
                'status' => true,
                'message' => 'City not found'
            ]);
            //return redirect()->route('categories.index');
        }


        $city->delete();

        $request->session()->flash('success', 'City deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'City deleted successfully'
        ]);
    }
}
