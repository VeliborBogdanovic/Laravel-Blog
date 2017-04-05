
@extends('layouts.admin-master')
@section('styles')
    <link rel="stylesheet"  href="{{ URL::secure('public/css/form.css') }}"  type="text/css">
@endsection
@section('content')
    <div class="container">
        @include('includes.info-box')
        <section id="post-admin">
            <a href="{{ route('admin.blog.create_post') }}" class="btn">New Post</a>
        </section>
        <section class="list">

                @if(count($posts)===0)
                    <li>No Posts</li>
                @else
                    @foreach($posts->all() as $post)
                    <!--if  posts -->

                            <article>
                                <div class="post-info">
                                    <h3>{{ $post->title }}</h3>
                                    <span class="info">{{$post->author }} | {{$post->created_at}}</span>
                                </div>
                                <div class="edit">
                                    <nav>
                                        <ul>
                                            <li><a href="{{ route('admin.blog.post',['post_id'=>$post->id,'end'=>'admin']) }}">View post</a></li>
                                            <li><a href="{{ route('admin.blog.post.edit',['post_id'=>$post->id]) }}" class="edit-link">Edit</a></li>
                                            <li><a href="{{ route('admin.blog.post.delete',['post_id'=>$post->id]) }}" class="danger">Delete</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </article>

                    @endforeach
                @endif

        </section>
        @if($posts->lastPage()>1)
            <section class='pagination1 '>
                {{$posts->links() }}

            </section>
        @endif
    </div>

@endsection