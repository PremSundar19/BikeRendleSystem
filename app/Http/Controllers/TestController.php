<?php

namespace App\Http\Controllers;

use App\Mail\TestEmailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public $name;
    public $email;

    public function __construct(){}

    public function sendEmail()
    {               
            $this->name = "Deepak"; //recipient name
            $this->email = "deepak.cotocus@gmail.com"; //recipient email id
            /**
             *creating an empty object of of stdClass
             *
             */
            $emailParams = new \stdClass(); 
            $emailParams->usersName = $this->name;
            $emailParams->usersEmail = $this->email;
           
            $emailParams->subject = "Testing Email sending feature";
            Mail::to($emailParams->usersEmail)->send(new TestEmailSender($emailParams));
    }   

    public function test(){            
           $this->sendEmail();
    }
}
