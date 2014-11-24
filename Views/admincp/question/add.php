<div id="home-holder" class="content-holder pending">
	<div class="sidebar">
		<div class="venue-info">
			<h3 class="title-admincp">Quản lý câu hỏi</h3>
			<button onclick="returnToQuestion()" id="" class="button button-primary redeem" type="button">
				<div class="button-inner">
					<div class="button-icon icons-arrow-left2"></div>
					Trờ về trang câu hỏi
				</div>
			</button>
		</div>
	</div>
	<div class="main-content">
		<h3 class="add-place">Thêm một câu hỏi</h3>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-4">Chọn loại dịch vụ (*)</label>
							<div class="col-md-8">
								<select class="form-control" id="question_service_type_id" name="">
									<option value="">Chọn loại dịch vụ (*)...</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Câu hỏi (*)</label>
							<div class="col-md-8">
								<input placeholder="Nhập câu hỏi (*)..." class="form-control" id="question_content" name="" type="text" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 form-horizontal" id="answer_field">
						<div class="form-group">
							<label class="control-label col-md-4">Câu trả lời</label>
							<div class="col-md-8">
								<input placeholder="Nhập câu trả lời..." class="form-control question_answer" name="" type="text"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4">Câu trả lời</label>
							<div class="col-md-8">
								<input placeholder="Nhập câu trả lời..." class="form-control question_answer"  name="" type="text"/>
							</div>
						</div>			
					</div>
					<div class="col-md-12 form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-4"></label>
							<div class="col-md-8">
								<button onclick="addMoreAnswer()" id="add_more_answer" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm câu trả lời</button>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-12">
				<button onclick="addQuestion()" type="button" class="button action action-default button-primary save-action">
					<div class="button-inner">
						<div class="button-icon icons-tick done"></div>
						<div class="button-icon fa fa-spin fa-refresh s-loading"></div>
						<span class="msg msg-action-default">Thêm</span>
					</div>
				</button>
				<small id="error_add_question" style="color: red; display: none;">Nhập đầy đủ các trường có (*).</small>
			</div>
		</div>
	</div>
</div>
<script>
	var IS_INDEX = 0;
	var IS_ADD = 1;
	var IS_EDIT = 0;
	var RULE_SERVICE_TYPE_ID = '';
	var FACT = '';
	var FACT_ID = '';
	var QUESTION_ID = ''; 
</script>