<?php

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
use App\Http\Controllers\Admin\SliderAndBanners\SliderAndBannersController as AdminSliderAndBannersController;

use App\Http\Controllers\Admin\GetInTouchController as AdminGetInTouchController;
use App\Http\Controllers\Admin\CareersController as AdminCareersController;

use App\Http\Controllers\Admin\Cms\PrivacyPolicyController as AdminPrivacyPolicyController;
use App\Http\Controllers\Admin\Cms\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\Cms\DisclaimerController as AdminDisclaimerController;
use App\Http\Controllers\Admin\Cms\CareersController as AdminCmsCareersController;
use App\Http\Controllers\Admin\Cms\AboutUsController as AdminAboutUsController;

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

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/route-clear', function() {
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    return 'Route cache cleared';
});

Route::get('/config-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Clear Config cleared';
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    Artisan::call('view:cache');
    return 'Views cleared';
});

// Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/blog', function () {
        return view('admin.blogs');
    });
    // Route::get('/gallerys', function () {
    //     return view('admin.gallerys');
    // });
    Route::get('/banner', function () {
        return view('admin.banner');
    });
    Route::get('/events', function () {
        return view('admin.events');
    });
    Route::get('/about', function () {
        return view('admin.about');
    });
    Route::get('/get-in-touch', function () {
        return view('admin.get-in-touch');
    });
    Route::get('/employee', function () {
        return view('admin.employee');
    });
    Route::get('/employee-positions', function () {
        return view('admin.employee-positions');
    });
    // Route::get('/about', function () {
    //     return view('admin.about');
    // });
    
    

// });

Route::prefix('/admin')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    });


    Route::resource('/gallerys', AdminGalleryController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.gallerys.index',
        'store' => 'admin.gallerys.store',
        'destroy' => 'admin.gallerys.destroy',
    ]);
    Route::post('/gallerys-youtube-Link', [AdminGalleryController::class, 'youtubeLinkStore'])->name('admin.gallerys.youtubeLinkStore');
    Route::post('/gallerys-update', [AdminGalleryController::class, 'update'])->name('gallerys.update');

    Route::resource('/blog', AdminBlogController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.blogs.index',
        'store' => 'admin.blogs.store',
        'destroy' => 'admin.blogs.destroy',
    ]);
    Route::post('/blog-update', [AdminBlogController::class, 'update']);

    Route::resource('/banner', AdminSliderAndBannersController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.banners.index',
        'store' => 'admin.banners.store',
        'destroy' => 'admin.banners.destroy',
    ]);
    Route::post('/banner-update', [AdminSliderAndBannersController::class, 'update']);

    // Route::resource('/menus', AdminMenuController::class)->only(['index', 'store', 'destroy']);
    // Route::post('menus-update',[AdminMenuController::class, 'update']);

    Route::resource('/events', AdminEventController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.events.index',
        'store' => 'admin.events.store',
        'destroy' => 'admin.events.destroy',
    ]);
    Route::post('events-update',[AdminEventController::class, 'update'])->name('admin.events.update');

    Route::resource('/employees', AdminEmployeeController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.employees.index',
        'store' => 'admin.employees.store',
        'destroy' => 'admin.employees.destroy',
    ]);
    Route::post('employees-update',[AdminEmployeeController::class, 'update'])->name('admin.employees.update');

    Route::resource('/employee-positions', AdminEmployeePositionController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.employee-positions.index',
        'store' => 'admin.employee-positions.store',
        'destroy' => 'admin.employee-positions.destroy',
    ]);
    Route::post('/employee-positions-update', [AdminEmployeePositionController::class, 'update'])->name('admin.employee-positions.update');

    //////////////////////////
    //////////////////////////
    Route::resource('/Privacy-Policy', AdminPrivacyPolicyController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.Privacy-Policy.index',
        'store' => 'admin.Privacy-Policy.store',
        'destroy' => 'admin.Privacy-Policy.destroy',
    ]);
    Route::post('Privacy-Policy-update',[AdminPrivacyPolicyController::class, 'update'])->name('admin.Privacy-Policy.update');

    Route::resource('/Location', AdminLocationController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.Location.index',
        'store' => 'admin.Location.store',
        'destroy' => 'admin.Location.destroy',
    ]);
    Route::post('Location-update',[AdminLocationController::class, 'update'])->name('admin.Location.update');

    Route::resource('/Disclaimer', AdminDisclaimerController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.Disclaimer.index',
        'store' => 'admin.Disclaimer.store',
        'destroy' => 'admin.Disclaimer.destroy',
    ]);
    Route::post('Disclaimer-update',[AdminDisclaimerController::class, 'update'])->name('admin.Disclaimer.update');

    Route::resource('/Careers', AdminCmsCareersController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.Careers.index',
        'store' => 'admin.Careers.store',
        'destroy' => 'admin.Careers.destroy',
    ]);
    Route::post('Careers-update',[AdminCmsCareersController::class, 'update'])->name('admin.Careers.update');

    Route::resource('/contactInfo', AdminContactInfoController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.contactInfo.index',
        'store' => 'admin.contactInfo.store',
        'destroy' => 'admin.contactInfo.destroy',
    ]);
    Route::post('/contactInfo-update', [AdminContactInfoController::class, 'update'])->name('admin.contactInfo.update');

    Route::resource('/about', AdminAboutUsController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.about.index',
        'store' => 'admin.about.store',
        'destroy' => 'admin.about.destroy',
    ]);
    Route::post('/about-update', [AdminAboutUsController::class, 'update'])->name('admin.about.update');

    // Route::resource('/cmss', AdminCmsController::class)->only(['index', 'store', 'destroy']);
    // Route::post('cmss-update',[AdminCmsController::class, 'update']);

    Route::resource('/get-in-touch', AdminGetInTouchController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.get-in-touch.index',
        'store' => 'admin.get-in-touch.store',
        'destroy' => 'admin.get-in-touch.destroy',
    ]);
    Route::post('/get-in-touch-updates', [AdminGetInTouchController::class, 'update'])->name('admin.get-in-touch.update');
    
    // Route::resource('/Careers-req', AdminCareersController::class)->only(['index', 'store', 'destroy'])->names([
    //     'index' => 'admin.Careers-req.index',
    //     'store' => 'admin.Careers-req.store',
    //     'destroy' => 'admin.Careers-req.destroy',
    // ]);
    // Route::post('Careers-req-update',[AdminCareersController::class, 'update'])->name('admin.Careers-req.update');

    Route::resource('/careerss', AdminCareersController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.Careers-req.index',
        'store' => 'admin.Careers-req.store',
        'destroy' => 'admin.Careers-req.destroy',
    ]);
    Route::post('/careers-update', [AdminCareersController::class, 'update']);

    
    Route::resource('/menus', AdminMenuController::class)->only(['index', 'store', 'destroy'])
    ->names([
        'index' => 'admin.menus.index',
        'store' => 'admin.menus.store',
        'destroy' => 'admin.menus.destroy',
    ]);
    Route::post('/menus-update', [AdminMenuController::class, 'update']);
    
    Route::resource('/meal-categories', AdminMealCategoryController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.meal-categories.index',
        'store' => 'admin.meal-categories.store',
        'destroy' => 'admin.meal-categories.destroy',
    ]);
    Route::post('/meal-categories-update', [AdminMealCategoryController::class, 'update']);
    
    Route::resource('/meal-subcategories', AdminMealSubCategoryController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.meal-subcategories.index',
        'store' => 'admin.meal-subcategories.store',
        'destroy' => 'admin.meal-subcategories.destroy',
    ]);
    Route::post('/meal-subcategories-update', [AdminMealSubCategoryController::class, 'update'])->name('admin.subcategories.update');
    
    Route::resource('/meal-subsubcategories', AdminMealSubSubCategoryController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.meal-subsubcategories.index',
        'store' => 'admin.meal-subsubcategories.store',
        'destroy' => 'admin.meal-subsubcategories.destroy',
    ]);
    Route::post('/meal-subsubcategories-update', [AdminMealSubSubCategoryController::class, 'update']);

   
    


    

    Route::resource('/available-offers', AdminAvailableOffersController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.available-offers.index',
        'store' => 'admin.available-offers.store',
        'destroy' => 'admin.available-offers.destroy',
    ]);
    Route::post('/available-offers-update', [AdminAvailableOffersController::class, 'update'])->name('admin.available-offers.update');

    Route::resource('/whats-news', AdminWhatsNewController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.whats-news.index',
        'store' => 'admin.whats-news.store',
        'destroy' => 'admin.whats-news.destroy',
    ]);
    Route::post('/whats-new-update', [AdminWhatsNewController::class, 'update']);

    Route::resource('/food-types', AdminFoodTypeController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.food-types.index',
        'store' => 'admin.food-types.store',
        'destroy' => 'admin.food-types.destroy',
    ]);
    Route::post('/food-type-update', [AdminFoodTypeController::class, 'update']);





});