@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
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

            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Добавить</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="packings/create" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="name" placeholder="Название упаковки">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection