<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use App\Mail\AdminMessageEmail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->get();

        return view("backend.admin.message.index", get_defined_vars());
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.message');
    }

    public function store(Request $request)
    {

        try {
            Mail::to($request->email)->bcc(env('MAIL_BCC_ADDRESS'))->from(env('MAIL_FROM_CHAT'))->send(new MessageEmail($request));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ogiltig e-postadress, kontrollera om det finns stavfel i e-postmeddelandet');
        }
        Mail::to(env('MAIL_FROM_CHAT'))->from(env('MAIL_FROM_CHAT'))->send(new AdminMessageEmail($request));

        $message = new Message();
        $message->fname = $request->fname;
        $message->lname = $request->lname;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->orderno = $request->orderno;
        $message->save();





        return redirect()->back();
    }
}
