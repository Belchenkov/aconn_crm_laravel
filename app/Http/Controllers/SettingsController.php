<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        // Напоминания
        $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {
            return view('settings.index', ['notifications' => $notifications]);
        }
    }

    public function changePass(Request $request)
    {
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {
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

            // Если старый пароль верен
            if (Hash::check($request->input('oldpassword'), Auth()->user()->password)) {
                // Хешируем новый пароль
                $newpass = Hash::make($request->input('newpassword'));

                // Достаем старый пароль
                $user_pass = User::find(Auth()->user()->id);

                // И перезаписываем на новый
                $user_pass->password = $newpass;
                $user_pass->save();

                return redirect('/settings')->with('success', 'Пароль был успешно изменен');
            } else {
                return redirect('/settings')->with('error', 'Старый пароль неверен');
            }
        }
    }
}
