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

            $old_active_comment = Comment::where('reminder_status', '=', 1)->where('user_id', '=', Auth()->id())->get();

            //dd($old_active_comment);

            $comment = new Comment();
            $comment->user_id = $request->input('user_id');
            $comment->contractor_id = $contractor_id;
            $comment->comments = $request->input('comment');
            $comment->reminder = 0;
            $comment->reminder_status = 0;

            if ($notification_date != " ") {
                $comment->date_reminder = $notification_date;
                $comment->reminder = 1;
                $comment->reminder_status = 1;

                // Деактивируем старую запись
                if (count($old_active_comment[0]) > 0) {
                    $old_active_comment[0]->reminder_status = 2;
                    $old_active_comment[0]->save();
                }
            }

            $comment->save();

            return redirect('/contractors/details/' . $contractor_id)->with('success', 'Комментарий добавлен');
        }
    }
}
