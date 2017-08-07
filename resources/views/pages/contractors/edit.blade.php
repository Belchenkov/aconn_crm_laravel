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
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if(count($regions) > 0)
                                            <label>Регион</label>
                                            <select class="form-control" name="region_id">
                                                <option value="0">Не выбран</option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Название</label>
                                        <input type="text" class="form-control" name="name" value="{{$contractor->name}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="{{$contractor->email}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Юридический адрес</label>
                                        <input type="text" class="form-control" name="ur_address" value="{{$contractor->ur_address}}" placeholder="Юридический адрес">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Сайт компании</label>
                                        <input type="text" class="form-control" name="site_company" value="{{$contractor->site_company}}" placeholder="Сайт компании">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>ИНН</label>
                                        <input type="text" class="form-control" name="inn" value="{{$contractor->inn}}" placeholder="ИНН">
                                    </div>

                                    @if(count($packing) > 0)
                                        <div class="form-group col-md-12">
                                            <label>Упаковка</label>
                                            <select class="select2 form-control" name="packing_id">
                                                <option value="0">Не выбран</option>
                                                @foreach($packing as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group col-md-12">
                                        <label>В каких объемах берут</label>
                                        <input type="number" min="1" class="form-control" name="take_amount">
                                    </div>

                                    @if(count($what_work) > 0)
                                        <div class="form-group col-md-12">
                                            <label>На чём работают</label>
                                            <select class="form-control" name="what_work_id">
                                                <option value="0">Не выбран</option>
                                                @foreach($what_work as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if(count($managers) > 0)
                                            <label>Менеджер</label>
                                            <select class="select2 form-control" name="manager">
                                                <option value="0">Не выбран</option>
                                                @foreach($managers as $manager)
                                                    <option value="{{$manager->id}}">{{$manager->fio}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <br>
                                        <div class="checkbox checkbox-circle">
                                            <input id="assign_manager" type="checkbox" name="assign_manager" value="1">
                                            <label for="assign_manager">
                                                Закрепить за менеджером
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label>Номер договора</label>
                                        <input type="text" min="1" class="form-control" name="contract_number">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Наличие договора</label><br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="contract_yes" value="1" name="contract_exist">
                                            <label for="contract_yes"> Да </label>
                                        </div>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="contract_no" value="0" name="contract_exist">
                                            <label for="contract_no"> Нет </label>
                                        </div>
                                    </div>

                                    @if(count($periodicity) > 0)
                                        <div class="form-group col-md-12">
                                            <label>Периодичность</label>
                                            <select class="form-control" name="periodicity_id">
                                                <option value="0">Не выбрана</option>
                                                @foreach($periodicity as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <label>Адресс доставки</label>
                                        <input type="text" class="form-control" name="delivery_address">
                                    </div>

                                    <div class="form-group col-md-12">
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

                                    <div class="form-group col-md-12">
                                        <label>Комментарии</label>
                                        <textarea rows="8" type="text" class="form-control" name="information"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if(count($contractor_statuses) > 0)
                        <div class="ibox float-e-margins">
                            <h2>Статус</h2>
                            <div class="ibox-content">
                                <div class="box-body" id="status">
                                    <select class="form-control" name="contractor_status_id">
                                        <option value="0">Не выбран</option>
                                        @foreach($contractor_statuses as $contractor_status)
                                            <option value="{{$contractor_status->id}}">{{$contractor_status->name}}</option>
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
                                            @if (count($contractor->phone) > 0)
                                                    <?php $phones = explode('<br>', $contractor->phone); ?>

                                                        @for ($i = 0; $i < count($phones) - 1; $i++)
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="phone[]" data-mask="+7 (999) 999-9999" value="{{$phones[$i]}}">
                                                                <div class="input-group-addon"><a href="#" onclick="$(this).parent('.input-group-addon').parent('.input-group').remove(); return false;"><i class="fa fa-trash"></i></a></div>
                                                            </div>
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
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-footer">
                                <a onclick="javascript:history.back();" class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Сохранить изменения</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


@endsection