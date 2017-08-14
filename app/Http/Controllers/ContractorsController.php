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
use App\Contact;
use Illuminate\Support\Facades\Input;
use DB;

class ContractorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = Contractor::orderBy('id', 'desc')->get();
        $users = User::all();
        $managers = User::where('group_id', '=', '2')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::where('id', '>', '1')->get();
        $what_work = WhatWork::all();
        $periodicity = Periodicity::all();
        $packing = Packing::all();
        $manager_contractors = Contractor::where('user_id', '=', Auth()->user()->id)->get();

        //dd($request->input('search'));

        return view('pages.contractors.index', [
            'contractors' => $contractors,
            'manager_contractors' => $manager_contractors,
            'managers' => $managers,
            'contractor_statuses' => $contractor_statuses,
            'regions' => $regions,
            'users' => $users,
            'what_work' => $what_work,
            'periodicity' => $periodicity,
            'packing' => $packing,
        ]);
    }

    public function post()
    {
        //dd($request->input('search'));
        $search = Input::get('search');
        $region = Input::get('regions');
        $manager = Input::get('client_manager');
        $status = Input::get('status');

        $is_not_first = false;

        $where = 'SELECT * FROM contractors';
        //$where .= 'region_id=' . $region;
        if ($region && $region !== 1) {
            $where .= ' WHERE region_id=' . $region;
            $is_not_first = true;
            echo $where;
        }

        if ($manager && $manager !== 1) {
            if ($is_not_first) {
                $where .= ' AND user_id=' . $manager;
                echo $where;
            } else {
                $where .= ' WHERE user_id=' . $manager;
                echo $where;
            }
        }

        if ($status && $status !== 1) {
            if ($is_not_first) {
                $where .= ' AND contractor_statuses=' . $status;
                echo $where;
            } else {
                $where .= ' WHERE contractor_statuses=' . $status;
                echo $where;
            }
        }

        //echo $where;
        //$contractors = DB::select($where);
        //echo json_encode($contractors);


        //echo $contractors;

        /*$contractors = Contractor::orderBy('id', 'desc')
                                    ->where('region_id', '=', $region)
                                    ->where('user_id', '=', $manager)
                                    ->where('contractor_status_id', '=', $status)->get();*/

        $users = User::all();
        $managers = User::where('group_id', '=', '2')->get();
        $contractor_statuses = ContractorStatus::all();
        $regions = Region::where('id', '>', '1')->get();
        $what_work = WhatWork::all();
        $periodicity = Periodicity::all();
        $packing = Packing::all();
        $manager_contractors = Contractor::where('user_id', '=', Auth()->user()->id)->get();


        //dd($contractors);
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
            $regions = Region::where('id', '>', '1')->get();
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
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Validate
            $this->validate($request, [
                'name' => 'required|unique:contractors|max:255',
                'region_id' => 'required',
                'inn' => 'max:12',
                'phone' => 'required|unique:contractors|max:255',
                'contract_number' => 'max:255'
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 12 символов',
                    'unique' => 'Поле :attribute должно быть уникальным',
                    'integer' => 'Поле :attribute должно быть числовым',
                    'string' => 'Поле :attribute должно быть строковым'
                )
            );

            //dd($request);
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
                $phones .= $phone . "<br>";
            }
            $contractor->phone = $phones;

            $contractor->save();

            $contractor_id = $contractor->id;
            $contacts = $request->input('contact');

            foreach ($contacts as $item) {
                $contact = new Contact();

                $contact->fio = $item['fio'];
                $contact->contractors_id = $contractor_id;
                $contact->position = $item['dolgnost'];
                $contact->email = $item['email'];
                $contact->lpr = $item['lpr'];
                $contact->comment = $item['comment'];

                /*$phones_contacts = '';
                dd($item);
                foreach ($item['phones'] as $phone) {
                    $phones_contacts .=  $phone ."<br>";
                }
                $contact->phones = $phones_contacts;
                dd($contact->phones);
                */
                $contact->save();
            }

            return redirect('/contractors')->with('success', 'Организация добавлена');
        } else {
            abort('401');
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
        $contractor = Contractor::find($id);
        $contacts =Contact::where('contractors_id', '=', $id)->get();
        $manager = User::find($contractor->user_id)->contractors()->getParent()->fio;
        $region = Region::find($contractor->region_id)->contractor()->getParent()->name;
        $status = ContractorStatus::find($contractor->contractor_status_id)->contractor()->getParent()->name;

        return view('pages.contractors.details', [
            'contractor' => $contractor,
            'manager' => $manager,
            'region' => $region,
            'status' => $status,
            'contacts' => $contacts
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
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
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
        } else {
            abort('401');
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
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Validate
            $this->validate($request, [
                'name' => 'required|max:255',
                'region_id' => 'required',
                'inn' => 'max:12',
                'phone' => 'required|unique:contractors|max:255',
                'contract_number' => 'max:255'
            ],
                $messages = array(
                    'required' => 'Поле :attribute обязательно',
                    'max' => 'Поле :attribute должно быть не более 12 символов',
                    'unique' => 'Поле :attribute должно быть уникальным',
                    'integer' => 'Поле :attribute должно быть числовым',
                    'string' => 'Поле :attribute должно быть строковым'
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

            $phones = '';
            foreach ($request->input('phone') as $phone) {
                $phones .= $phone . "<br>";
            }
            $contractor->phone = $phones;

            //dd($contractor);

            $contractor->save();
            return redirect('/contractors')->with('success', 'Данные об организации обновлены');
        } else {
            abort('401');
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
        if(!Auth()->user()->group_id) {
            $contractor = Contractor::find($id);
            $contractor->delete();

            return redirect('/contractors')->with('success', 'Организация удалена');
        }
        else {
            abort(401);
        }
    }
}
