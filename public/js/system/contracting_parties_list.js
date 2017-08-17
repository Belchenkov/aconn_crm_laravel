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
                    +'&currentUserID='+currentUserID,
                    success: function(data) {
                        console.log(data);

                        //DataTables
                        $('#example').DataTable( {
                            "ajax": {
                                "url": "data/json.txt",
                            },
                            "columns": [
                                { "data": "id" },
                                { "data": "name" },
                                { "data": "phone" },
                                { "data": "region_id" },
                                { "data": "user_id" },
                                { "data": "email" },
                            ],
                        } );

                         /*               var contractors = data.contractors;
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
                                                    /!*'<form action="contractors/delete/'+id+'" method="post" style="display: inline;">' +
                                                        '<input type="hidden" name="_method" value="POST">' +
                                                        '<input type="hidden" name="_token" value="1234:5ad02792a3285252e524ccadeeda3401">' +
                                                        '<button class="btn btn-danger btn-bitbucket" onclick="return confirm(\'Удалить?\')" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>' +
                                                    '</form>';*!/
                                ;
                            } else {
                                delete_btn = '';
                            }

                            // Формируем таблицу
                            table_row +=
                                '<tr data-num='+ (i+1) +' class="num">' +
                                '<td>' + (i+1) + '</td>' +
                                '<td><a href="/contractors/details/' + id + '">'+ name +'</a></td>' +
                                '<td>'+ phone +'</td>' +
                                '<td>'+ region +'</td>' +
                                '<td>'+ manager +'</td>' +
                                '<td>'+ email +'</td>' +
                                '<td class="text-center">'+
                                '<a href="contractors/edit/'+id+'" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right"  title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a> '
                                + delete_btn +
                                '</td>' +
                                '</tr>';
                        }
                        $('#currentPage').html(table_row);
*/
                    },
                    error: function (err) {
                        console.log(err);
                    }
                }); // end $.ajax()

                $('#pagination, #pagination2').bootpag({
                    'maxVisible': 5,
                    'total': data.allPage,
                    'page': data.currentPage
                });

                $('#pagination, #pagination2').show();

            }
        }); // end $.ajax()*/
	}
}

$(document).ready(function() {
	$('#pagination, #pagination2').bootpag({
		'maxVisible': 5
	}).on('page', function(event, num){
		if ($.isNumeric(num)) getPage(num);
	});

	/*if (localStorage.getItem('orgSearch')) {
		$('input[name="filter[search]"]').val(localStorage.getItem('orgSearch'));
	}
	if (localStorage.getItem('orgDirections')) {
		$('select[name="filter[directions]"] option[value="' + localStorage.getItem('orgDirections') + '"]').attr('selected', 'true');
		$('select[name="filter[directions]"]').val(localStorage.getItem('orgDirections'));
	}
	if (localStorage.getItem('orgStatus')) {
		$('select[name="filter[status]"] option[value="' + localStorage.getItem('orgStatus') + '"]').attr('selected', 'true');
		$('select[name="filter[status]"]').val(localStorage.getItem('orgStatus'));
	}
    if (localStorage.getItem('orgWhat_works')) {
        $('select[name="filter[what_works]"] option[value="' + localStorage.getItem('orgWhat_works') + '"]').attr('selected', 'true');
        $('select[name="filter[what_works]"]').val(localStorage.getItem('orgWhat_works'));
    }
	if (localStorage.getItem('orgManager')) {
		$('select[name="filter[client_manager]"] option[value="' + localStorage.getItem('orgManager') + '"]').attr('selected', 'true');
		$('select[name="filter[client_manager]"]').val(localStorage.getItem('orgManager'));
	}*/

	// Перерисовка списков
	//$('.select2').select2('destroy');

	$('.select2').select2();
    //getPage(localStorage.getItem('orgPage'));
	if (localStorage.getItem('orgPage') > 0) {
		getPage(localStorage.getItem('orgPage'));
	} else {
		getPage(1);
	}
	//$('select[name="filter[limit]"] option[value="'+CountOnPage+'"]').attr('selected', 'true');

	$('input[name="filter[search]"]').keyup(function(){
		getPage(1);
	});
	$('#filters').on('change', 'select', function(){
		getPage(1);
	});
});
