<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropertyImageController extends Controller {
    public function update(Request $request) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathname();

        // Get property to fetch slug
        $property = Property::findOrFail($request->property_id);

        $propertyImage = new PropertyImage();
        $propertyImage->property_id = $request->property_id;
        $propertyImage->image = "NULL";
        $propertyImage->save();

        //$imageName = $request->property_id.'-'.$propertyImage->id.'-'.time().'.'.$ext;
        $imageName = $property->slug . '_' . $property->id . '_' . time() . '.' . $ext;
        $propertyImage->image = $imageName;
        $propertyImage->save();

        // Init Image Manager (GD or Imagick driver)
        $manager = new ImageManager(new Driver());

        // === Large Image ===
        $destPath = public_path('uploads/property/'.$imageName);
        $large = $manager->read($sourcePath);
        $large->cover(900, 600); // keeps aspect ratio
        $large->save($destPath);
        $large->toJpeg(100)->save($destPath);

        // === Small Thumbnail ===
        $destPath = public_path('uploads/property/thumb/'.$imageName);
        $thumb = $manager->read($sourcePath);
        $thumb->cover(300, 300); // crop/cover to fit exactly 300x300
        $thumb->save($destPath);

        return response()->json([
            'status' => true,
            'image_id' => $propertyImage->id,
            'ImagePath' => asset('uploads/property/thumb/'.$propertyImage->image),
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
        File::delete(public_path('uploads/property/'.$propertyImage->image));
        File::delete(public_path('uploads/property/thumb/'.$propertyImage->image));

        //Delete images from database
        $propertyImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }


}
