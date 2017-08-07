<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;
use App\User;
use App\ContractorStatus;
use App\Region;
use App\WhatWork;
use App\Periodicity;
use App\Packing;

class ContractorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = Contractor::all();
        $users = User::all();
        $managers = User::where('group_id', '=', '2')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::all();
        $what_work = WhatWork::all();

        return view('pages.contractors.index', [
            'contractors' => $contractors,
            'managers' => $managers,
            'contractor_statuses' => $contractor_statuses,
            'regions' => $regions,
            'what_work' => $what_work,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            $contractors = Contractor::all();
            $managers = User::where('group_id', '=', '2')->get();
            $contractor_statuses = ContractorStatus::all();
            $regions = Region::all();
            $what_work = WhatWork::all();
            $periodicity = periodicity::all();
            $packing = packing::all();

            return view('pages.contractors.create',  [
                'contractors' => $contractors,
                'managers' => $managers,
                'contractor_statuses' => $contractor_statuses,
                'regions' => $regions,
                'what_work' => $what_work,
                'periodicity' => $periodicity,
                'packing' => $packing
            ]);
        }
        else {
            abort(404);
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
        // Validate
        $this->validate($request, [
            'name' => 'required|unique:contractors|max:255',
            'region_id' => 'required',
            'inn' => 'unique:contractors|max:255',
            'phone' => 'required|unique:contractors|max:255',
            'contract_number' => 'required|unique:contractors|max:255',
            'packing_id' => 'required',
            'periodicity_id' => 'required',
            'what_work_id' => 'required',


            ],
            $messages = array(
                'required' => 'Поле :attribute обязательно',
                'max' => 'Поле :attribute должно быть не более 255 символов',
                'unique'   => 'Поле :attribute должно быть уникальным'
            )
        );

        $contractor = new Contractor();

        $contractor->name = $request->input('name');
        $contractor->region_id = $request->input('region_id');
        $contractor->user_id = $request->input('manager');
        $contractor->email = $request->input('email');
        $contractor->ur_address = $request->input('ur_address');
        $contractor->site_company = $request->input('site_company');
        $contractor->inn = $request->input('inn');
        $contractor->assign_manager = $request->input('assign_manager');
        $contractor->what_work_id = $request->input('what_work_id');
        $contractor->periodicity_id = $request->input('periodicity_id');
        $contractor->take_amount = $request->input('take_amount');
        $contractor->delivery_address = $request->input('delivery_address');
        $contractor->delivery = $request->input('delivery');
        $contractor->packing_id = $request->input('packing_id');
        $contractor->contract_number = $request->input('contract_number');
        $contractor->contract_exist = $request->input('contract_exist');
        $contractor->comments = $request->input('comments');
        $contractor->contractor_status_id = $request->input('contractor_status_id');

        $phones = '';
        foreach ($request->input('phone') as $phone) {
            $phones .=  $phone ."<br>";
        }
        $contractor->phone = $phones;

        $contractor->save();
        //dd($contractor);
        return redirect('/contractors')->with('success', 'Организация добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contractor = Contractor::find($id);
        $manager = User::find($id)->contractors()->getParent()->fio;
        $region = Region::find($id)->contractor()->getParent()->name;
        $status = ContractorStatus::find($id)->contractor()->getParent()->name;

        //dd($manager);
        return view('pages.contractors.details', [
            'contractor' => $contractor,
            'manager' => $manager,
            'region' => $region,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contractor = Contractor::find($id);
        $managers = User::where('group_id', '=', '2')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::all();
        $what_work = WhatWork::all();
        $periodicity = periodicity::all();
        $packing = packing::all();

        return view('pages.contractors.edit', [
            'contractor' => $contractor,
            'managers' => $managers,
            'contractor_statuses' => $contractor_statuses,
            'regions' => $regions,
            'what_work' => $what_work,
            'periodicity' => $periodicity,
            'packing' => $packing
        ]);
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
            'region_id' => 'required',
            'phone' => 'required|max:255',
            'contract_number' => 'required|max:255',
            'packing_id' => 'required',
            'periodicity_id' => 'required',
            'what_work_id' => 'required',


        ],
            $messages = array(
                'required' => 'Поле :attribute обязательно',
                'max' => 'Поле :attribute должно быть не более 255 символов',
                'unique'   => 'Поле :attribute должно быть уникальным'
            )
        );

        $contractor = Contractor::find($id);

        $contractor->name = $request->input('name');
        $contractor->region_id = $request->input('region_id');
        $contractor->user_id = $request->input('manager');
        $contractor->email = $request->input('email');
        $contractor->ur_address = $request->input('ur_address');
        $contractor->site_company = $request->input('site_company');
        $contractor->inn = $request->input('inn');
        $contractor->assign_manager = $request->input('assign_manager');
        $contractor->what_work_id = $request->input('what_work_id');
        $contractor->periodicity_id = $request->input('periodicity_id');
        $contractor->take_amount = $request->input('take_amount');
        $contractor->delivery_address = $request->input('delivery_address');
        $contractor->delivery = $request->input('delivery');
        $contractor->packing_id = $request->input('packing_id');
        $contractor->contract_number = $request->input('contract_number');
        $contractor->contract_exist = $request->input('contract_exist');
        $contractor->comments = $request->input('comments');
        $contractor->contractor_status_id = $request->input('contractor_status_id');

         //dd($contractor);

        $contractor->save();
        return redirect('/contractors')->with('success', 'Данные об организации обновлены');
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
            $contractor = Contractor::find($id);
            $contractor->delete();
            return redirect('/contractors')->with('success', 'Организация удалена');
        }
        else {
            abort(404);
        }
    }
}
