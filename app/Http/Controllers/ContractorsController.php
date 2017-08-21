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
        // Менеджеры -- group_id = 2
        $managers = User::where('group_id', '=', '2')->get();
        // Статус контрагента
        $contractor_statuses = ContractorStatus::all();
        // Регионы
        $regions = Region::where('id', '>', '1')->get();
        // На чем работают
        $what_work = WhatWork::all();
        // Количество записей
        $count_row = Contractor::get()->count();


        return view('pages.contractors.index', [
            'managers' => $managers,
            'contractor_statuses' => $contractor_statuses,
            'regions' => $regions,
            'what_work' => $what_work,
            'count_row' => $count_row
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Контрагенты
            $contractors = Contractor::all();
            // Менеджеры group_id =2
            $managers = User::where('group_id', '=', '2')->get();
            // Статусы контрагентов
            $contractor_statuses = ContractorStatus::all();
            // Регионы
            $regions = Region::where('id', '>', '1')->get();
            // На чем работают
            $what_work = WhatWork::all();
            // Периодичность
            $periodicity = periodicity::all();
            // Упаковка
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
        dd($request);
        // Если (суперадмин, руководитель, менеджер)
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

            $contractor = new Contractor();
            $contractor->name = $request->input('name');
            $contractor->region_id = $request->input('region_id');
            $contractor->user_id = $request->input('manager');
            $contractor->email = $request->input('email');
            // Юридеский адрес
            $contractor->ur_address = $request->input('ur_address');
            $contractor->site_company = $request->input('site_company');
            $contractor->inn = $request->input('inn');
            // Закреплен ли менеджер
            $contractor->assign_manager = $request->input('assign_manager');
            // На чем работают
            $contractor->what_work_id = $request->input('what_work_id');
            // Периодичность
            $contractor->periodicity_id = $request->input('periodicity_id');
            // В каких объемах берут
            $contractor->take_amount = $request->input('take_amount');
            // Адресс доставки
            $contractor->delivery_address = $request->input('delivery_address');
            // Чья доставка
            $contractor->delivery = $request->input('delivery');
            // Упаковка
            $contractor->packing_id = $request->input('packing_id');
            // Номер контракта
            $contractor->contract_number = $request->input('contract_number');
            // Есть ли контракт
            $contractor->contract_exist = $request->input('contract_exist');
            $contractor->comments = $request->input('comments');
            // Статус контрагента
            $contractor->contractor_status_id = $request->input('contractor_status_id');

            // Собираем телефоны в одну строку
            $phones = '';
            foreach ($request->input('phone') as $phone) {
                $phones .= $phone . "<br>";
            }
            $contractor->phone = $phones;
            $contractor->save();

            // ID сохраненного контрагента
            $contractor_id = $contractor->id;
            if (!empty($contacts)) {
                // Контактное лицо(-ца)
                $contacts = $request->input('contact');
                //dd($contacts);
                foreach ($contacts as $item) {
                    $contact = new Contact();

                    $contact->fio = $item['fio'];
                    $contact->contractors_id = $contractor_id;
                    $contact->position = $item['dolgnost'];
                    $contact->email = $item['email'];
                    $contact->lpr = $item['lpr'];
                    $contact->comment = $item['comment'];

                    $phones_contacts = '';
                    //dd($item['phones']);
                    foreach ($item['phones'] as $phone) {
                        $phones_contacts .=  $phone ."<br>";
                    }
                    $contact->phones = $phones_contacts;
                    //echo $contact->phones . "<br>";

                    //dd($contact);
                    $contact->save();
                }
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
        // Список контактных лиц
        $contacts =Contact::where('contractors_id', '=', $id)->get();
        $manager = User::find($contractor->user_id)->contractors()->getParent()->fio;
        $region = Region::find($contractor->region_id)->contractor()->getParent()->name;
        // Статус контрагента
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
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            $contractor = Contractor::find($id);
            $managers = User::where('group_id', '=', '2')->get();
            // Статус контрагента
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
        // Если (суперадмин, руководитель, менеджер)
        if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3) {
            // Validate
            $this->validate($request, [
                'name' => 'required|max:255',
                'region_id' => 'required',
                'inn' => 'max:12',
                'phone' => 'required',
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
            // Юридеский адрес
            $contractor->ur_address = $request->input('ur_address');
            $contractor->site_company = $request->input('site_company');
            $contractor->inn = $request->input('inn');
            // Закреплен ли менеджер
            $contractor->assign_manager = $request->input('assign_manager');
            // На чем работают
            $contractor->what_work_id = $request->input('what_work_id');
            // Периодичность
            $contractor->periodicity_id = $request->input('periodicity_id');
            // В каких объемах берут
            $contractor->take_amount = $request->input('take_amount');
            // Адресс доставки
            $contractor->delivery_address = $request->input('delivery_address');
            // Чья доставка
            $contractor->delivery = $request->input('delivery');
            // Упаковка
            $contractor->packing_id = $request->input('packing_id');
            // Номер контракта
            $contractor->contract_number = $request->input('contract_number');
            // Есть ли контракт
            $contractor->contract_exist = $request->input('contract_exist');
            $contractor->comments = $request->input('comments');
            // Статус контрагента
            $contractor->contractor_status_id = $request->input('contractor_status_id');

            // Формирование строки телефонов
            $phones = '';
            foreach ($request->input('phone') as $phone) {
                $phones .= $phone . "<br>";
            }
            $contractor->phone = $phones;

            $contractor->save();


            if (!empty($request->input('contact'))) {
                // ID сохраненного контрагента
                $contractor_id = $contractor->id;
                // Контактное лицо(-ца)
                $contacts = $request->input('contact');

                foreach ($contacts as $item) {
                    $contact = new Contact();

                    $contact->fio = $item['fio'];
                    $contact->contractors_id = $contractor_id;
                    $contact->position = $item['dolgnost'];
                    $contact->email = $item['email'];
                    $contact->lpr = $item['lpr'];
                    $contact->comment = $item['comment'];

                    $phones_contacts = '';
                    foreach ($item['phones'] as $phone) {
                        $phones_contacts .= $phone . "<br>";
                    }
                    $contact->phones = $phones_contacts;

                    $contact->save();
                }
            }

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
        // Если (суперадмин -- group_id = 0)
        if(!Auth()->user()->group_id) {
            $contractor = Contractor::find($id);
            $contacts = Contact::where('contractors_id', '=', $id);

            $contacts->delete();
            $contractor->delete();

            return redirect('/contractors')->with('success', 'Организация удалена');
        }
        else {
            abort(401);
        }
    }
    public function contractorsGetAjax()
    {
        // Данные из фильтра
        $search = Input::get('search');
        $region = Input::get('regions');
        $manager = Input::get('client_manager');
        $status = Input::get('status');
        $what_works = Input::get('what_works');
        $currentUserGroup = Input::get('currentUserGroup');
        $currentUserID = Input::get('currentUserID');
        $limit_start = Input::get('limit_start');
        $limit_end = 10;
        //$currentUserGroup = Auth()->user()->group_id;
        // Формируем строку запроса к базе с данными из фильтра

        // Если условие не первое
        $and = false;
        $where = false;

        $where = 'SELECT * FROM contractors';

        if ($currentUserGroup == 2) {
            $where = 'SELECT * FROM contractors WHERE user_id='. $currentUserID;
            $and = true;
        }

        if ($region && $region !== 1) {
            if ($and) {
                $where .= ' AND region_id=' . $region;
            } else {
                $where .= ' WHERE region_id=' . $region;
                $and = true;
            }
        }

        if ($currentUserGroup < 2) {
            if ($manager && $manager !== 1) {
                if ($and) {
                    $where .= ' AND user_id=' . $manager;
                } else {
                    $where .= ' WHERE user_id=' . $manager;
                    $and = true;
                }
            }
        }

        if ($currentUserGroup == 2) {
            if ($manager && $manager !== 1) {
                if ($and) {
                    $where .= ' AND user_id=' . $manager;
                } else {
                    $where .= ' WHERE user_id=' . $manager;
                    $and = true;
                }
            }
        }

        if ($status && $status !== 1) {
            if ($and) {
                $where .= ' AND contractor_status_id=' . $status;
            } else {
                if ($where && $and) {
                    $where .= ' AND contractor_status_id=' . $status;
                } else {
                    $where .= ' WHERE contractor_status_id=' . $status;
                    $and = true;
                }
            }
        }

        if ($what_works && $what_works !== 1) {
            if ($and) {
                $where .= ' AND what_work_id=' . $what_works;
            } else {
                if ($where && $and) {
                    $where .= ' AND what_work_id=' . $what_works;
                } else {
                    $where .= ' WHERE what_work_id=' . $what_works;
                    $and = true;
                }
            }
        }

        if ($search) {
            if ($and) {
                $where .= ' AND name LIKE \'' . $search . '%\'';
            } else {
                if ($where && $and) {
                    $where .= ' AND name LIKE \'' . $search . '%\'';
                } else {
                    $where .= ' WHERE name LIKE \'' . $search . '%\'';
                    $and = true;

                }
            }
        }
        //  Выполняем запрос
        $where .= " ORDER BY id ASC LIMIT " . $limit_start . ", " . $limit_end;
        $contractors_filter = DB::select($where);
        $managers = User::where('group_id', '=', '2')->get();
        $regions = Region::all();

        $data = json_encode( [
            'data' => $contractors_filter,
        ]);

        //file_put_contents('data/json.txt', $data);

        // Отдаем на клиент
        echo json_encode([
            'managers' => $managers,
            'contractors' => $contractors_filter,
            'regions' => $regions,
            'user_group' => $currentUserGroup,
            'user' => $currentUserID,
            'where' => $where
        ]);
    }

    public function contractorsGetCurrentUser()
    {
        $currentUser = Auth()->user();
        echo json_encode($currentUser);
    }

    public function checkRepeat(Request $request)
    {
        $name = $request->input('name');
        $inn = $request->input('inn');
        $phone = $request->input('phone');
        $contract_number = $request->input('contract_number');

        $query = 'select * from `contractors` where `name` = ?';

        $checkFields = DB::select($query, $name);
                       /* ->orWhere('phone', 'like', '%' . $phone . '%')*/
        echo json_encode($checkFields);
        //echo $checkFields;
        /*if (count($checkFields) > 0) {
            echo '0';
        } else {
            echo '1';
        }*/

        //echo json_encode($checkFields);
    }
}
