@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="ibox float-e-margins col-md-6">
            <div class="ibox-content">
                <form action="" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>На чем работают - Наименование</label>
                            <input type="text" class="form-control" name="name" >
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/settings/admin-panel" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Сохранить</button>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>
@endsection