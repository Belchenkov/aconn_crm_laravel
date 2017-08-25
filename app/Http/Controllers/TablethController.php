<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tableth;
use App\Comment;

class TablethController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Заголовки таблицы контрагентов
        $table_th = Tableth::all();
        // Напоминания
        $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

        return view('settings.table-th.index', [
            'table_th' => $table_th,
            'notifications' => $notifications
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {

            // Validate
            $this->validate($request, [
                'name' => 'required|max:255'
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов'
                )
            );

            $table_th = new Tableth();
            $table_th->name = $request->input('name');
            $table_th->save();

            return redirect('/settings/table-th')->with('success', 'Добавлена новая запись');
        }
        else {
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {

            $table_th = Tableth::find($id);
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

            return view('settings.table-th.edit')->with('table_th', $table_th)->with('notifications', $notifications);
        }
        else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {
            // Validate
            $this->validate($request, [
                'name' => 'required|max:255',
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов'
                )
            );

            $table_th = Tableth::find($id);
            $table_th->name = $request->input('name');
            $table_th->save();

            return redirect('/settings/table-th')->with('success', 'Запись отредактирована');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {

            $table_th = Tableth::find($id);
            $table_th->delete();

            return redirect('/settings/table-th')->with('success', 'Запись удалена');
        }
        else {
            abort(401);
        }
    }
}
