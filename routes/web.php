<?php

use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectsController::class);
    Route::get('contact-me', [ContactMeController::class, 'list'])->name('contactMe.list');
    Route::delete('contact-me/delete/{id}', [ContactMeController::class, 'destroy'])->name('contactMe.destroy');
    Route::get('contact-me/view/{id}', [ContactMeController::class, 'show'])->name('contactMe.view');
});
