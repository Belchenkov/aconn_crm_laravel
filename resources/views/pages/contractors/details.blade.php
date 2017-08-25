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
                        @if(!empty($phones))
                            <div class="form-group col-md-6">
                                <div style="width: 160px">
                                    <label>Телефоны</label><br>
                                        @foreach($phones as $phone)
                                            <div class="phones copyButton" data-toggle="tooltip" data-placement="left" title="" data-original-title="Копировать">{{ $phone }}</div>
                                        @endforeach
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
                            <label>На чем работают</label><br>
                            @if (!empty($contractor->what_work_id))
                                {{$contractor->what_work_id}}
                            @else
                                Отсутствует
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>E-mail</label><br>

                            @if (!empty($contractor->email))
                                <span class="cont copyButton" data-toggle="tooltip" data-placement="left" title="" data-original-title="Копировать"> {{$contractor->email}}</span>
                            @else
                                Отсутствует
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Номер контракта</label><br>
                            @if (!empty($contractor->contract_number))
                                {{$contractor->contract_number}}
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
                            <label>В каких объемах берут</label><br>
                            @if (!empty($contractor->take_amount))
                                {{$contractor->take_amount}}
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
                            <label>Периодичность</label><br>
                            @if (!empty($periodicity))
                                {{$periodicity}}
                            @else
                                Отсутствует
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
                            <label>Доставка</label><br>
                            @if (!empty($contractor->delivery))
                                {{$contractor->delivery}}
                            @else
                                Отсутствует
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Адрес доставки</label><br>
                            @if (!empty($contractor->delivery_address))
                                {{$contractor->delivery_address}}
                            @else
                                Отсутствует
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Упаковка</label><br>
                            @if (!empty($packing))
                                {{$packing}}
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

                        <div class="form-group col-md-6">
                            <label>Комментарий</label><br>
                            @if (!empty($contractor->comments))
                                {{$contractor->comments}}
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
                                            <div class="phones copyButton" data-toggle="tooltip" data-placement="left" title="" data-original-title="Копировать" >{!! $contact->phones !!}</div>
                                        </div>
                                    @endif

                                    @if (!empty($contact->email))
                                        <span class="phones copyButton" data-toggle="tooltip" data-placement="left" title="" data-original-title="Копировать"> {{$contact->email}}</span>
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
                <form action="{{route('comments_add')}}" id="add_comment" method="post">
                    {{csrf_field()}}
                    <div class="vertical-timeline-icon blue-bg"><i class="fa fa-comments"></i></div>
                    
                    <div class="vertical-timeline-content">
                        <div class="row">
                            <div class="form-group col-md-12" style="margin-top: 25px">
                                <button type="button" class="btn btn-success btn-block btn-lg" id="notif-btn">Добавить комментарий</button>
                            </div>
                        </div>
                        <br>

                        <div class="row col-md-12" id="date_notif" style="display: none;">
                            <input type="hidden" name="contractor_id" value="{{$contractor->id}}">
                            <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">

                            <div>
                                <textarea id="comment" required="" class="form-control" name="comment" rows="5"></textarea>
                            </div>
                            <br>

                            <div class="row">
                                <div class="form-group col-md-10 col-md-offset-1" id="data_1">
                                    <label>Дата напоминания</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control inputmask" name="notification_date">
                                            </div>
                                        </div>
                                        <input type="hidden" id="notif_yes" value="0" name="notification">
                                        <div class="form-group col-md-3 col-md-push-2">
                                            <div class="input-group clockpicker" data-autoclose="true">
                                                <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                <input type="time" class="form-control" name="notification_time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox checkbox-circle" style="margin-left: 45px">
                                    <input type="checkbox" class="" id="notification_active" name="notification_active" value="1" />
                                    <label for="notification_active"><strong>Напоминание</strong></label>
                                </div>
                                <button type="submit" id="sendComment" class="btn btn-primary pull-right">Добавить комментарий</button></div>
                            </div>

                        </div>


                </form>
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

        </div>
    </div>
</div>
</div>
<script>

</script>
<br><br>
@endsection