@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
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

                                <?php $i = 1; ?>
                                @foreach($what_works as $what_work)
                                    <tr>
                                        <td> {{$i++}}</td>
                                        <td>
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

            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Добавить</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="what-works/create" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" name="name" placeholder="Название направления">
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