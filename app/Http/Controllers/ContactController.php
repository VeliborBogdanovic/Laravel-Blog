<?php

namespace App\Http\Controllers;
use App\ContactMessage;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContactIndex()
    {
        return view('frontend.other.contact');
    }
    public function postSendMessage(Request $request)
    {
        $this->validate($request,
        [
            'email'=>'required|email',
            'name'=>'required|min:3|max:50',
            'subject'=>'required|max:150',
            'message'=>'required|min:5'

        ]);

        $message=new ContactMessage();
        $message->email=$request['email'];
        $message->sender=$request['name'];
        $message->subject=$request['subject'];
        $message->body=$request['message'];
        $message->save();
        event(new MessageSent($message));
        return redirect()->route('contact')->with(['success'=>'Message successfully send']);

    }
    public function getContactMessageIndex()
    {
        $contact_messages=ContactMessage::orderBy('created_at','desc')->paginate(5);
        return view('admin.other.contact_messages',['contact_messages'=>$contact_messages]);

    }
    public function getDeleteContactMessage(Request $request)
    {
        ContactMessage::find($request['id'])->delete();
        return response()->json(['message'=>'Successfully deleted']);
    }
}
