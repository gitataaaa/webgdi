<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\RedactorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\WebsiteController;
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

/* front website */
Route::get('/', [WebsiteController::class, 'index']);
Route::get('/{slug}', [WebsiteController::class, 'index']);
Route::get('/program/{slug}', [WebsiteController::class, 'index_program']);
Route::get('/program/{slug}/{detailSlug}', [WebsiteController::class, 'index_program']);

Route::post('/q/login', [AuthController::class, 'authenticate']);
Route::get('/q/logout', [AuthController::class, 'logout']);
Route::get('/q/login', function(){
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

    /* BLOG */
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/table', [BlogController::class, 'table']);
    Route::get('/blog/{id}/delete', [BlogController::class, 'delete']);
    Route::get('/blog/add', [BlogController::class, 'form']);
    Route::get('/blog/{id}/edit', [BlogController::class, 'form']);
    Route::post('/blog/add', [BlogController::class, 'store']);

    /* GALERI */
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::post('/gallery/save', [GalleryController::class, 'store']);
    Route::post('/gallery/delete', [GalleryController::class, 'delete']);

    /* PROGRAM */
    Route::get('/program', [ProgramController::class, 'index']);
    Route::get('/program/table', [ProgramController::class, 'table']);
    Route::get('/program/add', [ProgramController::class, 'form']);
    Route::get('/program/{id}/delete', [ProgramController::class, 'delete']);
    Route::get('/program/{id}/edit', [ProgramController::class, 'form']);
    Route::get('/program/{id}/detail', [ProgramController::class, 'detail']);
    Route::post('/program/add', [ProgramController::class, 'store']);

    Route::get('/program/realisasi/{id}/table', [ProgramController::class, 'table_realisasi']);
    Route::get('/program/realisasi/{program}/add', [ProgramController::class, 'form_realisasi']);
    Route::get('/program/realisasi/{program}/{id}/edit', [ProgramController::class, 'form_realisasi']);
    Route::get('/program/realisasi/{id}/delete', [ProgramController::class, 'delete_realisasi']);
    Route::post('/program/realisasi/add', [ProgramController::class, 'store_realisasi']);

    Route::get('/program/rekapitulasi', [ProgramController::class, 'index_recap']);
    Route::get('/program/rekapitulasi/donatur', [ProgramController::class, 'index_recap_donatur']);
    Route::post('/program/rekapitulasi/chart', [ProgramController::class, 'getDataChart']);
    Route::post('/program/rekapitulasi/table', [ProgramController::class, 'table_recap']);
    Route::post('/program/rekapitulasi/donatur/table', [ProgramController::class, 'table_recap_donatur']);
    Route::get('/program/rekapitulasi/donatur/export/excel/{program}/{dateStart}/{dateEnd}', [ProgramController::class, 'exportExcel']);
    Route::get('/program/rekapitulasi/donatur/export/excel', [ProgramController::class, 'exportExcel']);
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

    /* META: IDENTITAS INSTANSI */
    Route::get('/meta/identitas-instansi', [MetaController::class, 'index']);
    Route::post('/meta/identitas-instansi/add', [MetaController::class, 'store']);

    /* MESSAGE */
    Route::get('/message', [MessageController::class, 'index']);
    Route::get('/message/table', [MessageController::class, 'table']);
    Route::get('/message/{id}/delete', [MessageController::class, 'delete']);
    Route::get('/message/{id}/detail', [MessageController::class, 'detail']);


    /* ---- */

});
