@extends('layouts.admin-master')
@section('styles')
    <link rel="stylesheet"  href="{{ URL::secure('public/css/admin.css') }}"  type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="container">
        @include('includes.info-box')
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.blog.create_post') }}" class="btn">New Post</a></li>
                        <li><a href="{{ route('admin.blog.index') }}" class="btn">Show all Posts</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($posts)===0)
                    <li>No Posts</li>
                    @else
                    @foreach($posts->all() as $post)
                    <!--if  posts -->
                    <li>
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
                    </li>
                    @endforeach
                    @endif
                </ul>
            </section>
        </div>
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.contact.index') }}" class="btn">Show all Messages</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                   @if (count($contact_messages)==0)
                    <li>No Messages</li>
                   @endif
                   @foreach($contact_messages as $contact_message)
                           <li>
                               <article data-message="{{ $contact_message->body }}" data-id1="{{ $contact_message->id }}" class="contact-message" >
                                   <div class="message-info">
                                       <h3>{{ $contact_message->subject }}</h3>
                                       <span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
                                   </div>
                                   <nav class="edit">
                                       <ul>
                                           {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#{{$contact_message->id}}">Open Modal</button>--}}
                                           <li><a href="#"  data-toggle="modal" data-target="#{{$contact_message->id}}" >Show Message</a></li>
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
                           </li>
                   @endforeach
                </ul>
            </section>
        </div>
    </div>
    <div class="modal" id="contact-message-info">
        <button class="btn" id="modal-close">Close</button>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var token="{{ Session::token() }}";
    </script>
    <script src="{{ URL::secure('public/js/admin.js') }}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::secure('public/js/contact_messages.js') }}"> </script>
@endsection