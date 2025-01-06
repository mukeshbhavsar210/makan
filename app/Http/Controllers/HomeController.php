<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Bathroom;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $bhk = Bathroom::where('status',1)->orderBy('name','ASC')->get();
        $amenities = Amenity::where('status',1)->orderBy('title','ASC')->take(8)->get();
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $newCategories = Category::where('status',1)->orderBy('name','ASC')->get();
        $featuredJobs = Property::where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        //$featuredJobs = Property::where('status',1)->orderBy('created_at','DESC')->with('jobType')->where('isFeatured','Yes')->take(6)->get();
        $latestJobs = Property::where('status',1)->orderBy('created_at','DESC')->with('amenityType')->take(6)->get();

        return view('front.home.index', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories,
            'amenities' => $amenities,
        ]);
    }
}
