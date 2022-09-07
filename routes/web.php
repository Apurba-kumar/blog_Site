<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;

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

//we can use middleware here
//Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create')->middleware('auth');
Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
Route::get('/blog/{post:slug}',[BlogController::class,'show'])->name('blog.show');
Route::get('/blog/{post}/edit',[BlogController::class,'edit'])->name('blog.edit');

Route::put('/blog/{post}/update',[BlogController::class,'update'])->name('blog.update');

Route::post('/blogs',[BlogController::class,'store'])->name('blog.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
