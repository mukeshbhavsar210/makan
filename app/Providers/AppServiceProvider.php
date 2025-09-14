<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedProperty;
use App\Models\PropertyApplication;
use App\Models\Property;
use App\Models\City;
use App\Models\Area;
use App\Models\User;


class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }

    
    public function boot(): void
{
    Paginator::useBootstrapFive();

    View::composer('*', function ($view) {
        $request = request(); // ✅ get current request

        $savedProperties   = collect();
        $countsSaved       = 0;
        $appliedProperties = collect();
        $countsApplied     = 0;
        $seenProperties    = session('seen_properties', []);
        $users = User::select('id', 'name', 'role')->get();
        $citySelected   = $request->filled('city') ? City::where('slug', $request->city)->first() : null;
        $areaSelected   = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
        $selectedAreas  = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
        $cities = City::where('status',1)->get();
        $areas = Area::where('status',1)->get();  

        $cityId = $request->get('city');
        $areaId = $request->get('area');                
        $seenProperties = session('seen_properties', []); 

        $categoryWord   = null;
        $areas = collect();
        $area = null;
        $city = null;
        $areas = collect();

        if (Auth::check()) {
            $user = Auth::user();

            $savedProperties = SavedProperty::with(['property.property_images'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->take(10)
                ->get();

            $countsSaved = SavedProperty::where('user_id', $user->id)->count();

            $appliedProperties = PropertyApplication::with([
                    'property',
                    'property.applications',
                    'property.builder',
                    'property.property_images',
                ])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->take(10)
                ->get();

            $countsApplied = PropertyApplication::where('user_id', $user->id)->count();

             if ($cityId) {
                $city = City::find($cityId);
            }

            if ($areaId) {
                $area = Area::find($areaId);
            }
        }

        $view->with([
            'seenProperties'   => $seenProperties,
            'savedProperties'  => $savedProperties,
            'countsSaved'      => $countsSaved,
            'appliedProperties'=> $appliedProperties,
            'countsApplied'    => $countsApplied,
            'categoryWord'     => $categoryWord,
            'citySelected'     => $citySelected,
            'areaSelected'     => $areaSelected,
            'selectedAreas'    => $selectedAreas,
            'seenProperties' => $seenProperties,
            'cities' => $cities,
            'areas' => $areas,
            'users' => $users,
            'area' => $area,
        ]);
    });
}

}
