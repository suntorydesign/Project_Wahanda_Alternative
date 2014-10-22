		<!--SERVICE DETAIL MODAL -->
		<div id="service_detail" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-max-height="840" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" >
					<div style="display: none;" class="modal-body" id="error_service_detail_modal_body">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<div style="color : #A1A1A1;" class="text-center">
							<h4>Dịch vụ không tồn tại hoặc có gián đoạn kết nối, thử kết nối lại!</h4>
						</div>
					</div>
					<div class="modal-body" id="service_detail_modal_body">
						<button type="button" class="close btn-close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<div class="row">
							<div class="well" style="background-color: #000000">
								<div class="row" style="font-size: 16px;">
									<div class="col-md-4" style="color: #FFCC00;">
										<strong style="text-transform: uppercase;" id="user_service_name">UỐN MI CONG VOLUM</strong>
									</div>
									<div class="col-md-4" style="color: #FFFFFF;">
										<strong class="user_business_name">Sun Spa Resort</strong>
									</div>
									<div class="col-md-4" id="general_rating_detail">
										<span style="color: #FFCC00;"> 
											<i class="fa fa-star"></i> 
											<i class="fa fa-star"></i> 
											<i class="fa fa-star"></i> 
											<i class="fa fa-star"></i> 
											<i class="fa fa-star-o"></i> 
										</span>
										<span style="color: #FFFFFF;">345 lượt bình chọn</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7" data-spy="scroll" data-target="#service_nav" >
								<div class="row">
									<div class="col-md-12">
										<img id="user_logo" height="auto" width="100%" src="<?php echo ASSETS; ?>img/tp-hcm-thanh-dai-cong-truong-thi-cong-metro-1408499845_490x294.jpg" />
									</div>
									<div class="col-md-12">
										<br />
										<nav id="service_nav" class="navbar navbar-default" role="navigation">
											<div class="">
												<ul class="nav navbar-nav">
													<li style="font-size: 19px" class="text-center">
														<a href="#detail"><strong>&nbsp;&nbsp;Chi tiết&nbsp;&nbsp;</strong></a>
													</li>
													<li style="font-size: 19px" class="text-center">
														<a href="#jugg"><strong>&nbsp;&nbsp;Đánh giá&nbsp;&nbsp;</strong></a>
													</li>
													<li style="font-size: 19px" class="text-center">
														<a href="#about_venue"><strong>&nbsp;&nbsp;&nbsp;Về địa điểm này&nbsp;&nbsp;&nbsp;</strong></a>
													</li>
												</ul>
											</div>
										</nav>
									</div>
									<div class="col-md-12">
										<div id="detail" class="container-fluid">
											<div class="row">
												<div class="col-md-6">
													<span class="service_properties">
														<i style="color: #FDBD0E;" class="fa fa-dollar"></i> <b>Giá</b>
													</span>
												</div>
												<div class="col-md-6">
													<span id="user_service_sale_price" class="service_properties">420.000</span><span> VNĐ</span>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-6">
													<span class="service_properties">
														<i style="color: #FDBD0E;" class="fa fa-clock-o"></i> <b>Thời gian</b>
													</span>
												</div>
												<div class="col-md-6">
													<span id="user_service_duration" class="service_properties">30</span><span> phút</span>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-6">
													<span class="service_properties">
														<i style="color: #FDBD0E;" class="fa fa-check-square-o"></i><b> Bạn được lựa chọn</b>
													<span>
												</div>
												<div class="col-md-6">
													<ul class="service_properties">
														<li>
															Cong nhẹ
														</li>
														<li>
															Cong vừa
														</li>
														<li>
															Cong vút
														</li>
													</ul>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-12">
													<i>Chính sách hủy: Trong vòng 24 giờ</i>
												</div>
												<div class="col-md-12">
													<i>Bạn nên biết: Nếu bạn đã mua một e Voucher,
													xin vui lòng liên hệ trước với các địa điểm
													để đặt hẹn chính xác sau khi đã nhận được
													xác nhận đặt hàng</i>
												</div>
											</div>
											<hr />
										</div>
										<div id="jugg" class="container-fluid">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-12">
													<h4><strong>ĐÁNH GIÁ</strong></h4>
												</div>
												<div class="col-md-12">
													<i>Những đánh giá của khách hàng đã sử dụng dịch vụ này</i>
												</div>
											</div>
											<div class="row" >
												<div class="col-md-12 well" style="padding: 0 10px 0 10px; margin-left: 12px; border: none;">
													<div class="row" id="user_review_overall_detail">
														<!-- <div class="col-md-3">
															<span style="color: #FFCC00; font-size: 40px;">4.2</span>
														</div>
														<div class="col-md-7">
															<span><small>điểm đánh giá</small></span>
															<br />
															<span style="color: #FFCC00"> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star-half-empty"></span> 
															</span>
															<br />
															<span><small>169 lượt đánh giá</small></span>
														</div> -->
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6" id="chart_rating">
													<div class="row">
														<div class="col-md-offset-1 col-md-3">
															<small>5 sao </small>
														</div>
														<div class="col-md-8">
															<span id="five_stars" style="width: 100%" class="progress_bar" ></span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-offset-1 col-md-3">
															<small>4 sao </small>
														</div>
														<div class="col-md-8">
															<span id="four_stars" style="width: 80%" class="progress_bar" ></span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-offset-1 col-md-3">
															<small>3 sao </small>
														</div>
														<div class="col-md-8">
															<span id="three_stars" style="width: 60%" class="progress_bar" ></span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-offset-1 col-md-3">
															<small>2 sao </small>
														</div>
														<div class="col-md-8">
															<span id="two_stars" style="width: 40%" class="progress_bar" ></span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-offset-1 col-md-3">
															<small>1 sao </small>
														</div>
														<div class="col-md-8">
															<span id="one_star" style="width: 20%" class="progress_bar" ></span>
														</div>
													</div>
												</div>
												<div id="user_review_properties_detail" class="col-md-6  pull-right" style="border-left: 1px solid #CCCCCA;">
													<!-- <div class="row">
														<div class="col-md-6">
															<small class="pull-right">Nhiệt tình</small>
														</div>
														<div class="col-md-6">
															<span class="pull-right" style="color: #FFCC00"> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star"></span> 
																<span class="fa fa-star-half-empty"></span> 
															</span>
														</div>
													</div> -->
												</div>
											</div>
											<hr />
											<div class="row" id="group_service_rating">
												<!-- <div class="col-md-12">
													<span><b>NAIL</b></span>
													<div class="row">
														<div class="col-md-6">
															<small>Vệ sinh móng</small>
														</div>
														<div class="col-md-6">
															<span style="color: #FFCC00"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-half-empty"></span> </span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<small>Đắp bột</small>
														</div>
														<div class="col-md-6">
															<span style="color: #FFCC00"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-half-empty"></span> </span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<small>Sơn nhiều màu</small>
														</div>
														<div class="col-md-6">
															<span style="color: #FFCC00"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-half-empty"></span> </span>
														</div>
													</div>
													<br />
												</div>
												<div class="col-md-12">
													<span><b>FACE</b></span>
													<div class="row">
														<div class="col-md-6">
															<small>Massage</small>
														</div>
														<div class="col-md-6">
															<span style="color: #FFCC00"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-half-empty"></span> </span>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<small>Đắp mặt nạ</small>
														</div>
														<div class="col-md-6">
															<span style="color: #FFCC00"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-half-empty"></span> </span>
														</div>
													</div>
													<br />
												</div> -->
												<div class="col-md-12">
													<span><a href="">Xem thêm >>></a></span>
												</div>
											</div>
											<hr />
											<div id="review_field_detail">
												<div style="display : none;" id="disallow_detail"></div>
												<div id="waiting_for_review_load_detail" class="text-center">
													<i style="color: #FDBD0E" class="fa fa-2x fa-spin fa-refresh"></i>
												</div>
												<!-- <div class="media">
													<a class="pull-left" href="#"> <img width="55" height="55" class="media-object" src="<?php echo ASSETS; ?>img/tp-hcm-thanh-dai-cong-truong-thi-cong-metro-1408499845_490x294.jpg" alt="avatar"> </a>
													<div class="media-body">
														<h5 class="media-heading"><strong>Việt Nguyễn</strong><small class="pull-right"><i>tham gia thang 6-2014</i></small></h5>
														<small><i>cách đây 3 giờ</i></small>
														<p>
															Nhân viên tận tình, môi trường sạch sẽ, tác... <span><a href="">Xem thêm >>></a></span>
														</p>
													</div>
												</div> -->
											</div>
											<hr />
										</div>
										<div id="about_venue" class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<h4><strong>VỀ ĐỊA ĐIỂM NÀY</strong></h4>
												</div>
												<div class="col-md-12" style="border: 3px solid #CCCCCA; padding: 10px">
													<img height="120" style="" width="100%" src="https://maps.googleapis.com/maps/api/staticmap?sensor=false&amp;zoom=15&amp;size=397x98&amp;maptype=roadmap&amp;markers=icon%3Ahttps%3A%2F%2Fconnect.wahanda.com%2Fassets%2Fmap-marker.png%7C54.54516881%2C-1.27919913">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<h5 class="text-center"><b style="text-transform: uppercase;" class="user_business_name">SUNSPA RESORT</b></h5>
													<p class="text-center"><span id="user_address">Đ.2, P.Bình An, Q.2, TP.HCM</span> | SĐT: <span id="user_contact_phone">0903676222</span> | Email: <span id="user_contact_email">vietnt134@gmail.com</span></p>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-12">
													<p id="user_description">SUNSPA RESORT được thành lập năm 2007 
													với các dịch vụ dành cho phái nữ, qua nhiều năm kinh nghiệm 
													chúng tôi đã nhận được sự tín nhiệm từ khách hàng 
													và ngày một nâng cao trình độ phục vụ</p>
													<p class="text-right"><a id="user_description_see_more" style="cursor: pointer;">Xem thêm >>></a></p>
												</div>
											</div>
											<hr />
											<div class="row">
												<div class="col-md-4">
													<p><b>GIỜ MỞ CỬA</b></p>
												</div>
												<div style="font-size: 13px;" class="col-md-4" id="user_open_hour_1">
													<p>Thứ 2 - Thứ 6 ........ 07am - 20pm</p>
													<p>Thứ 7 - Chủ nhật ... 07am - 20pm</p>
												</div>
												<div style="font-size: 13px;" class="col-md-4" id="user_open_hour_2">
													<p>Thứ 2 - Thứ 6 ........ 07am - 20pm</p>
													<p>Thứ 7 - Chủ nhật ... 07am - 20pm</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="row" style="border: 2px solid #CCCCCA;">
									<div class="col-md-12" style="padding: 10px;">
										<div class="row">
											<div style="margin-top: 2px" class="col-md-6">
												<button onclick="jumbToTab('online_booking_zone')" id="btn_online_booking_zone" class="btn btn-block btn-orange">ĐẶT HẸN</button>
											</div>
											<div style="margin-top: 2px" class="col-md-6">
												<button onclick="jumbToTab('evoucher_booking_zone')" id="btn_evoucher_booking_zone" class="btn btn-block btn-orange">MUA VOUCHER</button>
											</div>
										</div>
										<br />												
										<div>
											<div id="online_booking_zone">
												<div class="row">
													<div style="cursor: default;" id="month_and_year" class="col-md-12">
														<div class="text-center">&nbsp;&nbsp;&nbsp;AUGUST 2014&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i></div>
													</div>
												</div>	
												<div class="row" id="days_booking">
													<div class="col-md-12 text-center">
														<span>T2</span>
														<span>T3</span>
														<span>T4</span>
														<span>T5</span>
														<span>T6</span>
														<span>T7</span>
														<span>CN</span>
													</div>
												</div>
												<div class="row" id="date_booking" style="margin-top: 6px;">
													<div class="col-md-12 text-center">
														<span class="active">12</span>
														<span>13</span>
														<span>14</span>
														<span>15</span>
														<span>16</span>
														<span>17</span>
														<span>18</span>
													</div>
												</div>
												<div id="time_booking">
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">08:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">09:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">10:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">11:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">12:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">13:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">14:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">15:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
													<hr />
													<div class="row">
														<div class="col-md-offset-1 col-md-6">16:00am</div>
														<div class="col-md-5">400.000 Vnđ</div>
													</div>
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<button onclick="getBookingInfo()" style="height: 48px;box-shadow: 0 0 6px #9A9797;" class="btn btn-block btn-black booking_button">
															<span>Tổng cộng : </span>
															<span id="btn_user_service_price_b">400.000</span><span> VNĐ</span>
															<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<span class="span-separate"></span>
															<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<span>ĐẶT <i id="waiting_for_booking_save_b" style="display: none;" class="fa fa-refresh fa-spin"></i></span>
														</button>
													</div>
												</div>
											</div>
											<div id="evoucher_booking_zone" style="display: none;">
												<!-- evoucher here -->
												<div class="row">
													<div class="col-md-12">
														<span style="font-size: 14px;"><i class="fa fa-2x fa-ticket"></i> Chi tiết eVoucher</span>
													</div>
												</div>
												<div class="row" id="days_eVoucher">
													<div class="col-md-12 text-center">
														<span>T2</span>
														<span>T3</span>
														<span>T4</span>
														<span>T5</span>
														<span>T6</span>
														<span>T7</span>
														<span>CN</span>
													</div>
												</div>
												<div class="row" id="use_eVoucher">
													<div class="col-md-12 text-center">
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
														<span class="fa fa-check"></span>
													</div>
												</div>
												<hr />
												<div class="row" id="evoucher_expire">
													<div class="col-md-12">
														<p id="evoucher_due_date"></p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<p>Bạn sẽ cần phải liên hệ trực tiếp với các địa điểm mà bạn đã mua eVoucher
															 để đặt cuộc hẹn của bạn một khi đã nhận được xác nhận đặt hàng.
														</p>
													</div>
												</div>
												<div class="row" style="margin-bottom: 160px;">
													<div class="col-md-12">
														<form class="form-horizontal">
															<label class="control-label col-md-4">Số lượng</label>
															<div class="col-md-8">
																<select id="e_quantity" name="e_quantity" class="form-control"></select>
															</div>
														</form>
													</div>
												</div>
												<br />
												<div class="row">
													<div class="col-md-12">
														<button onclick="geteVoucherInfo()" style="height: 48px;box-shadow: 0 0 6px #9A9797;" class="btn btn-block btn-black booking_button">
															<span>Tổng cộng : </span>
															<span id="btn_user_service_price_e">400.000</span><span> VNĐ</span>
															<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<span class="span-separate"></span>
															<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<span>ĐẶT <i id="waiting_for_booking_save_e" style="display: none;" class="fa fa-refresh fa-spin"></i></span>
														</button>
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="border: none;" class="modal-footer">
						<button type="button" class="btn btn-black" data-dismiss="modal">
							Đóng
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- END SERVICE DETAIL MODAL -->
		<!-- Modal Login -->
        <div id="login_modal" style="z-index: 1051;" onkeydown="enterEvent(event)" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-max-height="440">
    	  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #FDBD0E; padding: 6px 10px;">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h5 class="modal-title" id="myModalLabel" style="text-align:center; font-weight:bold;">ĐĂNG NHẬP</h5>
		      </div>
		      <div class="modal-body" style="padding: 30px 20px 0px;">
		        <form class="form-horizontal">
		        	<div class="form-group">
		        		<label class="control-label col-sm-3">Email</label>
		        		<div class="col-sm-8">
		        			<input autocomplete="off" class="form-control" type="text" id="email_login" name="email_login" placeholder="Nhập email...VD:abc@example.com" />
		        		</div>
		        	</div>	
		        	<div class="form-group">
		        		<label class="control-label col-sm-3">Mật Khẩu</label>
		        		<div class="col-sm-8">
		        			<input autocomplete="off" class="form-control" type="password" id="pass_login" name="pass_login" placeholder="Nhập mật khẩu..." />
		        			<div style="padding-top:10px">
		        				<small >
			        				<a href="<?php echo URL . 'requestpass'; ?>">Quên mật khẩu?</a> Hay chưa có tài khoản, hãy 
			        				<a href="<?php echo URL . 'clientsignup'; ?>">Đăng ký!</a>
			        			</small>
		        			</div>
		        			
		        		</div>
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer" id="footer_login" style="padding: 15px 20px 15px;">
		        <button type="button" id="check_login_btn" onclick="login()" class="btn btn-sm btn-orange-black">Đăng Nhập</button>
		      	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</button>
		      </div>
		    </div>
		  </div>
        </div>
        <!-- End Modal Login -->
        <!-- Modal Shopping Cart -->
        <div id="Shopping_cart_info" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content" style="border-radius:0;">
        			<div class="modal-header" style="background-color: #FDBD0E; padding: 6px 10px;">
			        	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        	<h4 class="modal-title" id="myModalLabel">
			        		<strong><i class="fa fa-shopping-cart" style="font-size:16px;"></i> GIỎ HÀNG CỦA BẠN</strong> 
			        		<span><i>(Bạn đang có <span id="cart_amount">10</span> cuộc hẹn/E-voucher)</i></span>
			        	</h4>
			      	</div>
			      	<div class="modal-body">
			      		<div class="table-responsive" style="height: 300px;overflow: auto;">
				      		<table id="table_shopping_cart" class="table table-responsive table-hover" style="font-size:14px;">
				      			<tr>
				      				<th  style="border: none">DỊCH VỤ</th>
				      				<th  style="border: none">NGÀY - GIỜ</th>
				      				<th  style="border: none">GIÁ</th>
				      				<th  style="border: none">SỐ LƯỢNG</th>
				      				<th  style="border: none">TỔNG TIỀN</th>
				      			</tr>
				      			<tr>
				      				<td width="30%">CẮT TÓC CÔ DÂU - Spa Ngọc Trinh</td>
				      				<td width="20%">15/9/2014 - 09:00AM</td>
				      				<td width="19%">450000 VNĐ</td>
				      				<td width="12%"><input onkeypress="inputNumbers(event)" maxlength="1" class="form-control appointment_quantity" type="text" value="2" /></td>
				      				<td width="19%">900000 VNĐ</td>
				      			</tr>
				      		</table>
			      		</div>
			      		<div class="row">
				      		<div class="col-md-12">
				      			<button onclick="saveQuantityNumber()" id="update_cart" class="btn btn-default pull-right">
				      				<i id="waiting_for_update_cart" class="fa fa-refresh text-success fa-spin" style="display: none;"></i>
				      				<span>Cập nhật giỏ hàng</span>
				      			</button>
				      		</div>
			      		</div>
			      		<div class="row">
				      		<div class="col-md-12">
				      			<h4 class="pull-right"><strong>Thành Tiền</strong> : 
				      				<b><span id="total_cart" class="text-success">900000</span> <span class="text-success">VNĐ</span></b>
				      			</h4>
				      		</div>
			      		</div>
			      	</div>
			      	<div class="modal-footer">
			      		<button onclick="checkIsLoginPayment()" type="button" id="confirm_cart" class="btn btn-orange">Thực hiện thanh toán</button>
			      		<button type="button" class="btn btn-default" data-dismiss="modal">Trở về</button>
			      	</div>
        		</div>
        	</div>
        </div>
        <!-- End Modal Shopping Cart -->
        <footer id="footer">
            <div id="footer-info">
                <div class="container">
                    <div id="footer-1" class="col-md-2">
                        <h4><b>THÔNG TIN</b></h4>
                        <p id="contact_link" class="text-orange-black pointer">Liên hệ</p>
                        <p id="about_us" class="text-orange-black pointer">Về chúng tôi</p>
                        <p class="text-orange-black pointer">Góc báo chí</p>
                        <p class="text-orange-black pointer">Tuyển dụng</p>
                    </div>

                    <div id="footer-2" class="col-md-6">
                        <a href="<?php echo URL; ?>">
                        	<img width="35%" class="img-responsive" src="<?php echo ASSETS; ?>img/Beleza_logo_Final.png" />
                   		</a>
                    </div>

                    <div id="footer-3" class="col-md-2">
                        <h4><b>LINK NHANH</b></h4>
                        <p id="gift_voucher_link" class="text-orange-black pointer">Thẻ tặng quà</p>
                        <p class="text-orange-black pointer">Góc chuyên gia</p>
                        <p class="text-orange-black pointer">Chăm sóc toàn diện</p>
                        <p class="text-orange-black pointer">Tải ứng dụng</p>
                    </div>

                    <div id="footer-4" class="col-md-2">
                        <h4><b>THÔNG TIN</b></h4>
                        <p class="text-orange-black pointer">Xác thực voucher</p>
                        <p id="regist_venue" class="text-orange-black pointer">Đăng ký gian hàng</p>
                        <p id="" class="text-orange-black pointer">Trang tin</p>
                    </div>
                </div>
            </div>
            
            <div id="footer-last">
            	<img class="image-responsive" src="<?php echo ASSETS?>img/arrow-top.png" style="position: relative;top: -39px;left: 49%;"/>
                <div class="container" align="center">
                    <ul class="list-inline">
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-tumblr fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-tencent-weibo fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-google-plus fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-youtube fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-linkedin fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                        <li class="pointer">
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x text-white"></i>
                                <i class="fa fa-instagram fa-stack-1x fa-inverse text-orange"></i>
                            </span> 
                        </li>
                    </ul>

                    <p>2014 Design by Suntory</p>
                </div>
                
            </div>
        </footer>
    </body>
    <!-- Chèn link JavaScript-->
    <script src="<?php echo ASSETS ?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS ?>plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS ?>plugins/wysibb/jquery.wysibb.js" type="text/javascript"></script>
   	<script type="text/javascript" src="<?php echo ASSETS; ?>js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS; ?>js/messages_vi.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS; ?>js/common.js"></script>
	<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom.js"></script>
    <script type="text/javascript">
	  	// Active menu	
        $(function() {
            var pgurl = window.location.href.substr( window.location.href.lastIndexOf("/") + 1 );
            $("#nav1 li a").each(function(){
                var href = $(this).attr("href");
                var ctr = href.substr( href.lastIndexOf("/") + 1 ) ;
                if(ctr == pgurl || ctr == '' ) 
                    $(this).parent().addClass("on");
            });
        });
    </script>
    
    <script type="text/javascript">
        var URL = "<?php echo URL ?>";
        var USERNAME = "<?php if(isset($_SESSION['client_username']))
							      echo $_SESSION['client_username']; 
						?>";
		var USER_SERVICE_ID = '';
		var USER_ID_2 = '';
		var USER_BUSINESS_NAME = '';
		var USER_SERVICE_NAME = '';
		var BOOKING_DETAIL_DATE;
		var BOOKING_DETAIL_TIME;
		var WEEK_PAGE = 1;
		var TOTAL_WEEK = 0;
		var MON_OPEN_CLOSE = [];
		var TUE_OPEN_CLOSE = [];
		var WED_OPEN_CLOSE = [];
		var THU_OPEN_CLOSE = [];
		var FRI_OPEN_CLOSE = [];
		var SAT_OPEN_CLOSE = [];
		var SUN_OPEN_CLOSE = [];
		var TODAY_OF_WEEK;
		var TODAY_OF_MONTH;
		var TODAY_MONTH;
		var TODAY_YEAR;
		var TODAY_HOUR;
		var TODAY_MINUTE;
		var LIMIT_TIME_BEFORE_SERVICE;
		var USER_SERVICE_SALE_PRICE = '';
		var USER_SERVICE_DURATION;
		var CHOOSEN_DATE = '';
		var CHOOSEN_DATE_STORE = '';
		var CHOOSEN_TIME = '';
		var CHOOSEN_PRICE = '';
		var APPOINTMENT_QUANTITY_LIST_BEFORE = '';
		var EVOUCHER_QUANTITY_LIST_BEFORE = '';
		var USER_SERVICE_USE_EVOUCHER = '';
		var EVOUCHER_DUE_DATE = '';
		var MAX_QUANTITY_EVOUCHER = "<?php echo MAX_QUANTITY_EVOUCHER; ?>";
		var MAX_PAGINATION_ITEM = "<?php echo MAX_PAGINATION_ITEM; ?>";
		var IDLE_TIME = "<?php echo IDLE_TIME; ?>";
		var IDLE_CHECK = "<?php echo IDLE_CHECK; ?>";
		var IS_PAYMENT_PAGE = '<?php 
							      if(isset($this -> is_payment_page)){
								      echo $this -> is_payment_page; 
								  }else{
								  	  echo ''; 
								  }
							  ?>'
		$(document).ready(function(){
			checkSessionIdle();
		});
    </script>

    <?php
        // Include script module
        if(isset($this->script)){
            foreach ($this->script as $script) {
                echo '<script type="text/javascript" src="'. $script .'" ></script>';
            }
        }
		if(isset($this -> is_payment_page)){
			
		}
    ?>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="<?php echo ASSETS ?>plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS ?>plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript">
		jQuery(document).ready(function() {
		    jQuery('.tp-banner').revolution(
			{
				delay:9000,
				startwidth:1170,
				startheight:250,
				hideThumbs:10
			});
		});
	</script>
</html>