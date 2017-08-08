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
                                    <th>Id</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($regions as $region)
                                    <tr>
                                        <td> {{$region->id}}</td>
                                        <td>
                                            <a href="regions/create/{{$region->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="regions/edit/{{$region->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{$region->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                <i class="fa fa-trash"></i>
                                            </a> {{$region->name}}
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
                                    <th>Id</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($what_works as $what_work)
                                    <tr>
                                        <td> {{$what_work->id}}</td>
                                        <td>
                                            <a href="regions/create/{{$what_work->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="regions/edit/{{$what_work->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{$what_work->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                <i class="fa fa-trash"></i>
                                            </a> {{$what_work->name}}
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
                                    <th>Id</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($periodicity as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td>
                                            <a href="regions/create/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="regions/edit/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                <i class="fa fa-trash"></i>
                                            </a> {{$item->name}}
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
                                    <th>Id</th>
                                    <th>Название</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($packing as $item)
                                    <tr>
                                        <td> {{$item->id}}</td>
                                        <td>
                                            <a href="regions/create/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Добавить" data-original-title="Редактировать">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <a href="regions/edit/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/delete/{{$item->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                <i class="fa fa-trash"></i>
                                            </a> {{$item->name}}
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
@endsection