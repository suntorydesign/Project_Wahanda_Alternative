<div id="home-holder" class="content-holder pending">
	<div class="sidebar">
		<div class="venue-info">
			<h3>Quản lý câu hỏi</h3>
			<button onclick="addQuestionDetail()" class="button button-primary redeem" type="button">
				<div class="button-inner">
					<div class="button-icon icons-plus"></div>
					Thêm câu hỏi tư vấn
				</div>
			</button>
		</div>
	</div>

	<div class="main-content table-responsive">
		<div class="col-md-12 form-horizontal">
			<div class="form-group">
				<b class="control-label col-md-4">Chọn bộ câu hỏi ứng với loại dịch vụ</b>
				<div class="col-md-3">
					<select class="form-control" id="question_service_type_id" name="">
						<option value="">Chọn loại dịch vụ...</option>
					</select>
				</div>
			</div>
			<hr />
		</div>
		
		<table id="question_list" class="table table-hover" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 10%"><b>ID</b></th>
					<th style="width: 60%"><b>Câu hỏi</b></th>
					<th style="width: 30%"><b>Loại dịch vụ</b></th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th style="width: 10%"><b>ID</b></th>
					<th style="width: 60%"><b>Câu hỏi</b></th>
					<th style="width: 30%"><b>Loại dịch vụ</b></th>
				</tr>
			</tfoot>

			<tbody>

			</tbody>
		</table>
	</div>
</div>
<script>
	var IS_INDEX = 1;
	var IS_ADD = 0;
	var IS_EDIT = 0;
	var SERVICE_TYPE_ID = '';
	var oTable;
</script>