@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">
        {{--Если (суперадмин, руководитель, менеджер)--}}
        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
        ﻿   <a href="{{route('employees_create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить сотрудника</a><br><br>
        @endif
        <div class="box">
            <div class="box-body">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-check text-success"></i> Активные</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-ban text-danger"></i> Уволенные</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>ФИО</th>
                                        <th>Должность</th>
                                        <th>Группа</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($employees_active) && count($employees_active) > 0)
                                            <?php
                                                $i = 1;
                                                $group = '';
                                            ?>
                                            @foreach($employees_active as $employe)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td><a data-toggle="modal" href="#showprofile{{$employe->id}}">{{ $employe->fio }}</a></td>
                                                    <td>{{ $employe->position }}</td>
                                                    @if($employe->group_id == 0)
                                                        <?php $group = 'Администратор'; ?>
                                                        <td><span id="rus_group">{{$group}}</span></td>
                                                    @elseif($employe->group_id == 1)
                                                        <?php $group = 'Руководитель'; ?>
                                                        <td><span id="rus_group">{{$group}}</span></td>
                                                    @elseif($employe->group_id == 2)
                                                        <?php $group = 'Менеджер'; ?>
                                                         <td><span id="rus_group">{{$group}}</span></td>
                                                    @else
                                                        <?php $group = 'Сотрудник'; ?>
                                                        <td><span id="rus_group">{{$group}}</span></td>
                                                    @endif
                                                </tr>

                                                {{-- Modal Window--}}
                                                <div id="showprofile{{$employe->id}}" class="modal fade" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="exampleModalLabel">Профиль {{ $employe->fio }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="col-lg-3 control-label">ФИО</label>
                                                                    <div class="col-lg-9">{{ $employe->fio }}</div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-3 control-label">Логин</label>
                                                                    <div class="col-lg-9">{{ $employe->email }}</div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-3 control-label">Должность</label>
                                                                    <div class="col-lg-9">{{ $employe->position }}</div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-3 control-label">Группа</label>
                                                                    <div class="col-lg-9">{{$group}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{ route('employees_edit', ['id' => $employe->id]) }}" class="btn btn-success">Редактировать</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @else
                                            <tr><td colspan="5">Сотрудники не найдены</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>ФИО</th>
                                        <th>Должность</th>
                                        <th>Группа</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($employees_dismiss) && count($employees_dismiss) > 0)
                                        <?php
                                            $i = 1;
                                        ?>
                                        @foreach($employees_dismiss as $employe)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><a data-toggle="modal" href="#showprofile{{$employe->id}}">{{ $employe->fio }}</a></td>
                                                <td>{{ $employe->position }}</td>
                                                @if($employe->group_id == 0)
                                                    <td><span id="rus_group">Администратор</span></td>
                                                @elseif($employe->group_id == 1)
                                                    <td><span id="rus_group">Руководитель</span></td>
                                                @elseif($employe->group_id == 2)
                                                    <td><span id="rus_group">Менеджер</span></td>
                                                @else
                                                    <td><span id="rus_group">Сотрудник</span></td>
                                                @endif
                                            </tr>
                                            {{-- Modal Window--}}
                                            <div id="showprofile{{$employe->id}}" class="modal fade" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Профиль {{ $employe->fio }}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 control-label">ФИО</label>
                                                                <div class="col-lg-9">{{ $employe->fio }}</div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 control-label">Логин</label>
                                                                <div class="col-lg-9">{{ $employe->email }}</div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 control-label">Должность</label>
                                                                <div class="col-lg-9">{{ $employe->position }}</div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 control-label">Группа</label>
                                                                <div class="col-lg-9">{{$group}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ route('employees_edit', ['id' => $employe->id]) }}" class="btn btn-success">Редактировать</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr><td colspan="5">Сотрудники не найдены</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div></div></div><br><br>
    </div>

@endsection