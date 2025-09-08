<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedProperty;
use App\Models\PropertyApplication;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }

    
    public function boot(): void {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $savedProperties = collect();
            $countsSaved = 0;
            $appliedProperties = collect();
            $countsApplied = 0;

            if (Auth::check()) {
                $user = Auth::user();

                $savedProperties = SavedProperty::with(['property.property_images'])
                    ->where('user_id', $user->id)->orderBy('created_at', 'DESC')->take(10)->get();
                $countsSaved = SavedProperty::where('user_id', $user->id)->count();

                $appliedProperties = PropertyApplication::with(['property','property.applications','property.builder','property.property_images',])
                    ->where('user_id', $user->id)->orderBy('created_at', 'DESC')->take(10)->get();
                $countsApplied = PropertyApplication::where('user_id', $user->id)->count();
            }

            $view->with([
                'savedProperties'   => $savedProperties,
                'countsSaved'       => $countsSaved,
                'appliedProperties' => $appliedProperties,
                'countsApplied'     => $countsApplied,
            ]);
        });
    }
}
