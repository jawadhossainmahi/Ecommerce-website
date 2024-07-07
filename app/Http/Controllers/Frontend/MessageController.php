<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageEmail;
use App\Mail\AdminMessageEmail;
use App\Rules\Recaptcha;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:450',
            'lname' => 'required',
            'email' => 'required',
            'g-recaptcha-response' =>
                ['required', new Recaptcha()]
        ]);
        // try {
        //     Mail::to($request->email)->bcc(env('MAIL_BCC_ADDRESS'))->from(env('MAIL_FROM_CHAT'))->send(new MessageEmail($request));
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Ogiltig e-postadress, kontrollera om det finns stavfel i e-postmeddelandet');
        // }
        // Mail::to(env('MAIL_FROM_CHAT'))->send(new AdminMessageEmail($request));

        try {
            Mail::to($request->email)->send(new MessageEmail($request));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ogiltig e-postadress, kontrollera om det finns stavfel i e-postmeddelandet');
        }
        Mail::to(env('MAIL_FROM_CHAT'))->send(new AdminMessageEmail($request));

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
