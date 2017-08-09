@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h3><i class="fa fa-gears"></i> Смена пароля</h3>
            </div>
            <div class="ibox-content">
                <form action="{{route('change-pass')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Старый пароль</label>
                            <input type="password" name="oldpassword" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Новый пароль</label>
                            <input type="password" name="newpassword" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Повтор нового пароля</label>
                            <input type="password" name="newpassword2" required=""  class="form-control">
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сменить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><br><br>
    </div>
@endsection