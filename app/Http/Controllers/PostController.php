<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    
    public function index()
    {
        return view('posts', [
            'title' => 'Blog',
            // 'posts' => Post::all() //you will not find class all in model, because it's default from laravel
            // 'posts'=> Post::latest()->get() //to get the newest data
            'posts'=> Post::with(['user','category'])->latest()->get() //Its use eager loading to avoid N+1 problem
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'title' => 'Artikel',
            'post' => $post
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
