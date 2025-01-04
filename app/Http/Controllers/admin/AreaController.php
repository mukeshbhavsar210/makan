<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request){
        $areas = Area::select('areas.*','cities.name as cityName')
            ->latest('areas.id')
            ->leftJoin('cities', 'cities.id', 'areas.city_id');

        if(!empty($request->get('keyword'))){
            $areas = $areas->where('areas.name', 'like', '%'.$request->get('keyword').'%');
            $areas = $areas->orWhere('cities.name', 'like', '%'.$request->get('keyword').'%');
        }

        $areas = $areas->paginate(10);
        return view('admin.area.list', compact('areas'));
    }

    public function create(){
        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        return view("admin.area.create", $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:areas',
            'city' => 'required',
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


    public function edit($id, Request $request){

        $area = Area::find($id);
        if(empty($area)){
            $request->session()->flash('error','Record not found');
            return redirect()->route('areas.index');
        }

        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        $data['area'] = $area;
        return view("admin.area.edit", $data);
    }

    public function update($id, Request $request){

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
            'city' => 'required',
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

    public function destroy($id, Request $request){
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

    public function area(Request $request){

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
