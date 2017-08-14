<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodicity;
use App\Contractor;

class PeriodicityController extends Controller
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

            $periodicity = Periodicity::where('id', '>', '1')->get();

            return view('settings.periodicity.index', [
                'periodicity' => $periodicity,
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

            $periodicity = new Periodicity();
            $periodicity->name = $request->input('name');
            $periodicity->save();

            return redirect('/settings/periodicity')->with('success', 'Добавлена новая запись');
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

            $periodicity = Periodicity::find($id);

            return view('settings.periodicity.edit')->with('periodicity', $periodicity);
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

            $periodicity = Periodicity::find($id);
            $periodicity->name = $request->input('name');
            $periodicity->save();

            return redirect('/settings/periodicity')->with('success', 'Запись отредактирована');
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
            $periodicity = Periodicity::find($id);
            // Все контрагенты с удаляемой периодичностью
            $contractors_periodicity = Contractor::where('periodicity_id', '=', $id)->get();

            if (!empty($contractors_periodicity)) {
                // Меняем на отсутствует у контрагентов с удаленной периодичностью
                foreach ($contractors_periodicity as $item) {
                    $item->periodicity_id = 1;
                    $item->save();
                }
            }

            $periodicity->delete();

            return redirect('/settings/periodicity')->with('success', 'Запись удалена');

        }
        else {
            abort(401);
        }
    }
}
