@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">

        ﻿<div class="ibox float-e-margins col-md-6">
            <a href="{{route('employees')}}"  class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
            <br>
            <br>
            <div class="ibox-content">

                @if(!empty($employe))
                    <form action="{{route('employees_update', ['id' => $employe->id])}}" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>ФИО</label>
                                <input type="text" class="form-control" id="fio" name="fio" value="{{$employe->fio}}">
                            </div>
                            <div class="form-group">
                                <label>Должность</label>
                                <input type="text" class="form-control" id="dolgnost" name="position" value="{{$employe->position}}">
                            </div>
                            <div class="form-group">
                                <label>Логин</label>
                                <input type="text" class="form-control" id="login" name="login" value="{{$employe->email}}">
                            </div>
                            <div class="form-group">
                                <label>Новый пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Старый пароль будет сброшен">
                            </div>
                            <div class="form-group">
                                <label>Группа</label>
                                <select class="form-control" name="group">
                                    <option value="0"
                                            @if($employe->group_id == 0)
                                                selected=""
                                            @endif
                                    >Администратор</option>
                                    <option value="1"
                                            @if($employe->group_id == 1)
                                                selected=""
                                            @endif
                                    >Руководитель</option>
                                    <option value="2"
                                            @if($employe->group_id == 2)
                                                selected=""
                                            @endif
                                    >Менеджер</option>
                                    <option value="3"
                                            @if($employe->group_id > 2)
                                                selected=""
                                            @endif
                                    >Сотрудник</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Статус</label>
                                <select class="form-control" name="active">
                                    <option
                                            value="1"
                                            @if($employe->status == 1)
                                                selected=""
                                            @endif
                                    >
                                        Активный
                                    </option>
                                    <option
                                        value="0"
                                        @if($employe->status == 0)
                                            selected=""
                                        @endif
                                    >
                                        Уволенный
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                        </div>
                    </form>
                @endif
            </div>
        </div><br><br>
    </div>

@endsection