@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1> {{ $post->title   }}</h1>
                <article class="mb-5">
                    <p>By <a href="/author/{{ $post->user->username }}" class="text-decration-none"> {{ $post->user->name   }}</a> in <a href="/categories/ $post->category->slug   }}"> {{ $post->category->name  }}</a></p>
                    {!! $post->body !!}
                </article>

                <a href="/blog">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection