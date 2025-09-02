<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\City;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrapFive();

        $request = request();

        $cityId = $request->get('city');
        $areaId = $request->get('area');
        $areaId = $request->get('area');
        $roomIds = $request->get('room', []);
        $citySelected = $request->filled('city') ? City::where('slug', $request->city)->first() : null;
        $areaSelected = $request->filled('area') ? Area::where('slug', $request->area)->first() : null;
        $selectedAreas = $request->filled('area') ? \App\Models\Area::where('slug', $request->area)->first() : null;

        $cities = City::where('status', 1)->get();
        $categoryWord = null;
        $city = null;
        $areas = collect();
        $area = null;

        if ($cityId) {
            $city = City::find($cityId);
        }

        if ($areaId) {
            $area = Area::find($areaId);
        }        

        View::share([
            'cities' => $cities,
            'areas' => $areas,
            'area' => $area,
            'citySelected' => $citySelected,
            'areaSelected' => $areaSelected,
            'selectedAreas' => $selectedAreas,
            'categoryWord' => $categoryWord,
        ]);
    }
}
