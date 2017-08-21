function getPage(page) {
	$('#pagination, #pagination2').hide();
	 // $('#currentPage').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce" style="text-align: center"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	/* Сохраняем значения фильтров и номер страницы*/
	localStorage.setItem('orgSearch', $('input[name="filter[search]"]').val());
	localStorage.setItem('orgPage', page);
	localStorage.setItem('orgDirections', $('select[name="filter[regions]"]').val());
	localStorage.setItem('orgManager', $('select[name="filter[client_manager]"]').val());
	localStorage.setItem('orgStatus', $('select[name="filter[status]"]').val());
	localStorage.setItem('orgWhat_works', $('select[name="filter[what_works]"]').val());
    //console.log('search='+$('input[name="filter[search]"]').val()+'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()+'&client_manager='+$('select[name="filter[client_manager]"]').val()+'&status='+$('select[name="filter[status]"]').val());

	// Запрос осуществляем только на странице /contractors
    if (window.location.pathname == '/contractors') {

        //DataTables
        /*$('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/contractors/contractorsGetAjax",
                "type": "POST"
            },
            "columns": [
                { "data": "first_name" },
                { "data": "last_name" },
                { "data": "position" },
                { "data": "office" },
                { "data": "start_date" },
                { "data": "salary" }
            ]
        } );*/

        // Получаем группу текущего пользователя
        $.ajax({
            type: 'GET',
            url: '/contractors/contractorsGetCurrentUser',
            dataType: "json",
            success: function(data){
                // Текущий пользователь
                var currentUserGroup = data['group_id'];
                var currentUserID = data['id'];
                // Отправляем данные из фильтра

                function ajaxGet(limit_start, limit_end) {
                    $.ajax({
                        type: 'GET',
                        url: '/contractors/contractorsGetAjax',
                        dataType: "json",
                        data: 'search='+$('input[name="filter[search]"]').val()
                        +'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()
                        +'&client_manager='+$('select[name="filter[client_manager]"]').val()
                        +'&status='+$('select[name="filter[status]"]').val()
                        +'&what_works='+$('select[name="filter[what_works]"]').val()
                        +'&currentUserGroup='+currentUserGroup
                        +'&currentUserID='+currentUserID
                        +'&limit_start='+limit_start,
                        success: function(data) {
                            console.log(data);
                            var contractors = data.contractors;
                            var managers = data.managers;
                            var regions = data.regions;

                            // Показывать кнопку удалить только для админа
                            var deleteBtn = '';
                            if (data.user_group == 0) {
                                deleteBtn = ' <a href="contractors/delete/"><button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button></a></span>';
                            }
                            /*                     // Счетчик для ID
                                                 var i = 1;

                                                 //DataTables
                                                 var table = $('#example').DataTable( {
                                                     ajax: {
                                                          "url": "data/json.txt",
                                                         //"url": "contractors/contractorsGetAjax",
                                                     },
                                                     "bDestroy": true,
                                                     "bInfo": false,
                                                     "bFilter": false,
                                                     "bSearch": false,
                                                     "oLanguage": {
                                                         "sLengthMenu": "Отображено _MENU_ позиций на страницу",
                                                         "sSearch": '',
                                                         // "sZeroRecords": "<strong style='padding: 30px'>Ничего не найдено - извините</strong>",
                                                         "sInfo": "Показано с _START_ по _END_ из _TOTAL_ записей",
                                                         "sInfoEmpty": "",
                                                         "sInfoFiltered": "",
                                                         "oPaginate": {
                                                             "sFirst": "Первая",
                                                             "sLast": "Посл.",
                                                             "sNext": "След.",
                                                             "sPrevious": "Пред."
                                                         }
                                                     },
                                                     "columns": [
                                                         { "data": "id" },
                                                         { "data": "name" },
                                                         { "data": "phone" },
                                                         { "data": "email"},
                                                         { "data": "region_id" }
                                                     ],

                                                     "aoColumnDefs": [
                                                         {
                                                             "aTargets": [0],
                                                             "mData": "userId",
                                                             "mRender": function (data, type, full) {
                                                                 return i++;
                                                             },
                                                         },
                                                         {
                                                             "aTargets": [4],
                                                             "mData": "userId",
                                                             "mRender": function (data, type, full) {
                                                                 var region = '';
                                                                 for (var k = 0; k < contractors.length; k++) {

                                                                     var region_id = contractors[k]['region_id'];

                                                                     // Текущий менеджер
                                                                     for (var j = 0; j < regions.length; j++) {
                                                                         if (region_id == regions[j]['id']) {
                                                                             region = regions[j]['name'];
                                                                         }
                                                                     }
                                                                     return region;

                                                                 }
                                                             },
                                                         },
                                                         {
                                                             "aTargets": [5],
                                                             "mData": "userId",
                                                             "mRender": function (data, type, full) {
                                                                 var manager = '';
                                                                 for (var k = 0; k < contractors.length; k++) {
                                                                     //console.log(id);
                                                                     var manager_id = contractors[k]['user_id'];

                                                                     // Текущий менеджер
                                                                     for (var j = 0; j < managers.length; j++) {
                                                                         if (manager_id == managers[j]['id']) {
                                                                             manager = managers[j]['fio'];
                                                                         }
                                                                     }
                                                                     //console.log(manager);
                                                                 }
                                                                 return manager;
                                                             },
                                                         },
                                                         {
                                                             "aTargets": [6],
                                                             "mData": "userId",
                                                             "mRender": function (data, type, full) {
                                                                 return '<span class="text-center"><a href="contractors/edit/" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a> ' +
                                                                     deleteBtn;
                                                             }
                                                         }

                                                     ]
                                                 } );*/

                            var contractors = data.contractors;
                            var managers = data.managers;
                            var regions = data.regions;

                            var table_row = '';

                            for (var i = 0; i < contractors.length; i++) {
                                var id = contractors[i]['id'];
                                var name = contractors[i]['name'];
                                var phone =  contractors[i]['phone'];
                                var region_id = contractors[i]['region_id'];
                                var manager_id = contractors[i]['user_id'];
                                var email = contractors[i]['email'];

                                // Если email = null
                                if (!email) {
                                    email = 'Отсутствует';
                                }

                                var manager = '';
                                // Текущей менеджер
                                for (var j = 0; j < managers.length; j++) {
                                    if (manager_id == managers[j]['id']) {
                                        manager = managers[j]['fio'];
                                        break;
                                    }
                                }

                                var region = '';
                                // Текущей регион
                                for (var k = 0; k < regions.length; k++) {
                                    if (region_id == regions[k]['id'] ) {
                                        region = regions[k]['name'];
                                        break;
                                    }

                                }
                                //console.log(currentUserGroup);

                                if (currentUserGroup < 2) {
                                    var delete_btn = '<a href="contractors/delete/'+id+'""><button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button></a>'
                                    '<form action="contractors/delete/'+id+'" method="post" style="display: inline;">' +
                                    '<input type="hidden" name="_method" value="POST">' +
                                    '<input type="hidden" name="_token" value="1234:5ad02792a3285252e524ccadeeda3401">' +
                                    '<button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>' +
                                    '</form>';
                                } else {
                                    delete_btn = '';
                                }

                                // Формируем таблицу
                                table_row +=
                                    '<tr>' +
                                    '<td><a href="/contractors/details/' + id + '">'+ name +'</a></td>' +
                                    '<td>'+ phone +'</td>' +
                                    '<td>'+ email +'</td>' +
                                    '<td>'+ region +'</td>' +
                                    '<td>'+ manager +'</td>' +
                                    '<td class="text-center">'+
                                    '<a href="contractors/edit/'+id+'" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right"  title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a> '
                                    + delete_btn +
                                    '</td>' +
                                    '</tr>';
                            }
                            $('#currentPage').html(table_row);

                        },
                        error: function (err) {
                            console.log(err);
                        }
                    }); // end $.ajax()
                }

                ajaxGet(0);

                var i = 0;
                $('.paginate_button').on('click', function (e) {
                    e.preventDefault();
                    var that = $(this);
                    var page_num = that.data("page_num");
                    ajaxGet(page_num);
                    that.next().css('display', 'inline');
                    //console.log(page_num);
                    /*if (page_num > 25) {
                        $('.paginate_button').eq(i).css('display', 'none');
                    }*/
                });

            }
        }); // end $.ajax()*/
	}
}

$(document).ready(function() {

    // Активировать напоминание
    var date_nofit = $('#date_notif');
    date_nofit.css('display', 'none');

    // Отправляем в базу либо 0 либо 1
    $('#notif-btn').on('click', function () {
        date_nofit.slideToggle();
        if (date_nofit.css('height') == '1px') {
            $('#notif_yes').attr('value', 1)
        }
        if (date_nofit.css('height') != '1px') {
            $('#notif_yes').attr('value', 0)
        }

    });

	$('.select2').select2();
	if (localStorage.getItem('orgPage') > 0) {
		getPage(localStorage.getItem('orgPage'));
	} else {
		getPage(1);
	}

	$('input[name="filter[search]"]').keyup(function(){
		getPage(1);
	});
	$('#filters').on('change', 'select', function(){
		getPage(1);
	});
});
