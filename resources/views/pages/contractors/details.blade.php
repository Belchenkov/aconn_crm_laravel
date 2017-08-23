@extends('layouts.app')

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="box-footer">
                        <a onclick="javascript:history.back();" class="btn btn-white"><i class="fa fa-arrow-circle-o-left"></i> Назад</a>
                        {{-- Если (админ, руководитель, менеджер) --}}
                        @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                            <a href="{{ route('contractors_edit', ['contractor_id' => $contractor->id] )}}" class="btn btn-default"><i class="fa fa-edit"></i> Редактировать</a>
                            {{-- Если админ - удалять могут только админы --}}
                            @if(!Auth()->user()->group_id)
                                <form action="{{route('contractors_delete', ['contractor_id' => $contractor->id])}}" method="post" style="display: inline;">
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
                                    <i class="copyButton fa fa-copy"
                                      title="Копировать в буфер"
                                    ></i>
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

                            @if (!empty($contractor->email))
                                <i class="copyButton fa fa-copy"
                                   title="Копировать в буфер"
                                ></i>
                                <span class="cont" style="margin-left: 15px"> {{$contractor->email}}</span>
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
                            @if (!empty($contact->fio))
                            <input type="text" value="3" name="contact[0][id]" class="hidden">
                                <div class="form-group col-md-6">
                                    @if (!empty($contact->fio))
                                        <h4>{{$contact->fio}} </h4>
                                    @endif

                                    @if (!empty($contact->position))
                                        <p>{{$contact->position}} </p>
                                    @endif

                                    @if (!empty($contact->comment))
                                        <p>{{$contact->comment}} </p>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    @if ($contact->lpr == 1)
                                        <span class="label label-danger pull-right"> ЛПР </span>
                                    @endif

                                    @if (!empty($contact->phones) && count($contact->phones) > 0 && $contact->phones != '<br>')
                                        <div style="width: 160px; margin-bottom: 30px;">
                                            <i class="copyButton fa fa-copy"
                                              title="Копировать в буфер"
                                            ></i>
                                            <div class="cont pull-right">{!! $contact->phones !!}</div>
                                        </div>
                                    @endif

                                    @if (!empty($contact->email))
                                        <i class="copyButton fa fa-copy"
                                           title="Копировать в буфер"
                                        ></i>
                                        <span class="cont" style="margin-left: 15px"> {{$contact->email}}</span>
                                    @endif
                                </div>
                            @endif
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

            @if(!empty($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg"><i class="fa fa-check"></i></div>
                        <div class="vertical-timeline-content">
                            <p><em>{{$comment->comments}}</em></p>
                            <span class="vertical-date">
                                <span>Добавлено </span>
                                <?php
                                    // Разбиваем на время и дату
                                    $date = explode(" ", $comment->created_at);
                                ?>
                                <b><?= $date[1]; // Время ?></b>
						        <i class="fa fa-clock-o"></i>
                                <?= $date[0]; // Дата ?> <br/>
                                @if(!empty($users) && count($users) > 0)
                                    @foreach($users as $user)
                                        @if($user->id == $comment->user_id)
                                            <small>{{$user->fio}}</small>
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                            @if(!empty($comment->reminder_status) && $comment->reminder_status == 1)
                                <div class="pull-right">
                                    <i class="fa fa-bell bell" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$comment->comments}}  {{$comment->date_reminder}}"></i>
                                </div>
                            @elseif(!empty($comment->reminder_status) && $comment->reminder_status == 2)
                            <div class="pull-right">
                                <i class="fa fa-bell bell-not-active" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{$comment->comments}}  {{$comment->date_reminder}}"></i>
                            </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif
            <div class="vertical-timeline-block">
                <form action="{{route('comments_add')}}" id="add_comment" method="post">
                    {{csrf_field()}}
                    <div class="vertical-timeline-icon blue-bg"><i class="fa fa-comments"></i></div>
                    <div class="vertical-timeline-content">
                        <input type="hidden" name="contractor_id" value="{{$contractor->id}}">
                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                        <div>
                            <textarea id="comment" required="" class="form-control" name="comment" rows="5"></textarea>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button type="button" class="btn btn-success pull-left" id="notif-btn">Напоминание</button>
                            </div>
                        </div>
                        <br>
                        <div class="row" id="date_notif">
                            <div class="form-group col-md-8 col-md-offset-2" id="data_1">
                                <label>Дата напоминания</label>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control inputmask" name="notification_date">
                                        </div>
                                    </div>
                                    <input type="hidden" id="notif_yes" value="0" name="notification">
                                    <div class="form-group col-md-6">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            <input type="time" class="form-control" name="notification_time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="sendComment" class="btn btn-primary pull-right" name="title" value="title">Добавить комментарий</button></div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>

</script>
<br><br>
@endsection