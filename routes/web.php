<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UnitsController;
use \App\Http\Controllers\ProductsController;

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

	Route::get('/', function () {
	    return view('vendor.adminlte.auth.login');
	});
	
	
	Route::prefix('admin')->group(function () {
		Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
		Route::resource('categories', CategoriesController::class);
		Route::resource('units', UnitsController::class);
		Route::resource('products', ProductsController::class);
		
		
	});

	Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	    return view('home.index');
	})->name('dashboard');
