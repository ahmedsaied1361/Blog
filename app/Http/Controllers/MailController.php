<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('your_email@gmail.com')->send(new TestMail($mailData));

        dd("Email is sent successfully.");
    }
}
