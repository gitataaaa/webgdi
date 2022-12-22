<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\RedactorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Kernel;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/login', function(){
    return view('auth.login');
})->name('login');

/*
Route::get('/dashboard', function(){
    return view('sample');
});
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function(){
    Route::get('/dashboard', function(){
        return view('sample');
    });

    /* PLUGINS: REDACTORX */
    Route::post('/redactor/upload', [RedactorController::class, 'upload']);

    /* BAGIAN OCHA */
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/table', [UserController::class, 'table']);
    Route::get('/user/{id}/delete', [UserController::class, 'delete']);
    Route::get('/user/add', [UserController::class, 'form']);
    Route::get('/user/{id}/edit', [UserController::class, 'form']);
    Route::get('/user/detail', [UserController::class, 'detail']);
    Route::post('/user/add', [UserController::class, 'store']);

    
    /* ---- */

    /* BAGIAN PA ANDRI */
    /* MENU */
    Route::get('/menu', [MenuController::class, 'index']);
    Route::get('/menu/table', [MenuController::class, 'table']);
    Route::get('/menu/add', [MenuController::class, 'form']);
    Route::get('/menu/{id}/edit', [MenuController::class, 'form']);
    Route::get('/menu/{id}/delete', [MenuController::class, 'delete']);
    Route::post('/menu/add', [MenuController::class, 'store']);

    /* WIDGET: SLIDER */
    Route::get('/widget/slider', [WidgetController::class, 'index_slider']);
    Route::get('/widget/slider/table', [WidgetController::class, 'table_slider']);
    Route::get('/widget/slider/add', [WidgetController::class, 'form_slider']);
    Route::get('/widget/slider/{id}/edit', [WidgetController::class, 'form_slider']);
    Route::get('/widget/slider/{id}/delete', [WidgetController::class, 'delete_slider']);
    Route::post('/widget/slider/add', [WidgetController::class, 'store_slider']);

    /* WIDGET: ADS */
    Route::get('/widget/ads', [WidgetController::class, 'index_ads']);
    Route::post('/widget/ads/add', [WidgetController::class, 'store_ads']);

    /* WIDGET: SELAYANG PANDANG */
    Route::get('/widget/about', [WidgetController::class, 'index_about']);
    Route::post('/widget/about/add', [WidgetController::class, 'store_about']);

    /* WIDGET: SHORT DESC/DESKRIPSI SINGKAT */
    Route::get('/widget/desc', [WidgetController::class, 'index_desc']);
    Route::post('/widget/desc/add', [WidgetController::class, 'store_desc']);

    /* META: MEDIA SOSIAL */
    Route::get('/meta/social-media', [SocialMediaController::class, 'index']);
    Route::get('/meta/social-media/{id}/detail', [SocialMediaController::class, 'detail']);
    Route::post('/meta/social-media', [SocialMediaController::class, 'update']);
    /* ---- */

});
