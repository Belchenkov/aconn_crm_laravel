<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\WhatWork;
use App\Periodicity;
use App\Packing;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function adminPanel()
    {
        if(!Auth()->user()->group_id) {
            //$managers = User::where('group_id', '=', '2')->get();
            $regions = Region::all();
            $what_works = WhatWork::all();
            $periodicity = periodicity::all();
            $packing = packing::all();

            return view('settings.admin-panel', [
                /*'managers' => $managers,*/
                'regions' => $regions,
                'what_works' => $what_works,
                'periodicity' => $periodicity,
                'packing' => $packing
            ]);
        }
        else {
            abort(401);
        }


    }


}
