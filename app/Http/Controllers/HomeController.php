<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\bhk_type as ModelsBhk_type;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $bhk = ModelsBhk_type::where('status',1)->orderBy('name','ASC')->get();
        $amenities = Amenity::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $categories = Category::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $newCategories = Category::where('status',1)->orderBy('name','ASC')->get();
        $featuredJobs = Job::where('status',1)->orderBy('created_at','DESC')->with('jobType')->where('isFeatured',1)->take(6)->get();
        $latestJobs = Job::where('status',1)->orderBy('created_at','DESC')->with('jobType')->take(6)->get();

        return view('front.home.index', [
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs,
            'newCategories' => $newCategories,
            'amenities' => $amenities,
        ]);
    }
}
