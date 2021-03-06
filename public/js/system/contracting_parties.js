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

$(".select2_cities").select2();

$(document).ready(function() {

	// Select2 Responsive
    $(window).resize(function() {
        $('.select2').css('width', "100%");
    });

	// Multiselect Active
    $('.chosen-select').chosen({width: "100%"});

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
				//console.log(el.target);
				var elem = el.target;

                try {
                    // современный объект Selection
                    window.getSelection().removeAllRanges();

                } catch (e) {
                    // для IE8-
                    document.selection.empty();
                }

				// Выделение при клике
                function selection(elem) {
                    var select = window.getSelection();
                    var range = document.createRange();
                    range.selectNodeContents(elem);
                    select.addRange(range);
                }

                selection(elem);

                //пытаемся скопировать текст в буфер обмена
                try {
                    document.execCommand('copy');
                } catch(err) {
                    console.log('Can`t copy, boss');
                }
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
					data = JSON.parse(data);

					//console.log(data.checkFields[0]);
                    //console.log(data.managers);
                    //console.log(data.regions);


                    var managers = data.managers;
                    var regions = data.regions;

                    var region = '';

                    if (regions) {
                        for (var r = 0; r < regions.length; r++) {
                            if (regions[r]['id'] == data.checkFields[0]['region_id']) {
                                region = regions[r]['name'];
                                break;
                            }
                        }
					}

                   if (managers) {
                       var manager = '';
                       for (var m = 0; m < managers.length; m++) {
                           if (managers[m]['id'] == data.checkFields[0]['user_id']) {
                               manager = managers[m]['fio'];
                               break;
                           }
                       }
				   }

					if ( data != '0')  {
                    	//console.log(data);
                        $('#resultRepeat').html("<div class='col-md-12'><div class='panel panel-success'>" +
                            "<div class='panel-heading'><h5>Проверка организации на дубли</h5></div>" +
                            "<div class='panel-body'>" +
                            	"Найдены организации с похожими данными. Невозможно добавить организацию!</div></div>" +
								"<div class='ibox float-e-margins'>" +
	                            	"<div class='ibox-content'>" +
	                           			"<div class='table-responsive'>" +
											"<table class='display table table-striped table-bordered table-hover dataTables-example'>" +
												"<thead>" +
													"<tr>" +
														"<th>Наименование</th>" +
														"<th>Регион</th>" +
														"<th>Менеджер</th>" +
													"</tr>" +
												"</thead>" +
												"<tbody>" +
													"<td>" + data.checkFields[0]['name'] + "</td>" +
													"<td>" + region + "</td>" +
													"<td>" + manager + "</td>" +
												"</tbody>" +
											"</table>" +
										"</div>" +
									"</div>" +
								"</div>" +
							"</div>"
						);
					}
                    else {
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
