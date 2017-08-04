var pie;
function loadPage() {
	$('#alert').html('');
	//$('#pie').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	$('#listStatistics').html('<div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div>');
	$.ajax({
		type: 'POST',
		url: '/statistics/printStatistic',
		data: 'date='+$('input[name="date"]').val()+'&user='+$('select[name="user"]').val()+'&direction='+$('select[name="direction"]').val()+'&category='+$('select[name="category"]').val(),
		success: function(data){
			data = JSON.parse(data);
			if (data.alert) {
				$('#alert').html('<div class="alert alert-danger">'+data.alert+'</div>');
			} else {
				$('#allContractingParties').html(data.allLines);
				$('#listStatistics').html(data.listStatistics);
				$('select[name="user"]').html(data.filter.user);
				$('select[name="category"]').html(data.filter.category);
				$('select[name="direction"]').html(data.filter.direction);
				pie.load({
					columns: [
						["Был холодный звонок", data.graphStatistics[4]],
						["Рассылка", data.graphStatistics[5]],
						["Получил КП", data.graphStatistics[6]],
						["Переговоры", data.graphStatistics[7]],
						["Встреча с ЛПР", data.graphStatistics[8]],
						["Зарегистрировался", data.graphStatistics[9]],
						["Клиент А-Коннект", data.graphStatistics[10]],
					]
				});
			}
		}
	});
}

$(document).ready(function() {
	pie = c3.generate({
		bindto: '#pie',
		data:{
			columns: [
				["Был холодный звонок", 0],
				["Рассылка", 0],
				["Получил КП", 0],
				["Переговоры", 0],
				["Встреча с ЛПР", 0],
				["Зарегистрировался", 0],
				["Оплатил", 0],
			],
			colors:{
				'Был холодный звонок': "#1885ac",
				'Рассылка': "#884169",
				'Получил КП': "#019973",
				'Переговоры': "#fbb724",
				'Встреча с ЛПР': "#ed5565",
				'Зарегистрировался': "#be92e8",
				'Оплатил': "#7ac465"
			},
			type : 'pie'
		}
	});
	loadPage();
	$('select').change(function() {
		loadPage();
	});
	$('input[name="date"]').change(function() {
		loadPage();
	});

});
