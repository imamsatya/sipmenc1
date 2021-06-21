<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TuController;
use App\Http\Controllers\IpdsController;
use App\Models\Dokumen;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard_ipds',function () {
        return Inertia::render('Dashboard2');
    })->middleware(['isIpds', 'auth', 'verified'])->name('dashboard_ipds');
Route::get('/dashboard', [TuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';

Route::get('/dashboard2', [TuController::class, 'index']);

Route::get('/data', [TuController::class, 'index2']);

Route::post('/submitguillotine', [TuController::class, 'submitguillotine']);
Route::post('/submitmultipleguillotine', [TuController::class, 'submitMultipleGuillotine']);
Route::post('/submitmultiplekirimipds', [TuController::class, 'submitMultipleKirimipds']);
Route::post('/submitmultiplebackstep', [TuController::class, 'submitMultipleBackStep']);

Route::post('/submitmultiplebackstep2', [IpdsController::class, 'submitMultipleBackStep']);
Route::post('/submitmultipleterima', [IpdsController::class, 'submitMultipleGuillotine']);
Route::post('/submitmultiplegudang', [IpdsController::class, 'submitMultipleGudang']);
// Route::get('/downloadpdf/{a}', [TuController::class, 'createPDF'])
// ->name('downloadpdf');


// Route::get('/pdf_view', function () {
//     // return Inertia::render('Dashboard');
//     return view('pdf');
//     });

Route::get('/clear-cache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want
});

Route::get('/reset', function() {


Dokumen::query()->update(['status' => 'Gudang',
'petugas' => NULL,
'updated_at_custom' => NULL,
 'nosurat_index' => NULL,
 'nosurat_string' => NULL]);

        
    // return what you want
});