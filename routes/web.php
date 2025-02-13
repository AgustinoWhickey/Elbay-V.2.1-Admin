<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\UserBranchController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\StockController;

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

/* Authentication */
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/set_login/{email}', [LoginController::class, 'set_login']);

Route::post('/register', [LoginController::class, 'register']);
Route::get('/set_register/{token}', [LoginController::class, 'set_register']);

Route::post('/logout', [LoginController::class, 'logout']);

/* Admin */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('loggedin');

Route::resource('/branch', BranchController::class)->middleware('loggedin');
Route::resource('/userbranch', UserBranchController::class)->middleware('loggedin');
Route::resource('/supplier', SupplierController::class)->middleware('loggedin');
Route::resource('/category', CategoryController::class)->middleware('loggedin');
Route::resource('/item', ItemController::class)->middleware('loggedin');
Route::resource('/stock', StockController::class)->middleware('loggedin');

