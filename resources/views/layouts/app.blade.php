<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AconnCRM') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
                                <a href="/"><img src="{{ asset('img/aconncrm_logo_w.png') }}" /></a>
                             </span>
                        <br><br>
                        <span data-toggle="dropdown" class="dropdown-toggle">
                            {{--<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->fio }}</strong>--}}
                             {{--</span><br>--}}
                            <span class="text-muted text-center text-xs block font-bold"><strong class="text-white">{{ Auth::user()->position }}</strong></span> </span>
                        </span>

                    </div>
                    <div class="logo-element">
                        <img src="{{ asset('img/unixcrm_icon.png') }}" />
                    </div>
                </li>
                <li>
                    <a href="/"><i class="fa fa-home"></i> <span class="nav-label">Главная</span></a>
                </li>
                <li>
                    <a href="/employees"><i class="fa fa-users"></i> <span class="nav-label">Сотрудники</span></a>
                </li>
                {{--<li>
                    <a href="/tasks"><i class="fa fa-ticket"></i> <span class="nav-label">Задачи</span></a>
                </li>--}}
                <li>
                    <a href="/contractors"><i class="fa fa-briefcase"></i> <span class="nav-label">Организации</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">{{ Auth::user()->fio }}</span>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>
                            <span class="label label-danger">12</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="http://homestead.app/tasks/edit/14">
                                    <div>
                                        <i class="fa fa-ticket fa-fw"></i> <span class="pull-right text-muted small">01.01.70</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li><li>
                                <a href="http://homestead.app/tasks/edit/15">
                                    <div>
                                        <i class="fa fa-ticket fa-fw"></i> <span class="pull-right text-muted small">01.01.70</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li><li>
                                <a href="http://homestead.app/tasks/edit/9">
                                    <div>
                                        <i class="fa fa-ticket fa-fw"></i> Провести совещание в отделе продаж<span class="pull-right text-muted small">18.10.16</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li><li>
                                <a href="http://homestead.app/tasks/edit/1">
                                    <div>
                                        <i class="fa fa-ticket fa-fw"></i> Позвонить маме<span class="pull-right text-muted small">26.10.16</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li><li>
                                <a href="http://homestead.app/tasks/edit/3">
                                    <div>
                                        <i class="fa fa-ticket fa-fw"></i> Прозвонить клиентов<span class="pull-right text-muted small">26.10.16</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>									<li>
                                <div class="text-center link-block">
                                    <a href="http://homestead.app/alerts">
                                        <strong>Посмотреть все напоминания</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>  Выход
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    {{--<li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>--}}
                </ul>
            </nav>
        </div>
        @yield('content')

        <div class="footer fixed">
            <div class="pull-right">
                V. 1.0
            </div>
            <div>
                <strong>UnixCRM </strong> © 2016 - 2017
            </div>
        </div>

    </div>{{-- #page-wrapper --}}

    </div>{{-- #wrapper--}}

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('js/demo/sparkline-demo.js')}}"></script>
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/d3/d3.min.js')}}"></script>
    <script src="{{ asset('js/plugins/c3/c3.min.js')}}"></script>
    <script src="{{ asset('js/system/main.js')}}"></script>
    <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/plugins/clockpicker/clockpicker.js')}}"></script>
    <script src="{{ asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')}}" ></script>
    <script src="{{ asset('js/system/contracting_parties.js')}}"></script>
    <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

    {{--<script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('', 'Welcome to AconnCRM');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                    data1, data2
                ],
                {
                    series: {
                        lines: {
                            show: false,
                            fill: true
                        },
                        splines: {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            fill: 0.4
                        },
                        points: {
                            radius: 0,
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#d5d5d5",
                        borderWidth: 1,
                        color: '#d5d5d5'
                    },
                    colors: ["#1ab394", "#1C84C6"],
                    xaxis:{
                    },
                    yaxis: {
                        ticks: 4
                    },
                    tooltip: false
                }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>--}}

</body>

</html>