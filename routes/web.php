<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\RedactorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WidgetController;
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
    Route::get('/menu/{id}/delete', [MenuController::class, 'delete']);

    /* WIDGET: SLIDER */
    Route::get('/widget/slider', [WidgetController::class, 'index_slider']);
    Route::get('/widget/slider/table', [WidgetController::class, 'table_slider']);
    Route::get('/widget/slider/add', [WidgetController::class, 'form_slider']);
    /* ---- */

});
