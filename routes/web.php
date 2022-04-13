<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;

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
    Route::post('anak/store', [App\Http\Controllers\Api\User\AnakController::class, 'store']);
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
    Route::post('data/jenis-parenting', [App\Http\Controllers\Web\Admin\Data\DataController::class, 'jenisParenting'])->name('data.jenis.parenting');
    Route::post('data/kategori-nutrition', [App\Http\Controllers\Web\Admin\Data\DataController::class, 'kategoriNutrition'])->name('data.kategori.nutrition');
    Route::post('data/kategori-parenting', [App\Http\Controllers\Web\Admin\Data\DataController::class, 'kategoriParenting'])->name('data.kategori.parenting');
    Route::post('data/kategori-parenting-assessment', [App\Http\Controllers\Web\Admin\Data\DataController::class, 'kategoriParentingAssessment'])->name('data.kategori.parenting-assessment');
});

Route::group([
    'prefix' => 'admin',
], function(){
    Route::resource('jenis-parenting', App\Http\Controllers\Web\Admin\Jenis\ParentingController::class, ['as' => 'admin']);
    Route::resource('kategori-parenting', App\Http\Controllers\Web\Admin\Kategori\ParentingController::class, ['as' => 'admin']);
    Route::resource('kategori-development', App\Http\Controllers\Web\Admin\Kategori\DevelopmentController::class, ['as' => 'admin']);
    Route::resource('kategori-nutrition', App\Http\Controllers\Web\Admin\Kategori\NutritionController::class, ['as' => 'admin']);
    Route::resource('kategori-konsultasi', App\Http\Controllers\Web\Admin\Kategori\KonsultasiController::class, ['as' => 'admin']);
    Route::resource('kategori-parenting-assessment', App\Http\Controllers\Web\Admin\Kategori\ParentingAssessmentController::class, ['as' => 'admin']);

    Route::resource('klasifikasi-tinggi-badan', App\Http\Controllers\Web\Admin\Klasifikasi\TinggiBadanController::class, ['as' => 'admin']);
    Route::resource('klasifikasi-berat-badan', App\Http\Controllers\Web\Admin\Klasifikasi\BeratBadanController::class, ['as' => 'admin']);
    Route::resource('klasifikasi-lingkar-kepala', App\Http\Controllers\Web\Admin\Klasifikasi\LingkarKepalaController::class, ['as' => 'admin']);

    Route::resource('artikel', App\Http\Controllers\Web\Admin\Post\ArtikelController::class, ['as' => 'admin']);
    Route::resource('nutrition', App\Http\Controllers\Web\Admin\Post\NutritionController::class, ['as' => 'admin']);
    Route::resource('parenting', App\Http\Controllers\Web\Admin\Post\ParentingController::class, ['as' => 'admin']);
    Route::resource('vaksin', App\Http\Controllers\Web\Admin\Post\VaksinController::class, ['as' => 'admin']);

    Route::resource('parenting-assessment', App\Http\Controllers\Web\Admin\Quiz\ParentingAssessmentController::class, ['as' => 'admin']);
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
});

