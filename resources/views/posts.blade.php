@extends('layouts.main')

@section('container')
    <h1 class="mb-5">{{ $title }}</h1>

    @if($posts->count())
        <div class="card mb-3">
            <img src="{{ asset('img/image.jpg') }} " class="card-img-top" alt="...">
            <div class="card-body text-center">
                <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title  }}</a></h5>
                <p>
                    <small class="text-body-secondary">
                        By <a href="/authors/{{ $posts[0]->user->username }}"> {{ $posts[0]->user->name }}</a> in <a href="/categories/{{ $posts[0]->category->slug   }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a>{{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>

                <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn-primary">Read more..</a>
            </div>
        </div>
    @else
     <p class="text-center fs-4">Post not found</p>
    @endif

    <div class="container">
        <div class="row">
        @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute bg-dark p-1 text-white" style="background-color:rgba(0,0,0,0.7);"><a href="/categories/{{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>
                    <img src="{{ asset('img/image.jpg') }}" alt="" class="card-img-top">
                    <div class="card-body">
                        <div class="card-title">{{ $post->title }}</div>
                        <p>
                            <small class="text-body-secondary">
                                By <a href="/authors/{{ $post->user->username }}"> {{ $post->user->name }}</a> {{ $post->created_at->diffForHumans() }}
                            </small>
                        </p>
                        <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read More..</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection