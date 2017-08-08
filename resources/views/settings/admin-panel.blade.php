@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Регионы</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="panel-body">
                            <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($regions as $region)
                                    <tr>
                                        <td> {{$region->id}}</td>
                                        <td>
                                            <a href="regions/create" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="regions/edit/{{$region->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(!Auth()->user()->group_id)
                                                <form action="regions/delete/{{$region->id}}" method="post" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button onclick="return confirm('Удалить?')" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{$region->name}}
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>На чём работают</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="panel-body">
                            <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($what_works as $what_work)
                                    <tr>
                                        <td> {{$what_work->id}}</td>
                                        <td>
                                            <a href="what_works/create" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="what-works/edit/{{$what_work->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(!Auth()->user()->group_id)
                                                <form action="what-works/delete/{{$what_work->id}}" method="post" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button onclick="return confirm('Удалить?')" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{$what_work->name}}
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>

        <div class="row">
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Периодичность</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="panel-body">
                            <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($periodicity as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td>
                                            <a href="periodicity/create" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="periodicity/edit/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(!Auth()->user()->group_id)
                                                <form action="periodicity/delete/{{$item->id}}" method="post" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button onclick="return confirm('Удалить?')" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{$item->name}}
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Упаковка</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="panel-body">
                            <table id="users" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($packing as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td>
                                            <a href="packings/create" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="packings/edit/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(!Auth()->user()->group_id)
                                                <form action="packings/delete/{{$item->id}}" method="post" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button onclick="return confirm('Удалить?')" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{$item->name}}
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection