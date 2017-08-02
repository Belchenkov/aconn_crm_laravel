@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="http://homestead.app/contracting_parties/add" class="btn btn-success"><i class="fa fa-plus"></i> Добавить организацию</a><br>
                                </div>
                                <form action="http://homestead.app/contracting_parties/exportExcel" method="POST" target="_blank">
                                    <div class="col-md-9" id="filters">
                                        <div class="col-md-4">
                                            <b>Направления:</b>
                                            <select class="select2 form-control" name="filter[directions]">
                                                <option value="0">Все</option>
                                                <option value="1">База Диалог</option>
                                                <option value="2">База 2ГИС</option>
                                                <option value="3">Входящие заявки</option>
                                                <option value="4">База рассылки</option>
                                                <option value="5">Квесты</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Статусы:</b>
                                            <select class="select2 form-control" name="filter[status]">
                                                <option value="0">Все</option>
                                                <option value="1">Активный</option>
                                                <option value="2">Не активный</option>
                                                <option value="3">Теплый</option>
                                                <option value="11">На перспективу</option>
                                                <option value="12">Бесперспективный</option>
                                                <option value="13">Конкурент</option>
                                                <option value="14">Не работают</option>
                                                <option value="15">Не профильный</option>
                                                <option value="4">Был холодный звонок</option>
                                                <option value="5">Рассылка</option>
                                                <option value="6">Получил КП</option>
                                                <option value="7">Переговоры</option>
                                                <option value="8">Встреча с ЛПР</option>
                                                <option value="9">Зарегистрировался</option>
                                                <option value="10">Оплатил</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <b>Менеджер:</b>
                                            <select class="select2 form-control" name="filter[client_manager]">
                                                <option value="0">Все</option>
                                                <option value="4">Дмитрий Исайкин</option>
                                                <option value="5">Второй Манагер</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12"><br></div>
                                        <div class="col-md-12">
                                            <b>Поиск по названию организации:</b>
                                            <input type="text" name="filter[search]" class="form-control">
                                        </div>

                                    </div>

                            </div>
                            <div id="pagination"></div>
                            <div id="currentPage">
                                <div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>
                            </div>
                            <div id="pagination2"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>

@endsection