@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">
        <form action="/contractors/edit/{{$contractor->id}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-footer">
                                <a onclick="javascript:history.back();" class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Сохранить изменения</button>
                                <a href="/contractors/details/{{$contractor->id}}" class="btn btn-white btn-bitbucket"><i class="fa fa-eye"></i> Карточка организации</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Название</label>
                                        <input type="text" class="form-control" name="name" value="{{$contractor->name}}">
                                    </div>
                                    @if(!empty($packing))
                                        <div class="form-group col-md-6">
                                            <label>Упаковка</label>
                                            <select class="select2 form-control" name="packing_id">
                                                @foreach($packing as $item)
                                                    <option
                                                            @if($item->id === $contractor->packing_id)
                                                            selected
                                                            @endif
                                                            value="{{$item->id}}">{{$item->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        @if(!empty($regions))
                                            <label>Регион</label>
                                            <select
                                                    class="form-control"
                                                    name="region_id"
                                                    @if(Auth()->user()->group_id > 1 )
                                                    onmousedown="return(false)" onkeydown="return(false)"
                                                    readonly=""
                                                    @endif
                                            >
                                                @foreach($regions as $region)
                                                    <option
                                                            @if($region->id === $contractor->region_id)
                                                            selected
                                                            @endif
                                                            value="{{$region->id}}">{{$region->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    @if(!empty($periodicity))
                                        <div class="form-group col-md-6">
                                            <label>Периодичность</label>
                                            <select class="form-control" name="periodicity_id">
                                                @foreach($periodicity as $item)
                                                    <option
                                                            @if($item->id === $contractor->periodicity_id)
                                                            selected
                                                            @endif
                                                            value="{{$item->id}}">{{$item->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        @if(!empty($managers))
                                            <label>Менеджер</label>
                                            <select
                                                    class="form-control"
                                                    name="manager"
                                                    @if(Auth()->user()->group_id > 1 )
                                                    onmousedown="return(false)" onkeydown="return(false)"
                                                    readonly=""
                                                    @endif
                                            >
                                                @foreach($managers as $manager)
                                                    <option
                                                            @if($manager->id === $contractor->user_id)
                                                            selected
                                                            @endif
                                                            value="{{$manager->id}}">
                                                        {{$manager->fio}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-6" style="margin: 10px 0;">
                                        <b>В каких объемах берут:</b>
                                        <select class="select2 form-control" name="take_amount">
                                            @for($k = 0; $k <= 100; $k+=10)
                                                <option
                                                        value="{{$k}}"
                                                        @if($k == $contractor->take_amount)
                                                        selected
                                                        @endif
                                                >{{$k}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <br>
                                        <div class="checkbox checkbox-circle">
                                            <input id="assign_manager"
                                                   @if(Auth()->user()->group_id > 1 )
                                                   onclick="return(false)"
                                                   readonly=""
                                                   @endif
                                                   type="checkbox"
                                                   name="assign_manager"
                                                   value="1"
                                                   @if($contractor->assign_manager == 1)
                                                   checked
                                                    @endif
                                            >
                                            <label for="assign_manager">
                                                Закрепить за менеджером
                                            </label>
                                        </div>
                                    </div>

                                    @if(!empty($what_work))
                                        <div class="form-group col-md-6">
                                            <label class="font-normal">На чём работают</label>
                                            <div>
                                                <select data-placeholder="Выберете категорию" class="chosen-select" multiple="" name="what_work_id[]" style="width: 350px; display: none;" tabindex="-1">
                                                    @foreach($what_work as $item)
                                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Юридический адрес</label>
                                        <input type="text" class="form-control" name="ur_address" value="{{$contractor->ur_address}}" placeholder="Юридический адрес">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="{{$contractor->email}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Сайт компании</label>
                                        <input type="text" class="form-control" name="site_company" value="{{$contractor->site_company}}" placeholder="Сайт компании">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>ИНН</label>
                                        <input type="text"  min="0" max="999999999999" maxlength="12" class="form-control" name="inn" value="{{$contractor->inn}}" placeholder="ИНН">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Наличие договора</label><br>
                                        <div class="radio radio-inline">
                                            <input class="contract_number_yes"
                                                   type="radio"
                                                   id="contract_yes"
                                                   value="1"
                                                   name="contract_exist"
                                                   @if($contractor->contract_exist == 1)
                                                   checked
                                                    @endif
                                            >
                                            <label for="contract_yes"> Да </label>
                                        </div>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input  class="contract_number_no"
                                                    type="radio"
                                                    id="contract_no"
                                                    value="0"
                                                    name="contract_exist"
                                                    @if($contractor->contract_exist !== 1)
                                                    checked
                                                    @endif
                                            >
                                            <label for="contract_no"> Нет </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Номер договора</label>
                                            <input type="text" min="1" disabled  class="contract_number form-control" value="{{$contractor->contract_number}}" name="contract_number">
                                        </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Адресс доставки</label>
                                        <input type="text" class="form-control" value="{{$contractor->delivery_address}}" name="delivery_address">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Доставка</label><br>
                                        <div class="radio radio-inline">
                                            <input
                                                    type="radio"
                                                    id="delivery_our"
                                                    value="наша"
                                                    name="delivery"
                                                    @if($contractor->delivery == 'наша')
                                                    checked
                                                    @endif
                                            >
                                            <label for="delivery_our"> Наша </label>
                                        </div>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input
                                                    type="radio"
                                                    id="delivery_self"
                                                    value="сам"
                                                    name="delivery"
                                                    @if($contractor->delivery == 'сам')
                                                    checked
                                                    @endif
                                            >
                                            <label for="delivery_self"> Сам </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Комментарии</label>
                                        <textarea rows="8" type="text" class="form-control" name="comments">{{$contractor->comments}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    @if(!empty($contractor_statuses))
                        <div class="ibox float-e-margins">
                            <h2>Статус</h2>
                            <div class="ibox-content">
                                <div class="box-body" id="status">
                                    <select class="form-control" name="contractor_status_id">
                                        @foreach($contractor_statuses as $contractor_status)
                                            <option
                                                    @if($contractor_status->id == $contractor->contractor_status_id)
                                                    selected
                                                    @endif
                                                    value="{{$contractor_status->id}}">{{$contractor_status->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <h2>Телефоны</h2>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div id="listPhones">
                                            @if (!empty($contractor->phone))
                                                <?php
                                                    $phones = explode('<br>', $contractor->phone);
                                                ?>
                                                @for ($i = 0; $i < count($phones); $i++)
                                                    @if(!empty($phones[$i]))
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="phone[]" data-mask="+7 (999) 999-9999" value="{{$phones[$i]}}">
                                                            <div class="input-group-addon"><a href="#" onclick="$(this).parent('.input-group-addon').parent('.input-group').remove(); return false;"><i class="fa fa-trash"></i></a></div>
                                                        </div>
                                                    @endif
                                                @endfor
                                            @endif
                                        </div>
                                        <a href="" class="btn btn-xs btn-outline btn-success" style="margin-top: 10px;" onclick="add_phone();return false;"><i class="fa fa-plus"></i> Добавить телефон</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <h2>Контактные лица</h2>
                                <div id="listContacts" class="col-md-12">
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="" class="btn btn-outline btn-success" onclick="add_contact_person();return false;"><i class="fa fa-plus"></i> Добавить контактное лицо</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-footer">
                            <a href="{{route('contractors')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Сохранить изменения</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection