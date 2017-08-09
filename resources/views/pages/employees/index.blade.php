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
                                    <tbody><tr>
                                        <td>1</td>
                                        <td><a data-toggle="modal" href="#showprofile1">Василий Чураков </a></td>
                                        <td>Администратор</td>
                                        <td><span id="rus_group">администратор</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/1" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>2</td>
                                        <td><a data-toggle="modal" href="#showprofile2">Роман Милованов</a></td>
                                        <td>Директор</td>
                                        <td><span id="rus_group">администратор</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/2" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>3</td>
                                        <td><a data-toggle="modal" href="#showprofile3">Андрей Благовидов</a></td>
                                        <td>Главный программист</td>
                                        <td><span id="rus_group">администратор</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/3" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>4</td>
                                        <td> <a href="http://homestead.app/users/log_in_user/4" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="" data-original-title="Зайти как пользователь"><i class="fa fa-exchange"></i></a> <a href="http://homestead.app/users/edit/4" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Редактировать"><i class="fa fa-edit"></i></a> <a data-toggle="modal" href="#showprofile4">Дмитрий Исайкин</a></td>
                                        <td>Главный менеджер отдела продаж</td>
                                        <td><span id="rus_group">менеджер</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/4" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>5</td>
                                        <td> <a href="http://homestead.app/users/log_in_user/5" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="" data-original-title="Зайти как пользователь"><i class="fa fa-exchange"></i></a> <a href="http://homestead.app/users/edit/5" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Редактировать"><i class="fa fa-edit"></i></a> <a data-toggle="modal" href="#showprofile5">Второй Манагер</a></td>
                                        <td>Менеджер отдела продаж</td>
                                        <td><span id="rus_group">менеджер</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/5" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>6</td>
                                        <td><a data-toggle="modal" href="#showprofile6"></a></td>
                                        <td></td>
                                        <td><span id="rus_group">администратор</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/6" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr><tr>
                                        <td>7</td>
                                        <td><a data-toggle="modal" href="#showprofile7">Алексей Бельченков</a></td>
                                        <td></td>
                                        <td><span id="rus_group">администратор</span></td>
                                        <td><a href="http://homestead.app/tasks/add/0/7" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="" data-original-title="Добавить задачу"><i class="fa fa-plus"></i></a></td>
                                    </tr></tbody>
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
                                    <tbody><tr><td colspan="5">Сотрудники не найдены</td></tr></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div></div></div><br><br>
    </div>

@endsection