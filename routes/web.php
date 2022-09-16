<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;


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
// //with closure
// Route::get('/', function(){
    //fetch data from database
    //create some logic
//     return view('welcome');
// });
//with controller
//to welcome
Route::get('/',[WelcomeController::class,'index'])->name('welcome.index');
Route::get('/blog',[BlogController::class,'index'])->name('blog.index');


Route::get('/about-us', function(){
    return view('about');
})->name('about');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

// To Send data to email.
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//we can use middleware here
//Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create')->middleware('auth');
Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
Route::get('/blog/{post:slug}',[BlogController::class,'show'])->name('blog.show');
Route::get('/blog/{post}/edit',[BlogController::class,'edit'])->name('blog.edit');

Route::put('/blog/{post}',[BlogController::class,'update'])->name('blog.update');

Route::delete('/blog/{post}',[BlogController::class,'destroy'])->name('blog.destroy');

Route::post('/blogs',[BlogController::class,'store'])->name('blog.store');

// Category resource controller
Route::resource('/categories', CategoryController::class);

// The resource controller above under the hood.

// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
// Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
// Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
