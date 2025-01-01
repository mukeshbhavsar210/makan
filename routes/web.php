<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AreaController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\PropertyImageController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertiesController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

    // //Area
    // Route::get("/areas",[AreaController::class, 'index'])->name('areas.index');
    // Route::get("/create-area",[AreaController::class, 'createArea'])->name('areas.create');
    // Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    // Route::get("/areas/{id}",[AreaController::class, 'edit'])->name('areas.edit');
    // Route::put("/areas/{id}",[AreaController::class, 'update'])->name('areas.update');
    // Route::delete('/areas/{id}', [AreaController::class, 'destroy'])->name('areas.delete');

    // //City
    // Route::get("/cities",[CityController::class, 'index'])->name('cities.index');
    // Route::get("/create-city",[CityController::class, 'createCity'])->name('cities.create');
    // Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
    // Route::get("/cities/{id}",[CityController::class, 'edit'])->name('cities.edit');
    // Route::put("/cities/{id}",[CityController::class, 'update'])->name('cities.update');
    // Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.delete');
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
        Route::post("/update-profile-pic",[AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        
        Route::get("/createProperty",[AccountController::class, 'createProperty'])->name('account.createProperty');
        Route::get('/area', [AreaController::class, 'index'])->name('area.index');
        
        Route::post("/saveProperty",[AccountController::class, 'saveProperty'])->name('account.saveProperty');
        Route::get("/property",[AccountController::class, 'myProperties'])->name('account.property');
        Route::get("/property/edit/{jobId}",[AccountController::class, 'editProperty'])->name('account.editProperty');
        Route::post("/updateProperty/{jobId}",[AccountController::class, 'updateProperty'])->name('account.updateProperty');
        Route::post("/deleteProperty",[AccountController::class, 'deleteProperty'])->name('account.deleteProperty');
        Route::get("/myPropertyInterested",[AccountController::class, 'myPropertyApplications'])->name('account.myPropertyApplications');
        Route::post("/removePropertyInterested",[AccountController::class, 'removeProperty'])->name('account.removeProperties');
        Route::get("/savedProperties",[AccountController::class, 'savedProperties'])->name('account.savedProperties');
        Route::post("/removeSavedProperty",[AccountController::class, 'removeSavedProperty'])->name('account.removeSavedJob');
        Route::post("/updatePassword",[AccountController::class, 'updatePassword'])->name('account.updatePassword');

        //Setting Route
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
        Route::post('/uploadTempImage', [TempImagesController::class, 'create'])->name('temp-images.create');


        //Property Images
        Route::post('/propertyImages/update', [PropertyImageController::class, 'update'])->name('product-images.update');
        Route::delete('/propertyImages', [PropertyImageController::class, 'destroy'])->name('product-images.destroy');



         //Sub Categories Connect to main Categories
         //Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');
         
    });

});


//Admin related
Route::group(['prefix' => 'admin'], function(){
    // Route::group(['middleware' => 'admin.guest'], function(){
    //     Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
    //     Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    // });

    Route::group(['middleware' => 'admin.auth'], function(){
        // Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        // Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        //Category Routes
        // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        // Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        // Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        // Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

        // //Sub Category Routes
        // Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
        // Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
        // Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        // Route::get('/sub-categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
        // Route::put('/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        // Route::delete('/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete');

       
        //Product Route
        // Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        // Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        // Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        // Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
        // Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');

        
        //Delete Product Images Route
        //Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        //Route::delete('/product-images', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        //Shipping Routes
        // Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        // Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
        // Route::get('/shipping/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
        // Route::put('/shipping/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        // Route::delete('/shipping/{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');        
        
        //Users Routes
        // Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        // Route::post('/users', [UserController::class, 'store'])->name('users.store');
        // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');

        
        //Temp image controller
        //Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

        //Setting Route
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');

        // Route::get('/getSlug', function(Request $request){
        //     $slug = '';
        //     if (!empty($request->title)) {
        //         $slug = Str::slug($request->title);
        //     }
        //     return response()->json([
        //         'status' => true,
        //         'slug' => $slug
        //     ]);
        // })->name('getSlug');
    });
});

