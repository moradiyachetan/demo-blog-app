<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;

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

Route::get('/', [LoginController::class,'index'])->name('login');

//Route::view('users', 'users');
//Route::view('about', 'about');
//Route::get('users', [UsersController::class,'loadView']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
});
