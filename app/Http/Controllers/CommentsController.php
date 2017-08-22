<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{

    public function store(Request $request)
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            $notification_date = $request->input('notification_date');
            $notification_time = $request->input('notification_time');
            $notification_date = $notification_date . ' ' . $notification_time;
            $contractor_id = $request->input('contractor_id');

            $comment = new Comment();
            $comment->user_id = $request->input('user_id');
            $comment->contractor_id = $contractor_id;
            $comment->comments = $request->input('comment');
            $comment->reminder_status = $request->input('notification_active');
            $comment->reminder = 0;
            if ($notification_date != " ") {
                $comment->date_reminder = $notification_date;
                $comment->reminder = $request->input('notification');
            }

            $comment->save();

            return redirect('/contractors/details/' . $contractor_id)->with('success', 'Комментарий добавлен');
        }
    }
}
