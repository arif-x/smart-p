<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\Admin\GetUserDataController;
use App\Http\Controllers\Web\Admin\GrowthTrackerController;
use App\Http\Controllers\Web\Admin\DevelopmentTrackerController;
use App\Http\Controllers\Web\Admin\NutritionTrackerController;
use App\Http\Controllers\Web\Admin\TipsController;
use App\Http\Controllers\Web\Admin\ConsultationController;
use App\Http\Controllers\Web\Admin\ParentingController;
use App\Http\Controllers\Web\Admin\ParentingAssessmentController;
use App\Http\Controllers\Web\Admin\VaccinationTrackerController;
use App\Http\Controllers\Web\Admin\VaksinController;

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
Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'google']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'google_callback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [TestController::class, 'index'])->name('test');


Route::group([
    'prefix' => 'api',
    // 'middleware' => ['auth.basic', 'json']
    'middleware' => ['json', 'strip']
], function(){
    Route::resource('anak', App\Http\Controllers\Api\User\AnakController::class, ['as' => 'api']);
    Route::post('/anak/{id_anak}/{id_user}', [App\Http\Controllers\Api\User\AnakController::class, 'show'])->name('api.anak.show-data');
    Route::delete('/anak/{id_anak}/{id_user}', [App\Http\Controllers\Api\User\AnakController::class, 'destroy'])->name('api.anak.delete-data');
    
    Route::post('/home', [App\Http\Controllers\Api\User\HomeController::class, 'index'])->name('api.user.home');
    Route::post('/home/anak', [App\Http\Controllers\Api\User\HomeController::class, 'getAll'])->name('api.user.home.anak');
    Route::post('/home/anak/single', [App\Http\Controllers\Api\User\HomeController::class, 'show'])->name('api.user.home.anak.single');
    Route::post('/home/grafik', [App\Http\Controllers\Api\User\RecordController::class, 'index']);
    Route::post('/home/vaksinasi', [App\Http\Controllers\Api\User\VaksinasiCheckerController::class, 'index']);    
    Route::post('/home/artikel', [App\Http\Controllers\Api\User\ArtikelController::class, 'index']);    

    Route::post('/home/nutrition', [App\Http\Controllers\Api\User\NutritionTrackerController::class, 'index']);    
    Route::post('/home/nutrition/kategori', [App\Http\Controllers\Api\User\NutritionTrackerController::class, 'getByKategori']);

    Route::post('/home/konsultasi', [App\Http\Controllers\Api\User\ConsultationController::class, 'index']);
    Route::post('/home/konsultasi/kategori', [App\Http\Controllers\Api\User\ConsultationController::class, 'getByKategori']);
    Route::post('/home/konsultasi/store', [App\Http\Controllers\Api\User\ConsultationController::class, 'store']);

    Route::post('/home/parenting/artikel', [App\Http\Controllers\Api\User\ParentingController::class, 'artikel']);
    Route::post('/home/parenting/video', [App\Http\Controllers\Api\User\ParentingController::class, 'video']);
    Route::post('/home/parenting/custom', [App\Http\Controllers\Api\User\ParentingController::class, 'custom']);

    Route::post('/home/development', [App\Http\Controllers\Api\User\DevelopmentController::class, 'index']);
    Route::post('/home/development/single', [App\Http\Controllers\Api\User\DevelopmentController::class, 'single']);
    Route::post('/home/development/store', [App\Http\Controllers\Api\User\DevelopmentController::class, 'store']);

    Route::post('/home/parenting-assessment/kategori', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'kategori']);
    Route::post('/home/parenting-assessment/kategori/single', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'kategoriSingle']);
    Route::post('/home/parenting-assessment/soal', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'soal']);
    Route::post('/home/parenting-assessment/soal/kategori', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'getSoalByKategori']);
    Route::post('/home/parenting-assessment/soal/jawaban/submit-single', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'submitSingle']);
    Route::post('/home/parenting-assessment/soal/jawaban/submit-all', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'submitAll']);
    Route::post('/home/parenting-assessment/soal/jawaban/submit', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'submit']);
    Route::post('/home/parenting-assessment/soal/jawaban/jawab', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'jawab']);
    Route::post('/home/parenting-assessment/histori', [App\Http\Controllers\Api\User\ParentingAssessmentController::class, 'history']);
    

    Route::group([
        // 'middleware' => 'anak'
    ], function(){
        Route::resource('record-perkembangan', App\Http\Controllers\Api\User\RecordPerkembanganController::class, ['as' => 'api']);
        Route::post('record-perkembangan/index', [App\Http\Controllers\Api\User\RecordPerkembanganController::class, 'index']);
        Route::resource('record-vaksinasi', App\Http\Controllers\Api\User\RecordVaksinasiController::class, ['as' => 'api']);
    });

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin'
    ], function(){
        Route::resource('artikel', App\Http\Controllers\Api\Admin\ArtikelController::class, ['as' => 'api']);
        Route::resource('vaksin', App\Http\Controllers\Api\Admin\VaksinController::class, ['as' => 'api']);
    });
});

Route::group([
    'prefix' => 'api'
], function(){
    Route::group([
        'prefix' => 'auth'
    ], function(){
        Route::post('register', [App\Http\Controllers\Api\Auth\AuthController::class, 'register'])->name('auth.register');
        Route::post('login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login'])->name('auth.login');
        Route::post('logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::group([
    'prefix' => 'admin',
], function(){
    Route::post('get-anak-data', [GetUserDataController::class, 'getUser'])->name('admin.get-anak-data');
    Route::resource('growth-tracker', GrowthTrackerController::class, ['as' => 'admin']);
    Route::resource('development-tracker', DevelopmentTrackerController::class, ['as' => 'admin']);
    Route::resource('vaccination-tracker', VaccinationTrackerController::class, ['as' => 'admin']);
    Route::resource('nutrition-tracker', NutritionTrackerController::class, ['as' => 'admin']);
    Route::resource('tips', TipsController::class, ['as' => 'admin']);
    Route::resource('consultation', ConsultationController::class, ['as' => 'admin']);
    Route::resource('parenting', ParentingController::class, ['as' => 'admin']);
    Route::resource('parenting-assessment', ParentingAssessmentController::class, ['as' => 'admin']);
    Route::resource('vaksin', VaksinController::class, ['as' => 'admin']);
});

