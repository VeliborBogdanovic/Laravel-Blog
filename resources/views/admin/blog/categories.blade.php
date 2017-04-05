@extends('layouts.admin-master')
@section('title')
@endsection
@section('styles')
    <link rel="stylesheet"  href="{{ URL::secure('public/css/categories.css') }}"  type="text/css">
@endsection
@section('content')
    <div class="container">
        <section id="category-admin">
            <form action="" method="post">
                <div class="input-group left">
                    <label for="name" style="float:left">Category name</label>
                    <input type="text" name="name" id="name" style="float:left;width:300px;"/>
                    <button type="submit" class="btn" style="float:left" id="create_category">Create Category</button>
                </div>
            </form>
        </section>
        <section class="list">
            @foreach($categories as $category)
                <article>
                <div class="category-info">
                    <h3 id="cat_name{{ $category->id }}">{{ $category->name }}</h3>
                </div>
                <nav class="edit">
                    <ul>
                        <li class="category-edit"><input id="{{ $category->id }}" type="text"></li>
                        <li><a href="javascript:void(0) " onclick="edit({{$category->id}})" id="edit{{$category->id}}" class="edit-link">Edit</a> </li>
                        {{--<li><a href="javascript:void(0) " onclick="edit({{$category->id}})" id="edit" class="edit-link">Edit</a> </li>--}}
                        <li><a class="danger" href="javascript:void(0)" onclick="deleteCategory({{$category->id}})" >Delete</a> </li>
                    </ul>
                </nav>
                </article>
            @endforeach
        </section>
        @if($categories->lastPage()>1)
            <section class='pagination1'>
                {{$categories->links() }}
            </section>
        @endif
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" >
        var token="{{ Session::token() }}"
    </script>
    <script type="text/javascript" src="{{ URL::secure('public/js/categories.js') }}"></script>
@endsection