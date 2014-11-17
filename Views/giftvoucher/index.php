

<div id="header-2" class="clearfix">
	<div class="gift-title" align="center">
		<img class="img-responsive" src="<?php echo ASSETS;?>img/title.png"/>
	</div>	
	<div class="gift-action" align="center">
		<button class="btn btn-sm btn-orange buy-giftvc-btn">MUA GIFT VOUCHER</button>
		<button class="btn btn-sm btn-default readmore-giftvc-btn">TÌM HIỂU THÊM</button>
	</div>
</div>



<div id="content-wrap" >
	<div id="gift-voucher-1" class="container">
		<div class="attr-voucher clearfix">
			<div class="attr-voucher-1 col-sm-4">
				<div class="image" align="center">
					<img class="img-responsive" src="<?php echo ASSETS;?>img/map-point-o.png" />
				</div>
				<div class="description text-brown" align="center">ĐƯỢC CHẤP NHẬN TRÊN HƠN 3000 ĐỊA ĐIỂM TẠI TP HCM</div>
			</div>
			<div class="attr-voucher-1 col-sm-4">
				<div class="image" align="center">
					<img class="img-responsive" src="<?php echo ASSETS;?>img/gift-o.png"/>
				</div>
				<div class="description text-brown" align="center">MÓN QUÀ Ý NGHĨA CHO NHỮNG DỊP VUI</div>
			</div>
			<div class="attr-voucher-1 col-sm-4">
				<div class="image" align="center">
					<img class="img-responsive" src="<?php echo ASSETS;?>img/truck-o.png"/>
				</div>
				<div class="description text-brown" align="center">ĐƯỢC GỬI THƯ ĐẢM BẢO MIỄN PHÍ</div>
			</div>
		</div>

		<div class="choice-voucher">
			<div class="choice-voucher-wrap clearfix">
				<h3 align="center" class="text-white">CHỌN MỘT THẺ QUÀ TẶNG Ý NGHĨA</h3>
				<div class="row" align="center">
					<ul class="list-inline" align="center">
						<li>	
							<button gift-price-data="200000" class="btn btn-default voucher-card-btn">
								<img class="btn-xeng" src="<?php echo ASSETS;?>img/xeng.png" />
								 200.000đ
							</button>
						</li>
						<li>	
							<button gift-price-data="500000" class="btn btn-default voucher-card-btn xeng">
								<img class="btn-xeng" src="<?php echo ASSETS;?>img/xeng.png" />
								500.000đ
							</button>
						</li>
						<li>	
							<button gift-price-data="1000000" class="btn btn-default voucher-card-btn">
								<img class="btn-xeng" src="<?php echo ASSETS;?>img/xeng.png" />
								1.000.000đ
							</button>
						</li>
						<li>	
							<button gift-price-data="5000000" class="btn btn-default voucher-card-btn">
								<img class="btn-xeng" src="<?php echo ASSETS;?>img/xeng.png" />
								5.000.000đ
							</button>
						</li>
						<li>	
							<button gift-price-data="8000000" class="btn btn-default voucher-card-btn">
								<img class="btn-xeng" src="<?php echo ASSETS;?>img/xeng.png" />
								8.000.000đ
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="gift-voucher-2">
		<div class="container" align="center">
			<p class="title" align="center">NHỮNG ĐỊA ĐIỂM CHẤP NHẬN THẺ QUÀ TẶNG TẠI TP HCM</p>
			<ul id="place_use_gift_voucher" class="list-inline" align="center">
				<!-- <li>
					<div align="center">
						<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS3dkwjx9g9FwH6d35p1xa-hCuY4Vc77ckIjObaxd4SrQPWxwY_6w">
						<p><small><b>Spa Sen</b><small></p>
					</div>
				</li> -->
			</ul>
		</div>
	</div>

	<div id="gift-voucher-3" class="container">
		<p class="title" align="center">- THÔNG TIN VỀ THẺ BLIZA -</p>
		<div class="list-aq clearfix">
			<div class="col-sm-6" style="border-right: 2px solid #CCC;">
				<dl>
				  	<dt>1. Question ?</dt>
				  	<dd>Answer...</dd>
				</dl>
				<dl>
				  	<dt>1. Question ?</dt>
				  	<dd>Answer...</dd>
				</dl>
				<dl>
				  	<dt>1. Question ?</dt>
				  	<dd>Answer...</dd>
				</dl>
			</div>
			<div class="col-sm-6">
				<dl>
				  	<dt>1. Question ?</dt>
				  	<dd>Answer...</dd>
				</dl>
				<dl>
				  	<dt>1. Question ?</dt>
				  	<dd>Answer...</dd>
				</dl>
			</div>
		</div>

	</div>
	<div id="gift_modal" style="z-index: 1051;" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-max-height="440">
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 0px;">
				<div class="modal-header" style="background-color: #FDBD0E; padding: 6px 10px;">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h5 class="modal-title" id="myModalLabel" style="text-align:center; font-weight:bold;">MUA GIFTVOUCHER</h5>
				</div>
				<div class="modal-body" style="padding: 30px 20px 0px;">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-sm-3">Tên người gửi</label>
							<div class="col-sm-8">
								<input autocomplete="off" class="form-control" type="text" id="gift_sender" name="gift_sender" placeholder="Nhập họ tên bạn..." />
								<small style="color: red;"></small>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Email gửi tặng</label>
							<div class="col-sm-8">
								<input autocomplete="off" class="form-control" type="text" id="gift_email" name="gift_email" placeholder="Nhập email...VD:abc@example.com" />
								<small style="color: red;"></small>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Hình thức</label>
							<div class="col-sm-8">
								<label class="radio-inline">
								  	<input type="radio" id="gift_send_mail" name="gift_send_type" class="gift_send_type" checked="checked" value="1"> <small>Gửi mail</small>
								</label>
								<label class="radio-inline">
								  	<input type="radio" id="gift_send_card" name="gift_send_type" class="gift_send_type" value="2"> <small>Gửi thiếp</small>
								</label>
								<small style="color: red;"></small>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ngày gửi tặng</label>
							<div class="col-sm-8">
								<input autocomplete="off" class="form-control" type="text" id="gift_date" name="gift_date" placeholder="Ngày gửi tặng" />
								<small style="color: red;"></small>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Lời nhắn</label>
							<div class="col-sm-8">
								<textarea style="max-width: 100%;min-width: 100%;min-height: 100px;" autocomplete="off" class="form-control" type="text" id="gift_message" name="gift_message" placeholder="Nhập lời nhắn..."></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Giá trị</label>
							<div class="col-sm-8" >
								<p style="padding-top: 8px;" id="gift_value"></p>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer" id="gift_footer" style="padding: 15px 20px 15px;">
					<small style="display: none;color: red;" id="error_message_gift"><i>Email không hợp lệ </i></small>
					<button type="button" id="gift_btn" onclick="saveGiftvoucher()" class="btn btn-sm btn-orange-black">
						<i style="display: none" id="waiting_for_gift" class="fa fa-refresh fa-spin"></i> Gửi tặng
					</button>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
						Hủy
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var GIFT_PRICE = '';
	var GIFT_TYPE = 1;
</script>