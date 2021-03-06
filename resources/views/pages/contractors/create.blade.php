@extends('layouts.app')

@section('content')

<div class="row border-bottom white-bg dashboard-header">
    <form action="{{route('contractors_store')}}"  method="post" id="newForm">

    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-7">
            <a href="{{route('contractors')}}"  class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a><br><br>
            <div class="ibox float-e-margins">
                <h2>Основная информация</h2>
                <div class="ibox-content">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Наименование</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" required="" placeholder="Наименование">
                            </div>

                            @if(!empty($packing))
                                <div class="form-group col-md-6">
                                    <label>Упаковка</label>
                                    <select class="select2 form-control" required="" name="packing_id">
                                        @foreach($packing as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if(!empty($regions))
                                <div class="form-group col-md-6">
                                    <label>Регион</label>
                                    <select class="form-control select2" required="" name="region_id" >
                                        <option value="">Не выбран</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if(!empty($periodicity))
                                <div class="form-group col-md-6">
                                    <label>Периодичность</label>
                                    <select class="select2 form-control" name="periodicity_id" required="">
                                        @foreach($periodicity as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if(!empty($managers))
                                <div class="form-group col-md-6">
                                    <label>Менеджер</label>
                                    <select class="select2 form-control" name="manager" required="">
                                        @foreach($managers as $manager)
                                            <option
                                                    @if($manager->id == 1)
                                                    selected
                                                    @endif
                                                    value="{{$manager->id}}">{{$manager->fio}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group col-md-6">
                                <b>В каких объемах берут:</b>
                                <select class="select2 form-control" name="take_amount">
                                    @for($k = 0; $k <= 100; $k+=10)
                                        <option value="{{$k}}">{{$k}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <br>
                                <div class="checkbox checkbox-circle">
                                    <input id="assign_manager" type="checkbox" name="assign_manager" value="">
                                    <label for="assign_manager">
                                        Закрепить за менеджером
                                    </label>
                                </div>
                            </div>

                            @if(!empty($what_work))
                                <div class="form-group col-md-6">
                                    <label class="font-normal">На чём работают</label>
                                    <div>
                                        <select data-placeholder="Выберете категорию ..." class="chosen-select" multiple="" name="what_work_id[]" style="width: 350px; display: none;" tabindex="-1">
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
                                <input type="text" class="form-control" name="ur_address" value="{{old('ur_address')}}" placeholder="Юридический адрес">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Сайт компании</label>
                                <input type="text" class="form-control" value="{{old('site_company')}}" name="site_company">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>ИНН</label>
                                <input type="text"  min="0" max="999999999999" maxlength="12" class="form-control" value="{{old('inn')}}" name="inn">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Наличие договора</label><br>
                                <div class="radio radio-inline">
                                    <input
                                            type="radio"
                                            id="contract_yes"
                                            value="1"
                                            name="contract_exist"
                                            class="contract_number_yes"
                                    >
                                    <label for="contract_yes"> Да </label>
                                </div>
                                <br>
                                <div class="radio radio-inline">
                                    <input type="radio"
                                           id="contract_no"
                                           value="0"
                                           checked="checked"
                                           name="contract_exist"
                                           class="contract_number_no"
                                    >
                                    <label for="contract_no"> Нет </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Номер договора</label>
                                <input type="text" disabled="" class="contract_number form-control" value="{{old('contract_number')}}" name="contract_number">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Адресс доставки</label>
                                <input type="text" class="form-control" value="{{old('delivery_address')}}" name="delivery_address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Доставка</label><br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="delivery_our" value="наша" name="delivery">
                                    <label for="delivery_our"> Наша </label>
                                </div>
                                <br>
                                <div class="radio radio-inline">
                                    <input type="radio" id="delivery_self" value="сам" name="delivery">
                                    <label for="delivery_self"> Сам </label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Комментарии</label>
                                <textarea rows="4" class="form-control" name="comments">{{old('comments')}}</textarea>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>

        <div class="col-md-5" style="margin-top: 53px">

            @if(!empty($contractor_statuses))
                <div class="ibox float-e-margins">
                    <h2>Статус</h2>
                    <div class="ibox-content">
                        <div class="box-body" id="status">
                            <select class="form-control select2" required="" name="contractor_status_id">
                                @foreach($contractor_statuses as $contractor_status)
                                    <option value="{{$contractor_status->id}}">{{$contractor_status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="ibox float-e-margins">
                <h2>Контактные телефоны</h2>
                <div class="ibox-content">
                    <input type="text" class="form-control" name="phone[]" required data-mask="+7 (999) 999-9999">
                    <div id="listPhones"></div>
                    <a href="" class="btn btn-outline btn-success" style="margin-top: 10px;"
                       onclick="add_phone();return false;">
                        <i class="fa fa-plus"></i>
                        Добавить телефон
                    </a>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <h2>Контактные лица</h2>
                <div class="ibox-content">
                    <div class="box-body">
                        <div id="listContacts" class="col-md-12"></div>
                    </div>
                    <div class="box-footer">
                        <a href="" id="add-contact-person" class="btn btn-outline btn-success" onclick="add_contact_person();return false;"><i class="fa fa-plus"></i> Добавить контактное лицо</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="resultRepeat"></div>
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить организацию</button>
                    </div>
                </div>
            </div>
        </div>
        </div>


    </div>
    </form>
</div>

@endsection