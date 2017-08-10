@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-body">
                            <div class="row">
                                    @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                        <div class="col-md-3">
                                                <a href="contractors/create" class="btn btn-success"><i class="fa fa-plus"></i> Добавить организацию</a><br>

                                        </div>
                                    @endif

                                <form action="http://homestead.app/contracting_parties/exportExcel" method="POST" target="_blank">
                                    <div class="col-md-9" id="filters">
                                        @if(!empty($regions))
                                            <div class="col-md-4">
                                                <b>Регион:</b>
                                                <select class="select2 form-control" name="filter[directions]">
                                                    <option value="0">Все</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-md-4">
                                            <b>Статусы:</b>
                                            <select class="select2 form-control" name="filter[status]">
                                                <option value="0">Все</option>
                                                @if(!empty($contractor_statuses))
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
                                                @if(!empty($managers))
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
                                                @if(!empty($what_work))
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
                                                            {{--<th>Телефон</th>--}}
                                                            <th>Регион</th>
                                                            <th>Менеджер</th>
                                                            <th>Закреплено</th>
                                                            <th>Работают</th>
                                                            <th>Периодичность</th>
                                                            <th>Упаковка</th>
                                                            @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                <th>Управление</th>
                                                            @endif
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(!empty($contractors))
                                                            @foreach($contractors as $contractor)
                                                                @if(Auth()->user()->group_id != 2)
                                                                    <tr>
                                                                        <td>{{$contractor->id}}</td>
                                                                        <td>
                                                                            <a href="/contractors/details/{{$contractor->id}}">{{$contractor->name}}</a>
                                                                        </td>
                                                                        {{--<td>{!! $contractor->phone !!}</td>--}}
                                                                        <td>
                                                                            @foreach($regions as $region)
                                                                                @if($contractor->region_id === $region->id)
                                                                                    {{$region->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach($users as $user)
                                                                                @if($contractor->user_id === $user->id)
                                                                                    {{$user->fio}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @if($contractor->assign_manager)
                                                                                {{'Да'}}
                                                                            @else
                                                                                {{'Нет'}}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @foreach($what_work as $item)
                                                                                @if($contractor->what_work_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td>
                                                                            @foreach($periodicity as $item)
                                                                                @if($contractor->periodicity_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td>
                                                                            @foreach($packing as $item)
                                                                                @if($contractor->packing_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                            <td>
                                                                                <a href="/tasks/add/" class="btn btn-default btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить задачу" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a>
                                                                                <a href="/contractors/edit/{{$contractor->id}}" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a>
                                                                                @if(!Auth()->user()->group_id)
                                                                                    <form action="/contractors/delete/{{$contractor->id}}" method="post" style="display: inline;">
                                                                                        {{ csrf_field() }}
                                                                                        <button class="btn btn-danger btn-bitbucket" onclick="return confirm('Удалить?')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>
                                                                                    </form>
                                                                                @endif
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        {{-- if entered as manager --}}
                                                        @if(!empty($manager_contractors))
                                                            @foreach($manager_contractors as $contractor)
                                                                @if(Auth()->user()->group_id == 2)
                                                                    <tr>
                                                                        <td>{{$contractor->id}}</td>
                                                                        <td>
                                                                            <a href="/contractors/details/{{$contractor->id}}">{{$contractor->name}}</a>
                                                                        </td>
                                                                        <td>{!! $contractor->phone !!}</td>
                                                                        <td>
                                                                            @foreach($regions as $region)
                                                                                @if($contractor->region_id === $region->id)
                                                                                    {{$region->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @foreach($users as $user)
                                                                                @if($contractor->user_id === $user->id)
                                                                                    {{$user->fio}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            @if($contractor->assign_manager)
                                                                                {{'Да'}}
                                                                            @else
                                                                                {{'Нет'}}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @foreach($what_work as $item)
                                                                                @if($contractor->what_work_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td>
                                                                            @foreach($periodicity as $item)
                                                                                @if($contractor->periodicity_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td>
                                                                            @foreach($packing as $item)
                                                                                @if($contractor->packing_id === $item->id)
                                                                                    {{$item->name}}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>

                                                                        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                            <td>
                                                                                <a href="/tasks/add/" class="btn btn-default btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить задачу" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a>
                                                                                <a href="/contractors/edit/{{$contractor->id}}" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a>
                                                                                @if(!Auth()->user()->group_id)
                                                                                    <form action="/contractors/delete/{{$contractor->id}}" method="post" style="display: inline;">
                                                                                        {{ csrf_field() }}
                                                                                        <button class="btn btn-danger btn-bitbucket" onclick="return confirm('Удалить?')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>
                                                                                    </form>
                                                                                @endif
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @endif
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