<div class="sidebar">
		<div class="venue-info">
			
			<h1 class="venue-title v-venue-title"><?php echo Session::get('user_business_name'); ?></h1>

			<span>Loại tài khoản: </span><strong>Miễn phí</strong></br>
			<p><a href="#"><!-- Premium --></a></p></br>

			<div class="listing-type b-listing-type hidden" style="display: block;">
				<span class="type">Listing type: <strong class="v-listing-type">Enhanced</strong></span>
				<a class="more b-listing-link hidden a-upgrade-to-premium" href="javascript:;">Upgrade</a>
			</div>

			<a target="_blank" class="rating hidden"> <span class="value"></span> <span class="star-rating"><span class="star-rating-value" style=""></span></span> <span class="reviews"> <span class="review-count">Venue rating</span> <!-- <a href="#" class="new">3 new</a> --> </span> </a>

			<div class="review-request a-request-review hidden" style="">
				<a class="home-listing-block-enhanced-wrapper" href="javascript:;"> <div class="icon icons-review-request"></div> <span class="part-title">Want more reviews?</span> <span class="link-txt">Ask your customers</span> <span class="txt"></span> </a>
			</div>

			<button id="redeem" class="button button-primary redeem" type="button">
				<div class="button-inner">
					<div class="button-icon icons-voucher"></div>
					Xác thực eVoucher
				</div>
			</button>

			<ul class="action-links">
				<li>
					<a href="<?php echo URL . "spaCMS/settings";?>"> 
						<span class="icon icons-edit-link"></span> 
						<span class="link-txt">Chỉnh sửa thông tin địa điểm</span> 
					</a>
				</li>
				<li class="b-venue-page">
					<a class="l-venue-page" target="_blank" href="#"> 
						<span class="icon icons-web-link"></span> 
						<span class="link-txt">Xem địa điểm trên Beleza</span> 
					</a>
				</li>
			</ul>
		</div>

		<div class="onboard-wizard" style="display: block;">
			<h3 class="part-title">Your venue is not fully set up</h3>
			<ul class="action-links">
				<li>
					<a href="/settings#venue/285925"> <span class="icon icons-add-link"></span> <span class="link-txt">Add venue description</span> </a>
				</li>
				<li>
					<a href="/settings#venue/285925"> <span class="icon icons-add-link"></span> <span class="link-txt">Add venue images</span> </a>
				</li>
				<li>
					<a href="/settings#venue/285925/notifications-settings/fulfillment"> <span class="icon icons-add-link"></span> <span class="link-txt">Set fulfillment email address</span> </a>
				</li>
				<li>
					<a href="/settings#venue/285925/finance/bank-details"> <span class="icon icons-add-link"></span> <span class="link-txt">Add your bank account details</span> </a>
				</li>
			</ul>
		</div>

		<div class="home-contacts">
			<div class="part-title">
				Hỗ trợ quản lý dịch vụ?
			</div>
			<ul class="action-links">
				<li>
					<span class="no-link"> <span class="icon icons-phone-link-on"></span> <span class="link-txt">0973 708 1292</span> </span>
				</li>
				<li>
					<a href="mailto:info@sunstorydesign.net"> 
						<span class="icon icons-email-link"></span> 
						<span class="link-txt">info@sunstorydesign.net</span> 
					</a>
				</li>
				<li>
					<a href="https://www.wahanda.com/info/connect-faq/" target="_blank"> 
						<span class="icon icons-info-link"></span> 
						<span class="link-txt">Xem những hỏi-đáp thường gặp - FAQ</span> 
					</a>
				</li>
				<li>
					<a class="a-livechat" href="javascript:;"> 
						<span class="icon icons-chat-link"></span> 
						<span class="link-txt">Hỗ trợ trực tiếp</span> 
					</a>
				</li>
			</ul>
		</div>
	</div>