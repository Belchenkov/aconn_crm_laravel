<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;
use App\Region;
use App\User;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth()->user()->group_id) {
            $managers = User::where('group_id', '=', '2')->get();
            //dd($managers);
            $regions = Region::where('id', '>', '1')->get();

            return view('settings.regions.index', [
                'managers' => $managers,
                'regions' => $regions
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
                'name' => 'required|max:255',
                'manager' => 'required|integer'
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов',
                    'integer'   => 'Поле :attribute должно быть числовым'
                )
            );

            $region = new Region();
            $region->name = $request->input('name');
            $region->user_id = $request->input('manager');
            $region->save();

            return redirect('/settings/regions')->with('success', 'Регион добавлен');
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

            $managers = User::where('group_id', '=', '2')->get();
            //dd($managers);
            $region = Region::find($id);

            return view('settings.regions.edit', [
                'managers' => $managers,
                'region' => $region
            ]);
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
                'max' => 'Поле :attribute должно быть не более 255 символов',
            )
        );
        $contractors_region = Contractor::where('region_id', '=', $id)->get();
        $region = Region::find($id);

        if (!empty($contractors_region)) {
            foreach ($contractors_region as $item) {
                if ($item->assign_manager !== 1) {
                    $item->user_id = $request->input('manager');
                }
                $item->save();
            }
        }
        $region->name = $request->input('name');
        $region->user_id = $request->input('manager');
        $region->save();

        return redirect('/settings/regions')->with('success', 'Регион отредактирован');
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
            $region = Region::find($id);
            $contractors_region = Contractor::where('region_id', '=', $id)->get();

            if (!empty($contractors_region)) {
                foreach ($contractors_region as $item) {
                    $item->region_id = 1;
                    $item->save();
                }
            }

            $region->delete();

            return redirect('/settings/regions')->with('success', 'Регион удален');

        }
        else {
            abort(401);
        }
    }
}
