<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PlanChangeRequestController;
use App\Http\Controllers\UserPlanController;
use App\Http\Controllers\PdfToImageController;
use App\Http\Controllers\ActivityController;

use App\Models\Plan;


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
Route::get('admin/book/create', [BookController::class, 'create'])->name('book.create');
Route::get('admin/book/index', [BookController::class, 'index'])->name('book.index');
Route::get('admin/book/{id}', [BookController::class, 'showAdmin'])->name('book.showAdmin');
Route::get('admin/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('admin/book/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('admin/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
Route::post('admin/book', [BookController::class, 'store'])->name('book.store');


Route::resource('admin/author', 'App\Http\Controllers\AuthorController');

Route::get('/about', function () {
    return view('store.about');
})->name('about');

// Route::get('/pricing', function () {
//     return view('store.pricing');
// })->name('pricing');

// Route::get('/pricing', function () {
//     $plans = Plan::all();
//     return view('store.pricing', compact('plans'));
// })->name('pricing');

Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'index'])->name('pricing');


Route::get('/contact', function () {
    return view('store.contact');
})->name('contact');

Route::get('/terms', function () {
    return view('store.terms');
})->name('terms');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'update'])->name('user.profile.update');
});

Route::get('/authors/{id}', [AuthorController::class, 'showUser'])->name('author.details');

Route::get('/books', [BookController::class, 'indexRequest'])->name('book.indexRequest');

Route::get('/suggestions', [BookController::class, 'suggestions'])->name('book.suggestions');


Auth::routes(['reset' => true]);

// Reset Password Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'checkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::post('/request-plan-change', [PlanChangeRequestController::class, 'store'])->name('request.plan.change')->middleware('auth');

Route::get('/books/{book}/read', [BookController::class, 'read'])
    ->middleware(['auth', 'access.level'])
    ->name('book.read');
Route::get('/books/{book}/read', [BookController::class, 'read'])
    ->middleware('access.level');

Route::get('/books/{id}/first-page', [PdfToImageController::class, 'showFirstPage'])->name('books.first-page');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/books/{id}/favorite', [BookController::class, 'addToFavorites'])->name('book.favorite');
Route::post('/book/{id}/favorite', [BookController::class, 'toggleFavorite'])->name('book.favorite');

Route::get('/favorites', [BookController::class, 'favorites'])->name('book.favorites');

Route::get('/activities', function () {
    return view('activities');
})->name('activities');

Route::get('/books/{id}/read', [BookController::class, 'read'])->name('book.read');

Route::get('/books/{book}/read', [BookController::class, 'read'])
    ->middleware('access.level');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/plan-change-requests', [PlanChangeRequestController::class, 'index'])->name('plan-change-requests.index');
    Route::patch('/plan-change-requests/{id}/approve', [PlanChangeRequestController::class, 'approve'])->name('plan-change-requests.approve');
    Route::patch('/plan-change-requests/{id}/deny', [PlanChangeRequestController::class, 'deny'])->name('plan-change-requests.deny');
});

Route::get('/books/currently-reading', [BookController::class, 'currentlyReading'])->name('book.currentlyReading');
Route::post('/books/{book}/progress', [BookController::class, 'saveProgress'])->middleware('auth')->name('books.saveProgress');
Route::post('/books/{id}/rate', [BookController::class, 'rateBook'])->middleware('auth')->name('books.rate');

Route::get('/user-plans', [UserPlanController::class, 'index'])->name('user-plans.index');
Route::delete('/user-plans/{user}/revoke', [UserPlanController::class, 'revoke'])->name('user-plans.revoke');

Route::resource('activity', ActivityController::class);

Route::get('/authors/{id}/books', [AuthorController::class, 'showAuthorBooks'])->name('authors.books');

Route::get('/books/{id}', [App\Http\Controllers\BookController::class, 'show'])->name('books.show');

Route::get('/books/{id}/activities', [ActivityController::class, 'showBookActivities'])->name('book.activities');
