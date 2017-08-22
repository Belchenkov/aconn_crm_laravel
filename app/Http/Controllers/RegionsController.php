<?php

namespace App\Http\Controllers;

use App\Contractor;
use Illuminate\Http\Request;
use App\Region;
use App\Comment;
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
        // Если суперадмин
        if(!Auth()->user()->group_id) {

            $managers = User::where('group_id', '=', '2')->get();
            $regions = Region::where('id', '>', '1')->get();
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();


            return view('settings.regions.index', [
                'managers' => $managers,
                'regions' => $regions,
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
            // Назначенный менеджер
            $region->user_id = $request->input('manager');
            $region->save();

            return redirect('/settings/regions')->with('success', 'Регион добавлен');
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

            $managers = User::where('group_id', '=', '2')->get();
            $region = Region::find($id);
            // Напоминания
            $notifications = Comment::where('reminder', '=', '1')->where('user_id', '=', Auth()->id())->get();

            return view('settings.regions.edit', [
                'managers' => $managers,
                'region' => $region,
                'notifications' => $notifications
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
        // Если суперадмин
        if(!Auth()->user()->group_id) {
            // Validate
            $this->validate($request, [
                'name' => 'required|max:255',
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 255 символов',
                )
            );
            // Контрагенты привязанные к текущему региону
            $contractors_region = Contractor::where('region_id', '=', $id)->get();
            $region = Region::find($id);

            if (!empty($contractors_region)) {
                // При изменении менеджера у текущего региона
                foreach ($contractors_region as $item) {
                    // Если менеджер не закреплен за контрагентом
                    if ($item->assign_manager !== 1) {
                        // Меняем менеджера у контрагента
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
            $region = Region::find($id);
            // Контрагенты в текущем регионе
            $contractors_region = Contractor::where('region_id', '=', $id)->get();

            if (!empty($contractors_region)) {
                foreach ($contractors_region as $item) {
                    // Меняем регион у контрагентов на отсутствует
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
