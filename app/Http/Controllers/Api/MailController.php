<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        Mail::to('contact@atoshin.art')->send(new ContactUsMailSender($request->data));
        return response()->json([
            'message'=>'Email sent'
        ]);
    }
}
