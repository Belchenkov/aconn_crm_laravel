<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WhatWork;
use App\Contractor;

class WhatWorksController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function index()
    {
        if(!Auth()->user()->group_id) {

            $what_works = WhatWork::where('id', '>', '1')->get();

            return view('settings.what_works.index', [
                'what_works' => $what_works
            ]);
        }
        else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

            $what_work = new WhatWork();
            $what_work->name = $request->input('name');
            $what_work->save();

            return redirect('/settings/what-works')->with('success', 'Добавлена новая запись');
        }
        else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth()->user()->group_id) {

            $what_works = WhatWork::find($id);

            return view('settings.what_works.edit')->with('what_works', $what_works);
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
        // Validate
        $this->validate($request, [
            'name' => 'required|max:255',
        ],
            $messages = array(
                'required' => 'Поле :attribute обязательно',
                'max' => 'Поле :attribute должно быть не более 255 символов'
            )
        );

        $contractors_what_works = Contractor::where('what_work_id', '=', $id)->get();

        if (!empty($contractors_what_works)) {
            foreach ($contractors_what_works as $item) {
                $item->what_work_id = $request->input('id');
                $item->save();
            }
        }

        $what_work = WhatWork::find($id);
        $what_work->name = $request->input('name');
        $what_work->save();

        return redirect('/settings/what-works')->with('success', 'Запись отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth()->user()->group_id) {
            $what_work = WhatWork::find($id);
            $contractors_what_works = Contractor::where('what_work_id', '=', $id)->get();

            if (!empty($contractors_what_works)) {
                foreach ($contractors_what_works as $item) {
                    $item->what_work = 1;
                    $item->save();
                }
            }

            $what_work->delete();

            return redirect('/settings/what-works')->with('success', 'Запись удалена');

        }
        else {
            abort(401);
        }
    }
}
