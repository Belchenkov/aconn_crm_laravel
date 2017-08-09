<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packing;
use App\Contractor;

class PackingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth()->user()->group_id) {

            $packing = Packing::where('id', '>', '1')->get();

            return view('settings.packing.index', [
                'packing' => $packing,
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

            $packing = Packing::find($id);

            return view('settings.packing.edit')->with('packing', $packing);
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

        $packing = Packing::find($id);
        $packing->name = $request->input('name');
        $packing->save();

        return redirect('/settings/packings')->with('success', 'Запись отредактирована');
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
            $packing = Packing::find($id);
            $contractors_packing = Contractor::where('packing_id', '=', $id)->get();

            if (!empty($contractors_packing)) {
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
