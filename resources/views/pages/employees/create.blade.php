@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">

        ﻿<div class="ibox float-e-margins col-md-6">
            <a href="{{route('employees')}}"  class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
            <br>
            <br>
            <div class="ibox-content">

                <form action="{{route('employees_store')}}" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>ФИО</label>
                            <input type="text" class="form-control" id="fio" required="" name="fio" >
                        </div>
                        <div class="form-group">
                            <label>Должность</label>
                            <input type="text" class="form-control" id="dolgnost" name="position">
                        </div>
                        <div class="form-group">
                            <label>Логин</label>
                            <input type="text" class="form-control" id="login" required="" placeholder="email@email.com" name="login">
                        </div>
                        <div class="form-group">
                            <label>Новый пароль</label>
                            <input type="password" class="form-control" id="password" required="" name="password" placeholder="Старый пароль будет сброшен">
                        </div>
                        <div class="form-group">
                            <label>Группа</label>
                            <select class="form-control" name="group">
                                <option value="0">Администратор</option>
                                <option value="1">Руководитель</option>
                                <option value="2">Менеджер</option>
                                <option value="3">Сотрудник</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Статус</label>
                            <select class="form-control" name="status">
                                <option value="1">
                                    Активный
                                </option>
                                <option value="0">
                                    Уволенный
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>

@endsection