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
use App\Http\Controllers\Website\GetInTouchController;



use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
// use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\EmployeePositionController as AdminEmployeePositionController;

use App\Http\Controllers\Admin\Menu\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\Menu\MealCategoryController as AdminMealCategoryController;
use App\Http\Controllers\Admin\Menu\MealSubCategoryController as AdminMealSubCategoryController;
use App\Http\Controllers\Admin\Menu\MealSubSubCategoryController as AdminMealSubSubCategoryController;
use App\Http\Controllers\Admin\Menu\FoodTypeController as AdminFoodTypeController;

use App\Http\Controllers\Admin\Cms\ContactInfoController as AdminContactInfoController;

use App\Http\Controllers\Admin\SliderAndBanners\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\SliderAndBanners\AvailableOffersController as AdminAvailableOffersController;
use App\Http\Controllers\Admin\SliderAndBanners\WhatsNewController as AdminWhatsNewController;

use App\Http\Controllers\Admin\GetInTouchController as AdminGetInTouchController;
use App\Http\Controllers\Admin\CareersController as AdminCareersController;
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




Route::prefix('/')->group(function () {

    Route::resource('/home', HomeController::class);
    Route::resource('/menu', MenuController::class);
    Route::resource('/gallery', GalleryController::class);
    // Route::resource('/slider-and-banners', Controller::class);
    Route::resource('/cms', CmsController::class);
    Route::resource('/about-us', AboutUsController::class);
    Route::resource('/event', EventController::class);
    Route::resource('/whats_new', WhatsNewController::class);
    Route::resource('/reservations', ReservationsController::class);
    Route::resource('/careers', CareersController::class);

    Route::get('contactInfo',[CmsController::class, 'ContactInfo']);

    Route::resource('/get-in-touch', GetInTouchController::class)->only(['store']);

});

Route::prefix('/admin')->group(function () {

    Route::resource('/gallerys', AdminGalleryController::class)->only(['index', 'store', 'destroy']);
    Route::post('gallerys-update',[AdminGalleryController::class, 'update']);

    // Route::resource('/menus', AdminMenuController::class)->only(['index', 'store', 'destroy']);
    // Route::post('menus-update',[AdminMenuController::class, 'update']);

    Route::resource('/events', AdminEventController::class)->only(['index', 'store', 'destroy']);
    Route::post('events-update',[AdminEventController::class, 'update']);

    Route::resource('/cmss', AdminCmsController::class)->only(['index', 'store', 'destroy']);
    Route::post('cmss-update',[AdminCmsController::class, 'update']);

    Route::resource('/employees', AdminEmployeeController::class)->only(['index', 'store', 'destroy']);
    Route::post('employees-update',[AdminEmployeeController::class, 'update']);

    
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
    
    Route::resource('/contactInfo', AdminContactInfoController::class)->only(['index', 'store', 'destroy']);
    Route::post('/contactInfo-update', [AdminContactInfoController::class, 'update']);

    Route::resource('/blog', AdminBlogController::class)->only(['index', 'store', 'destroy']);
    Route::post('/blog-update', [AdminBlogController::class, 'update']);

    Route::resource('/available-offers', AdminAvailableOffersController::class)->only(['index', 'store', 'destroy']);
    Route::post('/available-offers-update', [AdminAvailableOffersController::class, 'update']);

    Route::resource('/whats-news', AdminWhatsNewController::class)->only(['index', 'store', 'destroy']);
    Route::post('/whats-new-update', [AdminWhatsNewController::class, 'update']);

    Route::resource('/food-types', AdminFoodTypeController::class)->only(['index', 'store', 'destroy']);
    Route::post('/food-type-update', [AdminFoodTypeController::class, 'update']);

    Route::resource('/get-in-touchs', AdminGetInTouchController::class)->only(['index', 'store', 'destroy']);
    Route::post('/get-in-touch-updates', [AdminGetInTouchController::class, 'update']);

    Route::resource('/careerss', AdminCareersController::class)->only(['index', 'store', 'destroy']);
    Route::post('/careers-update', [AdminCareersController::class, 'update']);

});