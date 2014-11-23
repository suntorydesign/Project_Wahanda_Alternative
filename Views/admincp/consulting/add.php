<div id="home-holder" class="content-holder pending">
	<div class="sidebar">
		<div class="venue-info">
			<h3 class="title-admincp">Quản lý luật tư vấn</h3>
			<button onclick="returnToConsulting()" id="" class="button button-primary redeem" type="button">
				<div class="button-inner">
					<div class="button-icon icons-arrow-left2"></div>
					Trờ về trang luật tư vấn
				</div>
			</button>
		</div>
	</div>
	<div class="main-content">
		<h3 class="add-place">Thêm một luật</h3>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-4">Chọn loại dịch vụ</label>
							<div class="col-md-8">
								<select class="form-control" id="rule_service_type" name="">
									<option value="">Chọn loại dịch vụ...</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div id="question_list" class="well" style="max-height: 340px; overflow-y: scroll;">
							<div class="question-field">
								<p class="question">
									1) ...
								</p>
								<p fact-id="" question-id="" class="answer pointer">
									<b>...</b>
								</p>
								<p fact-id="" question-id="" class="answer pointer">
									<b>...</b>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3">Luật (*)</label>
							<div class="col-md-8">
								<input placeholder="Chọn giả thuyết ở form câu hỏi..." class="form-control" id="rule_group" name="" type="text" readonly="readonly" />
							</div>
							<div class="col-md-1">
								<button class="btn btn-default" id="refresh_rule"><i class="fa fa-refresh"></i></button>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Dịch vụ (*)</label>
							<div class="col-md-9">
								<select class="form-control" id="rule_service" name="">
									<option value="">Chọn dịch vụ để gợi ý sau khi tư vấn...</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Kết luận (*)</label>
							<div class="col-md-9">
								<input placeholder="Kết luận từ luật tư vấn..." class="form-control" id="rule_result" name="" type="text"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-12">
				<button onclick="saveRule()" type="button" class="button action action-default button-primary save-action">
					<div class="button-inner">
						<div class="button-icon icons-tick done"></div>
						<div class="button-icon fa fa-spin fa-refresh s-loading"></div>
						<span class="msg msg-action-default">Thêm</span>
					</div>
				</button>
				<small id="error_add_consult" style="color: red; display: none;">Nhập đầy đủ các trường có (*)</small>
			</div>
		</div>
	</div>
</div>
<script>
	var IS_INDEX = 0;
	var IS_ADD = 1;
	var IS_EDIT = 0;
</script>