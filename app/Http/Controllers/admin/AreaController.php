<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    public function index(){
        $areas = Area::all();
        $cities = City::all();

        return view("admin.area.list", [
            "areas"=> $areas,
            "cities"=> $cities,
        ]);
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $area = new Area();
            $area->name = $request->name;
            $area->slug = $request->slug; 
            $area->city_id = $request->city;                   
            $area->save();

            $request->session()->flash('success', 'Area added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Area added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    //EDIT
    public function edit($areaId, Request $request){
        $area = Area::find($areaId);
        if (empty($area)) {
            return redirect()->route('cities.index');
        }
        return view('admin.area.edit', compact('area'));
    }

    //UPDATE
    public function update($id, Request $request){
        $area = Area::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',            
        ]);

        if ($validator->passes()) {
            $area->name = $request->name;
            $area->slug = $request->slug;
            $area->status = $request->status;             
            $area->save();

            $request->session()->flash('success', 'Area updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Area updated successfully'
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
        $city = Area::find($cityId);
        $city->delete();
        $request->session()->flash('success', 'Area deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Area deleted successfully'
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
