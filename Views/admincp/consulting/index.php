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
		<table id="rule_list" class="table table-hover" width="100%" cellspacing="0">
	        <thead>
	            <tr>
	                <th><b>ID</b></th>
	                <th><b>Tập Luật</b></th>
	                <th><b>Kết Luận</b></th>
	                <th><b>Dịch Vụ Gợi Ý Sau Tư Vấn</b></th>
	            </tr>
	        </thead>
	 
	        <tfoot>
	            <tr>
	                <th><b>ID</b></th>
	                <th><b>Tập Luật</b></th>
	                <th><b>Kết Luận</b></th>
	                <th><b>Dịch Vụ Gợi Ý Sau Tư Vấn</b></th>
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
</script>