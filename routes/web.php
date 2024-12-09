<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;

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

/* Admin */
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('loggedin');


Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
    return view('about', [
        "name" => "Agus Tino Wicaksono",
        "email" => "agustinowicaksono@gmail.com",
        "image" => "img/logo.png",
        'title' => 'About'
    ]);
});

Route::get('/blog', [PostController::class, 'index']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function(){
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all()
    ]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts',[
        'title' => "Post by Category : $category->name",
        'posts' => $category->posts->load('category','user'),
    ]);
});

Route::get('/authors/{user:username}', function(User $user){
    return view('posts',[
        'title' => "Post By Author : $user->name",
        'posts' => $user->posts->load('category','user'),
    ]);
});


/* Authentication */
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/set_login/{email}', [LoginController::class, 'set_login']);

Route::post('/register', [LoginController::class, 'register']);
Route::get('/set_register/{token}', [LoginController::class, 'set_register']);

Route::post('/logout', [LoginController::class, 'logout']);

