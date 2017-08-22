<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;
use App\Comment;

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
        // Напоминания
        $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


        if (Auth()->user()->group_id == 2) {
            $count_contractors = Contractor::where('user_id', '=', Auth()->id())->get()->count();
        }

        return view('home', [
            'count_contractors' => $count_contractors,
            'notifications' => $notifications
        ]);
    }

    public function getNotification()
    {
        $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

        return view();
    }
}
