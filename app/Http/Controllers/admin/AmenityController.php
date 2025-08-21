<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AmenityController extends Controller {
    public function index(){
        $amenities = Amenity::all();
        $counts = Amenity::count(); 

        return view("admin.amenity.list", [
            "amenities"=> $amenities,
            "counts"=> $counts,
        ]);
    }

    //STORE
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',            
        ]);

        if ($validator->passes()) {
            $amenity = new Amenity();
            $amenity->title = $request->title;
            $amenity->icon = $request->icon;                    
            $amenity->save();

            $request->session()->flash('success', 'Amenity added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Amenity added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    //EDIT
    public function edit($amenityId, Request $request){
        $amenity = Amenity::find($amenityId);
        if (empty($amenity)) {
            return redirect()->route('amenities.index');
        }
        return view('admin.amenity.edit', compact('amenity'));
    }

    //UPDATE
    public function update($id, Request $request){
        $amenity = Amenity::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',            
        ]);

        if ($validator->passes()) {
            $amenity->title = $request->title;
            $amenity->icon = $request->icon;
            $amenity->status = $request->status;             
            $amenity->save();

            $request->session()->flash('success', 'Amenity updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Amenity updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //DELETE 
    public function destroy($amenityId, Request $request){
        $amenity = Amenity::find($amenityId);
        $amenity->delete();
        $request->session()->flash('success', 'Amenity deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Amenity deleted successfully'
        ]);
    }
}
