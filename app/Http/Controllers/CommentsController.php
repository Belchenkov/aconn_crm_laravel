<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $notification_date = $request->input('notification_date');
        $notification_time = $request->input('notification_time');
        $notification_date = $notification_date . ' ' . $notification_time;
        $contractor_id = $request->input('contractor_id');
        //dd($date);
        $comment = new Comment();
        $comment->user_id = $request->input('user_id');
        $comment->contractor_id = $contractor_id;
        $comment->comments = $request->input('comment');
        $comment->reminder = $request->input('notification');
        $comment->date_reminder = $notification_date;
        $comment->reminder_status = $request->input('notification_active');
        $comment->save();

        //dd($comment);
        return redirect('/contractors/details/' . $contractor_id)->with('success', 'Комментарий добавлен');
    }
}
