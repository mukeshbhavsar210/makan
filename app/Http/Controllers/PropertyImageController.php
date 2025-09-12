<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropertyImageController extends Controller {
    public function update(Request $request) {
        $file = $request->file('image');
        $ext = strtolower($file->getClientOriginalExtension());

        // Get property to fetch slug
        $property = Property::findOrFail($request->property_id);

        // Create DB record first
        $propertyImage = new PropertyImage();
        $propertyImage->property_id = $request->property_id;
        $propertyImage->image = "NULL";
        $propertyImage->save();

        // Generate filename
        $fileName = $property->slug . '_' . $property->id . '_' . time() . '.' . $ext;
        $propertyImage->image = $fileName;
        $propertyImage->save();

        // === Handle Images ===
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'])) {
            $sourcePath = $file->getPathname();
            $manager = new ImageManager(new Driver());

            // Large image
            $largePath = public_path('uploads/property/' . $fileName);
            $large = $manager->read($sourcePath);
            $large->cover(900, 600);
            $large->toJpeg(100)->save($largePath);

            // Thumbnail
            $thumbPath = public_path('uploads/property/thumb/' . $fileName);
            $thumb = $manager->read($sourcePath);
            $thumb->cover(300, 300);
            $thumb->toJpeg(90)->save($thumbPath);

            $previewPath = asset('uploads/property/thumb/' . $fileName);
            $filePath = asset('uploads/property/' . $fileName);
        } 
        // === Handle PDFs ===
        elseif ($ext === 'pdf') {
            $pdfPath = public_path('uploads/property/pdf');
            if (!file_exists($pdfPath)) {
                mkdir($pdfPath, 0777, true);
            }

            $file->move($pdfPath, $fileName);

            // Use a default PDF icon for preview
            $previewPath = asset('images/pdf-icon.png');
            $filePath = asset('uploads/property/pdf/' . $fileName);
        } 
        // === Other unsupported file types ===
        else {
            return response()->json([
                'status' => false,
                'message' => 'Unsupported file type'
            ], 422);
        }

        return response()->json([
            'status'    => true,
            'image_id'  => $propertyImage->id,
            'ImagePath' => $previewPath, // for Dropzone/gallery preview
            'FilePath'  => $filePath,    // actual file (image or pdf)
            'message'   => 'File saved successfully'
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
