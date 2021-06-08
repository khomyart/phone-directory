<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ExecutiveAuthorityController;

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
//resources/js/pages - place for components of render function

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/',[ContactsController::class, 'index'])
    ->name('home');

Route::get('/control',[ExecutiveAuthorityController::class, 'index'])
    ->middleware('auth')
    ->name('control');

Route::post('/control',[ExecutiveAuthorityController::class, 'store'])
    ->middleware('auth')
    ->name('control');

require __DIR__.'/auth.php';
