@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-body">
                            <div class="row">
                                <?php /*dd($contractor_statuses); */?>
                                <div class="col-md-3">
                                    <a href="/contracting_parties/add" class="btn btn-info"><i class="fa fa-plus"></i> Добавить организацию</a><br>
                                </div>
                                <form action="http://homestead.app/contracting_parties/exportExcel" method="POST" target="_blank">
                                    <div class="col-md-9" id="filters">
                                        <div class="col-md-4">
                                            <b>Регион:</b>
                                            <select class="select2 form-control" name="filter[directions]">
                                                <option value="0">Все</option>
                                                @if(count($regions) > 0)
                                                    @foreach($regions as $region)
                                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Статусы:</b>
                                            <select class="select2 form-control" name="filter[status]">
                                                <option value="0">Все</option>
                                                @if(count($contractor_statuses) > 0)
                                                    @foreach($contractor_statuses as $contractor_status)
                                                        <option value="{{$contractor_status->id}}">{{$contractor_status->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <b>Менеджер:</b>
                                            <select class="select2 form-control" name="filter[client_manager]">
                                                <option value="0">Все</option>
                                                @if(count($managers) > 0)
                                                    @foreach($managers as $manager)
                                                        <option value="{{$manager->id}}">{{$manager->fio}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <b>На чем работают:</b>
                                            <select class="select2 form-control" name="filter[client_manager]">
                                                <option value="0">Все</option>
                                                @if(count($what_work) > 0)
                                                    @foreach($what_work as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <b>В каких объемах берут:</b>
                                            <input type="number" class="form-control" min="1"  name="take_amount">
                                        </div>

                                        <div class="col-md-12"><br></div>
                                        <div class="col-md-12">
                                            <b>Поиск по названию организации:</b>
                                            <input type="text" name="filter[search]" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-content">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Наименование(s)</th>
                                                            <th>ИНН</th>
                                                            <th>Телефон</th>
                                                            <th>Юридический адрес</th>
                                                            <th>Почта</th>
                                                            <th>Сайт</th>
                                                            <th>Контакты</th>
                                                            <th>Адресс доставки</th>
                                                            <th>Управление</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($contractors) > 0)
                                                            @foreach($contractors as $contractor)
                                                                <tr>
                                                                    <td>{{$contractor->id}}</td>
                                                                    <td>{{$contractor->name}}</td>
                                                                    <td>{{$contractor->inn}}</td>
                                                                    <td>{{$contractor->phone}}</td>
                                                                    <td>{{$contractor->ur_address}}</td>
                                                                    <td>{{$contractor->email}}</td>
                                                                    <td>{{$contractor->site_company}}</td>
                                                                    <td>{{$contractor->contacts}}</td>
                                                                    <td>{{$contractor->delivery_address}}</td>

                                                                    <td>
                                                                        <button class="btn btn-outline btn-primary dim" title="Добавить" type="button"><i class="fa fa-plus"></i></button>
                                                                        <button class="btn btn-outline btn-warning  dim" title="Редактировать" type="button"><i class="fa fa-edit"></i></button>
                                                                        <button class="btn btn-outline btn-danger  dim " title="Удалить" type="button"><i class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>

@endsection