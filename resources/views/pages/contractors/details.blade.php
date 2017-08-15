@extends('layouts.app')

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="box-footer">
                        <a href="/contractors" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        {{-- Если (админ, руководитель, менеджер) --}}
                        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                            <a href="/contractors/edit/{{$contractor->id}}" class="btn btn-default"><i class="fa fa-edit"></i> Редактировать</a>
                            {{-- Если админ - удалять могут только админы --}}
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
                                <div style="width: 160px">
                                    <label>Телефоны</label><br>
                                    <button class="copyButton btn btn-info" title="Копировать в буфер">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                    <span class="cont pull-right">{!! $contractor->phone !!}</span>
                                </div>
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
                            <button  class="copyButton btn btn-info" title="Копировать в буфер">
                                <i class="fa fa-copy"></i>
                            </button>
                            @if (!empty($contractor->email))
                                <span class="cont" style="margin-left: 3px"> {{$contractor->email}}</span>
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
                    </div>
                </div>
            </div>
        </div>

        <h2>Контактные лица</h2>
        @if(!empty($contacts))
            @foreach($contacts as $contact)
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-body row">
                            <input type="text" value="3" name="contact[0][id]" class="hidden">
                            <div class="form-group col-md-6">
                                @if (!empty($contact->fio))
                                    <h4>{{$contact->fio}} </h4>
                                @else
                                    Отсутствует
                                @endif

                                @if (!empty($contact->position))
                                    <p>{{$contact->position}} </p>
                                @else
                                    Отсутствует
                                @endif

                                @if (!empty($contact->comment))
                                    <p>{{$contact->comment}} </p>
                                @else
                                    Отсутствует
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                @if ($contact->lpr == 1)
                                    <span class="label label-danger pull-right"> ЛПР </span>
                                @endif

                                @if (!empty($contact->phones))
                                    <p>{{$contact->phones}} </p>
                                @else
                                    Отсутствует
                                @endif

                                @if (!empty($contact->email))
                                    <p>{{$contact->email}} </p>
                                @else
                                    Отсутствует
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
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
    <div class="col-md-12">
        <div id="vertical-timeline" class="vertical-container">
            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon navy-bg"><i class="fa fa-check"></i></div>
                <div class="vertical-timeline-content">
                    <p>Организация добавлена</p>
                    <span class="vertical-date">
                        <?php
                            // Разбиваем на время и дату
                            $date = explode(" ", $contractor->created_at);
                        ?>
						<b><?= $date[1]; // Время ?></b>
						<i class="fa fa-clock-o"></i>
                        <?= $date[0]; // Дата ?> <br/>
					</span>
                </div>
            </div>

            <div class="vertical-timeline-block">
                <form action="{{route('comments_add')}}" id="add_comment" method="post">
                    {{csrf_field()}}
                    <div class="vertical-timeline-icon blue-bg"><i class="fa fa-comments"></i></div>
                    <div class="vertical-timeline-content">
                        <input type="hidden" name="contractor_id" value="{{$contractor->id}}">
                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">

                        <div class="row">
                            <div class="form-group col-md-8 col-md-offset-2" id="data_1">
                                <label>Дата напоминания</label>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control inputmask" name="notification_date">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            <input type="time" class="form-control" name="notification_time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4 col-md-offset-2">
                                <label>Напоминание</label><br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="notification_yes" value="1" name="notification">
                                    <label for="notification_yes"> Да </label>
                                </div>
                                <br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="notification_no" value="0" name="notification">
                                    <label for="notification_no"> Нет </label>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Напоминание активно</label><br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="notification_active" value="1" name="notification_active">
                                    <label for="notification_active"> Да </label>
                                </div>
                                <br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="notification_active_no" value="0" name="notification_active">
                                    <label for="notification_active_no"> Нет </label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <textarea id="comment" class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button {{--onclick="return false" --}}type="submit" id="sendComment" class="btn btn-primary pull-right" name="title" value="title">Добавить комментарий</button></div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
  /*  $('button#sendComment').click(function(){
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
    });*/

</script>
<br><br>
@endsection