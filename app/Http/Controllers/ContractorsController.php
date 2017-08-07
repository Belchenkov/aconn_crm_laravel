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
        $managers = User::where('group_id', '=', '2')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::all();
        $what_work = WhatWork::all();

        return view('pages.contractors.index', [
            'contractors' => $contractors,
            'managers' => $managers,
            'contractor_statuses' => $contractor_statuses,
            'regions' => $regions,
            'what_work' => $what_work
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
            return redirect('/contractors');
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
       /* // Validate
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required'
        ]);
       */

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
        foreach ($request->input('phones') as $phone) {
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
//      $manager = User::find($id)->users;
        $region = Region::find($id)->contractor()->getParent()->name;
        $status = ContractorStatus::find($id)->contractor()->getParent()->name;

        //dd($status);
        return view('pages.contractors.details', [
            'contractor' => $contractor,
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
        //
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
            echo 'Delete';
        }
        else {
            return redirect('/contractors');
        }
    }
}
