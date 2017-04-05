@extends('layouts.master')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::to('public/css/form.css') }}" type="text/css"  >
@endsection

@section('content')
    @include('includes.info-box')
    <form action="{{ route('contact.send') }}" method="POST" id="contact-form">
        <div class="input-group">
            <label for="name">Your name</label>
            <input type="text" name="name" id="name" value="{{ Request::old('name') }}"/>
        </div>
        <div class="input-group">
            <label for="email">Your email</label>
            <input type="text" name="email" id="email" value="{{ Request::old('email') }}"/>
        </div>
        <div class="input-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ Request::old('subject') }}"/>
        </div>
        <div class="input-group">
            <label for="message">Message</label>
           <textarea name="message" id="message" rows="10" >{{ Request::old('message') }}</textarea>
        </div>
        <div class="input-group">
            <button type="submit" class="btn">Submit message</button>
        </div>
        <input type="hidden" value="{{ Session::token() }}" name="_token"/>
    </form>
@endsection