<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packing;
use App\Contractor;
use App\Comment;

class PackingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Если суперадмин
        if(!Auth()->user()->group_id) {

            $packing = Packing::where('id', '>', '1')->get();
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


            return view('settings.packing.index', [
                'packing' => $packing,
                'notifications' => $notifications
            ]);
        }
        else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Если суперадмин
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

            $packing = new Packing();
            $packing->name = $request->input('name');
            $packing->save();

            return redirect('/settings/packings')->with('success', 'Добавлена новая запись');
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
        // Если суперадмин
        if(!Auth()->user()->group_id) {

            $packing = Packing::find($id);
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


            return view('settings.packing.edit')->with('packing', $packing)->with('notifications', $notifications);
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
        // Если суперадмин
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

            $packing = Packing::find($id);
            $packing->name = $request->input('name');
            $packing->save();

            return redirect('/settings/packings')->with('success', 'Запись отредактирована');
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
        // Если суперадмин
        if(!Auth()->user()->group_id) {
            $packing = Packing::find($id);
            // Контрагенты ищеюмие данный тип упаковки
            $contractors_packing = Contractor::where('packing_id', '=', $id)->get();

            if (!empty($contractors_packing)) {
                // Меняем тип упаковки на отсутствует у контрагентов с удаленной упаковкой
                foreach ($contractors_packing as $item) {
                    $item->packing_id = 1;
                    $item->save();
                }
            }

            $packing->delete();

            return redirect('/settings/packings')->with('success', 'Запись удалена');

        }
        else {
            abort(401);
        }
    }
}
