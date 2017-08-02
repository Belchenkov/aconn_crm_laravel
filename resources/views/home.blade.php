@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Организации</span>
                            <h2 class="font-bold">55</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-ticket fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Задачи в работе</span>
                            <h2 class="font-bold">12</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-calendar fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Задачи на сегодня</span>
                            <h2 class="font-bold">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title"><h5>Мои задачи на сегодня</h5></div>
                    <div class="ibox-content">
                        <div class="box-body">
                            Отсутствуют
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Личные задачи</h5>
                        <div class="ibox-tools">
                            <a href="http://homestead.app/tasks/add/my" class="btn btn-xs btn-success">
                                <i class="fa fa-plus"></i> Новая задача
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="box-body">
                            Отсутствуют
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>

@endsection
