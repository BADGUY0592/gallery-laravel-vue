<?php

use App\Http\Controllers\GalleryController;
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

Route::get('/', [GalleryController::class, 'index'])->name('home');
Route::post('/store', [GalleryController::class, 'store'])->name('image-store');
Route::get('/view-gallery', [GalleryController::class, 'gallery'])->name('view-gallery');
Route::get('/get-images', [GalleryController::class, 'getImages'])->name('get-images');
