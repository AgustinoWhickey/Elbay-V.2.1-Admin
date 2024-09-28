<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;

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


