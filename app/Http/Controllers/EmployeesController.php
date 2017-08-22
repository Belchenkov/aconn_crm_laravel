<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Hash;


class EmployeesController extends Controller
{
    public function index()
    {
        // Активные сотрудники
        $employees_active = User::where('id', '<>', 1)->where('status', '=', '1')->get();
        // Уволенные сотрудники
        $employees_dismiss = User::where('id', '<>', 1)->where('status', '=', '0')->get();
        // Напоминания
        $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


        return view('pages.employees.index', [
            'employees_active' => $employees_active,
            'employees_dismiss' => $employees_dismiss,
            'notifications' => $notifications
        ]);
    }

    public function create()
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

            return view('pages.employees.create', ['notifications' => $notifications]);
        }
        else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Validate
            $this->validate($request, [
                'fio' => 'required|max:255',
                'login' => 'required|max:255',
                'password' => 'required|max:255|min:6',
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов',
                    'min' => 'Пароль должен быть не менее 6 символов',
                )
            );

            // Хешируем введенные пароль
            $password = Hash::make($request->input('password'));

            $user = new User();
            $user->email = $request->input('login');
            $user->fio = $request->input('fio');
            // Из какой группы
            $user->group_id = $request->input('group');
            // Должность
            $user->position = $request->input('position');
            $user->status = $request->input('status');
            $user->password = $password;

            $user->save();

            return redirect('/employees')->with('success', 'Сотрудник добавлен');
        }
        else {
            abort(401);
        }
    }

    public function edit($id)
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {

            $employe = User::find($id);
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


            return view('pages.employees.edit', [
                'employe' => $employe,
                'notifications' => $notifications
            ]);
        }
        else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Validate
            $this->validate($request, [
                'fio' => 'required|max:255',
                'login' => 'required|max:255',
                'password' => 'required|max:255|min:6',
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов',
                    'min' => 'Пароль должен быть не менее 6 символов',
                )
            );

            $password = Hash::make($request->input('password'));

            $user = User::find($id);
            $user->email = $request->input('login');
            $user->fio = $request->input('fio');
            $user->group_id = $request->input('group');
            $user->position = $request->input('position');
            $user->status = $request->input('status');
            $user->password = $password;

            $user->save();

            return redirect('/employees')->with('success', 'Данные о сотруднике обновлены');
        } else {
            abort(401);
        }
    }

}
