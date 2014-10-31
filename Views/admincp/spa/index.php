<div id="home-holder" class="content-holder pending">
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
	<div class="main-content">
		<div class="dashboard-actions clearfix">
			<div class="top-search home-search">
				<div class="txt-input">
					<input type="text" placeholder="Tìm kiếm: client, phone#, order#..." id="top-search" name="top-search" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
					<a class="clear-search" href="#" style="display: none;"><div class="icons-clear-search-mini"></div></a>
					<div class="search-loader" style="display: none;"></div>
				</div>
				<ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all search-results" role="listbox" aria-activedescendant="ui-active-menuitem" style="top: 0px; left: 0px; display: none;"></ul>
			</div>
		</div>

		<div class="content-box home-bookings b-home-bookings">
			<h2 class="box-hd"> Bookings chưa xác nhận <span class="amount v-count hidden" style="display: none;"></span></h2>
			<a class="view-all" href="<?php echo URL ."spaCMS/reports";?>">Xem tất cả bookings</a>
			<div class="data-table">
				<table>
					<tbody>
						<tr class="empty">
							<td> Không có vé bookings tại thời điểm này </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="stats-columns">
			<table>
				<tbody>
					<tr>
						<td class="content-box sales" id="monthly-sales"><h2 class="box-hd">Doanh số tháng này</h2>
						<div class="totals">
							<div class="stats-item">
								<span class="title">Tổng lượt bookings</span>
								<span class="value v-bookings">1</span>
							</div>
							<div class="stats-item">
								<span class="title">Tổng doanh số tài chính - Total transaction value</span>
								<span class="value v-ttv">£40.00</span>
							</div>
						</div>
						<div class="graph" id="monthly-sales-graph" style="min-height: 300px; position: relative;">
							<div dir="ltr" style="position: relative; width: 497px; height: 300px;">
								<div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
									<svg width="497" height="300" aria-label="A chart." style="overflow: hidden;">
										<defs id="defs">
											<clipPath id="_ABSTRACT_RENDERER_ID_0">
												<rect x="94" y="58" width="310" height="185"/>
											</clipPath>
										</defs>
										<rect x="0" y="0" width="497" height="300" stroke="none" stroke-width="0" fill="#ffffff"/>
										<g>
											<rect x="94" y="58" width="310" height="185" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/>
											<g clip-path="url(https://connect.wahanda.com/home#_ABSTRACT_RENDERER_ID_0)">
												<g>
													<rect x="94" y="242" width="310" height="1" stroke="none" stroke-width="0" fill="#cccccc"/>
													<rect x="94" y="196" width="310" height="1" stroke="none" stroke-width="0" fill="#cccccc"/>
													<rect x="94" y="150" width="310" height="1" stroke="none" stroke-width="0" fill="#cccccc"/>
													<rect x="94" y="104" width="310" height="1" stroke="none" stroke-width="0" fill="#cccccc"/>
													<rect x="94" y="58" width="310" height="1" stroke="none" stroke-width="0" fill="#cccccc"/>
												</g>
												<g>
													<rect x="124" y="242" width="95" height="0" stroke="none" stroke-width="0" fill="#ff9800"/>
													<rect x="278" y="242" width="95" height="0" stroke="none" stroke-width="0" fill="#ff9800"/>
													<rect x="124" y="242" width="95" height="0" stroke="none" stroke-width="0" fill="#adbd02"/>
													<rect x="278" y="242" width="95" height="0" stroke="none" stroke-width="0" fill="#adbd02"/>
													<rect x="124" y="59" width="95" height="183" stroke="none" stroke-width="0" fill="#546899"/>
													<rect x="278" y="59" width="95" height="183" stroke="none" stroke-width="0" fill="#546899"/>
												</g>
												<g>
													<rect x="94" y="242" width="310" height="1" stroke="none" stroke-width="0" fill="#333333"/>
												</g>
											</g>
											<g/>
											<g>
												<g>
													<text text-anchor="middle" x="171.75" y="260.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">
														Jul '14
													</text>
												</g>
												<g>
													<text text-anchor="middle" x="326.25" y="260.2" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#222222">
														Aug '14
													</text>
												</g>
												<g>
													<text text-anchor="end" x="82" y="246.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">
														0
													</text>
												</g>
												<g>
													<text text-anchor="end" x="82" y="200.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">
														10
													</text>
												</g>
												<g>
													<text text-anchor="end" x="82" y="154.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">
														20
													</text>
												</g>
												<g>
													<text text-anchor="end" x="82" y="108.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">
														30
													</text>
												</g>
												<g>
													<text text-anchor="end" x="82" y="62.7" font-family="Arial" font-size="12" stroke="none" stroke-width="0" fill="#444444">
														40
													</text>
												</g>
											</g>
										</g>
										<g/>
									</svg>
								</div>
							</div>
							<div style="display: none; position: absolute; top: 310px; left: 507px; white-space: nowrap; font-family: DINWebPro,Arial,Helvetica; font-size: 14px; font-weight: bold;">
								40
							</div><div></div>
						</div></td>
						<td class="empty"><span>&nbsp;</span></td>
						<td class="content-box tops">
						<div id="top-services">
							<h2 class="box-hd">Dịch vụ tốt nhất</h2>

							<table>
								<thead>
									<tr>
										<th class="box-subhd">Tìm xem số lượt được bookings</th>
										<td>Tháng
										<br>
										này</td>
										<td>Tháng
										<br>
										trước</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Body Wraps</th>
										<td>1</td>
										<td>1</td>
									</tr>
								</tbody>
							</table>
						</div><div class="box-separator"></div>


						<div id="top-performers hidden" style="display:none;">
							<h2 class="box-hd v-title">Top employees</h2>

							<table>
								<thead>
									<tr>
										<th class="box-subhd">By TTV</th>
										<td>This
										<br>
										month</td>
										<td>Last
										<br>
										month</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Sunspa Resort</th>
										<td>£40.00</td>
										<td>£40.00</td>
									</tr>
								</tbody>
							</table>
						</div></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="stats-marketplace hidden">
			<table>
				<tbody>
					<tr>
						<td id="bookings" title="<strong>Wahanda Bookings</strong> - Number of bookings done so far this month" class="b-bookings">
						<div class="graph graph-clicks">
							<span title="Mar 2014: 0" class="bar" style="height: 5%"></span><span title="Apr 2014: 0" class="bar" style="height: 5%"></span><span title="May 2014: 0" class="bar" style="height: 5%"></span><span title="Jun 2014: 0" class="bar" style="height: 5%"></span><span title="Jul 2014: 1" class="bar" style="height: 100%"></span><span title="Aug 2014: 1" class="bar" style="height: 100%"></span>
						</div>
						<div class="stats-item">
							<span class="title">Wahanda bookings</span>
							<span class="value v-value">1</span>
						</div></td>
						<td id="venue" title="<strong>Visits to Venue Page</strong> - Number of people who visited the venue page on Wahanda this month" class="tooltips tooltips-top b-visits">
						<div class="graph graph-visits">
							<span title="Mar 2014: 0" class="bar" style="height: 5%"></span><span title="Apr 2014: 0" class="bar" style="height: 5%"></span><span title="May 2014: 0" class="bar" style="height: 5%"></span><span title="Jun 2014: 0" class="bar" style="height: 5%"></span><span title="Jul 2014: 1" class="bar" style="height: 100%"></span><span title="Aug 2014: 0" class="bar" style="height: 5%"></span>
						</div>
						<div class="stats-item">
							<span class="title">Visits to Venue Page</span>
							<span class="value v-value">0</span>
						</div></td>
						<td id="phone" title="<strong>Phone views</strong> - Number of times customers clicked to see the phone number on the venue page this month" class="tooltips tooltips-top b-phoneViews">
						<div class="graph graph-pviews">
							<span title="Mar 2014: 0" class="bar" style="height: 5%"></span><span title="Apr 2014: 0" class="bar" style="height: 5%"></span><span title="May 2014: 0" class="bar" style="height: 5%"></span><span title="Jun 2014: 0" class="bar" style="height: 5%"></span><span title="Jul 2014: 0" class="bar" style="height: 5%"></span><span title="Aug 2014: 0" class="bar" style="height: 5%"></span>
						</div>
						<div class="stats-item">
							<span class="title">Phone views</span>
							<span class="value v-value">0</span>
						</div></td>
						<td id="sale" title="<strong>Enquiries</strong> - Number of sales leads sent from the venue page by Wahanda customers this month" class="tooltips tooltips-top b-enquiries">
						<div class="graph graph-enquiries">
							<span title="Mar 2014: 0" class="bar" style="height: 5%"></span><span title="Apr 2014: 0" class="bar" style="height: 5%"></span><span title="May 2014: 0" class="bar" style="height: 5%"></span><span title="Jun 2014: 0" class="bar" style="height: 5%"></span><span title="Jul 2014: 0" class="bar" style="height: 5%"></span><span title="Aug 2014: 0" class="bar" style="height: 5%"></span>
						</div>
						<div class="stats-item">
							<span class="title">Enquiries</span>
							<span class="value v-value">0</span>
						</div></td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
