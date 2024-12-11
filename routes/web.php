<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;


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



Route::get('/books', [BookController::class, 'index'])->name('book.index');
Route::get('/books/popular', [BookController::class, 'popularBooks'])->name('books.popular');

Route::get('/book/{id}', [BookController::class, 'showUser'])->name('book.details');
Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
Route::get('/book/{id}/read', [BookController::class, 'read'])->name('book.read');


Route::get('/book/pdf/{id}', [BookController::class, 'viewPdf'])->name('book.pdf');


// Routes principais
Route::get('/', 'App\Http\Controllers\StoreController@index')->name('store');
Route::get('/admin', 'App\Http\Controllers\AdminController@index')
->middleware(['auth', 'admin'])
->name('dashboard');

// Routes para páginas de administração
// Route::resource('admin/product', 'App\Http\Controllers\ProductController');
Route::resource('admin/book', 'App\Http\Controllers\BookController');
Route::resource('admin/author', 'App\Http\Controllers\AuthorController');

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'showUser'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'update'])->name('user.profile.update');
});

Route::get('/authors/{id}', [AuthorController::class, 'showUser'])->name('author.details');

Route::get('/books', [BookController::class, 'indexRequest'])->name('book.indexRequest');

Auth::routes(['reset' => true]);
