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
                                    <th>Закрепленный менеджер</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1; ?>
                                @if(!empty($regions))
                                    @foreach($regions as $region)
                                    <tr>
                                        <td> {{$i++}}</td>
                                        <td>

                                            <a href="regions/edit/{{$region->id}}" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if(!Auth()->user()->group_id)
                                                <form action="delete/{{$region->id}}" method="post" style="display: inline;">
                                                    {{ csrf_field() }}
                                                    <button onclick="return confirm('Удалить?')" class="btn btn-white btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Удалить" data-original-title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    {{$region->name}}
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($managers as $manager)
                                                @if($manager->id === $region->user_id)
                                                    {{$manager->fio}}
                                                @endif
                                            @endforeach

                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Добавление региона</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="regions/create" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Название</label>
                                    <input type="text" class="form-control" required="" name="name" placeholder="Название региона">
                                </div>
                                @if(!empty($managers))
                                    <div class="form-group">
                                        <label>Менеджер</label>
                                        <select class="form-control" required="" name="manager">
                                            <option value="">Не выбран</option>
                                            @foreach($managers as $manager)
                                                <option value="{{$manager->id}}">{{$manager->fio}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <br>
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