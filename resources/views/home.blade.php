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
                            <h2 class="font-bold">
                                @if(!empty($count_contractors))
                                    {{$count_contractors}}
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-4">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-ticket fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Задачи в работе</span>
                            <h2 class="font-bold">?</h2>
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
                            <h2 class="font-bold">?</h2>
                        </div>
                    </div>
                </div>
            </div>--}}
        <br><br>
    </div>

@endsection
