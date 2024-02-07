<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\GalleryController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\CmsController;
use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\EventController;
use App\Http\Controllers\Website\WhatsNewController;
use App\Http\Controllers\Website\CareersController;



use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
// use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;

use App\Http\Controllers\Admin\Menu\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\Menu\MealCategoryController as AdminMealCategoryController;
use App\Http\Controllers\Admin\Menu\MealSubCategoryController as AdminMealSubCategoryController;
use App\Http\Controllers\Admin\Menu\MealSubSubCategoryController as AdminMealSubSubCategoryController;

use App\Http\Controllers\Admin\EmployeePositionController as AdminEmployeePositionController;
use App\Http\Controllers\Admin\Cms\ContactInfoController as AdminContactInfoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::resource('/home', HomeController::class);
Route::resource('/menu', MenuController::class);
Route::resource('/gallery', GalleryController::class);
// Route::resource('/slider-and-banners', Controller::class);
Route::resource('/cms', CmsController::class);
Route::resource('/about-us', AboutUsController::class);
Route::resource('/events', EventController::class);
Route::resource('/whats_new', WhatsNewController::class);
Route::resource('/reservations', ReservationsController::class);
Route::resource('/careers', CareersController::class);

Route::get('contactInfo',[CmsController::class, 'ContactInfo']);



Route::prefix('admin')->group(function () {

    Route::resource('/gallery', AdminGalleryController::class)->only(['index', 'store', 'destroy']);
    Route::post('gallery-update',[AdminGalleryController::class, 'update']);

    Route::resource('/menu', AdminMenuController::class)->only(['index', 'store', 'destroy']);
    Route::post('menu-update',[AdminMenuController::class, 'update']);

    Route::resource('/events', AdminEventController::class)->only(['index', 'store', 'destroy']);
    Route::post('events-update',[AdminEventController::class, 'update']);

    Route::resource('/cms', AdminCmsController::class)->only(['index', 'store', 'destroy']);
    Route::post('cms-update',[AdminCmsController::class, 'update']);

    Route::resource('/employee', AdminEmployeeController::class)->only(['index', 'store', 'destroy']);
    Route::post('employee-update',[AdminEmployeeController::class, 'update']);

    
    Route::resource('/menus', AdminMenuController::class)->only(['index', 'store', 'destroy']);
    Route::post('/menus-update', [AdminMenuController::class, 'update']);
    
    Route::resource('/meal-categories', AdminMealCategoryController::class)->only(['index', 'store', 'destroy']);
    Route::post('/meal-categories-update', [AdminMealCategoryController::class, 'update']);
    
    Route::resource('/meal-subcategories', AdminMealSubCategoryController::class)->only(['index', 'store', 'destroy']);
    Route::post('/meal-subcategories-update', [AdminMealSubCategoryController::class, 'update']);
    
    Route::resource('/meal-subsubcategories', AdminMealSubSubCategoryController::class)->only(['index', 'store', 'destroy']);
    Route::post('/meal-subsubcategories-update', [AdminMealSubSubCategoryController::class, 'update']);

    Route::resource('/employee-positions', AdminEmployeePositionController::class)->only(['index', 'store', 'destroy']);
    Route::post('/employee-positions-update', [AdminEmployeePositionController::class, 'update']);
    
    Route::post('/contactInfo-update', [AdminContactInfoController::class, 'update']);

});