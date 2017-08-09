<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\User;
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
            'newpassword' => 'required|string|min:6|confirmed:newpassword2',
            'newpassword_confirmation' => 'required|min:6',
        ],
            $messages = array(
                'required' => 'Поле :attribute обязательно',
                'min' => 'Поле :attribute должно быть не менне 6 символов',
                'confirmed' => 'Пароли должны совпадать',
            )
        );

       if ( Hash::check($request->input('oldpassword'), Auth()->user()->password) ) {
           //echo "<h3>Совпали</h3>";
           $newpass = Hash::make($request->input('newpassword'));

           $user_pass = User::find(Auth()->user()->id);

           $user_pass->password = $newpass;
           $user_pass->save();

           return redirect('/settings')->with('success', 'Пароль был успешно изменен');
       } else {
           return redirect('/settings')->with('error', 'Старый пароль неверен');
       }
    }
}
