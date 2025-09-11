<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller {
    public function index(){
        $areas = Area::all();
        $cities = City::with('areas')->withCount('areas')->get();
        $counts = Area::count();

        return view("front.area.list", [
            "areas"=> $areas,
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
        $city = City::with('areas')->get();

        if (empty($area)) {
            return redirect()->route('cities.index');
        }
        return view('front.area.edit', [
            "area"=> $area,
            "city"=> $city,
        ]);
    }

    //UPDATE
    public function update($id, Request $request) {
        $area = Area::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'city_id'  => 'required|exists:cities,id', // ✅ validate city foreign key
            'status'   => 'required|in:0,1',
        ]);

        if ($validator->passes()) {
            $area->name    = $request->name;
            $area->slug    = $request->slug ?? Str::slug($request->name); // fallback if slug empty
            $area->status  = $request->status;
            $area->city_id = $request->city_id; // ✅ assign city foreign key
            $area->save();

            $request->session()->flash('success', 'Area updated successfully');

            return response()->json([
                'status'  => true,
                'message' => 'Area updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
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
