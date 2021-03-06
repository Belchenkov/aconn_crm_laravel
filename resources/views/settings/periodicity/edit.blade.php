@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="ibox float-e-margins col-md-6">
            <div class="ibox-content">
                <form action="{{route('periodicity_update', ['periodicity_id' => $periodicity->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Периодичность - Наменование</label>
                            <input type="text" class="form-control" value="{{$periodicity->name}}" required="" name="name" >
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{route('periodicity')}}" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>
@endsection