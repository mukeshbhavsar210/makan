<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(){
        $areas = Area::orderBy('created_at','DESC')->paginate(10);
        return view('admin.job.create',[
            'areas' => $areas
        ]);
    }

    public function edit($id){
        $area = Area::findOrFail($id);
        return view('admin.area.edit',[
            'area' => $area
        ]);
    }

    public function createArea(){
        return view('admin.area.create');
    }

    public function saveProperty(Request $request){
        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',            
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()) {
            $job = new Area();
            $job->title = $request->title;
            $job->save();

            session()->flash('success','Property added successfully.');

            return response()->json([
                'status' => true,
                'errors' => [],
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:30',            
            'slug' => 'required|min:5|max:30',
        ]);

        if($validator->passes()) {
            $user = Area::find($id);
            $user->name = $request->name;
            $user->slug = $request->slug;
            $user->save();

            session()->flash('success','Area updated successfully.');

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
