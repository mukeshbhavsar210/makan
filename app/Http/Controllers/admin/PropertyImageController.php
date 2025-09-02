<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropertyImageController extends Controller
{
    public function update(Request $request) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathname();

        $propertyImage = new PropertyImage();
        $propertyImage->product_id = $request->product_id;
        $propertyImage->image = "NULL";
        $propertyImage->save();

        $imageName = $request->product_id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
        $propertyImage->image = $imageName;
        $propertyImage->save();

        // Init Image Manager (GD or Imagick driver)
        $manager = new ImageManager(new Driver());

        // === Large Image ===
        $destPath = public_path('uploads/property/large/'.$imageName);
        $large = $manager->read($sourcePath);
        $large->scale(width: 1000); // keeps aspect ratio
        $large->save($destPath);

        // === Small Thumbnail ===
        $destPath = public_path('uploads/product/small/'.$imageName);
        $thumb = $manager->read($sourcePath);
        $thumb->cover(300, 300); // crop/cover to fit exactly 300x300
        $thumb->save($destPath);

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
