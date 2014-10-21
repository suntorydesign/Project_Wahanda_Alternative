<style>
	p{
		font-weight: bold;
	}
</style>
<div id="header-2" class="clearfix">
	<!--
	#################################
		- THEMEPUNCH BANNER -
	#################################
	-->
	<div class="tp-banner-container">
		<div class="tp-banner" >
			<ul>
				<!-- SLIDE  -->
				<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
					<!-- MAIN IMAGE -->
					<img src="<?php echo ASSETS;?>img/slider-image-01.jpg"  alt="Spa Hồng Vân"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption lightgrey_divider skewfromrightshort fadeout"
						data-x="85"
						data-y="224"
						data-speed="500"
						data-start="1200"
						data-easing="Power4.easeOut">Spa Hồng Vân
					</div>
					Địa điểm 245 Trường Chinh, Tp.HCM

				</li>
				<!-- SLIDE  -->
				<li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
					<!-- MAIN IMAGE -->
					<img src="<?php echo ASSETS;?>img/slider-image-02.jpg"  alt="Spa Ngọc Trinh"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption lightgrey_divider skewfromrightshort fadeout"
						data-x="85"
						data-y="224"
						data-speed="500"
						data-start="1200"
						data-easing="Power4.easeOut">My Caption
					</div>
					...
				</li>
				<!-- SLIDE  -->
				<li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
					<!-- MAIN IMAGE -->
					<img src="<?php echo ASSETS;?>img/slider-image-03.png"  alt="Người mẫu"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
					<!-- LAYERS -->
					<!-- LAYER NR. 1 -->
					<div class="tp-caption lightgrey_divider skewfromrightshort fadeout"
						data-x="85"
						data-y="224"
						data-speed="500"
						data-start="1200"
						data-easing="Power4.easeOut">My Caption
					</div>
					...
				</li>
				....
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10 well">
			<h2 class="page-header text-center text-black">- <i id="gear" class="fa fa-gear"></i>&nbsp;QUẢN LÝ TÀI KHOẢN</i> -</h2>
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">EMAIL :</p></div>
				<div class="col-md-6"><p class="" id="client_email"></p></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange control-label">HỌ TÊN :</p></div>
				<div class="col-md-3">
					<input title="<strong>Lưu ý</strong>: Không được để trống!" class="form-control" id="client_name" type="text" readonly=""/>		
				</div>
				<div class="col-md-3" id="client_name_edit"><i title="Sửa họ tên" id="client_name_edit_btn" class="fa fa-pencil text-orange-black"></i></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">GIỚI TÍNH :</p></div>
				<div class="col-md-6"><p class="" id="client_sex"></p></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">ĐIỆN THOẠI :</p></div>
				<div class="col-md-3">
					<input title="<strong>Lưu ý</strong>: Không được để trống, <br/>là số và ít nhất 9 ký tự!" class="form-control" id="client_phone" type="text" readonly=""/>		
				</div>
				<div class="col-md-3"><i title="Sửa số điện thoại" id="client_phone_edit_btn" class="fa fa-pencil text-orange-black"></i></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">USERNAME :</p></div>
				<div class="col-md-6"><p class="" id="client_username"></p></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">CREDIT POINT :</p></div>
				<div class="col-md-6"><p class="" id="client_creditpoint"></p></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-offset-3 col-md-3"><p class="text-orange">GIFT POINT :</p></div>
				<div class="col-md-6"><p class="" id="client_giftpoint"></p></div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center text-orange page-header">
						<a class="text-orange-black" id="hidden_change_pass" style="cursor: pointer;">- <i class="fa fa-shield"></i>&nbsp;ĐỔI MẬT KHẨU</i> -</a>
					</h2>
				</div>
			</div>
			<br />
			<div class="row" id="client_change_pass" style="display: none;">
				<!-- <div class="col-md-offset-3 col-md-3"><p class=""><strong>ĐỔI MẬT KHẨU :</strong></p></div> -->
				<div class="col-md-12">
					<form class="form-horizontal">
						<div class="form-group">
							<b class="control-label col-md-4 text-orange">MẬT KHẨU CŨ : </b>
							<div class="col-md-5">
								<input type="password" class="form-control" name="client_old_pass" id="client_old_pass" placeholder="Nhập mật khẩu cũ..."/>
							</div>
						</div>
						<div class="form-group">
							<b class="control-label col-md-4 text-orange">MẬT KHẨU MỚI (1) : </b>
							<div class="col-md-5">
								<input type="password" class="form-control" name="client_pass_1" id="client_pass_1" placeholder="Nhập mật khẩu mới..."/>
							</div>
						</div>
						<div class="form-group">
							<b class="control-label col-md-4 text-orange">MẬT KHẨU MỚI (2) : </b>
							<div class="col-md-5">
								<input type="password" class="form-control" name="client_pass_2" id="client_pass_2" placeholder="Nhập lại mật khẩu mới..."/>
							</div>
						</div>
						<div class="form-group">
							<span class="control-label col-md-4"></span>
							<div class="col-md-6" id="change_pass_btn">
								<a class="btn btn-orange-black" onclick="changePass()">Đổi mật khẩu</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<br />
		</div>
	</div>
</div>
<style>
	p, input{
		font-size: 16px;
	}
	i.fa-pencil, i.fa-save{
		cursor: pointer;
	}
	i.fa-pencil:hover, i.fa-save:hover{
		font-size: 18px;
		color: #000000;
	}
	input#client_name, input#client_phone{
		margin-top: -8px;
	}
</style>