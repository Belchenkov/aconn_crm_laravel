<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment_req = $request->input('comment');
        $contractors_id = $request->input('contractors_id');
        $user_id = $request->input('user_id');
        $notification = $request->input('');
        $notification_date = $request->input('notification_date');
        $notification_time = $request->input('notification_time');
        $date_create = date("H:m:s d-m-Y");

        dd($notification_time);

        $comment = new Comment();

        //return redirect('/contractors/details/'.$id)->with('success', 'Комментарий добавлен');
    }
}
