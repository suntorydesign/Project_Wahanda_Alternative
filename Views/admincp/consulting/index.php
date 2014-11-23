<div id="home-holder" class="content-holder pending">
	<div class="sidebar">
		<div class="venue-info">
			<h3>Quản lý luật tư vấn</h3>
			<button onclick="addRuleDetail()" class="button button-primary redeem" type="button">
				<div class="button-inner">
					<div class="button-icon icons-plus"></div>
					Thêm luật tư vấn
				</div>
			</button>
		</div>
	</div>

	<div class="main-content table-responsive">
		<div class="col-md-12 form-horizontal">
			<div class="form-group">
				<b class="control-label col-md-4">Chọn tập luật ứng với loại dịch vụ</b>
				<div class="col-md-3">
					<select class="form-control" id="rule_service_type" name="">
						<option value="">Chọn loại dịch vụ...</option>
					</select>
				</div>
			</div>
			<hr />
		</div>
		
		<table id="rule_list" class="table table-hover" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th style="width: 5%"><b>ID</b></th>
					<th style="width: 15%"><b>Tập Luật</b></th>
					<th style="width: 50%"><b>Kết Luận</b></th>
					<th style="width: 20%"><b>Dịch Vụ Gợi Ý Sau Tư Vấn</b></th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th style="width: 5%"><b>ID</b></th>
					<th style="width: 15%"><b>Tập Luật</b></th>
					<th style="width: 50%"><b>Kết Luận</b></th>
					<th style="width: 20%"><b>Dịch Vụ Gợi Ý Sau Tư Vấn</b></th>
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
	var RULE_SERVICE_TYPE_ID = '';
	var oTable;
</script>