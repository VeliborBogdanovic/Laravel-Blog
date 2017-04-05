@extends('layouts.master')
@section('title')
    {{ $post->title }}
@endsection
@section('content')
    <div class="container" id="single-container">
        {{--<section id="post-admin">--}}
            {{--<a href="{{ route('admin.blog.post.edit',['post_id'=>$post->id]) }}" class="edit-link">Edit Post</a>--}}
            {{--<a href="{{ route('admin.blog.post.delete',['post_id'=>$post->id]) }}" class="danger">Delete Post</a>--}}
        {{--</section>--}}
        <section class="post">
            <h1>{{ $post->title }}</h1>
            <span class="info">{{ $post->author }} | {{ $post->created_at }}</span><br/><br/>
            <span>Categories:
                @foreach($post_categories as $post_category)
                    <strong>{{ $post_category->name }}</strong>
                @endforeach
            </span><br/><br/>
            <p>{{ $post->body }}</p>
        </section>
    </div>
@endsection