<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    public function index()
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'slug' => 'admin_dashboard',
        ]);
    }

    public function show($slug)
    {
        return view('post', [
            'title' => 'Artikel',
            'post' => Post::find($slug)
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
