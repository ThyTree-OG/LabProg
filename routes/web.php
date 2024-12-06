<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/book/{id}', [App\Http\Controllers\BookController::class, 'show'])->name('book.details');
Route::get('/book/pdf/{id}', [App\Http\Controllers\BookController::class, 'viewPdf'])->name('book.pdf');

Route::get('/', 'App\Http\Controllers\StoreController@index')->name('store');
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->middleware('auth')->name('dashboard');

Route::resource('admin/category', 'App\Http\Controllers\CategoryController');
Route::resource('admin/product', 'App\Http\Controllers\ProductController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('store.about');
})->name('about');

Route::get('/pricing', function () {
    return view('store.pricing');
})->name('pricing');

Route::get('/contact', function () {
    return view('store.contact');
})->name('contact');

Route::get('/terms', function () {
    return view('store.terms');
})->name('terms');
