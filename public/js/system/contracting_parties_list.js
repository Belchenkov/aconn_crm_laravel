function getPage(page) {
	$('#pagination, #pagination2').hide();
	$('#currentPage').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	/* Сохраняем значения фильтров и номер страницы*/
	localStorage.setItem('orgSearch', $('input[name="filter[search]"]').val());
	localStorage.setItem('orgPage', page);
	localStorage.setItem('orgDirections', $('select[name="filter[directions]"]').val());
	localStorage.setItem('orgManager', $('select[name="filter[client_manager]"]').val());
	localStorage.setItem('orgStatus', $('select[name="filter[status]"]').val());
	$.ajax({
		type: 'POST',
		url: '/contracting_parties/printPage',
		data: 'search='+$('input[name="filter[search]"]').val()+'&page='+page+'&directions='+$('select[name="filter[directions]"]').val()+'&client_manager='+$('select[name="filter[client_manager]"]').val()+'&status='+$('select[name="filter[status]"]').val(),
		success: function(data){
			//console.log(data);
			data = JSON.parse(data);
			$('#pagination, #pagination2').bootpag({
				'maxVisible': 25,
				'total': data.allPage,
				'page': data.currentPage,
			});
			$('#currentPage').html(data.html);
			$('#pagination, #pagination2').show();
		}
	});
}

$(document).ready(function() {
	$('#pagination, #pagination2').bootpag({
		'maxVisible': 10
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
