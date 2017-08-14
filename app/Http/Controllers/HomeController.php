<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Общее количество контрагентов(организаций)
        $count_contractors = Contractor::get()->count();

        return view('home', [
            'count_contractors' => $count_contractors
        ]);
    }
}
