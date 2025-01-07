<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function city_create(Request $request){
        $cities = City::orderBy('created_at','DESC')->paginate(10);
        $areas = Area::orderBy('created_at','DESC')->paginate(10);

        $data['areas'] = $areas;
        $data['cities'] = $cities;        
        
        return view('admin.city.list',$data);      
    }

    public function city_store(Request $request){
        $validator = Validator::make($request->all(), [
            //'name' => 'required|unique:cities',
            //'slug' => 'required|unique:cities',
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

    public function city_edit($cityId, Request $request){
        $city = City::find($cityId);

        if (empty($city)) {
            return redirect()->route('cities.create');
        }

        return view('admin.city.edit', compact('city'));
    }

    public function city_update($cityId, Request $request){
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

    public function city_destroy($cityId, Request $request){
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







    //AREA ROUTES
    public function area_edit($id, Request $request){
        $area = Area::find($id);
        $cities = City::orderBy('name','ASC')->get();        

        if(empty($area)){
            $request->session()->flash('error','Record not found');
            return redirect()->route('areas.create');
        }

        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        $data['area'] = $area;
        return view("admin.city.areaEdit", $data);
    }


    public function area_store(Request $request){
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
            return response([
                'status' => true,
                'message' => 'Area added successfully',
            ]);

        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function area_update($id, Request $request){
        $area = Area::find($id);
        if(empty($area)){
            $request->session()->flash('error','Record not found');
            return response([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:areas,slug,'.$area->id.',id',
            // 'city' => 'required',
        ]);

        if ($validator->passes()) {
            $area->name = $request->name;
            $area->slug = $request->slug;
            $area->city_id = $request->city;
            $area->save();
            $request->session()->flash('success', 'Area updated successfully');
            return response([
                'status' => true,
                'message' => 'Area updated successfully',
            ]);

        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function area_destroy($id, Request $request){
        $area = Area::find($id);

        if(empty($area)){
            $request->session()->flash('error','Record not found');
            return response([
                'status' => false,
                'notFound' => true,
            ]);
        }
        $area->delete();
        $request->session()->flash('success', 'Area deleted successfully');

        return response([
            'status' => true,
            'message' => 'Area deleted successfully',
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
