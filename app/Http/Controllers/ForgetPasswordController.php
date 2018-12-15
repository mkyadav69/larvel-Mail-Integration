<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Jobs\ProcessEmail;
class ForgetPasswordController extends Controller
{
    
    public function testMail(Request $request)
    {
        $token = Password::getRepository()->createNewToken();
        $url = route('check.mail', $token);
        ProcessEmail::dispatch('forget_password_link', 'mkyadav59@gmail.com', ['url' => $url])->onQueue('high');
    }
    public function setPassword()
    {
    	return view('email.check-mail');
    }
}
