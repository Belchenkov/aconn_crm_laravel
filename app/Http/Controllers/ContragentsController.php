<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;
use App\User;

class ContragentsController extends Controller
{
    public function show()
    {

        $contractors = Contractor::all();
        $managers = User::where('group_id', '>', '1')->get();

        return view('pages.contragents', ['contractors' => $contractors, 'managers' => $managers]);
    }
}
