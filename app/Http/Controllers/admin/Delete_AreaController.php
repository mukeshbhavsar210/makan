<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function create(){
        $areas = Area::orderBy('created_at','DESC')->paginate(10);
        $cities = City::orderBy('name','ASC')->get();
        $data['areas'] = $areas;
        $data['cities'] = $cities;
        return view('admin.area.list',$data);
    }


    

    

    public function edit($id, Request $request){
        $area = Area::find($id);
        $cities = City::orderBy('name','ASC')->get();        

        if(empty($area)){
            $request->session()->flash('error','Record not found');
            return redirect()->route('areas.create');
        }

        $cities = City::orderBy('name','ASC')->get();
        $data['cities'] = $cities;
        $data['area'] = $area;
        return view("admin.area.edit", $data);
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
