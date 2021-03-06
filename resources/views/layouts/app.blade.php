<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AconnCRM') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/nouslider/jquery.nouislider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
</head>

<body class="skin-1 pace-done">
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

                            <span class="text-muted text-center text-xs block font-bold"><strong class="text-white">{{ Auth::user()->position }}</strong></span> </span>
                        </span>

                    </div>
                    <div class="logo-element">
                        <img src="{{ asset('img/unixcrm_icon.png') }}" />
                    </div>
                </li>
                <li>
                    <a href="{{route('home')}}"><i class="fa fa-home"></i> <span class="nav-label">Главная</span></a>
                </li>
                <li>
                    <a href="{{route('employees')}}"><i class="fa fa-users"></i> <span class="nav-label">Сотрудники</span></a>
                </li>
                <li>
                    <a href="{{route('contractors')}}"><i class="fa fa-briefcase"></i> <span class="nav-label">Организации</span></a>
                </li>
                {{-- Если суперадмин --}}
                @if(!Auth()->user()->group_id)
                    <li>
                        <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Настройки</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{route('settings')}}"><i class="fa fa-cog"></i> Настройки</a></li>
                            <li><a href="{{route('regions')}}"><i class="fa fa-cog"></i> Регионы</a></li>
                            <li><a href="{{route('what-works')}}"><i class="fa fa-cog"></i> На чем работают</a></li>
                            <li><a href="{{route('periodicity')}}"><i class="fa fa-cog"></i> Периодичность</a></li>
                            <li><a href="{{route('packings')}}"><i class="fa fa-cog"></i> Упаковка</a></li>
                            <li><a href="{{route('table-th')}}"><i class="fa fa-cog pull-left"></i> Заголовки</a></li>
                        </ul>
                    </li>
                @endif
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
                            <span class="label label-danger">{{count($notifications)}}</span>
                        </a>

                        @if (!empty($notifications))

                            <ul class="dropdown-menu dropdown-alerts" style="min-width: 600px;">
                                @foreach($notifications as $notification)
                                    <li>
                                        <a href="{{route('contractors_details', ['id' => $notification->contractor_id])}}">
                                            <div>
                                                <i class="fa fa-ticket fa-fw"></i>
                                                <span class="text-muted small">{{$notification->comments}}</span>
                                                <span class="pull-right text-muted small"> {{$notification->date_reminder}}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"
                           >
                           <i class="fa fa-sign-out"></i>  Выход
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <br>


        {{-- Вывод оповещений --}}
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error  }}
                </div>
            @endforeach
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

        <div class="footer fixed">
            <div class="pull-right">
                V. 1.0
            </div>
            <div>
                <strong>UnixCRM </strong> © 2016 - <?php echo date('Y')?>
            </div>
        </div>

    </div>{{-- #page-wrapper --}}

    </div>{{-- #wrapper--}}

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}"></script>
    <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    {{--<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/demo/sparkline-demo.js')}}"></script>
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/d3/d3.min.js')}}"></script>
    <script src="{{ asset('js/plugins/c3/c3.min.js')}}"></script>
    <script src="{{ asset('js/system/main.js')}}"></script>
    <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/plugins/clockpicker/clockpicker.js')}}"></script>
    <script src="{{ asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')}}" ></script>
    <script src="{{ asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{ asset('js/plugins/dualListbox/jquery.bootstrap-duallistbox.js')}}"></script>
    <script src="{{ asset('js/system/contracting_parties.js')}}"></script>
    <script src="{{ asset('js/system/contracting_parties_list.js')}}"></script>
    <script src="{{ asset('js/jquery.bootpag.min.js')}}"></script>

   {{-- <script>
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