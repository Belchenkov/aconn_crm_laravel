function getPage(page) {
	$('#pagination, #pagination2').hide();
	$('#currentPage').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	/* Сохраняем значения фильтров и номер страницы*/
	localStorage.setItem('orgSearch', $('input[name="filter[search]"]').val());
	localStorage.setItem('orgPage', page);
	localStorage.setItem('orgDirections', $('select[name="filter[regions]"]').val());
	localStorage.setItem('orgManager', $('select[name="filter[client_manager]"]').val());
	localStorage.setItem('orgStatus', $('select[name="filter[status]"]').val());
    //console.log('search='+$('input[name="filter[search]"]').val()+'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()+'&client_manager='+$('select[name="filter[client_manager]"]').val()+'&status='+$('select[name="filter[status]"]').val());

   /* $.ajax({
		type: 'GET',
		url: '/contractors/post',
		data: 'search='+$('input[name="filter[search]"]').val()+'&page='+page+'&regions='+$('select[name="filter[regions]"]').val()+'&client_manager='+$('select[name="filter[client_manager]"]').val()+'&status='+$('select[name="filter[status]"]').val(),
        success: function(data){
            //data = JSON.parse(data);
            console.log(data);
            /!*var table_row = '';
            for (var i = 0; i < data.length; i++) {
                table_row += '<tr>' +
                                    '<td>' + (i+1) + '</td>' +
                                    '<td><a href="/contractors/details/' + data[i]['id'] + '">'+ data[i]['name'] +'</a></td>' +
                                    '<td>'+ data[i]['phone'] +'</td>' +
                            '</tr>';
                //console.log(data[i]);
            }*!/

            $('#pagination, #pagination2').bootpag({
				'maxVisible': 5,
				'total': data.allPage,
				'page': data.currentPage
			});
			$('#currentPage').html(/!*table_row*!/);
			$('#pagination, #pagination2').show();
		}
	});*/
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


	$('input[name="filter[search]"]').keyup(function(){
		getPage(1);
	});
	$('#filters').on('change', 'select', function(){
		getPage(1);
	});
});
