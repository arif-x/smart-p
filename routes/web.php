<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\Admin\GetUserDataController;
use App\Http\Controllers\Web\Admin\GrowthTrackerController;
use App\Http\Controllers\Web\Admin\DevelopmentTrackerController;

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

Route::get('/', function () {
    return view('welcome');
})->name('first');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [TestController::class, 'index'])->name('test');

Route::group([
    'prefix' => 'admin',
], function(){
    Route::post('get-user-data', [GetUserDataController::class, 'getUser'])->name('admin.get-user-data');
    Route::resource('growth-tracker', GrowthTrackerController::class, ['as' => 'admin']);
    Route::resource('development-tracker', DevelopmentTrackerController::class, ['as' => 'admin']);
});

