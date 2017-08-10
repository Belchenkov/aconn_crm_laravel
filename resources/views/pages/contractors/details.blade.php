@extends('layouts.app')

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="box-footer">
                        <a href="/contractors" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                            {{--<a href="/tasks/add" class="btn btn-default"><i class="fa fa-plus"></i> Добавить задачу</a>--}}
                            <a href="/contractors/edit/{{$contractor->id}}" class="btn btn-default"><i class="fa fa-edit"></i> Редактировать</a>
                            @if(!Auth()->user()->group_id)
                                <form action="/contractors/delete/{{$contractor->id}}" method="post" style="display: inline;">
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger" onclick="return confirm('Удалить?')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i> Удалить</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <h2> {{$contractor->name}}</h2>
            <div class="ibox-content">
                <div class="box-body">
                    <div class="row">
                        @if(!empty($contractor->phone))
                            <div class="form-group col-md-6">
                                <label>Телефоны</label><br>
                                {!! $contractor->phone !!}
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label>Менеджер</label><br>
                            @if (!empty($manager))
                                {{$manager}}
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label><br>
                            @if (!empty($contractor->email))
                                {{$contractor->email}}
                            @else
                                Отсутствует
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>ИНН</label><br>
                            @if (!empty($contractor->inn))
                                {{$contractor->inn}}
                            @else
                                Отсутствует
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Регион</label><br>
                            @if (!empty($region))
                                {{$region}}
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Юридический адрес</label><br>
                            @if (!empty($contractor->ur_address))
                                {{$contractor->ur_address}}
                            @else
                                Отсутствует
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Адрес доставки</label><br>
                            @if (!empty($contractor->ur_address))
                                {{$contractor->ur_address}}
                            @else
                                Отсутствует
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Сайт</label><br>
                            @if (!empty($contractor->site_company))
                                {{$contractor->site_company}}
                            @else
                                Отсутствует
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>Контактные лица</h2>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <h2>Статус организации</h2>
            <div class="ibox-content">
                <div class="box-body" id="status">
                    @if (!empty($status))
                        <span>{{$status}}</span>
                    @else
                        Отсутствует
                    @endif
                </div>
            </div>
    </div>
    <div class="col-md-6">
        <div id="vertical-timeline" class="vertical-container">
            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon navy-bg"><i class="fa fa-check"></i></div>
                <div class="vertical-timeline-content">
                    <p>Организация добавлена</p>
                    <span class="vertical-date">
                        <?php
                            $date = explode(" ", $contractor->created_at);
                        ?>
						<b><?= $date[1]; ?></b>
						<i class="fa fa-clock-o"></i>
                        <?= $date[0]; ?> <br/><small></small>
					</span>
                </div>
            </div>
            <div class="vertical-timeline-block">
                <form action="/contractors/comment/{{$contractor->id}}" method="post">
                    <div class="vertical-timeline-icon blue-bg"><i class="fa fa-comments"></i></div>
                    <div class="vertical-timeline-content">
                        <div>
                            <textarea id="comment" class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <br>
                        <div class="form-group"><button onclick="return false" type="submit" id="sendComment" class="btn btn-primary pull-right" name="title" value="title">Добавить комментарий</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--<div class="col-md-12">
        <div class="ibox float-e-margins">
            <h2>Задачи по организации</h2>
            <div class="ibox-content">
                <table id="tasks" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contracting_parties"><thead><tr><th>Задача/событие</th><th>Дата завершения</th><th>Организация</th><th>Кто поставил задачу</th><th>Исполнитель</th><th>Статус</th><th>Действие</th></tr></thead><tbody><tr><td colspan="100%">Задачи не найдены</td></tr></tbody></table>		</div>
        </div>
    </div>--}}
</div>

</div>
<script>
    $('button#sendComment').click(function(){
        comment = $('textarea#comment').val();

        $.ajax({
            type: 'POST',
            url: '/contracting_parties/comment/79',
            data: 'comment='+comment,
            success: function(data){
                location.reload();
            }
        });
        return false;
    });

</script>
<br><br>
@endsection