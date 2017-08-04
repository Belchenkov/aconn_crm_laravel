function finishTask(id) {
	swal({
        title: "Подтверждение выполнения задачи",
        text: "Вы точно выполнили задачу?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Да!",
        closeOnConfirm: false
    }, function () {
		$.ajax({
			type: 'POST',
			url: '/tasks/finish',
			data: 'id='+id,
			success: function(){
				if ($('#task'+id).is('tr')) {
					$('#task'+id).removeClass().addClass('success');
					if (typeof getPage == 'function')
						getPage($('#pagination ul li.active').attr('data-lp'));
				} else {
					location.reload();
				}
			}
		});
        swal("Выполнено!", "Задача успешно помечена, как выполненная", "success");
    });
}

function setAside(id) {
	swal({
        title: "Подтверждение продления задачи",
        text: "Вы точно хотите продлить задачу?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Да!",
        closeOnConfirm: false
    }, function () {
		$.ajax({
			type: 'POST',
			url: '/tasks/setAside',
			data: 'id='+id,
			success: function(){
				if ($('#task'+id)) {
					getPage($('#pagination ul li.active').attr('data-lp'));
				}
			}
		});
        swal("Выполнено!", "Задача успешно продлена на 1 день", "success");
    });
}