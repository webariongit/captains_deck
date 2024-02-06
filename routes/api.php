<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\GalleryController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\CmsController;

use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CmsController as AdminCmsController;

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
Route::resource('/slider-and-banners', GalleryController::class);
Route::resource('/cms', CmsController::class);



Route::prefix('admin')->group(function () {

    Route::resource('/gallery', AdminGalleryController::class)->only(['index', 'store', 'destroy']);
    Route::post('gallery-update',[AdminGalleryController::class, 'update']);

    Route::resource('/menu', AdminMenuController::class)->only(['index', 'store', 'destroy']);
    Route::post('menu-update',[AdminMenuController::class, 'update']);

    Route::resource('/events', AdminEventController::class)->only(['index', 'store', 'destroy']);
    Route::post('events-update',[AdminEventController::class, 'update']);

    Route::resource('/cms', AdminCmsController::class)->only(['index', 'store', 'destroy']);
    Route::post('cms-update',[AdminCmsController::class, 'update']);

});