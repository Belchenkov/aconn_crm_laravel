@extends('layouts.app')

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="box-footer">
                        <a onclick="javascript:history.back();" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        <a href="http://homestead.app/tasks/add/79" class="btn btn-default"><i class="fa fa-plus"></i> Добавить задачу</a>
                        <a href="http://homestead.app/contracting_parties/edit/79" class="btn btn-default"><i class="fa fa-edit"></i> Редактировать</a>
                        <a href="http://homestead.app/contracting_parties/delete/79" class="btn btn-danger" onclick="return confirm('Удалить?')"><i class="fa fa-trash"></i> Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <h2> ttttttttttttttt1232143</h2>
            <div class="ibox-content">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Телефоны</label><br>
                            +7 (555) 555-5555						</div>
                        <div class="form-group col-md-6">
                            <label>Менеджер</label><br>
                            Дмитрий Исайкин						</div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label><br>
                            Отсутствует						</div>
                        <div class="form-group col-md-6">
                            <label>Канал</label><br>
                            Отсутствует						</div>
                        <div class="form-group col-md-6">
                            <label>Город</label><br>
                            Отсутствует						</div>
                        <div class="form-group col-md-6">
                            <label>Категория</label><br>
                            Отсутствует						</div>
                        <div class="form-group col-md-6">
                            <label>Адрес офиса</label><br>
                            Отсутствует						</div>
                        <div class="form-group col-md-6">
                            <label>Сайт</label><br>
                            Отсутствует						</div>
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
                    <span>Активный <i class='fa fa-chevron-right'></i> Бесперспективный</span>
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
						<b>07:28</b>
						<i class="fa fa-clock-o"></i>
						16.11.2016 <br/><small></small>
					</span>
                </div>
            </div>
            <div class="vertical-timeline-block">
                <form action="http://homestead.app/contracting_parties/comment/79" method="post">
                    <div class="vertical-timeline-icon blue-bg"><i class="fa fa-comments"></i></div>
                    <div class="vertical-timeline-content">
                        <div><textarea id="comment" class="form-control" name="comment" rows="3"></textarea></div><br>
                        <div class="form-group"><button onclick="return false" type="submit" id="sendComment" class="btn btn-primary pull-right" name="title" value="title">Добавить комментарий</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <h2>Задачи по организации</h2>
            <div class="ibox-content">
                <table id="tasks" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contracting_parties"><thead><tr><th>Задача/событие</th><th>Дата завершения</th><th>Организация</th><th>Кто поставил задачу</th><th>Исполнитель</th><th>Статус</th><th>Действие</th></tr></thead><tbody><tr><td colspan="100%">Задачи не найдены</td></tr></tbody></table>		</div>
        </div>
    </div>
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