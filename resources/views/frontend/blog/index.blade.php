@extends('layouts.master')

@section('title')
    Blog index
@endsection

@section('content')
    @include('includes.info-box')
    @foreach($posts->all() as $post)
    <div class="col-lg-4 col-sm-12 col-md-12">
     <article class="blog-post">
         <h3>{{ $post->title }}</h3>
         <span class="subtitle">{{ $post->author }} | {{ $post->created_at }}</span>
         <p>{{ $post->body }}</p>
         <div class="read-more">
             <a href="{{ route('blog.single',['post_id'=>$post->id,'end'=>'frontend']) }}">Read more</a>
         </div>

     </article>
    </div>
    @endforeach

    @if($posts->lastPage()>1)
         <section class='pagination1 col-sm-12 col-xs-12 col-md-12 col-lg-12'>
             {{$posts->links() }}
         </section>
    @endif

@endsection
