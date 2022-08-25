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
Route::get('/blog/single-blog-post',[BlogController::class,'show'])->name('blog.show');

Route::get('/about-us', function(){
    return view('about');
})->name('about');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
