<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function changePass(Request $request)
    {

        $this->validate($request, [
            'oldpassword' => 'required|string',
            'newpassword' => 'required|string|min:6|confirmed',
            'newpassword2' => 'required|min:6',
        ],
            $messages = array(
                'required' => 'Поле :attribute обязательно',
                'min' => 'Поле :attribute должно быть не менне 6 символов',
                'confirmed' => 'Пароли должны совпадать',
                'unique'   => 'Поле :attribute должно быть уникальным'
            )
        );

        //dd(Hash::make($request->input('oldpassword')));
       if ( Hash::check($request->input('oldpassword'), Auth()->user()->password) ) {
            echo "<h3>Совпали</h3>";
           //$newpass = Hash::make($request->input('newpassword'));
           //dd($newpass);
       } else {
           return view('settings.index')->with('error', 'sdrfwe');
       }
    }
}
