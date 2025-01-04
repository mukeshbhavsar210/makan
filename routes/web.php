<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DeveloperController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\PropertyImageController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BuilderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\PropertyController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PropertiesController;
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

Route::get("/contact",[ContactFormController::class, 'index']);
Route::post("/contact",[ContactFormController::class, 'store']);

Route::get("/",[HomeController::class, 'index'])->name('home');
Route::get("/properties",[PropertiesController::class, 'index'])->name('properties');
Route::get("/details/{id}",[PropertiesController::class, 'propertyDetails'])->name('propertyDetails');
Route::post("/apply-property",[PropertiesController::class, 'applyProperty'])->name('applyProperty');
Route::post("/save-property",[PropertiesController::class, 'saveProperty'])->name('saveProperty');
Route::get("/forgot-password",[AccountController::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post("/process-forgot-password",[AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');
Route::get("/reset-password/{token}",[AccountController::class, 'resetPassword'])->name('account.resetPassword');
Route::post("/process-reset-password",[AccountController::class, 'processResetPassword'])->name('account.processResetPassword');

Route::group(['prefix' => 'admin','middleware' => 'checkRole'], function(){
    Route::get("/dashboard",[DashboardController::class, 'index'])->name('admin.dashboard');

    //Users
    Route::get("/users",[UserController::class, 'index'])->name('admin.users');
    Route::get("/users/{id}",[UserController::class, 'edit'])->name('admin.users.edit');
    Route::put("/users/{id}",[UserController::class, 'update'])->name('admin.users.update');

    // //City
    Route::get("/cities",[CityController::class, 'index'])->name('cities.index');
    Route::get("/create-city",[CityController::class, 'create'])->name('cities.create');
    Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
    Route::get("/cities/{id}",[CityController::class, 'edit'])->name('cities.edit');
    Route::put("/cities/{id}",[CityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.delete');

    //Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

    //Developer Routes
    Route::get('/builders', [BuilderController::class, 'index'])->name('builders.index');
    Route::get('/builders/create', [BuilderController::class, 'create'])->name('builders.create');
    Route::post('/builders', [BuilderController::class, 'store'])->name('builders.store');
    Route::get('/builders/{category}/edit', [BuilderController::class, 'edit'])->name('builders.edit');
    Route::put('/builders/{category}', [BuilderController::class, 'update'])->name('builders.update');
    Route::delete('/builders/{category}', [BuilderController::class, 'destroy'])->name('builders.delete');
    Route::post("/updateProfilePic",[BuilderController::class, 'updateProfilePic'])->name('builders.updateProfilePic');

    //Delete Product Images Route
    Route::post('/product-images/update', [PropertyImageController::class, 'update'])->name('product-images.update');
    Route::delete('/product-images', [PropertyImageController::class, 'destroy'])->name('product-images.destroy');

    //Property Images
    Route::post('/propertyImages/update', [PropertyImageController::class, 'update'])->name('product-images.update');
    Route::delete('/propertyImages', [PropertyImageController::class, 'destroy'])->name('product-images.destroy');

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
        Route::get("/profile",[AccountController::class, 'profile'])->name('account.profile');
        Route::put("/update-profile",[AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get("/logout",[AccountController::class, 'logout'])->name('account.logout');
        Route::post("/updateProfilePic",[AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        
        //Working Property
        Route::get("/property",[PropertyController::class, 'index'])->name('property.index');
        Route::get("/property/create",[PropertyController::class, 'create'])->name('property.create');
        Route::post("/property/store",[PropertyController::class, 'store'])->name('property.store');                
        Route::get("/property/edit/{jobId}",[PropertyController::class, 'edit'])->name('property.edit');
        Route::post("/updateProperty/{jobId}",[PropertyController::class, 'update'])->name('property.update');
        Route::post("/deleteProperty",[PropertyController::class, 'delete'])->name('property.delete');

        Route::get('/get-amenities',[PropertyController::class,'get_amenities'])->name('property.amenities');
        Route::get('/get-properties',[PropertyController::class,'similar_properties'])->name('property.similarProperty');
        Route::get("/savedProperties",[PropertyController::class, 'savedProperties'])->name('property.savedProperties');
        Route::post("/removeSavedProperty",[PropertyController::class, 'removeSavedProperty'])->name('account.removeSavedJob');
        Route::post("/removePropertyInterested",[PropertyController::class, 'removeProperty'])->name('account.removeProperties');
        Route::get("/myPropertyInterested",[PropertyController::class, 'myPropertyApplications'])->name('account.myPropertyApplications');

        //Get area name parent city
        Route::get('/area', [AreaController::class, 'area'])->name('area.index');

        Route::post("/updatePassword",[AccountController::class, 'updatePassword'])->name('account.updatePassword');

        //Setting Route
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
        Route::post('/uploadTempImage', [TempImagesController::class, 'create'])->name('temp-images.create');
        
    });
});


//Admin related
// Route::group(['prefix' => 'admin'], function(){
//     Route::group(['middleware' => 'admin.auth'], function(){
//         //Setting Route
//         Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
//         Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
//     });
// });

