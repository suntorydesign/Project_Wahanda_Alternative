<div class="container">
	<div class="row">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="row section-title text-center">
				<h2>- CREATE A COMPANY PROFILE -</h2>
				<span><i class="text-muted">Tell us a bit about yourself and we’ll set up your profile so
					you can post reviews, ask the Wahanda community questions,
					and book even faster next time.</i> </span>
			</div>
			<br />
		</div>
		<div class="col-sm-offset-2 col-sm-8 well" style="border: none;">
			<form class="form-horizontal" method="post" id="register_form">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<p class="col-sm-6">
								EMAIL
							</p>
							<div class="col-sm-12">
								<input class="form-control email required" type="email" id="email_address" name="email_address">
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6">
								HỌ
							</p>
							<div class="col-sm-12">
								<input class="form-control required" type="text" id="first_name" name="first_name">
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6">
								TÊN
							</p>
							<div class="col-sm-12">
								<input class="form-control required" type="text" id="last_name" name="last_name">
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6">
								TÊN ĐĂNG NHẬP <i title='Bạn sẽ được biết đến trên cộng đồng Wahanda qua tên đăng nhập, ít nhất 5 ký tự, số hoặc "-".' class="fa fa-question-circle text-muted" id="user_des"></i>
							</p>
							<div class="col-sm-12">
								<input class="form-control required" type="text" id="profile" name="profile">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="checkbox-inline">
									<label>
										<input type="checkbox" name="sex" id="sex" value="1" checked="checked"/>
										Nhận thư thông báo của chúng tôi với các tin tức và độc quyền
										phương pháp điều trị và luôn bên bạn
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<p class="col-sm-6">
								MẬT KHẨU <i title="Ít nhất là 6 ký tự" class="fa fa-question-circle text-muted" id="pass_des"></i>
							</p>
							<div class="col-sm-12">
								<input class="form-control required" minlength="6" type="password" id="password" name="password">
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6">
								POST CODE <i title="Cho chúng tôi biết bạn đang ở đâu và chúng tôi sẽ giúp bạn tìm những địa điểm tuyệt vời gần đó." class="fa fa-question-circle text-muted" id="postcode_des"></i>
							</p>
							<div class="col-sm-12">
								<input class="form-control required" type="text" id="postcode" name="postcode">
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6">
								BẠN LÀ
							</p>
							<div class="col-sm-12">
								<div class="radio-inline">
									<label>
										<input type="radio" name="sex" id="sex" value="1" checked="checked"/>
										Nữ
									</label>
								</div>
								<div class="radio-inline">
									<label>
										<input type="radio" name="sex" id="sex" value="0" />
										Nam
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<p class="col-sm-6"></p>
							<br />
							<div class="col-sm-12">
								<label>
									<i> Bằng việc gửi form này, bạn đồng ý với 
										<a href="https://www.wahanda.com/info/terms-of-use/" target="_blank">
											<strong> Điều khoản và Điều kiện </strong>
										</a> của chúng tôi 
									</i>
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-warning pull-right">
									<span style="color: #000000">
										<strong>
											GIA NHẬP WAHANDA
										</strong>
									</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Le Transition -->
<style>
	#register_form *, .well {
		border-radius: 0px !important;	
	}
	#register_form{
		border: none !important;
	}
	#register_form p,#register_form label {
		font-weight: normal;
		color: #5B5C56;
	}
	#register_form .fa-question-circle:hover{
		color: #000000;
	}
	.tooltip{
		font-size: 13px;
	}
	input.error{
		position: relative;
		border-left: 2px solid #cc3333;
	}
	span.error{
		position:absolute;
		background-color: #D2322D;
		left: 70%;
		bottom: 115%;
		color: #fff;
		padding: 1%;
		border: solid;
		border-color: #f5f5f5 transparent;
		border-width: 0px 0px 12px 12px;
		content: "";
		box-shadow: -3px -3px 3px #9A9797;
	}
</style>