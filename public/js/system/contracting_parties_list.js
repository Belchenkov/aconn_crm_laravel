function getPage(page) {
	/* Сохраняем значения фильтров и номер страницы*/
	localStorage.setItem('orgSearch', $('input[name="filter[search]"]').val());
	localStorage.setItem('orgPage', page);
	localStorage.setItem('orgDirections', $('select[name="filter[regions]"]').val());
	localStorage.setItem('orgManager', $('select[name="filter[client_manager]"]').val());
	localStorage.setItem('orgStatus', $('select[name="filter[status]"]').val());
	localStorage.setItem('orgWhat_works', $('select[name="filter[what_works]"]').val());

	// Запрос осуществляем только на странице /contractors
    if (window.location.pathname == '/contractors') {

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
                function ajaxGet(limit_start) {
                    var dataRequest = 'search='+$('input[name="filter[search]"]').val()
                        +'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()
                        +'&client_manager='+$('select[name="filter[client_manager]"]').val()
                        +'&status='+$('select[name="filter[status]"]').val()
                        +'&what_works='+$('select[name="filter[what_works]"]').val()
                        +'&take_amount='+$('select[name="take_amount"]').val()
                        +'&currentUserGroup='+currentUserGroup
                        +'&currentUserID='+currentUserID
                        +'&limit_start='+limit_start;
                    //console.log(dataRequest);
                    $.ajax({
                        type: 'GET',
                        url: '/contractors/contractorsGetAjax',
                        dataType: "json",
                        data: dataRequest,
                        success: function(data) {

                            var contractors = data.contractors;
                            var managers = data.managers;
                            var regions = data.regions;
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

                                if (currentUserGroup < 2) {
                                    var delete_btn = '<a href="contractors/delete/'+id+'""><button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button></a>';
                                   /* '<form action="contractors/delete/'+id+'" method="post" style="display: inline;">' +
                                        '<input type="hidden" name="_method" value="POST">' +
                                        '<input type="hidden" name="_token" value="1234:5ad02792a3285252e524ccadeeda3401">' +
                                        '<button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>' +
                                    '</form>';*/
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
                            console.log(err.responseText);
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
                        $('.paginate_button').eq(i++).css('display', 'none');
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
