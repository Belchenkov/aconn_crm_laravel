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

    $.ajax({
		type: 'GET',
		url: '/contractors/post',
		data: 'search='+$('input[name="filter[search]"]').val()+'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()+'&client_manager='+$('select[name="filter[client_manager]"]').val()+'&status='+$('select[name="filter[status]"]').val()+'&what_works='+$('select[name="filter[what_works]"]').val(),
        success: function(data){
            data = JSON.parse(data);
			//console.log(data);
            var table_row = '';
            for (var i = 0; i < data.length; i++) {
            	var id = data[i]['id'];
                //console.log(id);
            	var name = data[i]['name'];
            	var phone =  data[i]['phone'];
            	var region_id = data[i]['region_id'];
            	var user_id = data[i]['user_id'];

                table_row += '<tr>' +
                    '<td>' + (i+1) + '</td>' +
                    '<td><a href="/contractors/details/' + id + '">'+ name +'</a></td>' +
                    '<td>'+ phone +'</td>' +
                    '<td>'+ region_id +'</td>' +
                    '<td>'+ user_id +'</td>' +
                    '<td>'+ data[i]['assign_manager'] +'</td>' +
                    '<td>'+ data[i]['what_work_id'] +'</td>' +
                    '<td>'+ data[i]['periodicity_id'] +'</td>' +
                    '<td>'+ data[i]['packing_id'] +'</td>' +
                    '<td>'+
                    	'<a href="contractors/edit/'+id+'" class="btn btn-outline btn-warning btn-bitbucket" data-toggle="tooltip" data-placement="right" title="Редактировать" data-original-title="Редактировать"><i class="fa fa-edit"></i></a>' +
                    	'<form action="contractors/delete/'+id+'" method="post" style="display: inline;">' +
			            	'<button class="btn btn-danger btn-bitbucket" onclick="return confirm("Удалить?")" data-toggle="tooltip" data-placement="right" title="Удалить организацию" data-original-title="Удалить организацию"><i class="fa fa-trash"></i></button>' +
                    	'</form>' +
					'</td>' +
                    '</tr>';

                /*$.ajax({
                    type: 'GET',
                    url: '/contractors/getParam',
                    data: 'region_id='+region_id+'&user_id='+user_id,
					success: function (data) {
                        data = JSON.parse(data);
                        //console.log(data);

                        region_id = data[0].name;


                    },
					error: function (err) {
						console.log(err);
                    }
				});*/

            }

            $('#pagination, #pagination2').bootpag({
				'maxVisible': 5,
				'total': data.allPage,
				'page': data.currentPage
			});
			// $('#currentPage').html(table_row);
			$('#pagination, #pagination2').show();
		}
	});
}

$(document).ready(function() {
	$('#pagination, #pagination2').bootpag({
		'maxVisible': 5
	}).on('page', function(event, num){
		if ($.isNumeric(num)) getPage(num);
	});
	if (localStorage.getItem('orgSearch')) {
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
	}
	// Перерисовка списков
	$('.select2').select2('destroy');
	$('.select2').select2();
    getPage(localStorage.getItem('orgPage'));
	if (localStorage.getItem('orgPage') > 0) {
		getPage(localStorage.getItem('orgPage'));
	} else {
		getPage(1);
	}
	//$('select[name="filter[limit]"] option[value="'+CountOnPage+'"]').attr('selected', 'true');

    getPage(1);

	$('input[name="filter[search]"]').keyup(function(){
		getPage(1);
	});
	$('#filters').on('change', 'select', function(){
		getPage(1);
	});
});
