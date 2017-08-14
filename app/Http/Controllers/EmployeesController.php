<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


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
}
