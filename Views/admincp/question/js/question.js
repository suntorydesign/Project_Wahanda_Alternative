$(document).ready(function() {
	if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
		oTable = $('#question_list').dataTable({
			"oLanguage" : {
				"sZeroRecords" : "Không có dữ liệu nào cả.",
				"sSearch" : "Tìm kiếm: ",
				"sLengthMenu" : "Hiển thị &nbsp;&nbsp; _MENU_ &nbsp;&nbsp; dòng.",
				"sInfo" : "Hiển thị _START_ đến _END_ của _TOTAL_ dòng.",
				"sInfoEmpty" : "Hiển thị 0 đến 0 của 0 dòng."
			}
		});
		loadServiceTypeList();
	}
	if (IS_INDEX == 0 && IS_ADD == 1 && IS_EDIT == 0) {
		loadServiceTypeList();
	}
	if (IS_INDEX == 0 && IS_ADD == 0 && IS_EDIT == 1) {
		loadServiceTypeList();
	}
});

function loadServiceTypeList() {
	$.ajax({
		url : URL + 'admincp_question/loadServiceTypeList',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(key, value) {
					html += '<option value="' + value.service_type_id + '">' + value.service_type_name + '</option>';
				});
				$('#question_service_type_id').append(html);
			}
		},
		complete : function() {
			if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
				$('#question_service_type_id').on('change', function() {
					SERVICE_TYPE_ID = $(this).val();
					loadQuestionList();
				});
			}
			if (IS_INDEX == 0 && IS_ADD == 0 && IS_EDIT == 1) {
				loadQuestionDetail();
			}
		}
	});
}

function loadQuestionList() {
	$.ajax({
		url : URL + 'admincp_question/loadQuestionList',
		type : 'post',
		dataType : 'json',
		data : {
			service_type_id : SERVICE_TYPE_ID,
		},
		success : function(response) {
			if (response[0] != null) {
				oTable.fnClearTable();
				oTable.fnAddData(response);
			} else {
				oTable.fnClearTable();
				oTable.fnAddData(response);
			}
		},
		complete : function() {
			$("#question_list").delegate("tbody tr", "click", function() {
				var question_id = $(this).find('td').eq(0).text();
				// console.log(user_id);
				jumpToOtherPage(URL + 'admincp_question/editQuestionDetail/' + question_id);
			});
		}
	});
}

function addQuestionDetail() {
	jumpToOtherPage(URL + 'admincp_question/addQuestionDetail');
}

function returnToQuestion() {
	jumpToOtherPage(URL + 'admincp_question');
}

function addMoreAnswer() {
	var html = '<div class="form-group">';
	html += '<label class="control-label col-md-4">Câu trả lời</label>';
	html += '<div class="col-md-8">';
	html += '<input placeholder="Nhập câu trả lời..." class="form-control question_answer insert"  name="" type="text"/>';
	html += '</div>';
	html += '</div>';
	$('#answer_field').append(html);
}

function addQuestion() {
	$('div.done').fadeOut(function() {
		$('div.s-loading').fadeIn(function() {
			var count_answer = 0;
			var question_answer = '';
			$('.question_answer').each(function() {
				if ($(this).val() != '') {
					if (question_answer == '') {
						question_answer = $(this).val();
					} else {
						question_answer += ',' + $(this).val();
					}
					count_answer++;
				}
			});
			var question_service_type_id = $('#question_service_type_id').val();
			var question_content = $('#question_content').val();
			if (question_service_type_id == '' || question_content == '') {
				$('#error_add_question').text('Nhập đầy đủ các trường có (*).');
				$('#error_add_question').fadeIn(function() {
					$('div.s-loading').fadeOut(function() {
						$('div.done').fadeIn();
					});
				});
			} else {
				if (count_answer < 2) {
					$('#error_add_question').text('Phải có ít nhất 2 câu trả lời.');
					$('#error_add_question').fadeIn(function() {
						$('div.s-loading').fadeOut(function() {
							$('div.done').fadeIn();
						});
					});
				} else {
					$('#error_add_question').fadeOut(function() {
						$('div.s-loading').fadeOut(function() {
							$('div.done').fadeIn(function() {
								$.ajax({
									url : URL + 'admincp_question/addQuestion',
									type : 'post',
									// dataType : 'json',
									data : {
										question_answer : question_answer,
										question_service_type_id : question_service_type_id,
										question_content : question_content
									},
									success : function(response) {
										if (response == 200) {
											alert('Thêm thành công !');
											jumpToOtherPage(URL + 'admincp_question');
										} else {
											alert('Thêm thất bại !');
										}
									},
									complete : function() {

									}
								});
							});
						});
					});
				}
			}
		});
	});

}

function loadQuestionDetail() {
	$.ajax({
		url : URL + 'admincp_question/loadQuestionDetail',
		type : 'post',
		dataType : 'json',
		data : {
			question_id : QUESTION_ID,
		},
		success : function(response) {
			if (response[0] != null) {
				$.each(response[0], function(key, value) {
					$('#' + key).val(value);
					if (key == 'question_answers') {
						var html = '';
						$.each(value, function(i, item) {
							html += '<div class="form-group">';
							html += '<label class="control-label col-md-4">Câu trả lời</label>';
							html += '<div class="col-md-8">';
							html += '<input value="' + item.fact_answer + '" placeholder="Nhập câu trả lời..." class="form-control fact_answer update" name="" type="text"/>';
							html += '<input value="' + item.fact_id + '" type="hidden" class="fact_id" value="" />';
							html += '</div>';
							html += '</div>';
						});
						$('#answer_field').append(html);
					}
				});
			} else {
				$('#main_detail').html('<div class="alert alert-warning"><h3><b>Cảnh báo!</b></h3><span>Câu hỏi không tồn tại</span></div>');
			}
		},
		complete : function() {

		}
	});
}

function editQuestion() {
	cfirm = confirm('Bạn có muốn sửa không?');
	if (cfirm == true) {
		$('#btn_edit_question').attr('disabled', true);
		$('#btn_delete_question').attr('disabled', true);
		$('#error_edit_question').fadeOut();
		$('div.done').fadeOut(function() {
			$('#edit_loading').fadeIn(function() {
				var question_service_type_id = $('#question_service_type_id').val();
				var question_content = $('#question_content').val();
				var count_answer = 0;
				$('.fact_answer').each(function() {
					if ($(this).val() != '') {
						count_answer++;
					}
				});
				if (question_service_type_id == '' || question_content == '') {
					$('#error_edit_question').text('Nhập đầy đủ các trường có (*)');
					$('#error_edit_question').fadeIn(function() {
						$('#edit_loading').fadeOut(function() {
							$('div.done').fadeIn();
							$('#btn_edit_question').attr('disabled', false);
							$('#btn_delete_question').attr('disabled', false);
						});
					});
				} else {
					if (count_answer >= 2) {
						var fact_id = '';
						var update_fact_answer = '';
						var insert_fact_answer = '';
						$('.fact_id').each(function() {
							if (fact_id == '') {
								fact_id = $(this).val();
							} else {
								fact_id += ',' + $(this).val();
							}
						});
						$('.fact_answer.update').each(function(){
							if (update_fact_answer == '') {
								update_fact_answer = $(this).val();
							} else {
								update_fact_answer += ',' + $(this).val();
							}
						});
						$('.question_answer.insert').each(function(){
							if (insert_fact_answer == '') {
								insert_fact_answer = $(this).val();
							} else {
								insert_fact_answer += ',' + $(this).val();
							}
						});
						$.ajax({
							url : URL + 'admincp_question/editQuestion',
							type : 'post',
							data : {
								question_id : QUESTION_ID,
								question_service_type_id : question_service_type_id,
								question_content : question_content,
								fact_id : fact_id,
								update_fact_answer : update_fact_answer,
								insert_fact_answer : insert_fact_answer
								
							},
							success : function(response) {
								if (response == 200) {
									alert('Sửa thành công !');
									$('div#edit_loading').fadeOut(function() {
										$('div.done').fadeIn(function() {
											jumpToOtherPage(URL + 'admincp_question');
										});
									});
								} else {
									alert('Sửa thất bại !');
									$('div#edit_loading').fadeOut(function() {
										$('div.done').fadeIn(function() {
											$('#btn_edit_question').attr('disabled', false);
											$('#btn_delete_question').attr('disabled', false);
										});
									});
								}
							},
							complete : function() {
								$('#btn_edit_question').attr('disabled', false);
								$('#btn_delete_question').attr('disabled', false);
							}
						});
					} else {
						$('#error_edit_question').text('Phải có ít nhất 2 câu trả lời.');
						$('#error_edit_question').fadeIn(function() {
							$('div.s-loading').fadeOut(function() {
								$('div.done').fadeIn();
								$('#btn_edit_question').attr('disabled', false);
								$('#btn_delete_question').attr('disabled', false);
							});
						});
					}
				}
			});
		});
	}
}

function deleteQuestion() {
	cfirm = confirm('Bạn có muốn xóa không?');
	if (cfirm == true) {
		$('#btn_edit_question').attr('disabled', true);
		$('#btn_delete_question').attr('disabled', true);
		$('#error_edit_question').fadeOut();
		$('div.remove').fadeOut(function() {
			$('#remove_loading').fadeIn(function() {
				$.ajax({
					url : URL + 'admincp_question/deleteQuestion',
					type : 'post',
					data : {
						question_id : QUESTION_ID,
					},
					success : function(response) {
						if (response == 200) {
							alert('Xóa thành công !');
							$('div#remove_loading').fadeOut(function() {
								$('div.remove').fadeIn(function() {
									jumpToOtherPage(URL + 'admincp_question');
								});
							});
						} else {
							alert('Xóa thất bại !');
							$('div#remove_loading').fadeOut(function() {
								$('div.remove').fadeIn(function() {
									$('#btn_edit_question').attr('disabled', false);
									$('#btn_delete_question').attr('disabled', false);
								});
							});
						}
					},
					complete : function() {
						$('#btn_edit_question').attr('disabled', false);
						$('#btn_delete_question').attr('disabled', false);
					}
				});

			});
		});
	}
}
