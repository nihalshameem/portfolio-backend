<?php

use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CertificatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact-me-submit', [ContactMeController::class, 'store'])->name('contact.store');

Route::get('/projects', [ProjectsController::class, 'getList'])->name('project.get');
Route::get('/project/{slug}', [ProjectsController::class, 'getProject'])->name('project.get');

Route::get('/certificates', [CertificatesController::class, 'getList'])->name('certificate.get');
Route::get('/certificate/{slug}', [CertificatesController::class, 'getCertificate'])->name('certificate.get');