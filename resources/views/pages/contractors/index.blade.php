@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="box-body">
                            <div class="row">
                                    {{-- Если (суперадмин, руководитель, менеджер)--}}
                                    @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                        <div class="col-md-3">
                                            <a href="{{route('contractors_add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить организацию</a><br>
                                        </div>
                                    @endif

                                <form action="{{route('contractors_add')}}" method="POST" target="_blank">
                                    <div class="col-md-9" id="filters">
                                        @if(!empty($regions))
                                            <div class="col-md-4">
                                                <b>Регион:</b>
                                                <select class="select2 form-control" name="filter[regions]">
                                                    <option value="0" selected>Все</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        @if(!empty($contractor_statuses))
                                            <div class="col-md-4">
                                                <b>Статус:</b>
                                                <select class="select2 form-control" name="filter[status]">
                                                    <option value="0" selected>Все</option>
                                                    @foreach($contractor_statuses as $status)
                                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="col-md-4">
                                            <b>Менеджер:</b>
                                            <select
                                                    class="select2 form-control"
                                                    name="filter[client_manager]"
                                                    @if(Auth()->user()->group_id == 2 )
                                                        disabled
                                                    @endif
                                            >
                                                <option value="0" selected>Все</option>
                                                @if(!empty($managers))
                                                    @foreach($managers as $manager)
                                                        <option value="{{$manager->id}}">{{$manager->fio}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-12"><br></div>

                                        <div class="col-md-4">
                                            <b>На чем работают:</b>
                                            <select class="select2 form-control" name="filter[what_works]">
                                                <option value="0" selected>Все</option>
                                                @if(!empty($what_work))
                                                    @foreach($what_work as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <b>В каких объемах берут:</b>
                                                <select class="select2 form-control" name="take_amount">
                                                    <option selected value="0">Все</option>
                                                    @for($k = 10; $k <= 100; $k+=10)
                                                        <option value="{{$k}}">{{$k}}</option>
                                                    @endfor
                                                </select>
                                        </div>

                                        <div class="col-md-12"><br></div>
                                        <div class="col-md-12">
                                            <b>Поиск по названию организации:</b>
                                            <input type="text" name="filter[search]" class="form-control">
                                        </div>
                                         </div>
                                   </form>
                                </div>
                            </div>

                            {{-- Pagination --}}
                            <ul class="pagination">
                                {{-- <li class="paginate_button previous disabled" id="DataTables_Table_0_previous">
                                     <a href="#" data-id="0">Пред</a>
                                 </li>--}}
                                @if (count($count_row) > 0)
                                    <?php $step = 0; $page = 1;?>
                                    @for ($i = 0; $i < $count_row; $i++)
                                            <li
                                                @if ($i >= 5)
                                                    style="display: none"
                                                @endif
                                                class="paginate_button"
                                                data-page_num="{{$step}}"
                                            >
                                                <a href="#">{{$page++}}</a>
                                            </li>
                                            {{--@if ($i == 5 )
                                                <li class="paginate_button"><a>...</a></li>
                                            @endif--}}
                                        <?php $step+=5; ?>
                                    @endfor
                                @endif

                                {{-- <li class="paginate_button next" data-id="4" id="DataTables_Table_0_next">
                                     <a href="#">След</a>
                                 </li>--}}
                             </ul>
                            {{-- Pagination --}}

                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-content">

                                                <div class="table-responsive" >
                                                    <table id="example" class="display table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                            <tr>
                                                                <th>Наименование(s)</th>
                                                                <th>Телефон</th>
                                                                <th>Email</th>
                                                                <th>Регион</th>
                                                                <th>Менеджер</th>
                                                                @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                    <th>Управление</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody id="currentPage">
                                                       <!--{{--@if(!empty($contractors))
                                                               <?php $i = 1; ?>
                                                               @foreach($contractors as $contractor)
                                                                   @if(Auth()->user()->group_id != 2)
                                                                       <tr id="currentPage">
                                                                           <td>{{$i++}}</td>
                                                                           <td>
                                                                               <a href="{{route('contractors_details', ['id' => $contractor->id])}}">{{$contractor->name}}</a>
                                                                           </td>
                                                                           <td>{!! $contractor->phone !!}</td>
                                                                           <td>
                                                                               @foreach($regions as $region)
                                                                                   @if($contractor->region_id === $region->id)
                                                                                       {{$region->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>
                                                                           <td>
                                                                               @foreach($users as $user)
                                                                                   @if($contractor->user_id === $user->id)
                                                                                       {{$user->fio}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>
                                                                           <td>
                                                                               @if($contractor->assign_manager)
                                                                                   {{'Да'}}
                                                                               @else
                                                                                   {{'Нет'}}
                                                                               @endif
                                                                           </td>
                                                                           <td>
                                                                               @foreach($what_work as $item)
                                                                                   @if($contractor->what_work_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           <td>
                                                                               @foreach($periodicity as $item)
                                                                                   @if($contractor->periodicity_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           <td>
                                                                               @foreach($packing as $item)
                                                                                   @if($contractor->packing_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                               <td>
                                                                                   <a href="{{route('contractors_edit', ['id' => $contractor->id] )}}" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a>
                                                                                   @if(!Auth()->user()->group_id)
                                                                                       <form action="{{route('contractors_delete', ['id' => $contractor->id])}}" method="post" style="display: inline;">
                                                                                           {{ csrf_field() }}
                                                                                           <button class="btn btn-danger btn-bitbucket" onclick="return confirm('Удалить?')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>
                                                                                       </form>
                                                                                   @endif
                                                                               </td>
                                                                           @endif
                                                                       </tr>
                                                                   @endif
                                                               @endforeach
                                                           @endif

                                                           @if(!empty($manager_contractors))
                                                               @foreach($manager_contractors as $contractor)
                                                                   @if(Auth()->user()->group_id == 2)
                                                                       <tr>
                                                                           <td>{{$contractor->id}}</td>
                                                                           <td>
                                                                               <a href="{{route('contractors_details', ['id' => $contractor->id] ) }}">{{$contractor->name}}</a>
                                                                           </td>
                                                                           <td>{!! $contractor->phone !!}</td>
                                                                           <td>
                                                                               @foreach($regions as $region)
                                                                                   @if($contractor->region_id === $region->id)
                                                                                       {{$region->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>
                                                                           <td>
                                                                               @foreach($users as $user)
                                                                                   @if($contractor->user_id === $user->id)
                                                                                       {{$user->fio}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>
                                                                           <td>
                                                                               @if($contractor->assign_manager)
                                                                                   {{'Да'}}
                                                                               @else
                                                                                   {{'Нет'}}
                                                                               @endif
                                                                           </td>
                                                                           <td>
                                                                               @foreach($what_work as $item)
                                                                                   @if($contractor->what_work_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           <td>
                                                                               @foreach($periodicity as $item)
                                                                                   @if($contractor->periodicity_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           <td>
                                                                               @foreach($packing as $item)
                                                                                   @if($contractor->packing_id === $item->id)
                                                                                       {{$item->name}}
                                                                                   @endif
                                                                               @endforeach
                                                                           </td>

                                                                           @if(Auth()->user()->group_id >= 0 && Auth()->user()->group_id < 3)
                                                                               <td>
                                                                                   <a href="{{route('contractors_edit', ['id' => $contractor->id] )}}" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a>
                                                                                   @if(!Auth()->user()->group_id)
                                                                                       <form action="{{route('contractors_delete', ['id' => $contractor->id] )}}" method="post" style="display: inline;">
                                                                                           {{ csrf_field() }}
                                                                                           <button class="btn btn-danger btn-bitbucket" onclick="return confirm('Удалить?')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>
                                                                                       </form>
                                                                                   @endif
                                                                               </td>
                                                                           @endif
                                                                       </tr>
                                                                   @endif
                                                               @endforeach
                                                           @endif--}}-->
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{--<div id="pagination" style="display: block;"><ul class="pagination bootpag"><li data-lp="1" class="prev disabled"><a href="javascript:void(0);">«</a></li><li data-lp="1" class="active"><a href="javascript:void(0);">1</a></li><li data-lp="2"><a href="javascript:void(0);">2</a></li><li data-lp="2" class="next"><a href="javascript:void(0);">»</a></li></ul></div>--}}
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>


@endsection