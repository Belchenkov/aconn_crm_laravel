@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">
        ﻿<a href="http://homestead.app/users/add" class="btn btn-success"><i class="fa fa-plus"></i> Добавить сотрудника</a><br><br>
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($employees_active))
                                            <?php
                                                $i = 1;
                                            ?>
                                            @foreach($employees_active as $employe)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td><a data-toggle="modal" href="#showprofile1">{{ $employe->fio }}</a></td>
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
                                                    <td><a href="http://homestead.app/tasks/add/0/1" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                                </tr>
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
                                                <td><a data-toggle="modal" href="#showprofile1">{{ $employe->fio }}</a></td>
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