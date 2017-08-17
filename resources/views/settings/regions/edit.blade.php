@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="ibox float-e-margins col-md-6">
            <div class="ibox-content">
                <form action="{{route('regions_update', ['region_id' => $region->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        @if(!empty($region))
                            <div class="form-group">
                                <label>Наменование региона</label>
                                <input type="text" class="form-control" required="" value="{{$region->name}}" name="name" >
                            </div>
                        @endif
                        @if(!empty($managers))
                            <label>Менеджер</label>
                            <select class="form-control" name="manager">
                                @foreach($managers as $manager)
                                    <option
                                            @if($manager->id === $region->user_id)
                                                selected
                                            @endif
                                            value="{{$manager->id}}">
                                        {{$manager->fio}}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <br><br>
                    <div class="box-footer">
                        <a href="{{route('regions')}}" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>
@endsection