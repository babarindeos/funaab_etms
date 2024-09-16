<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleMail;
use App\Mail\ParamsMail;


class MailTestController extends Controller
{
    //

    public function dispatch()
    {
        Mail::to("kondishiva007@gmail.com")->send(new SimpleMail());

        return "Sent mail";
    }

    public function param_dispatch()
    {
        $name = "Babarinde Oluwaseyi";
        $email = "kondishiva008@gmail.com";

        Mail::to($email)->send(new ParamsMail($name));

        return response()->json(['message' => 'message sent']);

    }
}
