<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;
use App\User;
use App\ContractorStatus;
use App\Region;
use App\WhatWork;
use App\Periodicity;

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
        $managers = User::where('group_id', '>', '1')->get();
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
            $managers = User::where('group_id', '>', '1')->get();
            $contractor_statuses = ContractorStatus::all();
            $regions = Region::all();
            $what_work = WhatWork::all();
            $periodicity = periodicity::all();

            return view('pages.contractors.create',  [
                'contractors' => $contractors,
                'managers' => $managers,
                'contractor_statuses' => $contractor_statuses,
                'regions' => $regions,
                'what_work' => $what_work,
                'periodicity' => $periodicity
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
        //
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
        return view('pages.contractors.details', ['contractor' => $contractor]);
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

        return view('pages.contractors.edit', ['contractor' => $contractor]);
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
