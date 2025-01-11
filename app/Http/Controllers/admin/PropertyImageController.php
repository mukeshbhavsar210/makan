<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PropertyImageController extends Controller
{
    public function update(Request $request){

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathName();

        $propertyImage = new PropertyImage();
        $propertyImage->product_id = $request->product_id;
        $propertyImage->image = "NULL";
        $propertyImage->save();

        $imageName = $request->product_id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
        $propertyImage->image = $imageName;
        $propertyImage->save();

        //Generate Product Thumbnails
        //Large Image
        $destPath = public_path().'/uploads/property/large/'.$imageName;
        $image = Image::make($sourcePath);
        $image->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($destPath);

        //Small Image
        // $destPath = public_path().'/uploads/product/small/'.$imageName;
        // $image = Image::make($sourcePath);
        // $image->fit(300,300);
        // $image->save($destPath);

        return response()->json([
            'status' => true,
            'image_id' => $propertyImage->id,
            'ImagePath' => asset('uploads/product/small/'.$propertyImage->image),
            'message' => 'Image saved successfully'
        ]);
    }

    
    public function destroy(Request $request){
        $propertyImage = PropertyImage::find($request->id);

        if (empty($propertyImage)){
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }

        //Delete images from folder
        File::delete(public_path('uploads/property/large/'.$propertyImage->image));
        File::delete(public_path('uploads/property/small/'.$propertyImage->image));

        //Delete images from database
        $propertyImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
