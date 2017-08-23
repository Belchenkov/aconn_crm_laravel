@extends('layouts.app')

@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Организации</span>
                            <h2 class="font-bold">
                                @if(!empty($count_contractors))
                                    {{$count_contractors}}
                                @endif
                            </h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="notifications" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="contacts_info">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Комментарий</th>
                        <th>Организация</th>
                        <th>Дата напоминания</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($notifications) && count($notifications) > 0)
                            <?php $i = 1; ?>
                            @foreach($notifications as $item)
                                <tr
                                    @if($item->reminder_status == 1)
                                       style="background: #ffb733;"
                                    @endif
                                >
                                    <td>{{$i}}</td>
                                    <td><a href="contractors/details/{{$item->contractor_id}}">{{$item->comments}} </a></td>
                                    <td>
                                        @if(!empty($contractors) && count($contractors) > 0)
                                            @foreach($contractors as $contractor)
                                                @if($item->contractor_id == $contractor->id)
                                                    {{$contractor->name}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td><span id="rus_group">{{$item->date_reminder}}</span></td>
                                </tr>
                                <?php $i++?>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
