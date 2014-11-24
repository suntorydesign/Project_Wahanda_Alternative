<div id="settings-holder" class="content-holder">
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="settings-tabs">
		<div class="section-aside">
			<ul id="nav2" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
				<li id="venue-settings-tab" class="ui-state-default ui-corner-top active" >
					<a href="#venue-settings" style="position: relative;" role="tab" data-toggle="tab"> <div class="nav-icon icons-nav-venue"></div>
					<div class="title" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">
						Địa điểm
					</div> </a>
				</li>
				<li id="finance-tab" class="ui-state-default ui-corner-top">
					<a href="#finance" style="position: relative;" role="tab" data-toggle="tab"> <div class="nav-icon icons-nav-supplier"></div>
					<div class="title" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">
						Tài chính
					</div> </a>
				</li>
				<li id="notifications-settings-tab" class="ui-state-default ui-corner-top">
					<a href="#notifications-settings" style="position: relative;" role="tab" data-toggle="tab"> <div class="nav-icon icons-nav-notifications"></div>
					<div class="title" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">
						Thông báo
					</div> </a>
				</li>
				<li id="online-booking-tab" class="ui-state-default ui-corner-top">
					<a href="#online-booking" style="position: relative;" role="tab" data-toggle="tab"> <div class="nav-icon icons-nav-booking"></div>
					<div class="title" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">
						Online booking
					</div> </a>
				</li>
				<li id="security-tab" class="ui-state-default ui-corner-top">
					<a href="#security" style="position: relative;" role="tab" data-toggle="tab"> <div class="nav-icon icons-nav-employees"></div>
					<div class="title" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">
						Bảo mật
					</div> </a>
				</li>
			</ul>
		</div>

		<div class="tab-content section-main">

			<div class="tab-pane active" id="venue-settings">
				<div id="venue-settings-tabs" class="tabs-inner ui-tabs ui-widget ui-widget-content ui-corner-all">
					<div class="nav3">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top active">
								<a href="#venue-details" role="tab" data-toggle="tab">Địa điểm</a>
							</li>
							<li class="ui-state-default ui-corner-top">
								<a href="#opening-hours" role="tab" data-toggle="tab">Giờ mở cửa</a>
							</li>
							<!-- <li class="ui-state-default ui-corner-top">
								<a href="#policies" role="tab" data-toggle="tab">Policies</a>
							</li> -->
						</ul>
					</div>

					<div class="tab-content tab-content-fix">
						<div id="venue-details" class="tab-pane active">
							<form id="user_detail_form" action="<?php echo URL . 'spaCMS/settings/xhrUpdate_user_detail'?>" novalidate="novalidate">
								<div class="form-content">
									<div class="form-venue-details">
										<div class="venue-main-info">
											<div class="picture-logo">
												<img id="user_logo_thumbnail" class="logo-image" src="">
												<input type="hidden" name="user_logo">
												<div class="edit">
													<a id="iM_user_logo" class="set-logo imageManager_openModal" href="javascript:;" data-toggle="modal" data-target="#imageManager_modal" title="Sửa logo">
														<i class="fa fa-pencil"></i>
													</a>
												</div>
											</div>
											<table cellspacing="0" cellpadding="0" class="default-form">
												<tbody>
													<tr id="venue_name" title="&lt;strong&gt;Venue name&lt;/strong&gt; - Enter your venue name here - make sure it's all spelt correctly." class="form-row" aria-describedby="ui-tooltip-0">
														<td colspan="2">
														<div class="txt-input txt-input-big">
															<input type="text" id="" name="user_business_name" class="required">
														</div>
														<div class="part-of hidden">
															part of <span class="chain-name"></span>
														</div></td>
													</tr>
													<tr id="venue_type" title="&lt;strong&gt;Primary venue type&lt;/strong&gt; - Set the venue type here. If you can't find the exact type, choose the one that's closest to what you do." class="form-row" aria-describedby="ui-tooltip-1">
														<td class="label-part"><label for="user_business_id">Dịch vụ chính</label></td>
														<td class="input-part">
														<select id="user_type_business_id" name="user_type_business_id" class=""></select></td>
													</tr>
												</tbody>
											</table>
										</div>
										<table cellspacing="0" cellpadding="0" class="default-form">
											<tbody>
												<tr class="form-header-row">
													<td colspan="2">Địa điểm của bạn ở đâu?</td>
												</tr>
												<tr id="venue_address" title="&lt;strong&gt;Venue address&lt;/strong&gt; - You can include short instructions in the address such as &amp;#34;entrance on New Bond Street&amp;#34;" class="form-row" aria-describedby="ui-tooltip-4">
													<td class="label-part"><label for="user_address">Địa chỉ</label></td>
													<td class="input-part">
														<textarea max-text-lines="4" id="user_address" name="user_address" cols="5" rows="4" class="full required"></textarea>
													</td>
												</tr>
												<tr class="form-row">
													<td class="label-part"><label for="user_district_id">Quận</label></td>
													<td class="input-part">
													<select id="user_district_id" name="user_district_id" class="required">
														<option value="0">Chưa chọn</option>
													</select></td>
												</tr>
												<tr id="loc_map" title="&lt;strong&gt;Location on the map&lt;/strong&gt; - Click on the map to enlarge it and drag the pointer to the exact location of your venue." class="form-row">
													<td class="label-part"><label for="">Vị trí trên bản đồ</label></td>
													<td class="input-part">
														<div class="location-map-wrapper">
															<input type="hidden" name="user_lat" />
															<input type="hidden" name="user_long" />
															<img id="staticmap_img" alt="" src="">
															<div class="edit">
																<a id="btnOM_editUserMap" class="edit-location" href="javascript:;">Edit</a>
															</div>
														</div>
														<span class="location-txt hidden">Vietnam</span>
													</td>
												</tr>
												<tr class="form-separator-row">
													<td colspan="2"><span></span></td>
												</tr>
												<tr class="form-header-row">
													<td colspan="2">Thông tin liên hệ</td>
												</tr>
												<tr id="phone" title="&lt;strong&gt;Phone number&lt;/strong&gt; - Enter your reception phone number. This should be the number that your clients can call for any enquiries." class="form-row">
													<td class="label-part"><label for="user_phone">Số điện thoại</label></td>
													<td class="input-part">
													<div class="txt-input">
														<input type="text" id="user_phone" name="user_phone" class="required" phone-by-country-field="#venue-details-addressCountryCode">
													</div></td>
												</tr>
												<tr id="email" title="&lt;strong&gt;Email&lt;/strong&gt; - Enter the email address that customers can use to enquire about your services." class="form-row">
													<td class="label-part"><label for="user_email" class="optional">Email</label></td>
													<td class="input-part">
													<div class="txt-input">
														<input type="text" id="user_email" name="user_email" class="email" disabled>
													</div></td>
												</tr>
												<tr id="website" title="&lt;strong&gt;Website&lt;/strong&gt; - Enter the link to your venue's website." class="form-row">
													<td class="label-part"><label for="user_website" class="optional">Website</label></td>
													<td class="input-part">
													<div class="txt-input">
														<input type="text" id="user_website" name="user_website" class="">
													</div></td>
												</tr>
												<tr id="face" title="&lt;strong&gt;Facebook&lt;/strong&gt; - Enter the link to your venue's Facebook." class="form-row">
													<td class="label-part"><label for="user_facebook" class="optional">Trang Facebook</label></td>
													<td class="input-part">
													<div class="txt-input">
														<input type="text" id="user_facebook" name="user_facebook" class="">
													</div></td>
												</tr>
												<tr id="google" title="&lt;strong&gt;Google+&lt;/strong&gt; - Enter the link to your venue's Google+." class="form-row">
													<td class="label-part"><label for="user_googleplus" class="optional">Trang Google+</label></td>
													<td class="input-part">
													<div class="txt-input">
														<input type="text" id="user_googleplus" name="user_googleplus" class="">
													</div></td>
												</tr>
												<tr class="form-separator-row">
													<td colspan="2"><span></span></td>
												</tr>
												<tr id="description" title="&lt;strong&gt;Venue description&lt;/strong&gt; - Enter a few sentences about your venue - those with good descriptions always receive more bookings." class="form-header-row">
													<td colspan="2"><label for="user_description">Mô tả về địa điểm/dịch vụ của bạn</label></td>
												</tr>
												<tr data-tooltip="&lt;strong&gt;Venue description&lt;/strong&gt; - Enter a few sentences about your venue - those with good descriptions always receive more bookings." class="form-row">
													<td colspan="2" class="input-part">
														<textarea max-text-lines="4" id="user_description" name="user_description" cols="5" rows="4" class="full required"></textarea>
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
									<div class="form-venue-pictures ui-sortable">
										<div class="part-title">
											Ảnh địa điểm
										</div>
										<ul class="menu-item-pictures">
											<div class="list_user_slide">
												
											</div>
											

											<li class="single-picture empty">
												<div id="iM_user_slide" class="single-picture-wrapper imageManager_openModal" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
													<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
														<div class="icon icons-plus3"></div>
														Thêm ảnh
													</div>
												</div>
											</li>
										</ul>
									</div>
									<div class="top-shadow" style="width: 606px;"></div>
									<div class="bottom-shadow" style="width: 606px;"></div>
								</div>

								<div class="form-actions">
									<button class="button action action-default button-primary save-action" type="submit">
										<div class="button-inner">
											<div class="button-icon icons-tick done"></div>
											<div class="button-icon fa fa-spin fa-refresh loading" style="display: none;"></div>
											<span class="msg msg-action-default">Lưu</span>
										</div>
									</button>
									<!-- <a target="_blank" class="button-link preview-link" href="http://www.wahanda.com/place/sunspa-resort/overview/">Preview on Wahanda</a> -->
								</div>
							</form>
						</div><!-- END VENUA DETAILS -->

						<div id="opening-hours" class="tab-pane ">
							<form id="user_open_hour_form" method="GET">
							<div class="form-content">
								<ul class="form-list">
									<li data-tooltip="&lt;strong&gt;Business hours&lt;/strong&gt; - Define what days and times your venue is open. This will show up in your Wahanda.com listing and will be used for appointment bookings." class="special" aria-describedby="ui-tooltip-172">
										<div class="label-column">
											Business hours
										</div>
										<ul class="week">
										</ul>
									</li>
									<li data-tooltip="&lt;strong&gt;Time zone&lt;/strong&gt; - Set the timezone that your venue is operating in." aria-describedby="ui-tooltip-173">
										<label class="label-column" for="time-zone">Time zone</label>
										<select id="time-zone">
											<option selected="selected" value="21">Vietnam Time</option>
										</select>
									</li>
								</ul>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading" style="display: none;"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END OPEN HOUR -->

						<div id="policies" class="tab-pane hidden">
							<div class="form-content">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<!-- Appointment policies -->
									<tbody>
										<tr class="form-header-row">
											<td colspan="2">Appointment policies</td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;eVoucher validity&lt;/strong&gt; - Set how eVouchers expire by default. This can be changed for individual services." class="form-row for-with-supplier">
											<td class="label-part"><label for="policies-voucherValidityMonths">eVoucher validity</label></td>
											<td class="input-part">
											<div class="txt-input txt-input-mini">
												<input type="text" max="24" min="1" id="policies-voucherValidityMonths" name="voucherValidityMonths" class="required digits">
											</div><span class="help-txt">months</span></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Allow cancellations?&lt;/strong&gt; - Set to Yes if you agree to refund appointments when a client complies to the cancellation policy set below." class="form-row">
											<td class="label-part"><label for="">Allow cancellations?</label></td>
											<td data-related="b-appointment-cancellation" class="input-part b-related-cancellation-toggle">
											<div class="several">
												<input type="radio" value="1" id="appointment-allowCancellation-yes" name="appointment-allowCancellation" class="required">
												<label for="appointment-allowCancellation-yes">Yes</label>

												<input type="radio" value="0" id="appointment-allowCancellation-no" name="appointment-allowCancellation" class="required">
												<label for="appointment-allowCancellation-no">No</label>
											</div></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Cancellation period&lt;/strong&gt; - Set the number of hours' notice that a client must give in order to cancel and be eligible for a refund." class="form-row b-appointment-cancellation">
											<td class="label-part"><label for="appointment-cancellationPeriodHours">Cancellation period</label></td>
											<td class="input-part">
											<div class="txt-input txt-input-mini">
												<input type="text" max="168" min="0" id="appointment-cancellationPeriodHours" name="appointment-cancellationPeriodHours" class="required digits">
											</div><span class="help-txt">hours</span></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Cancellation policy&lt;/strong&gt; - Set your venue's cancellation policy, stating your terms and conditions for cancelling appointments." class="form-row b-appointment-cancellation">
											<td class="label-part"><label for="appointment-cancellationPolicy" class="optional">Cancellation policy</label></td>
											<td class="input-part">
											<div class="">
												<textarea id="appointment-cancellationPolicy" name="appointment-cancellationPolicy" rows="3" class="full" cols="30"></textarea>
											</div></td>
										</tr>
										<!-- Spa Day policies -->
										<tr class="form-separator-row">
											<td colspan="2"><span></span></td>
										</tr>
										<tr class="form-header-row">
											<td colspan="2">Spa Day policies</td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Spa Day arrival time&lt;/strong&gt; - Used for Spa Day services on the website. Part of your general service terms and conditions." class="form-row">
											<td class="label-part"><label for="spa-day-spaDayCheckinTime" class="optional">Arrival time</label></td>
											<td class="input-part">
											<select id="spa-day-spaDayCheckinTime" name="spaDayCheckinTime">
												<option value="">Not set</option>
												<option value="07:00">07:00</option>
												<option value="08:00">08:00</option>
												<option value="09:00">09:00</option>
												<option value="10:00">10:00</option>
												<option value="11:00">11:00</option>
												<option value="12:00">12:00</option>
												<option value="13:00">13:00</option>
												<option value="14:00">14:00</option>
												<option value="15:00">15:00</option>
												<option value="16:00">16:00</option>
												<option value="17:00">17:00</option>
												<option value="18:00">18:00</option>
												<option value="19:00">19:00</option>
												<option value="20:00">20:00</option>
												<option value="21:00">21:00</option>
												<option value="22:00">22:00</option>
											</select></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Spa Day departure time&lt;/strong&gt; - Used for Spa Day services on the website. Part of your general service terms and conditions." class="form-row">
											<td class="label-part"><label for="spa-day-spaDayCheckoutTime" class="optional">Departure time</label></td>
											<td class="input-part">
											<select id="spa-day-spaDayCheckoutTime" name="spaDayCheckoutTime">
												<option value="">Not set</option>
												<option value="07:00">07:00</option>
												<option value="08:00">08:00</option>
												<option value="09:00">09:00</option>
												<option value="10:00">10:00</option>
												<option value="11:00">11:00</option>
												<option value="12:00">12:00</option>
												<option value="13:00">13:00</option>
												<option value="14:00">14:00</option>
												<option value="15:00">15:00</option>
												<option value="16:00">16:00</option>
												<option value="17:00">17:00</option>
												<option value="18:00">18:00</option>
												<option value="19:00">19:00</option>
												<option value="20:00">20:00</option>
												<option value="21:00">21:00</option>
												<option value="22:00">22:00</option>
											</select></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="">Allow cancellations?</label></td>
											<td data-related="b-spa-day-cancellation" class="input-part b-related-cancellation-toggle">
											<div class="several">
												<input type="radio" value="1" id="spa-day-allowCancellation-yes" name="spa-day-allowCancellation" class="required">
												<label for="spa-day-allowCancellation-yes">Yes</label>

												<input type="radio" value="0" id="spa-day-allowCancellation-no" name="spa-day-allowCancellation" class="required">
												<label for="spa-day-allowCancellation-no">No</label>
											</div></td>
										</tr>
										<tr class="form-row b-spa-day-cancellation">
											<td class="label-part"><label for="spa-day-cancellationPeriodDays">Cancellation period</label></td>
											<td class="input-part">
											<div class="txt-input txt-input-mini">
												<input type="text" max="21" min="1" id="spa-day-cancellationPeriodDays" name="spa-day-cancellationPeriodDays" class="required digits">
											</div><span class="help-txt">days</span></td>
										</tr>
										<tr class="form-row b-spa-day-cancellation">
											<td class="label-part"><label for="spa-day-cancellationPolicy" class="optional">Cancellation policy</label></td>
											<td class="input-part">
											<div class="">
												<textarea id="spa-day-cancellationPolicy" name="spa-day-cancellationPolicy" rows="3" class="full" cols="30"></textarea>
											</div></td>
										</tr>
										<!-- Spa Break policies -->
										<tr class="form-separator-row b-for-dated hidden">
											<td colspan="2"><span></span></td>
										</tr>
										<tr class="form-header-row b-for-dated hidden">
											<td colspan="2">Overnight Stay policies</td>
										</tr>
										<tr class="form-row b-for-dated hidden">
											<td class="label-part"><label for="spa-break-checkinTime" class="optional">Check in</label></td>
											<td class="input-part">
											<select id="spa-break-checkinTime" name="checkinTime">
												<option value="">Not set</option>
												<option value="07:00">07:00</option>
												<option value="08:00">08:00</option>
												<option value="09:00">09:00</option>
												<option value="10:00">10:00</option>
												<option value="11:00">11:00</option>
												<option value="12:00">12:00</option>
												<option value="13:00">13:00</option>
												<option value="14:00">14:00</option>
												<option value="15:00">15:00</option>
												<option value="16:00">16:00</option>
												<option value="17:00">17:00</option>
												<option value="18:00">18:00</option>
												<option value="19:00">19:00</option>
												<option value="20:00">20:00</option>
												<option value="21:00">21:00</option>
												<option value="22:00">22:00</option>
											</select></td>
										</tr>
										<tr class="form-row b-for-dated hidden">
											<td class="label-part"><label for="spa-break-checkoutTime" class="optional">Check out</label></td>
											<td class="input-part">
											<select id="spa-break-checkoutTime" name="checkoutTime">
												<option value="">Not set</option>
												<option value="07:00">07:00</option>
												<option value="08:00">08:00</option>
												<option value="09:00">09:00</option>
												<option value="10:00">10:00</option>
												<option value="11:00">11:00</option>
												<option value="12:00">12:00</option>
												<option value="13:00">13:00</option>
												<option value="14:00">14:00</option>
												<option value="15:00">15:00</option>
												<option value="16:00">16:00</option>
												<option value="17:00">17:00</option>
												<option value="18:00">18:00</option>
												<option value="19:00">19:00</option>
												<option value="20:00">20:00</option>
												<option value="21:00">21:00</option>
												<option value="22:00">22:00</option>
											</select></td>
										</tr>
										<tr class="form-row b-for-dated hidden">
											<td class="label-part"><label for="">Allow cancellations?</label></td>
											<td data-related="b-spa-break-cancellation" class="input-part b-related-cancellation-toggle">
											<div class="several">
												<input type="radio" value="1" id="spa-break-allowCancellation-yes" name="spa-break-allowCancellation" class="required">
												<label for="spa-break-allowCancellation-yes">Yes</label>

												<input type="radio" value="0" id="spa-break-allowCancellation-no" name="spa-break-allowCancellation" class="required">
												<label for="spa-break-allowCancellation-no">No</label>
											</div></td>
										</tr>
										<tr class="form-row b-for-dated b-spa-break-cancellation hidden" style="display: none;">
											<td class="label-part"><label for="spa-break-cancellationPeriodDays">Cancellation period</label></td>
											<td class="input-part">
											<div class="txt-input txt-input-mini">
												<input type="text" max="21" min="1" id="spa-break-cancellationPeriodDays" name="spa-break-cancellationPeriodDays" class="required digits">
											</div><span class="help-txt">days</span></td>
										</tr>
										<tr class="form-row b-for-dated b-spa-break-cancellation hidden" style="display: none;">
											<td class="label-part"><label for="spa-break-cancellationPolicy" class="optional">Cancellation policy</label></td>
											<td class="input-part">
											<div class="">
												<textarea id="spa-break-cancellationPolicy" name="spa-break-cancellationPolicy" rows="3" class="full" cols="30"></textarea>
											</div></td>
										</tr>
										<!-- Other policies -->
										<tr class="form-separator-row">
											<td colspan="2"><span></span></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Minimum age&lt;/strong&gt; - Set if you have any restrictions regarding customer age range in your venue." class="form-row">
											<td class="label-part"><label for="policies-minimumClientAge" class="optional">Minimum age</label></td>
											<td class="input-part">
											<select id="policies-minimumClientAge" name="minimumClientAge" class="full">
												<option value="0">Not set</option>
												<option>5</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>9</option>
												<option>10</option>
												<option>11</option>
												<option>12</option>
												<option>13</option>
												<option>14</option>
												<option>15</option>
												<option>16</option>
												<option>17</option>
												<option>18</option>
												<option>19</option>
												<option>20</option>
												<option>21</option>
												<option>22</option>
												<option>23</option>
												<option>24</option>
												<option>25</option>
											</select></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Other venue policies&lt;/strong&gt; - Use this field to set out other venue policies such as underwear requirements, mobile phone usage and more." class="form-row">
											<td class="label-part"><label for="policies-otherPolicies" class="optional">Other policies</label></td>
											<td class="input-part">											<textarea id="policies-otherPolicies" name="otherPolicies" cols="5" rows="3" class="full"></textarea></td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
						</div><!-- END POLICIES -->

					</div>
				</div>
			</div>
			<!-- END VENUE SETTINGS -->

			<div class="tab-pane" id="finance">
				<div id="finance-tabs" class="tabs-inner ui-tabs ui-widget ui-widget-content ui-corner-all">
					<div class="nav3">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top active">
								<a href="#billing-details" role="tab" data-toggle="tab">Thông tin doanh nghiệp</a>
							</li>
							<li class="ui-state-default ui-corner-top">
								<a href="#bank-details" role="tab" data-toggle="tab">Thông tin ngân hàng</a>
							</li>
						</ul>
					</div>

					<div class="tab-content tab-content-fix">
						<div id="billing-details" class="tab-pane active">
							<form id="user_company_form" method="GET" action="#">
							<div class="form-content">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="user_company_name">Tên công ty</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_company_name" name="user_company_name" >
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_company_delegate" class="optional">Người đại diện</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_company_delegate" name="user_company_delegate" class="alphanumeric">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_company_tax_code" class="optional">Mã số thuế</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_company_tax_code" name="user_company_tax_code" class="alphanumeric">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_company_address">Địa chỉ</label></td>
											<td class="input-part">
												<textarea max-text-lines="4" id="user_company_address" name="user_company_address" rows="4" class="full required"></textarea>
											</td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_company_country_id">Quốc gia</label></td>
											<td class="input-part">
												<select id="user_company_country_id" name="user_company_country_id" class="required">
													<option value="">Not set</option>
												</select>
											</td>
										</tr>
										<tr class="form-separator-row">
											<td colspan="2"><span></span></td>
										</tr>
										<tr class="form-header-row">
											<td colspan="2">Thông tin người liên hệ</td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_contact_name">Tên người liên hệ</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_contact_name" name="user_contact_name" class="required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_contact_email">Email</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_contact_email" name="user_contact_email" class="email required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_contact_phone">Số điện thoại</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_contact_phone" name="user_contact_phone" class="required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_contact_role">Chức vụ</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_contact_role" name="user_contact_role" class="required">
											</div></td>
										</tr>
									</tbody>
								</table>

							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading" style="display:none"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END BILLING DETAILS -->

						<div id="bank-details" class="tab-pane">
							<form id="user_bank_acc_form" method="POST" action="#">
							<div class="form-content">
								<div class="content-note">
									<div class="icons-info"></div>
									<p class="main-txt">
										Bộ phận kế toán sẽ thực hiện việc chuyển khoản, thanh toán cho những vé đặt và voucher được bán thông qua W.A. Điều khoản thanh toán:
									</p>
									<div class="b-payment-term b-payment-por">
										<ul class="simple-list">
											<li>
												eVouchers sẽ được thanh toán trong vòng <strong>15 ngày</strong> sau khi được xác thực trên hệ thống booking của W.A
											</li>
											<li>
												All dated services will be automatically paid <strong>15 days</strong> after the date of the appointment/check in.
											</li>
										</ul>
									</div>
								</div>
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="user_bank_acc_owner">Tên chủ sở hữu</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_bank_acc_owner" name="user_bank_acc_owner" class="required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_bank_acc">Số tài khoản</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_bank_acc" name="user_bank_acc" class="required account-no">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_bank_branch">Chi nhánh</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_bank_branch" name="user_bank_branch" class="required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_bank_name">Tên ngân hàng</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="text" id="user_bank_name" name="user_bank_name" class="required">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_bank_address">Địa chỉ chi nhánh</label></td>
											<td class="input-part">											
												<textarea max-text-lines="4" id="user_bank_address" name="user_bank_address" rows="4" class="full required"></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading" style="display:none"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END BANK DETAILS -->
					</div>
				</div>
			</div>
			<!-- END FINANCE SETTINGS -->

			<div class="tab-pane" id="notifications-settings">
				<div id="notifications-settings-tabs" class="tabs-inner ui-tabs ui-widget ui-widget-content ui-corner-all">
					<div class="nav3">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top hidden">
								<a href="#client-notifications" role="tab" data-toggle="tab">Thông báo cho khách hàng</a>
							</li>
							<li class="ui-state-default ui-corner-top active">
								<a href="#fulfillment" role="tab" data-toggle="tab">Thông báo cho bạn</a>
							</li>
						</ul>
					</div>

					<div class="tab-content tab-content-fix">
						<div id="client-notifications" class="tab-pane ">
							<div class="form-content">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="second-txt">
										Khi chúng tôi nhận được đơn hàng từ khách hàng, chúng tôi sẽ gửi email cho bạn. Bạn có thể tùy chỉnh email bạn sử dụng để kiểm tra những thông tin này.
									</p>
								</div>
								<div class="text-message-settings">
									<div class="part-title">Text message settings</div>
									<div class="content-note b-premium" style="margin-left: 0px;">
										<div class="icon icons-info"></div>
										<p class="second-txt">
											Text reminders to clients are available for premium venues only.<br>
											<a class="a-upgrade-dialog" href="#">Read more...</a>
										</p>
									</div>
									<div class="send-text-reminder b-for-premium">
										<input type="checkbox" value="true" name="client-notifications-sendSmsReminders" id="client-notifications-sendSmsReminders">
										<label for="client-notifications-sendSmsReminders">Send text message reminder</label>

										<div class="txt-input txt-input-mini"><input type="text" min="1" class="digits required" name="client-notifications-smsReminderHours" id="client-notifications-smsReminderHours"></div>
										<label for="client-notifications-smsReminderHours">hour(s) before appointment</label>
									</div>
									<div class="send-messages-from b-for-premium">
										<label for="client-notifications-smsFromNumber">Send messages from this number:</label>
										<div class="txt-input"><input type="text" class="mobile-phone-by-country" name="client-notifications-smsFromNumber" id="client-notifications-smsFromNumber"></div>
									</div>
								</div>
								<div class="separating-line"></div>
								<div class="email-settings">
									<div class="part-title">Email settings</div>
									<div class="send-confirmations">
										<input type="checkbox" value="true" name="client-notifications-sendEmailNotifications" id="client-notifications-sendEmailNotifications">
										<label for="client-notifications-sendEmailNotifications">Gởi email xác nhận đến khách hàng về việc được xác nhận, đổi lịch hoặc hủy đặt cuộc hẹn dịch vụ</label>
									</div>
									<div class="send-reminder">
										<input type="checkbox" value="true" name="client-notifications-sendEmailReminders" id="client-notifications-sendEmailReminders">
										<label for="client-notifications-sendEmailReminders">Gửi email thông báo trước</label>

										<div class="txt-input txt-input-mini"><input type="text" min="1" class="digits required" name="client-notifications-emailReminderHours" id="client-notifications-emailReminderHours"></div>
										<label for="client-notifications-emailReminderHours">giờ(s) theo lịch hẹn</label>
									</div>
									<div class="input-row">
										<input type="checkbox" value="true" name="client-notifications-directReviewRequestEnabled" id="client-notifications-directReviewRequestEnabled">
										<label for="client-notifications-directReviewRequestEnabled">Gửi email khuyến khích khách hàng đăng bài dịch vụ</label>
										<p class="small-note">Chúng tôi sẽ gửi mail đề nghị khách hàng đăng đánh giá dịch vụ của bạn trên W.A. Bạn có thể bỏ chọn để không thực hiện thao tác này.</p>
									</div>
								</div>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading" style="display:none"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
						</div><!-- END Client Notifications -->

						<div id="fulfillment" class="tab-pane active">
							<form id="user_notification_form" action="#" method="POST" >
							<div class="form-content">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="second-txt">
										Khi chúng tôi nhận được đơn hàng từ khách hàng, chúng tôi sẽ gửi email cho bạn. Bạn có thể tùy chỉnh email bạn sử dụng để kiểm tra những thông tin này.
									</p>
								</div>

								<div class="email-settings">
									<div class="part-title">
										Email settings
									</div>
									<table cellspacing="0" cellpadding="0" class="default-form">
										<tbody>
											<tr class="form-row for-appointments">
												<td class="label-part"><label for="notifications-settings-address">Địa chỉ email của bạn</label></td>
												<td class="input-part">
												<div class="txt-input">
													<input type="email" id="notifications-settings-address" name="user_notification_email" required>
												</div></td>
											</tr>
											<tr class="form-row hidden">
												<td class="label-part"><label for="notifications-settings-method">Email format</label></td>
												<td class="input-part">
												<select id="notifications-settings-method" name="notifications-settings-method" class="full">
													<option value="EMH">HTML</option>
													<option value="EMT">Plain text</option>
												</select></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="separating-line"></div>
								<div class="text-message-settings">
									<div class="part-title">
										Text message settings
									</div>
									<div class="send-sms" >
										<input type="checkbox" disabled="disabled" value="true" name="client-notifications-sendSMS" id="client-notifications-sendSMS">
										<label for="client-notifications-sendSMS">Gửi tin nhắn SMS khi có booking từ Beleza</label>
									</div>
									<table cellspacing="0" cellpadding="0" class="default-form hidden">
										<tbody>
											<tr class="form-row for-appointments">
												<td class="label-part"><label for="appointmentBookingNotificationSms">Phone number to send appointment confirmations to</label></td>
												<td class="input-part">
												<div class="txt-input">
													<input type="text" id="appointmentBookingNotificationSms" name="appointmentBookingNotificationSms" class="mobile-phone-by-country required disabled" disabled="">
												</div></td>
											</tr>
											<tr class="form-row">
												<td class="label-part"><label for="datedBookingNotificationSms">Phone number to send overnight/dated confirmations to</label></td>
												<td class="input-part">
												<div class="txt-input">
													<input type="text" id="datedBookingNotificationSms" name="datedBookingNotificationSms" class="mobile-phone-by-country required disabled" disabled="">
												</div></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div>
						<!-- END Contact You -->
					</div>
				</div>
			</div><!-- END NOTIFICATIONS SETTINGS -->

			<div class="tab-pane" id="online-booking">
				<div id="online-booking-tabs" class="tabs-inner ui-tabs ui-widget ui-widget-content ui-corner-all">
					<div class="nav3">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top active">
								<a href="#online-booking-settings" role="tab" data-toggle="tab">Cài đặt</a>
							</li>
						</ul>
					</div>

					<div class="tab-content tab-content-fix">
						<div id="online-booking-settings" class="tab-pane active">
							<form id="editOBs_form" action="#" method="POST">
							<div class="form-content">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="main-txt">
										Bạn có thể thiết lập cách khách hàng của bạn đặt dịch vụ thông qua website Beleza
									</p>
									</br>
								</div>
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr data-tooltip="&lt;strong&gt;Lead time&lt;/strong&gt; - Set how soon the first time slot is available for online bookings. Bigger values prevent last minute bookings." class="form-row">
											<td class="label-part"><label for="booking-settings-onlineBookingMinHours">Thời gian tối thiểu trước dịch vụ</label></td>
											<td class="input-part">
											<select id="booking-settings-onlineBookingMinHours" name="user_limit_before_service" class="required">
												<option value="0">Chưa chọn</option><option value="60">1 tiếng</option><option value="120">2 tiếng</option><option value="180">3 tiếng</option><option value="240">4 tiếng</option><option value="300">5 tiếng</option><option value="360">6 tiếng</option><option value="420">7 tiếng</option><option value="480">8 tiếng</option><option value="1440">1 ngày</option><option value="2880">2 ngày</option><option value="4320">3 ngày</option><option value="7200">5 ngày</option><option value="10080">1 tuần</option><option value="20160">2 tuần</option><option value="30240">3 tuần</option><option value="40320">4 tuần</option>
											</select></td>
										</tr>
										<tr data-tooltip="&lt;strong&gt;Online booking limit&lt;/strong&gt; - Set how far in future your clients can book online." class="form-row">
											<td class="label-part"><label for="policies-onlineBookingMaxDays">Giới hạn thời gian booking tối đa</label></td>
											<td class="input-part">
											<div class="txt-input txt-input-mini">
												<input type="number" max="365" min="1" id="policies-onlineBookingMaxDays" name="user_limit_before_booking" required class="required digits" title="Nhập số ngày">
											</div><span class="help-txt">ngày trong tương lai</span></td>
										</tr>
										<tr class="form-row">
											<td class="label-part">
												<input type="checkbox" value="true" name="user_is_use_gvoucher" id="user_is_use_gvoucher">
												<label for="user_is_use_gvoucher"> Đồng ý sử dụng Gift Vouchers </label>
											</td>
										</tr>
										<tr class="form-row">
											<td class="label-part">
												<input type="checkbox" value="true" name="user_is_use_evoucher" id="user_is_use_evoucher">
												<label for="user_is_use_evoucher"> Đồng ý sử dụng eVoucher </label>
											</td>
										</tr>
										<tr class="form-row">
											<td class="label-part">
												<input type="checkbox" value="true" name="user_is_use_appointment" id="user_is_use_appointment">
												<label for="user_is_use_appointment"> Đồng ý sử dụng Appointment </label>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div>

						<!-- GIFT VOUCHERS -->
						<div id="online-booking-gvoucher" class="tab-pane">
							<form id="user_is_use_gvoucher_form" action="#" method="POST">
							<div class="data-content" style="top: 32px;">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="main-txt">
										The Wahanda Gift Voucher is the UK’s most widely accepted beauty and wellness voucher
									</p>
									<p class="second-txt">
										It is used as full or part payment for your full price treatments/packages. If a client doesn’t use the full voucher there’s no obligation to offer change, but you can give credit towards a future appointment to encourage repeat business. If they spend over the voucher value, you collect the difference from them direct. To accept our Voucher and enjoy the extra revenue this will bring, tick the box below.
									</p>
								</div>
								<div class="enabler">
									<input type="checkbox" value="true" name="user_is_use_gvoucher" id="user_is_use_gvoucher">
									<label for="user_is_use_gvoucher"> Đồng ý sử dụng Gift Vouchers </label>
								</div>
							</div>
							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END GIFT VOUCHERS -->

						<!-- EVOUCHERS -->
						<div id="online-booking-evoucher" class="tab-pane">
							<form id="user_is_use_evoucher_form" action="#" method="POST">
							<div class="data-content" style="top: 32px;">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="main-txt">
										The Wahanda Gift Voucher is the UK’s most widely accepted beauty and wellness voucher
									</p>
									<p class="second-txt">
										It is used as full or part payment for your full price treatments/packages. If a client doesn’t use the full voucher there’s no obligation to offer change, but you can give credit towards a future appointment to encourage repeat business. If they spend over the voucher value, you collect the difference from them direct. To accept our Voucher and enjoy the extra revenue this will bring, tick the box below.
									</p>
								</div>
								<div class="enabler">
									<input type="checkbox" value="true" name="user_is_use_evoucher" id="user_is_use_evoucher">
									<label for="user_is_use_evoucher"> Đồng ý sử dụng eVoucher </label>
								</div>
							</div>
							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END EVOUCHERS -->

						<!-- APPOINTMENT -->
						<div id="online-booking-appointment" class="tab-pane">
							<form id="user_is_use_appointment_form" action="#" method="POST">
							<div class="data-content" style="top: 32px;">
								<div class="content-note">
									<div class="icon icons-info"></div>
									<p class="main-txt">
										The Wahanda Gift Voucher is the UK’s most widely accepted beauty and wellness voucher
									</p>
									<p class="second-txt">
										It is used as full or part payment for your full price treatments/packages. If a client doesn’t use the full voucher there’s no obligation to offer change, but you can give credit towards a future appointment to encourage repeat business. If they spend over the voucher value, you collect the difference from them direct. To accept our Voucher and enjoy the extra revenue this will bring, tick the box below.
									</p>
								</div>
								<div class="enabler">
									<input type="checkbox" value="true" name="user_is_use_appointment" id="user_is_use_appointment">
									<label for="user_is_use_appointment"> Đồng ý sử dụng Appointment </label>
								</div>
							</div>
							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
							</form>
						</div><!-- END APPOINTMENT -->
					</div>
				</div>
			</div><!-- END BOOKING SETTINGS -->

			<div class="tab-pane" id="security">
				<div id="security-tabs" class="tabs-inner ui-tabs ui-widget ui-widget-content ui-corner-all">
					<div class="nav3">
						<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
							<li class="ui-state-default ui-corner-top active">
								<a href="#security-password" role="tab" data-toggle="tab">Mật khẩu</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="tab-content tab-content-fix">
					<div id="security-password" class="tab-pane active">
						<form id="security_password_form" method="POST" action="#">
							<div class="form-content">
								<div class="warning warning-archived warning_notmatch">
									<div class="icon icons-lock"></div>
									<span class="title">Mật khẩu xác thực không trùng khớp</span>
									<!-- <div class="info">Vui lòng tắt.</div> -->
								</div>
								<div class="warning warning-archived warning_error">
									<div class="icon icons-lock"></div>
									<span class="title">Mật khẩu hiện tại không chính xác</span>
									<!-- <div class="info">Vui lòng tắt.</div> -->
								</div>
								<table cellspacing="0" cellpadding="0" class="default-form" style="width:508px;">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="user_password">Mật khẩu hiện tại</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="password" id="user_password" name="user_password" required pattern=".{6,}" title="Ít nhất 6 ký tự">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_password_new" class="optional">Mật khẩu mới </label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="password" id="user_password_new" name="user_password_new" required pattern=".{6,}" title="Ít nhất 6 ký tự">
											</div></td>
										</tr>
										<tr class="form-row">
											<td class="label-part"><label for="user_password_new_confirm" class="optional">Nhập lại</label></td>
											<td class="input-part">
											<div class="txt-input">
												<input type="password" id="user_password_new_confirm" name="user_password_new_confirm" required pattern=".{6,}" title="Ít nhất 6 ký tự">
											</div></td>
										</tr>
									</tbody>
								</table>

							</div>

							<div class="form-actions">
								<button class="button action action-default button-primary save-action" type="submit">
									<div class="button-inner">
										<div class="button-icon icons-tick done"></div>
										<div class="button-icon fa fa-spin fa-refresh loading"></div>
										<span class="msg msg-action-default">Lưu</span>
									</div>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- END SECURITY -->
		</div>
	</div>
</div>



<!-- Image Manager Modal -->
<div class="modal fade" id="imageManager_modal" tabindex="-1" role="dialog" aria-labelledby="imageManager_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="imageManager_modalLabel">Upload image</h4>
      </div>
      <div class="modal-body">
        <div id="imageManager_descriptionImage">
            <div id="imageManager_descriptionImage-content">
                <strong>Image title:</strong> </br>
                <span class="cover_title"></span>
                <div>
                    <h6>Image name: </h6><h6 class="cover_image_name"> </h6>
                    <h6>Image size: </h6><h6 class="cover_image_size"> </h6>
                    <h6>Thumbnail: </h6><h6 class="cover_thumbnail_name"> </h6>
                </div>
            </div>
            <button type="button" id="imageManager_removeImage" class="btn btn-sm btn-danger pull-left" disabled="disabled"><i class="fa fa-trash-o"></i> Remove</button>
        </div>
        <div id="imageManager_allImage">
            <!-- All image show here --> 
                
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer" style="margin-top: 0px;">
        <div class="col-md-9" style="border-right: 1px solid #CCC; margin-bottom: 10px;">
            <form id="imageManager_uploadForm" method="post" action="upload.php" enctype="multipart/form-data">
                
                <div id="upload_imagePreview" class="pull-left" >
                    <img src="" style="width: 127px; height: 70px;"/>
                </div>
                <div class="pull-left" align="left" style="margin-left: 10px; width: 120px;">
                    <span class="btn btn-sm btn-success fileinput-button" style="margin-bottom: 11px;">
                        <i class="fa fa-plus"></i>
                        <span>Add file ...</span>
                        <input type="file" name="file" id="imageManger_inputFile" >
                    </span>
                    </br>
                    <button type="submit" class="btn btn-sm btn-primary" value="Upload" id="imageManager_startUpload" >
                        <i class="fa fa-upload"></i>
                        <span>Start upload</span>
                    </button>
                </div>
                <div class="pull-left" style="width: 315px">
                    <input id="cover_title" name="cover_title" type="text" class="form-control" pattern=".{3,}" required title="3 characters minimum" placeHolder="Nhập tiêu đề cho cover" >
                    </br>
                    <div class="progress progress-striped active" style="margin-bottom: 0px;">
                      <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">45% Complete</span>
                      </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <button type="submit" id="imageManager_saveChange" class="btn btn-sm btn-primary" >Save changes</button>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div><!--// END Image Manager Modal -->


<div id="venueDetailsMap_modal" class=" modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog" style="width: 820px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-venue-details-map">Venue location</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button">
						<span class="ui-icon ui-icon-closethick">close</span>
					</a>
				</div>
				<div id="venue-details-map" style="width: auto; min-height: 107px; height: auto;" class="ui-dialog-content ui-widget-content">
				<form id="editUserMap_form" action="#" method="POST">
					<div class="dialog-content clearfix">
						<div id="venue-details-map-container" style="z-index: 3000; position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">
							
						</div>
						<input type="hidden" name="user_lat" />
						<input type="hidden" name="user_long" />
						<div id="venue-details-map-info">
							<div id="venue-details-map-address" class="b-full-address hidden">
								<div class="part-title">Address</div>
								<p class="v-full-address">My Canh Bao Dong Hoi Quang Binh, 7000, Samoa</p>
								<button class="button button-basic a-geocode">
									<div class="button-icon icons-pin"></div>
									Find on map
								</button>
							</div>
							<div class="instructions">
								<!-- <p>You can drag the marker to the exact location of your venue and set the map's position.</p> -->
								<p>Bạn có thể kéo các điểm đánh dấu đến vị trí chính xác của địa điểm của bạn và thiết lập vị trí của bản đồ.</p>
								<!-- <p>We also store the scale you select for the map, so if it makes more sense to zoom in or out, feel free to move it until it's just right.</p> -->
								<p>Chúng tôi cũng lưu trữ quy mô mà bạn chọn cho bản đồ , vì vậy nếu nó làm cho ý nghĩa hơn để phóng to hoặc thu , cảm thấy tự do để di chuyển nó cho đến khi nó vừa phải.</p>
								<!-- <p>Please try to keep your venue as close to the centre of the map as possible.</p> -->
								<p>Hãy cố gắng giữ cho địa điểm của bạn càng gần trung tâm bản đồ càng tốt.</p>
							</div>
						</div>
					</div>
					<div class="dialog-actions">
						<button type="submit" class="button action action-default button-primary save-action">
							<div class="button-inner">
								<div class="button-icon icons-tick done"></div>
								<div class="button-icon fa fa-spin fa-refresh loading"></div>
								<span class="msg msg-action-default">Lưu</span>
							</div>
						</button>
						<a href="javascript:;" class="button-cancel" data-dismiss="modal">Cancel</a>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>