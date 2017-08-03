<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contractor;
use App\User;
use App\ContractorStatus;
use App\Region;
use App\WhatWork;

class ContragentsController extends Controller
{
    public function show()
    {

        $contractors = Contractor::all();
        $managers = User::where('group_id', '>', '1')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::all();
        $what_work = WhatWork::all();

        return view('pages.contragents', [
                        'contractors' => $contractors,
                        'managers' => $managers,
                        'contractor_statuses' => $contractor_statuses,
                        'regions' => $regions,
                        'what_work' => $what_work
                    ]);
    }

    public function add()
    {
        return '<h2>Add</h2>';
    }
}
