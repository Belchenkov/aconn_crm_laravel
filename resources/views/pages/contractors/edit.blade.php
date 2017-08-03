@extends('layouts.app')

@section('content')

    <div class="row  border-bottom white-bg dashboard-header">
        <form action="http://homestead.app/contracting_parties/edit/79" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-footer">
                                <a onclick="javascript:history.back();" class="btn btn-danger"><i class="fa fa-arrow-circle-o-left"></i> Отмена</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Сохранить изменения</button>
                                <a href="http://homestead.app/contracting_parties/details/79" class="btn btn-white btn-bitbucket"><i class="fa fa-eye"></i> Карточка организации</a>
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
                                        <label>Тип Организации</label>
                                        <select class="form-control" name="type">
                                            <option value="0">Не выбран</option>
                                            <option value="1" >ООО</option>
                                            <option value="2" >ЗАО</option>
                                            <option value="3" >ОАО</option>
                                            <option value="4" >ОДО</option>
                                            <option value="5" >ПАО</option>
                                            <option value="6" >НКО</option>
                                            <option value="7" >ИП</option>
                                            <option value="8" >Физ. лицо</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Название</label>
                                        <input type="text" class="form-control" name="name" value="ttttttttttttttt1232143">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Город</label>
                                        <select class="select2 form-control" name="city">
                                            <option value="0">Не выбран</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Адрес офиса</label>
                                        <input type="text" class="form-control" name="office" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Сайт</label>
                                        <input type="text" class="form-control" name="site" value="">
                                    </div>
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
                                        <label>Менеджер</label>
                                        <select class="select2_cities form-control" name="client_manager">
                                            <option value="0">Не выбран</option>
                                            <option value="4" selected>Дмитрий Исайкин</option>
                                            <option value="5" >Второй Манагер</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Канал</label>
                                        <select class="select2_cities form-control" name="direction">
                                            <option value="0">Не выбран</option>
                                            <option value="1" >База Диалог</option>
                                            <option value="2" >База 2ГИС</option>
                                            <option value="3" >Входящие заявки</option>
                                            <option value="4" >База рассылки</option>
                                            <option value="5" >Квесты</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Тип Организации</label>
                                        <select class="form-control" name="category">
                                            <option value="0">Не выбрана</option>
                                            <option value="1" >Малый бизнес (до 10 сотрудников)</option>
                                            <option value="2" >Средний бизнес (более 10 сотрудников)</option>
                                            <option value="3" >Крупный бизнес (более 20 сотрудников)</option>
                                            <option value="4" >VIP</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Информация об организации</label>
                                        <textarea rows="8" type="text" class="form-control" name="information"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body" id="status">
                                <h2>Статус</h2>
                                <select class="form-control" name="status">
                                    <option value="0">Не выбран</option>
                                    <option value="3" >Теплый</option>
                                    <option value="11" >На перспективу</option>
                                    <option value="12" selected>Бесперспективный</option>
                                    <option value="13" >Конкурент</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="box-body">
                                <h2>Телефоны</h2>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div id="listPhones">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="phones[]" data-mask="+7 (999) 999-9999" value="+7 (555) 555-5555">
                                                <div class="input-group-addon"><a href="#" onclick="$(this).parent('.input-group-addon').parent('.input-group').remove(); return false;"><i class="fa fa-trash"></i></a></div>
                                            </div>							</div>
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