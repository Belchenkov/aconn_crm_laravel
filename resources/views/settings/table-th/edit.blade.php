@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="ibox float-e-margins col-md-6">
            <div class="ibox-content">
                <form action="{{ route('packings_update', ['packing_id' => $packing->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Упаковка - Наменование</label>
                            <input type="text" class="form-control" required="" value="{{$packing->name}}" name="name" >
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{route('packings')}}" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>
@endsection