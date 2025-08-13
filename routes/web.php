<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AmenityController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PropertyImageController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BuilderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\PropertyController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get("/contact",[ContactController::class, 'index'])->name('contact.index');;
// Route::post("/contact",[ContactController::class, 'store'])->name('contact.store');
// Route::get("/contact/{id}",[ContactController::class, 'details'])->name('contact.details');;

Route::get("/",[HomeController::class, 'index'])->name('front.home');
Route::get("/buy",[HomeController::class, 'index'])->name('front.rent');
Route::get('/get-areas/{city_id}', [HomeController::class, 'getAreas']);
Route::get("/properties",[HomeController::class, 'properties'])->name('properties');
Route::get("/details/{id}",[HomeController::class, 'propertyDetails'])->name('propertyDetails');
Route::post("/apply-property",[HomeController::class, 'applyProperty'])->name('applyProperty');
Route::post("/save-property",[HomeController::class, 'saveProperty'])->name('saveProperty');

Route::get("/forgot-password",[AccountController::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post("/process-forgot-password",[AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');
Route::get("/reset-password/{token}",[AccountController::class, 'resetPassword'])->name('account.resetPassword');
Route::post("/process-reset-password",[AccountController::class, 'processResetPassword'])->name('account.processResetPassword');

//ADMIN ROLES
Route::group(['prefix' => 'admin','middleware' => 'checkRole'], function(){
    Route::get("/dashboard",[DashboardController::class, 'index'])->name('admin.dashboard');

    //Users
    Route::get("/users",[UserController::class, 'index'])->name('users.index');
    Route::get("/users/{id}",[UserController::class, 'edit'])->name('users.index.edit');
    Route::put("/users/{id}",[UserController::class, 'update'])->name('users.index.update');

    //City
    Route::get('/cities', [CityController::class, 'index'])->name('cities.index');    
    Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
    Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.delete');

    //Area
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');    
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/areas/{id}/edit', [AreaController::class, 'edit'])->name('areas.edit');
    Route::put('/areas/{id}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.delete');
      
    //Get area name parent city
    Route::get('/areaSub', [CityController::class, 'areaSub'])->name('areaSub.index');

    //Category Routes
    Route::get('/categories', [CategoryController::class, 'create'])->name('categories.create');    
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

    //Developer Routes
    Route::get('/builders', [BuilderController::class, 'index'])->name('builders.index');
    Route::get('/builders/create', [BuilderController::class, 'create'])->name('builders.create');
    Route::post('/builders', [BuilderController::class, 'store'])->name('builders.store');
    Route::get('/builders/{id}/edit', [BuilderController::class, 'edit'])->name('builders.edit');
    Route::put('/builders/{id}', [BuilderController::class, 'update'])->name('builders.update');
    Route::delete('/builders/{id}', [BuilderController::class, 'destroy'])->name('builders.delete');

    //Amienites routes
    Route::get('/amenities', [AmenityController::class, 'index'])->name('amenities.index');    
    Route::post('/amenities', [AmenityController::class, 'store'])->name('amenities.store');
    Route::get('/amenities/{id}/edit', [AmenityController::class, 'edit'])->name('amenities.edit');
    Route::put('/amenities/{id}', [AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('/amenities/{id}', [AmenityController::class, 'destroy'])->name('amenities.delete');

    Route::get('/getSlug', function(Request $request){
        $slug = '';
        if (!empty($request->title)) {
            $slug = Str::slug($request->title);
        }
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    })->name('getSlug');
});


Route::group(['prefix' => 'account'], function(){
    //Guest routes
    Route::group(['middleware' => 'guest'], function(){
        Route::get("/register",[AccountController::class, 'registration'])->name('account.registration');
        Route::post("/process-register",[AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get("/login",[AccountController::class, 'login'])->name('account.login');
        Route::post("/authenticate",[AccountController::class, 'authenticate'])->name('account.authenticate');
    });

    //Authenticate routes
    Route::group(['middleware' => 'auth'], function(){
        Route::get("/profile",[AccountController::class, 'index'])->name('profile.index');
        Route::put("/update-profile",[AccountController::class, 'update'])->name('profile.update');
        Route::get("/logout",[AccountController::class, 'logout'])->name('account.logout');
        Route::post("/updateProfilePic",[AccountController::class, 'updateProfilePic'])->name('profile.updatePic');
        //Route::post("/updateProfilePic",[BuilderController::class, 'updateProfilePic'])->name('builders.updateProfilePic');
               
        //Product Route
        Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.delete');
        Route::get('/get-properties',[PropertyController::class,'getProducts'])->name('properties.getProducts');

        //Delete Product Images Route
        Route::post('/property-images/update', [PropertyImageController::class, 'update'])->name('property-images.update');
        Route::delete('/property-images', [PropertyImageController::class, 'destroy'])->name('property-images.destroy');   

        //Array Data
        Route::get('/get-amenities',[PropertyController::class,'get_amenities'])->name('property.amenities');
        Route::get('/get-properties',[PropertyController::class,'similar_properties'])->name('property.properties');
        Route::get('/get-amenities',[PropertyController::class,'similar_amenities'])->name('property.amenities');
        Route::get('/get-rooms',[PropertyController::class,'similar_rooms'])->name('property.rooms');
        Route::get('/get-bathrooms',[PropertyController::class,'similar_bathrooms'])->name('property.bathrooms');
        Route::get('/get-facings',[PropertyController::class,'similar_facings'])->name('property.facings');
        Route::get("/savedProperties",[PropertyController::class, 'savedProperties'])->name('property.savedProperties');
        Route::post("/removeSavedProperty",[PropertyController::class, 'removeSavedProperty'])->name('account.removeSavedJob');
        Route::post("/removePropertyInterested",[PropertyController::class, 'removeProperty'])->name('account.removeProperties');
        Route::get("/myPropertyInterested",[PropertyController::class, 'myPropertyApplications'])->name('account.myPropertyApplications');

        Route::post("/updatePassword",[AccountController::class, 'updatePassword'])->name('account.updatePassword');

        //Setting Route
        //Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        //Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
        Route::post('/uploadTempImage', [TempImagesController::class, 'create'])->name('temp-images.create');        
    });
});