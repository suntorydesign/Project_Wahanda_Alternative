<div id="header-2" class="clearfix">

</div>

<div id="content-wrap">
	<div class="container">

		<div class="col-md-8">
			<div id="result-total" class="clearfix">
				<div class="col-md-4">
					<div class="form-horizontal">
						<label class="control-label" style="color: #FFFFFF"><span id="count_result">0</span> Địa điểm được tìm thấy</label>
					</div>
				</div>

				<div class="col-md-8">
					<div class="form-horizontal">
						<label style="color: #A09E9E;" class="control-label col-md-4">Tìm theo</label>
						<div class="col-md-8">
							<select id="sort_by" class="form-control">
								<option value="1" selected="">Dịch vụ mới nhất</option>
								<option value="2">Được đánh giá nhiều nhất</option>
								<option value="3">Giá rẻ nhất</option>
								<option value="4">Giá mắc nhất</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div id="result_container">
				<div class="processing_loading">
				</div>
				<div id="waiting_for_result_list">
					<i id="waiting_for_result_list" style="color: #FDBD0E" class="fa fa-3x fa-gear fa-spin"></i>
				</div>
				<div id="result-list" class="clearfix">
					
					<!-- <div class="item clearfix">
						<div class="col-md-6 clearfix">
							<p style="white-space: normal" class="name">LADIVA NAIL SPA | CHĂM SÓC MÓNG CHUYÊN NGHIỆP</p>
							<div class="rating clearfix">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
							</div>
							<div class="address clearfix">
								<span class="pull-left">68 Lý Tự Trọng - P.Bến Nghé - Q.1 -TP.HCM</span>
								<a class="pull-right" href="#">Show map >>></a>
							</div>
							<div class="description clearfix">
								Tại salon Ladive nail các hiệu trình chăm sóc thiết kế nail được thực hiện theo một quy trình hiện đại, bằng tất cả sự khéo léo và cẩn thận. Ladivi Nail chăm sóc từng ngón tay, ngón chân của khách hàng...
							</div>
							<div class="services">
								Hair	NAIL 	Face
							</div>
						</div>
						<div class="col-md-6 clearfix image">
							<span class="fa-stack fa-lg new-item">
							  	<i class="fa fa-circle fa-stack-2x text-orange"></i>
							  	<i class="fa fa-stack-1x fa-inverse"><b>new</b></i>
							</span>
							<img width="100%" height="auto" class="img-responsive img-rounded" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
						</div>
						<div class="col-md-12 clearfix">
							<div class="price clearfix">
								<div class="col-sm-5 text-orange price-info-1">
									<strong>Móng gắn đá kim tuyến Hàn Quốc</strong>
								</div>
								<div class="col-sm-3 price-info-2">
									<i class="fa fa-clock-o text-orange"></i> 30 phút - 1 giờ
								</div>
								<div class="col-sm-2 price-info-3">
									<i class="fa fa-arrow-down text-orange"></i> Giảm 20%
								</div>
								<div class="col-sm-2 price-info-4" >
									<button type="button" class="btn btn-sm btn-orange pull-right">
										<i class="fa fa-dollar text-white"></i> 250.000 đ
									</button>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
			<div id="result-pagination" align="center">
				<ul class="pagination pagination-sm">
				  	<!-- <li><a href="#">&laquo;</a></li>
				  	<li><a href="#">1</a></li>
				  	<li><a href="#">2</a></li>
				  	<li><a href="#">3</a></li>
				  	<li><a href="#">4</a></li>
				  	<li><a href="#">5</a></li>
				  	<li><a href="#">&raquo;</a></li> -->
				</ul>
			</div>
		</div>

		<div class="col-md-4">
			<div id="side-bar">
				<p class="title">TÌM KIẾM KẾT QUẢ THEO BỘ LỌC</p>
				<div class="divider"></div>

				<div class="filter-1">
					<p class="filter-name">SẴN SÀNG CHO BẠN</p>
					<input type="text" class="form-control" placeHolder="Theo ngày">
					<p></p>
					<select class="form-control">
						<option value="" disabled>Theo giờ</option>
					</select>
				</div>
				<div class="divider"></div>

				<div class="filter-2">
					<p class="filter-name">TÔI MUỐN ĐẶT THEO</p>
					<div>
						<input id="filter-2-1" type="checkbox" name=""> 
						<label for="filter-2-1">Lựa chọn theo ngày giờ</label>
						<span class="pull-right badge">24</span>
					</div>
					<div>
						<input id="filter-2-2" type="checkbox" name=""> 
						<label for="filter-2-2">Voucher</label>
						<span class="pull-right badge">24</span>
					</div>
					<div>
						<input id="filter-2-3" type="checkbox" name=""> 
						<label for="filter-2-3">Tất cả</label>
					</div>
				</div>
				<div class="divider"></div>

				<div class="filter-3">
					<p class="filter-name">ĐỊA ĐIỂM</p>
					<select class="form-control">
						<option value="">Quận 1</option>
					</select>
				</div>
				<div class="divider"></div>

				<div class="filter-4">
					<p class="filter-name">LOẠI DỊCH VỤ</p>
					<div id="service_type">
						<div>
							<input id="filter-4-1" type="radio" name="service_type"> 
							<label for="filter-4-1">Vệ sinh móng</label>
							<span class="pull-right badge">24</span>
						</div>
						<a href="#">>>> Xem thêm loại dịch vụ khác (7)</a>
					</div>
				</div>
				<div class="divider"></div>
				
				<div class="filter-4">
					<p class="filter-name">DỊCH VỤ</p>
					<div id="service">
						<div>
							<input id="filter-4-1" type="checkbox" name="service"> 
							<label for="filter-4-1">Vệ sinh móng</label>
							<span class="pull-right badge">24</span>
						</div>
						<a href="#">>>>Xem thêm dịch vụ khác (7)</a>
					</div>
				</div>
				<div class="divider"></div>
				
				<div class="filter-5">
					<p class="filter-name">SẢN PHẨM</p>
					<div>
						<input id="filter-5-1" type="checkbox" name=""> 
						<label for="filter-5-1">Đính đá</label>
						<span class="pull-right badge">24</span>
					</div>
					<div>
						<input id="filter-5-2" type="checkbox" name=""> 
						<label for="filter-5-2">Móng giả</label>
						<span class="pull-right badge">24</span>
					</div>
					<a href="#">>>> Thêm sản phẩm khác (7)</a>
				</div>
				<div class="divider"></div>

				<div class="filter-6">
					<p class="filter-name">KHOẢNG GIÁ</p>
				</div>
			</div>
			
			<div class="sidebar-image" align="center" class="clearfix">
				<img class="img-responsive" alt="Responsive image" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
			</div>
			<div class="sidebar-image" align="center">
				<img class="img-responsive" alt="Responsive image" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
			</div>
		</div>

	</div>

	<div id="public" class="clearfix">
		<p class="title">- CỘNG ĐỒNG -</p>
		<div class="col-md-2"></div>
		<div class="col-sm-4 col-md-2 public-item-1">
			<img class="image img-responsive" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
			<div class="description">
				Công nghệ hại điện tại salon Mỹ Nhệ và các dịch vụ tâm điểm...
			</div>
			<div class="clearfix">
				<a class="pull-right read-more" href="#">XEM THÊM >>></a>
			</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-sm-4 col-md-2 public-item-2">
			<img class="image img-responsive" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
			<div class="description">
				Công nghệ hại điện tại salon Mỹ Nhệ và các dịch vụ tâm điểm...
			</div>
			<div class="clearfix">
				<a class="pull-right read-more" href="#">XEM THÊM >>></a>
			</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-sm-4 col-md-2 public-item-3">
			<img class="image img-responsive" src="http://webdesignledger.com/wp-content/uploads/2014/08/1-ipad-apps-for-web-designers.jpg">
			<div class="description">
				Công nghệ hại điện tại salon Mỹ Nhệ và các dịch vụ tâm điểm...
			</div>
			<div class="clearfix">
				<a class="pull-right read-more" href="#">XEM THÊM >>></a>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
<script>
	var SERVICE_NAME = "<?php echo $this -> service; ?>";
	var DISTRICT_ID = "<?php echo $this -> location; ?>";
	var TOTAL_PAGE = 0;
	var CURRENT_PAGE = 1;
	var REVIEW_RESULT = 0;
	var RESULT_PER_SHOW_MORE = "<?php echo RESULT_PER_SHOW_MORE; ?>";
</script>