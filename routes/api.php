<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;

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


Route::post('/map/show', [LocationController::class, 'show'])->name('location.show');
Route::get('/map/show', [LocationController::class, 'show'])->name('location.show');
Route::get('/dashboard', [AdminController::class, 'search'])->name('admin.search');
Route::post('/dashboard/approved', [AdminController::class, 'approved'])->name('admin.approved');
Route::post('/dashboard/rejected', [AdminController::class, 'rejected'])->name('admin.rejected');
Route::post('/dashboard/pending', [AdminController::class, 'pending'])->name('admin.pending');

