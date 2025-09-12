<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller {
    public function index(){
        $cities = City::all();
        $counts = City::count();

        return view("front.admin.city.list", [
            "cities"=> $cities,
            "counts"=> $counts,
        ]);
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $city = new City();
            $city->name = $request->name;
            $city->slug = $request->slug;                    
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


    //EDIT
    public function edit($cityId, Request $request){
        $city = city::find($cityId);
        if (empty($city)) {
            return redirect()->route('cities.index');
        }
        return view('front.admin.city.edit', compact('city'));
    }

    //UPDATE
    public function update($id, Request $request){
        $city = City::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $city->name = $request->name;
            $city->slug = $request->slug;
            $city->status = $request->status;             
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

    //DELETE 
    public function destroy($cityId, Request $request){
        $city = City::find($cityId);
        $city->delete();
        $request->session()->flash('success', 'City deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'City deleted successfully'
        ]);
    }


    public function areaSub(Request $request){
        if (!empty($request->city_id)) {
            $subAreas = Area::where('city_id',$request->city_id)
            ->orderBy('name','ASC')
            ->get();

            return response()->json([
                'status' => true,
                'subAreas' => $subAreas
            ]);
        } else {
            return response()->json([
                'status' => true,
                'subAreas' => []
            ]);
        }
    }
}
