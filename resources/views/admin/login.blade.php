@extends('layouts.master')
@section('styles')
    <link rel="stylesheet"  href="{{ URL::secure('public/css/form.css') }}"  type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="container">
        @include('includes.info-box')
        <form action="{{ route('admin.login') }}" method="POST">
            <div class="input-group">
                <label for="email">E-Mail</label>
                <input type="text" id="email" name="email" value="{{ Request::Old('email') }}"  {{ $errors->has('email') ? 'class=has-error': '' }} />
            </div>
            <div class="input-group">
                <label for="password">E-Mail</label>
                <input type="password" id="password" name="password" {{ $errors->has('password') ? 'class=has-error': '' }} />
            </div>
            <div class="input-group">
            <button type="submit" class="btn lg" id="submit">Login</button>
            <input type="hidden" name="_token" value="{{ Session::token() }}" />
            </div>
        </form>
    </div>
@endsection