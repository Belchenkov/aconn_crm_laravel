<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
    protected $redirectPath = '/home';

    public function getLogin()
    {
        $email = Input::get('login');
        $password = Input::get('password');

        //dd($password);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            echo '<h2>Enter</h2>';
            return redirect()->intended('/home');
        }
    }
}
