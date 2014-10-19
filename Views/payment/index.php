<div class="container">
	<!-- Booking detail -->
	<div class="row">
		<div class="col-md-12 thumbnail" style="border-radius: 0px">
			<h4 class="text-center" style="color: #FFCC00"><i class="fa fa-shopping-cart"></i><b> CHI TIẾT GIỎ HÀNG</b></h4>
			<div class="table-responsive">
				<table id="table_payment_detail" class="table table-responsive">
					<tr>
						<th  style="border: none">DỊCH VỤ</th>
						<th  style="border: none">NGÀY - GIỜ</th>
						<th  style="border: none">GIÁ</th>
						<th  style="border: none">SỐ LƯỢNG</th>
						<th  style="border: none">TỔNG TIỀN</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<!--End booking detail -->
	<div class="row">
		<!-- Payment -->
		<div class="col-md-7">
			<h4 style="color: #FFCC00"><i class="fa fa-credit-card"></i><b> THANH TOÁN</b></h4>
			<div class="row">
				<div class="col-md-12">
					<button id="btn_online_payment" onclick="jumbToPaymentTab('online_payment')" class="btn btn-choose">
						Thanh toán online
					</button>
					<button id="btn_venue_payment" onclick="jumbToPaymentTab('venue_payment')" class="btn btn-orange">
						Thanh toán tại địa điểm
					</button>
				</div>
			</div>
			<br />

			<div class="row">
				<!-- PAYPAL -->
				<div id="online_payment" class="col-md-12">
					<div style="background-color: #f7f7f7; padding: 24px 12px 24px 12px;">
						<div class="form-horizontal">
							<div class="row">
								<div class="col-md-6">
									<i class="fa fa-2x fa-paypal"></i><b>CHUYỂN KHOẢN ĐẾN PAYPAL</b>
								</div>
								<div class="col-lg-6 text-right">
									<i class="fa fa-3x fa-cc-mastercard"></i>
									<i class="fa fa-3x fa-cc-visa"></i>
									<i class="fa fa-3x fa-cc-discover"></i>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<small class="col-sm-12 payment_text"> SỐ THẺ </small>
										<div class="col-sm-12">
											<input onkeypress="inputNumbers(event)" class="form-control" type="text" id="client_card_number" name="client_card_number">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<small class="col-sm-12 payment_text"> MÃ BẢO MẬT </small>
										<div class="col-sm-12">
											<input onkeypress="inputNumbers(event)" maxlength="4" class="form-control" type="text" id="client_security_code" name="client_security_code">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<small class="col-sm-12 payment_text"> CHỦ THẺ </small>
										<div class="col-sm-6">
											<input class="form-control" type="text" id="client_card_holder_first" name="client_card_holder_first" placeholder="HỌ">
										</div>
										<div class="col-sm-6">
											<input class="form-control" type="text" id="client_card_holder_last" name="client_card_holder_last" placeholder="TÊN">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<small class="col-sm-12 payment_text"> HẾT HẠN VÀO </small>
										<div class="col-sm-6">
											<input onkeypress="inputNumbers(event)" maxlength="2" class="form-control" type="text" id="month_expire" name="month_expire" placeholder="MM">
										</div>
										<div class="col-sm-6">
											<input onkeypress="inputNumbers(event)" maxlength="2" class="form-control" type="text" id="year_expire" name="year_expire" placeholder="YY">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button onclick="processPayment()" class="btn btn-orange-black pull-right">
										Thanh toán
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END PAYPAL -->
				<!-- VENUE PAYMENT -->
				<div id="venue_payment" style="display: none;" class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<small style="font-size: 13px;">Bạn sẽ được tính tiền ở các địa điểm sau khi thực hiện cuộc hẹn. </small>
							<br />
							<br />
							<small style="font-size: 13px;"><i>
								<b>Vui lòng đặt hẹn có trách nhiệm</b>. Thường thì các địa điểm là các doanh nghiệp 
								độc lập, vì vậy thực sự rất buồn khi bạn tự ý hủy một cuộc hẹn mà bạn đã đặt. 
								Chúng tôi biết kế hoạch của bạn có thể thay đổi, vì vậy nếu bạn 
								không thể thực hiện cuộc hẹn mà bạn đã đặt bằng tùy chọn này, xin vui lòng làm điều đúng đắn và 
								liên hệ cho địa điểm bạn hủy cuộc hẹn càng sớm càng tốt. 
								Nếu bạn tự ý hủy một cuộc hẹn không lý do khi bạn lựa chọn "Thanh toán tại địa điểm", 
								bạn sẽ không được phép đặt bất cứ một cuộc hẹn nào bằng cách sử dụng tùy chọn thanh toán này.
							</i></small>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<button onclick="processVenuePayment()" class="btn btn-orange-black pull-right">
								Thanh toán
							</button>
						</div>
					</div>
				</div>
				<!-- END VENUE PAYMENT -->
			</div>
			<br />
		</div>
		<!-- End payment -->
		<!--Payer detail-->
		<div id="payer_info" class="col-md-5 thumbnail" style="border-radius: 0px">
			<h5 class="text-center" style="color: #FFCC00"><i class="fa fa-user"></i><b> THÔNG TIN KHÁCH HÀNG</b></h5>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Mã số khách hàng : </b>
					</p>
				</div>
				<div id="client_id" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Họ tên : </b>
					</p>
				</div>
				<div id="client_name" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Username : </b>
					</p>
				</div>
				<div id="client_username" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Email : </b>
					</p>
				</div>
				<div id="client_email" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Số điện thoại : </b>
					</p>
				</div>
				<div id="client_phone" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-5">
					<p>
						<b>Tham gia : </b>
					</p>
				</div>
				<div id="client_join_date" class="col-md-6">
					<p>
						<i>...</i>
					</p>
				</div>
			</div>
		</div>
		<!--End payer detail-->
	</div>
</div>