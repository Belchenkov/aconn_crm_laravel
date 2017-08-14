<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class EmployeesController extends Controller
{
    public function index()
    {
        $employees_active = User::where('id', '<>', 10)->where('status', '=', '1')->get();
        $employees_dismiss = User::where('id', '<>', 10)->where('status', '=', '0')->get();

        return view('pages.employees.index', [
            'employees_active' => $employees_active,
            'employees_dismiss' => $employees_dismiss
        ]);
    }

    public function create()
    {
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            return view('pages.employees.create');
        }
        else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
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

            $user = new User();
            $user->email = $request->input('login');
            $user->fio = $request->input('fio');
            $user->group_id = $request->input('group');
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
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            $employe = User::find($id);
            return view('pages.employees.edit', [
                'employe' => $employe,
            ]);
        }
        else {
            abort(401);
        }
    }

    public function update($id)
    {
        return 'Update';
    }

}
