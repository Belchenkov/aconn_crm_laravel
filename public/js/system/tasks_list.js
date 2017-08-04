function getPage(page) {
	$('#pagination, #pagination2').hide();
	$('#currentPage').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	$.ajax({
		type: 'POST',
		url: '/tasks/printPage',
		data: 'page='+page+'&cid='+$('select[name="filter[cid]"]').val()+'&fromuid='+$('select[name="filter[fromuid]"]').val()+'&touid='+$('select[name="filter[touid]"]').val()+'&status='+$('select[name="filter[status]"]').val(),
		success: function(data){
			data = JSON.parse(data);
			$('#pagination, #pagination2').bootpag({
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
	getPage(1);
	$('#filters').on('change', 'select', function(){
		getPage(1);
	});
});
