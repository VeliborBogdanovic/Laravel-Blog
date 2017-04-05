@extends('layouts.admin-master')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::to('public/css/form.css') }}" type="text/css"  >
    <link rel="stylesheet" href="{{ URL::to('public/css/test1.css') }}" type="text/css"  >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

@endsection

@section('content')
    <div class="container">
        <section class="list">
            @if(count($contact_messages)==0)
                No messages
            @endif
            @foreach($contact_messages as $contact_message)
                <article data-message="{{ $contact_message->body }}" data-id1="{{ $contact_message->id }}" class="contact-message" >
                    <div class="message-info">
                        <h3>{{ $contact_message->subject }}</h3>
                        <span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
                    </div>
                    <nav class="edit">
                        <ul>
                            {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#{{$contact_message->id}}">Open Modal</button>--}}
                            <li><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#{{$contact_message->id}}" >Show Message</a></li>
                           <li><a class="danger" href="javascript:void(0)" onclick="deleteMessage({{$contact_message->id}})" >Delete</a> </li>
                        </ul>
                    </nav>
                </article>
                    <div class="modal fade" id="{{ $contact_message->id }}" role="dialog">
                        <div class="modal-dialog" style="margin-top:10%">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ $contact_message->subject }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $contact_message->body }}.</p>
                                    <br/>
                                    {{--<p style="font-size: calc(100% - 8px); font-style: italic;">{{ $contact_message->sender }}  |  {{ $contact_message->created_at }}</p>--}}
                                </div>
                                <div class="modal-footer" style="position: relative !important;">
                                    <p style="font-size: calc(100% - 8px); font-style: italic;text-align: left;margin:0;position:absolute ;bottom:15px ;">From: <strong>{{ $contact_message->sender }}</strong>  |  Received: <strong>{{ $contact_message->created_at }}</strong></p>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
            @endforeach
        </section>
        @if($contact_messages->lastPage()>1)
            <section class='pagination1'>
                {{$contact_messages->links() }}
            </section>
        @endif
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var token="{{ Session::token() }}"
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::secure('public/js/contact_messages.js') }}"> </script>
@endsection
