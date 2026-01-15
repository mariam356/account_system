<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // رسالة لك
//        Mail::to('mariambabaqi@gmail.com')
//            ->replyTo($request->email, $request->name)
//            ->send(new TestMail([
//                'name' => $request->name,
//                'message' => $request->message
//            ]));


        Mail::to($request->email)->send(
            new TestMail([
                'name' => $request->name,
                'message' => $request->message
            ])
        );

        $user_id = User::where('email', $request->email)->get();

        Message::create(['sender_name' => $request->name, 'content' => $request->message, 'user_id' => $user_id->first()->id]);

        return back()->with('success', 'تم إرسال الرسالة بنجاح');
    }
}
