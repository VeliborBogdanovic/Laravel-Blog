
@extends('layouts.admin-master')
@section('styles')
    <link rel="stylesheet"  href="{{ URL::secure('public/css/form.css') }}"  type="text/css">
@endsection
@section('content')
    <div class="container" id="post-form">
        @include('includes.info-box')
        <form method="post" action="{{ route('admin.blog.post.update') }}">
            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" {{ $errors->has('title')? 'class=has-error':''}} value="{{Request::old('title') ? Request::old('title') : isset($post) ? $post->title:''}}" />

            </div>
            <div class="input-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" {{ $errors->has('author')? 'class=has-error':'' }} value="{{Request::old('author') ? Request::old('author') : isset($post) ? $post->author:''}} "/>
            </div>
            <div class="input-group">
                <label for="category_select">Add Categories</label>
                <select name="category_select" class="category_select" id="category_select">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach

                </select>
                <button type="button" id="addCategory" class="btn" >Add Category</button>
                <div class="added-categories">
                    <ul>
                        @foreach($post_categories as $post_categories)
                            <li class="list1"  data-id="{{$post_categories->id}}" ><a href="javascript:void(0)" name="{{$post_categories->name}}" id="cat{{$post_categories->id}}"  onclick="removeCategory({{$post_categories->id}})">{{$post_categories->name}}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{--@foreach($post_categories as $post_categories)--}}

                {{--@endforeach--}}

                <input type="hidden" name="categories"  value="0" id="categories" />
            </div>

            <div class="input-group" >
                <label for="body">Body</label>
                <textarea  name="body" id="body" rows="12" {{ $errors->has('body')? 'class=has-error':'' }} >{{Request::old('body') ? Request::old('body') : isset($post) ? $post->body:''}}</textarea>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" >Update Post</button>
            </div>
            <input type="hidden" name="post_id"  value="{{ $post->id }}" id="post_id" />
            <input type="hidden" name="_token" value="{{ Session::token() }}"/>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::secure('public/js/posts.js') }}"></script>
    <script type="text/javascript">

    </script>
@endsection