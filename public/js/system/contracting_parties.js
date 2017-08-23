var checkRepeat = false;
var count = 1;

function add_contact_person() {
	$('#listContacts').append('<div class="ibox float-e-margins">' +
		'<div class="ibox-title">' +
			'<h5>Контакт №'+count+'</h5>' +
			'<div class="ibox-tools">' +
				'<a class="close-link close-window-contact">' +
					'<i class="fa fa-times"></i>' +
				'</a>' +
			'</div>' +
		'</div>' +
		'<div class="ibox-content">' +
			'<div class="box-body row">' +
				'<div class="form-group col-md-12">' +
					'<label>ФИО</label>' +
					'<input type="text" class="form-control" name="contact['+count+'][fio]" placeholder="ФИО">' +
				'</div>' +
				'<div class="form-group col-md-7">' +
					'<label>Должность</label>' +
					'<input type="text" class="form-control" name="contact['+count+'][dolgnost]" placeholder="Должность">' +
				'</div>' +
				'<div class="form-group col-md-5">' +
					'<label>ЛПР</label>' +
					'<div class="col-md-12">' +
						'<div class="checkbox-inline i-checks"><label> <input type="radio" value="1" name="contact['+count+'][lpr]"> <i></i> Да </label></div>' +
						'<div class="checkbox-inline i-checks"><label> <input type="radio" checked="true" value="0" name="contact['+count+'][lpr]"> <i></i> Нет </label></div>' +
					'</div>' +
				'</div>' +
				'<div class="form-group col-md-7">' +
					'<label>Телефон</label>' +
					'<input type="text" class="form-control" name="contact['+count+'][phones][]" data-mask="+7 (999) 999-9999">' +
					'<div class="phones"></div>' +
					'<a href="#" onclick="addPhoneContact(this, '+count+'); return false;" class="btn btn-outline btn-xs btn-success" style="margin-top: 10px;"><i class="fa fa-plus"></i> Добавить телефон</a>' +
				'</div>' +
				'<div class="form-group col-md-5">' +
					'<label>Email</label>' +
					'<input type="text" class="form-control" name="contact['+count+'][email]" placeholder="Email">' +
				'</div>' +
				'<div class="form-group col-md-12">' +
					'<label>Комментарий</label>' +
					'<textarea name="contact['+count+'][comment]" class="form-control"></textarea>' +
				'</div>' +
			'</div>' +
		'</div>' +
	'</div>');
	count++;
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}

function add_phone() {
	$('#listPhones').append('<div class="input-group">' +
		'<input type="text" class="form-control" name="phone[]" data-mask="+7 (999) 999-9999">' +
		'<div class="input-group-addon"><a href="#" onclick="$(this).parent(\'.input-group-addon\').parent(\'.input-group\').remove(); return false;"><i class="fa fa-trash"></i></a></div>' +
	'</div>');
}

function addPhoneContact(element, id) {
	$(element).siblings('.phones').append('<div class="input-group">' +
		'<input type="text" class="form-control" name="contact['+id+'][phones][]" data-mask="+7 (999) 999-9999">' +
		'<div class="input-group-addon"><a href="#" onclick="$(this).parent(\'.input-group-addon\').parent(\'.input-group\').remove(); return false;"><i class="fa fa-trash"></i></a></div>' +
	'</div>');
}

function add_office() {
	$('#offices').append('<div class="input-group">' +
		'<input type="text" class="form-control" name="office[]">' +
		'<div class="input-group-addon"><a href="#" onclick="$(this).parent(\'.input-group-addon\').parent(\'.input-group\').remove(); return false;"><i class="fa fa-trash"></i></a></div>' +
	'</div>');
}

// WebSockets
/*
var conn = new WebSocket("ws://laravel.app:8000");
conn.onopen = function (e) {
	console.log("Соединение открылось");
	send();
};

conn.onmessage = function (e) {
	console.log ("Пришло сообщение с содержанием: " + e.data);
};

function send() {
	var data = Math.random();
	conn.send(data);
	console.log ("Отправлено: " + data);
}
*/

$(".select2_cities").select2();

$(document).ready(function() {

	// Активируем и гасим поле номер договора
    if ($('.contract_number_yes:checked').val() == 1) {
        $('.contract_number').prop('disabled',false);
    }

    $('.contract_number_no').on('click', function () {
        $('.contract_number').prop('disabled', true);
        $('.contract_number').val('');
    });

    $('.contract_number_yes').on('click', function () {
        $('.contract_number').prop('disabled', false);
    });

    // Модуль копирование текста
		var button = document.querySelectorAll('.copyButton');
		for (var i = 0; i < button.length; i++) {
			button[i].addEventListener('click', function (el) {
				var elem = el.target;
				var ta = elem.nextElementSibling;

				//производим его выделение
                var range = document.createRange();
                range.selectNode(ta);

                try {
                    // современный объект Selection
                    window.getSelection().removeAllRanges();
                } catch (e) {
                    // для IE8-
                    document.selection.empty();
                }

                window.getSelection().addRange(range);

                //пытаемся скопировать текст в буфер обмена
                try {
                    document.execCommand('copy');
                } catch(err) {
                    console.log('Can`t copy, boss');
                }
                //очистим выделение текста, чтобы пользователь "не парился"
                window.getSelection().removeAllRanges();
            });
		}

	$("#newForm").submit(function (e) {
	    e.preventDefault();
		if (!checkRepeat) {
			$.ajax({
				type: "GET",
				url: "checkRepeat",
                data: $("#newForm").serialize(),
				success: function(data){
					console.log(data);
					if ( data.length != '1' )  {
                        $('#resultRepeat').html("<div class='col-md-12'><div class='panel panel-success'>" +
                            "<div class='panel-heading'><h5>Проверка организации на дубли</h5></div>" +
                            "<div class='panel-body'>" +
                            "Найдены организации с похожими данными. Невозможно добавить организацию!</div></div></div>");
					}
                    else {
                        $('#resultRepeat').html("<div class='col-md-12'><div class='panel panel-success'>" +
                            "<div class='panel-heading'><h5>Проверка организации на дубли</h5></div>" +
                            "<div class='panel-body'>" +
                            "Организации с похожими данными не найдены. Можно добавлять организацию!</div></div></div>");
                        $.ajax({
                            type: "POST",
                            url: "store",
                            dataType: 'json',
                            data: $("#newForm").serialize(),
                            success: function (data) {
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                        window.location.href = '/contractors';
                    }
                }
			});
		}
		/*if (checkRepeat) {

			return true;
		} else {
			checkRepeat = true;
			return false;
		}*/
	});

	$(".sale").TouchSpin({
		min: 0,
		max: 60,
		step: 1,
		decimals: 0,
		boostat: 5,
		maxboostedstep: 10,
		buttondown_class: 'btn btn-white',
		buttonup_class: 'btn btn-white'
	});

	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
	$('#status').on('change', 'select[name="status"]', function(){
		$(this).nextAll('select[name="status"]').remove();
		var selectelement = this;
		$.ajax({
			type: "POST",
			url: "/getter/contracting_parties_status",
			data: "id="+$(this).val(),
			success: function(selects){
				$(selectelement).after(selects);
			}
		});
	});
	//$('div#status select').first().hide();
	//$('#status select').change();

	$('#listContacts').on('click', '.close-window-contact', function(){
		if (typeof swal == 'function') {
			var ibox = this;
			swal({
				title: "Точно удалить?",
				text: "Вы собираетесь удалить контакт, вы точно согласны с этим?!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Да, удалить!",
				closeOnConfirm: false
			}, function () {
				if ($(ibox).attr('contactid') && $(ibox).attr('contractid')) {
					$.ajax({
						type: "POST",
						url: "/contracting_parties/delete_contact",
						data: "contactid="+$(ibox).attr('contactid')+"&contractid="+$(ibox).attr('contractid'),
						success: function(selects){
							$(selectelement).after(selects);
						}
					});
				}
				var content = $(ibox).closest('div.ibox');
				content.remove();

				swal("Контакт удален!", "Удаление контакта прошло успешно.", "success");
			});
		} else {
			var content = $(this).closest('div.ibox');
			content.remove();
		}
		return false;
	});
});
