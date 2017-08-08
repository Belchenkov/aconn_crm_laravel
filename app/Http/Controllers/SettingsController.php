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
}
