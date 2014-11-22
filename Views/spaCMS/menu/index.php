<div id="menu-holder" class="content-holder has-offers">
	<div class="section-main2">
		<div id="filters">
			<!-- Code....
			....All active services
			-->
		</div>
		<div id="list_group_user_service" class="data-content menu-content ui-sortable">
			<!-- list user service -->
		</div>

		<div class="data-actions b-menu-edit-actions">
			<div id="menu_group" title='<strong>Add a group</strong> - Menu groups allow you to arrange your services in the way you prefer our customers to see them. Using generic treatment types like "Hair", "Nails" or "Spa days" works best.' class="tooltips tooltips-top button-wrapper b-action">
				<button class="button button-primary add-group" type="button">
					<div class="button-inner">
						<div class="button-icon icons-plus done"></div>
						<div class="button-icon fa fa-spin fa-refresh loading"></div>
						Thêm nhóm dịch vụ
					</div>
				</button>
			</div>
			<a class="button-link add-multiple-services b-action hidden" data-toggle="modal" data-target="#servicesList_modal" href="javascript:;">Quick menu setup wizard</a>
		</div>
		<div class="top-shadow" style="top: 32px; left: 0px; width: 1067px;"></div><div class="bottom-shadow hidden" style="top: 193px; left: 0px; width: 1067px;"></div>
	</div>

	<div class="section-aside2 featured-services">
		<h2 class="section-title">Những dịch vụ nổi bật</h2>

		<div class="listing listing-enhanced">

			<div class="view-enhanced">
				<div class="intro">
					<p>
						Những dịch vụ nổi bật sẽ được hiển thị ở đầu danh sách dịch vụ của bạn trên Beleza và các website đối tác của chúng tôi.
					</p>
					<p>
						Tạo sự chú ý cho những dịch vụ nổi trội mà bạn tự hào.
					</p>
				</div>

				<div class="featured">
					
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit group name -->
<div id="editGroupName_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-802" aria-hidden="true">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all no-title ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-802">Menu group</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"> <span class="ui-icon ui-icon-closethick">close</span> </a>
				</div>
				<div class="menu-group-form ui-dialog-content ui-widget-content" id="802" scrolltop="0" scrollleft="0">
					<form id="editGroupName_form" action="#" method="POST">
						<ul class="offer-type-selection">
							<li class="menu-name">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="cat-name" style="padding-top: 3px;">Tên nhóm dịch vụ</label></td>
											<td class="input-part">
											<div class="txt-input form-element-wrapper">
												<input type="text" maxlength="100" name="group_service_name" id="cat-name" required pattern=".{3,}" title="ít nhất 3 ký tự">
												<input type="hidden" name="group_service_id">
											</div></td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>

						<div class="dialog-actions" style="border-top: medium none;">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick e-done"></div>
									<div class="button-icon fa fa-spin fa-refresh e-loading"></div>
									<span class="msg msg-action-default">Lưu</span>
								</div>
							</button>
							<button class="button action action-default button-secondary delete-action aDeleteGroup" type="button">
								<div class="button-inner">
									<div class="button-icon icons-delete done"></div>
									<div class="button-icon fa fa-spin fa-refresh loading"></div>
									<span class="msg msg-action-default">Xóa</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Hủy</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal add group name -->
<div id="addGroupName_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-8023" aria-hidden="true">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all no-title ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-8023">Nhóm dịch vụ</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"> <span class="ui-icon ui-icon-closethick">close</span> </a>
				</div>
				<div class="menu-group-form ui-dialog-content ui-widget-content" id="8023" scrolltop="0" scrollleft="0">
					<form id="addGroupName_form" action="#" method="POST">
						<ul class="offer-type-selection">
							<li class="menu-name">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="cat-name" style="padding-top: 3px;">Tên nhóm dịch vụ</label></td>
											<td class="input-part">
												<select id="group_service_name" name="group_service_name" style="width:350px" required title="Vui lòng chọn">
													<option></option>
									            </select>
											</td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>

						<div class="dialog-actions" style="border-top: medium none;">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick done"></div>
									<div class="button-icon fa fa-spin fa-refresh s-loading"></div>
									<span class="msg msg-action-default">Thêm</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Hủy</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Quick menu setup -->
<div id="servicesList_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-1089" aria-hidden="true">
	<div class="modal-dialog" style="width: 685px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-1089">Select services to add to your menu</span><a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
				</div>
				<div class="multiple-services-form ui-dialog-content ui-widget-content" id="1089" scrolltop="0" scrollleft="0">

					<form id="addQuickMenu_form" onsubmit="return false">
						<div id="multiple-services-tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
							<div class="multiple-services-groups">
								<ul class="multiple-services-groups-list ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
									<!-- List services-groups-list -->
								</ul>
							</div>
							<div class="multiple-service-items tab-content">
								<!-- List service-items -->
							</div>
						</div>
						<div class="dialog-actions">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick"></div>
									<span class="msg msg-action-default">Save</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Cancel</a>

							<div class="dialog-note hidden b-items-limit-note">
								<span class="icon icons-attention-small"></span>
								<span class="note-text v-items-limit-note"></span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add User services -->
<div id="addUserServices_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog" style="width: 800px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-1">Dịch vụ</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button">
						<span class="ui-icon ui-icon-closethick">close</span>
					</a>
				</div>
				<div class="offer-form ui-dialog-content ui-widget-content" style="height: 550px;" scrolltop="0" scrollleft="0">
					<form id="addUserService_form" action="#" method="POST" >
						<div class="dialog-content clearfix">
							<div class="offer-form-main">
								<div class="offer-type">
									<div class="icon icons-treatment-big"></div>
									<div class="type-select">
										<select id="select2_addService" class="form-control select2" data-placeholder="Vui lòng chọn loại dịch vụ" required title="Trước tiên, bạn hãy chọn loại dịch vụ.">
											<option value=""></option>
											<!-- List service system -->

										</select>

										<input type="hidden" name="user_service_group_id">
										<input type="hidden" name="user_service_service_id">
										
										<div id="selF0G_chzn" class="chzn-container chzn-container-single" style="width: 534px;">
											<div style="left: -9000px; width: 532px; top: 34px;" class="chzn-drop">
												<div class="chzn-search">
													<input type="text" autocomplete="off" style="width: 485px;" placeholder="Look up service type by typing in a name" tabindex="-1">
												</div>
											</div>
										</div>
									</div>
									<div id="service_name" title="<strong>Service name</strong> - Type in the name of the service. Avoid using pricing or discount rate in the name as we will calculate and show them based on pricing information below." class="tooltips tooltips-bottom b-select-valid txt-input txt-input-big form-element-wrapper" aria-describedby="ui-tooltip-1">
										<input type="text" placeholder="Tên dịch vụ của bạn" class="offer-name" name="user_service_name" required pattern=".{6,}" title="Hãy nhập tên dịch vụ (ít nhất 6 ký tự)">
									</div>
								</div>
								<div tabindex="-1" class="offer-content">
									<div class="warning warning-archived" style="display:none;">
										<div class="icon icons-lock"></div>
										<span class="title">Dịch vụ nổi bật đã đủ số lượng</span>
										<div class="info">Số lượng dịch vụ nổi bật đã đủ 5. Nếu bạn muốn chọn đây là dịch vụ nổi bật thì vui lòng tắt tính năng nổi bật của dịch vụ nổi bật khác trước khi thêm.</div>
									</div>

									<div class="skus-pricing group-dependancy">
										<h2 class="part-title">Price</h2>

										<table cellspacing="0" cellpadding="0" class="skus-list hidden"></table>
										<div class="single-sku-container">
											<table cellspacing="0" cellpadding="0" class="default-form skus-edit">
												<tbody>
													<tr class="form-row sku-duration">
														<td class="label-part"><label>Thời gian</label></td>
														<td class="input-part">
														<select name="user_service_duration">
															<option value="0">Not set</option>
															<option value="10">10 min</option>
															<option value="15">15 min</option>
															<option value="20">20 min</option>
															<option value="25">25 min</option>
															<option value="30">30 min</option>
															<option value="35">35 min</option>
															<option value="40">40 min</option>
															<option value="45">45 min</option>
															<option value="50">50 min</option>
															<option value="55">55 min</option>
															<option selected="selected" value="60">1 h </option>
															<option value="65">1 h 05 min</option>
															<option value="70">1 h 10 min</option>
															<option value="75">1 h 15 min</option>
															<option value="80">1 h 20 min</option>
															<option value="85">1 h 25 min</option>
															<option value="90">1 h 30 min</option>
															<option value="95">1 h 35 min</option>
															<option value="100">1 h 40 min</option>
															<option value="105">1 h 45 min</option>
															<option value="110">1 h 50 min</option>
															<option value="115">1 h 55 min</option>
															<option value="120">2 h </option>
															<option value="135">2 h 15 min</option>
															<option value="150">2 h 30 min</option>
															<option value="165">2 h 45 min</option>
															<option value="180">3 h </option>
															<option value="195">3 h 15 min</option>
															<option value="210">3 h 30 min</option>
															<option value="225">3 h 45 min</option>
															<option value="240">4 h </option>
															<option value="270">4 h 30 min</option>
															<option value="300">5 h </option>
															<option value="330">5 h 30 min</option>
															<option value="360">6 h </option>
															<option value="390">6 h 30 min</option>
															<option value="420">7 h </option>
															<option value="450">7 h 30 min</option>
															<option value="480">8 h </option>
															<option value="540">9 h </option>
															<option value="600">10 h </option>
															<option value="660">11 h </option>
															<option value="720">12 h </option>
														</select></td>
													</tr>
													<tr id="price" title="<strong>Full and Sale price</strong> - Full price is the pricelist price of your service. If you are offering a special price on this offer, add it to Sale price." class="form-row" aria-describedby="ui-tooltip-5">
														<td class="label-part sku-rrp"><label>Giá gốc </label></td>
														<td data-tooltips="&lt;strong&gt;Full and Sale price&lt;/strong&gt; - Full price is the pricelist price of your service. If you are offering a special price on this offer, add it to Sale price." class="tooltips tooltips-top input-part">
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="number" min="0" class="required number" value="" name="user_service_full_price" required pattern=".{6,}" title="Hãy nhập giá tiền cho dịch vụ" >
														</div><label class="optional"> Giá khuyến mãi </label>
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="number" class="number sku-amount" value="" name="user_service_sale_price">
														</div></td>
													</tr>
												</tbody>
											</table>
										</div>

									</div>
									<div class="listing group-dependancy">
										<h2 class="part-title">How would you like to sell this service?</h2>
										<div id="sell_service" title="<strong>Feature on Wahanda</strong> - Featuring a service will put it on top on your listing and expose it through all partners&amp;#39; websites. You can feature up to five of your top services." class="choices form-element-wrapper enhanced-listing-only">
											<label>
												<input type="checkbox" name="user_service_is_featured" id="service-feature">
												Dịch vụ nổi bật (tối đa 5 dịch vụ) </label>
										</div>
										<div class="fullfilment">
											<div class="empty standard-listing hidden">
												<p class="intro">
													<span class="icons-attention-small"></span>
													You're not selling on Wahanda.
												</p>
												<p class="after-txt">
													Do you know that you can start selling on Wahanda today? It's a no-brainer - we'll charge you only if we sell.
												</p>
												<button class="button button-basic upgrade-to-enhanced" type="button">
													<div class="button-inner">
														<div class="button-icon icons-upgrade2"></div>
														Find out more
													</div>
												</button>
											</div>

											<table cellspacing="0" cellpadding="0" class="fulfillment-edit">
												<tbody>
													<tr class="form-row voucher-part">
														<td class="label-part"><label>Trạng thái</label></td>
														<td class="input-part">
														<select id="fulfillment-expiry-type" name="user_service_status">
															<option value="1">Hoạt động</option>
															<option value="0">Ngưng hoạt động</option>
														</select>
													</tr>
													<tr id="sold_as" title="<strong>Sell as</strong> - Service can be fulfilled as: <strong><em>Appointment</em></strong> - customers book in directly by finding available slots in your calendar. It’s much more convenient both for you and your customers. <strong><em>eVoucher</em></strong> - customers receive vouchers that they can redeem in your venue." class="form-row hidden">
														<td class="label-part"><label for="service-type">Sold as</label></td>
														<td class="input-part">
														<select id="fulfillment-types" name="user_service_use_evoucher">
															<option value="AE">Appointment or eVoucher</option>
															<option value="A">Appointment</option>
															<option value="E">eVoucher</option>
														</select></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="descriptions group-dependancy">
										<div class="txts description">
											<h2 class="part-title">Mô tả dịch vụ</h2>
											<!-- bb code -->
											<textarea max-text-lines="4" id="user_description" name="user_service_description" cols="5" rows="4" class="full required"></textarea>
										</div>
									</div>
								</div>
								<div class="top-shadow"></div>
								<div class="bottom-shadow"></div>
							</div>
							<div class="offer-form-aside pictures ui-sortable">
								<h2 class="part-title">Hình ảnh dịch vụ</h2>
								<ul class="menu-item-pictures">
									<div id="ListIM_addUS">
										<!-- List user service image -->

									</div> 
									<li class="single-picture empty">
										<div id="iM_addUS" class="single-picture-wrapper imageManager_openModal" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Thêm hình
											</div>
										</div>
									</li>

								</ul>
							</div>
						</div>
						<div class="dialog-actions">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick done"></div>
									<div class="button-icon fa fa-spin fa-refresh s-loading"></div>
									<span class="msg msg-action-default">Thêm</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Hủy</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit User services -->
<div id="editUserServices_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog" style="width: 800px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-1">Dịch vụ</span><a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
				</div>
				<div class="offer-form ui-dialog-content ui-widget-content" style="height: 550px;" scrolltop="0" scrollleft="0">
					<form id="editUserService_form" action="#" method="POST" >
						<div class="dialog-content clearfix">
							<div class="offer-form-main">
								<div class="offer-type">
									<div class="icon icons-treatment-big"></div>
									<div class="type-select">
										<select id="select2_editService" class="form-control select2" data-placeholder="Vui lòng chọn loại dịch vụ" required title="Trước tiên, bạn hãy chọn loại dịch vụ.">
											<option value=""></option>
											<!-- List service system -->

										</select>

										<input type="hidden" name="user_service_id">
										<input type="hidden" name="user_service_group_id" disabled="disabled">
										<input type="hidden" name="user_service_service_id">
										
										<div id="selF0G_chzn" class="chzn-container chzn-container-single" style="width: 534px;">
											<div style="left: -9000px; width: 532px; top: 34px;" class="chzn-drop">
												<div class="chzn-search">
													<input type="text" autocomplete="off" style="width: 485px;" placeholder="Look up service type by typing in a name" tabindex="-1">
												</div>
											</div>
										</div>
									</div>
									<div id="service_name" title="<strong>Service name</strong> - Type in the name of the service. Avoid using pricing or discount rate in the name as we will calculate and show them based on pricing information below." class="tooltips tooltips-bottom b-select-valid txt-input txt-input-big form-element-wrapper" aria-describedby="ui-tooltip-1">
										<input type="text" placeholder="Tên dịch vụ của bạn" class="offer-name" name="user_service_name" required pattern=".{6,}" title="Hãy nhập tên dịch vụ (ít nhất 6 ký tự)">
									</div>
								</div>
								<div tabindex="-1" class="offer-content">
									<div class="warning warning-archived" style="display:none;">
										<div class="icon icons-lock"></div>
										<span class="title">Dịch vụ nổi bật đã đủ số lượng</span>
										<div class="info">Số lượng dịch vụ nổi bật đã đủ 5. Nếu bạn muốn chọn đây là dịch vụ nổi bật thì vui lòng tắt tính năng nổi bật của dịch vụ nổi bật khác trước khi thêm.</div>
									</div>

									<div class="skus-pricing group-dependancy">
										<h2 class="part-title">Price</h2>

										<table cellspacing="0" cellpadding="0" class="skus-list hidden"></table>
										<div class="single-sku-container">
											<table cellspacing="0" cellpadding="0" class="default-form skus-edit">
												<tbody>
													<tr class="form-row sku-duration">
														<td class="label-part"><label>Thời gian</label></td>
														<td class="input-part">
														<select name="user_service_duration">
															<option value="0">Not set</option>
															<option value="10">10 min</option>
															<option value="15">15 min</option>
															<option value="20">20 min</option>
															<option value="25">25 min</option>
															<option value="30">30 min</option>
															<option value="35">35 min</option>
															<option value="40">40 min</option>
															<option value="45">45 min</option>
															<option value="50">50 min</option>
															<option value="55">55 min</option>
															<option selected="selected" value="60">1 h </option>
															<option value="65">1 h 05 min</option>
															<option value="70">1 h 10 min</option>
															<option value="75">1 h 15 min</option>
															<option value="80">1 h 20 min</option>
															<option value="85">1 h 25 min</option>
															<option value="90">1 h 30 min</option>
															<option value="95">1 h 35 min</option>
															<option value="100">1 h 40 min</option>
															<option value="105">1 h 45 min</option>
															<option value="110">1 h 50 min</option>
															<option value="115">1 h 55 min</option>
															<option value="120">2 h </option>
															<option value="135">2 h 15 min</option>
															<option value="150">2 h 30 min</option>
															<option value="165">2 h 45 min</option>
															<option value="180">3 h </option>
															<option value="195">3 h 15 min</option>
															<option value="210">3 h 30 min</option>
															<option value="225">3 h 45 min</option>
															<option value="240">4 h </option>
															<option value="270">4 h 30 min</option>
															<option value="300">5 h </option>
															<option value="330">5 h 30 min</option>
															<option value="360">6 h </option>
															<option value="390">6 h 30 min</option>
															<option value="420">7 h </option>
															<option value="450">7 h 30 min</option>
															<option value="480">8 h </option>
															<option value="540">9 h </option>
															<option value="600">10 h </option>
															<option value="660">11 h </option>
															<option value="720">12 h </option>
														</select></td>
													</tr>
													<tr id="price" title="<strong>Full and Sale price</strong> - Full price is the pricelist price of your service. If you are offering a special price on this offer, add it to Sale price." class="form-row" aria-describedby="ui-tooltip-5">
														<td class="label-part sku-rrp"><label>Giá gốc </label></td>
														<td data-tooltips="&lt;strong&gt;Full and Sale price&lt;/strong&gt; - Full price is the pricelist price of your service. If you are offering a special price on this offer, add it to Sale price." class="tooltips tooltips-top input-part">
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="number" min="0" class="required number" value="" name="user_service_full_price" required pattern=".{6,}" title="Hãy nhập giá tiền cho dịch vụ" >
														</div><label class="optional"> Giá khuyến mãi </label>
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="number" class="number sku-amount" value="" name="user_service_sale_price">
														</div></td>
													</tr>
												</tbody>
											</table>
										</div>

									</div>
									<div class="listing group-dependancy">
										<h2 class="part-title">How would you like to sell this service?</h2>
										<div id="sell_service" title="<strong>Feature on Wahanda</strong> - Featuring a service will put it on top on your listing and expose it through all partners&amp;#39; websites. You can feature up to five of your top services." class="choices form-element-wrapper enhanced-listing-only">
											<label>
												<input type="checkbox" name="user_service_is_featured" id="service-feature">
												Dịch vụ nổi bật (tối đa 5 dịch vụ) </label>
										</div>
										<div class="fullfilment">
											<div class="empty standard-listing hidden">
												<p class="intro">
													<span class="icons-attention-small"></span>
													You're not selling on Wahanda.
												</p>
												<p class="after-txt">
													Do you know that you can start selling on Wahanda today? It's a no-brainer - we'll charge you only if we sell.
												</p>
												<button class="button button-basic upgrade-to-enhanced" type="button">
													<div class="button-inner">
														<div class="button-icon icons-upgrade2"></div>
														Find out more
													</div>
												</button>
											</div>

											<table cellspacing="0" cellpadding="0" class="fulfillment-edit">
												<tbody>
													<tr class="form-row voucher-part">
														<td class="label-part"><label>Trạng thái</label></td>
														<td class="input-part">
														<select id="fulfillment-expiry-type" name="user_service_status">
															<option value="1">Hoạt động</option>
															<option value="0">Ngưng hoạt động</option>
														</select>
													</tr>
													<tr id="sold_as" title="<strong>Sell as</strong> - Service can be fulfilled as: <strong><em>Appointment</em></strong> - customers book in directly by finding available slots in your calendar. It’s much more convenient both for you and your customers. <strong><em>eVoucher</em></strong> - customers receive vouchers that they can redeem in your venue." class="form-row">
														<td class="label-part"><label for="service-type">Hình thức bán</label></td>
														<td class="input-part">
														<select id="fulfillment-types" name="user_service_use_evoucher">
															<option value="2">Appointment or eVoucher</option>
															<option value="1">Appointment</option>
															<option value="0">eVoucher</option>
														</select></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="descriptions group-dependancy">
										<div class="txts description">
											<h2 class="part-title">Mô tả dịch vụ</h2>
											<!-- bb code -->
											<textarea max-text-lines="4" id="user_description" name="user_service_description" cols="5" rows="4" class="full required"></textarea>
										</div>
									</div>
								</div>
								<div class="top-shadow"></div>
								<div class="bottom-shadow"></div>
							</div>
							<div class="offer-form-aside pictures ui-sortable">
								<h2 class="part-title">Hình ảnh dịch vụ</h2>
								<ul class="menu-item-pictures">
									<div id="ListIM_editUS">
										<!-- List user service image -->

									</div> 
									<li class="single-picture empty">
										<div id="iM_editUS" class="single-picture-wrapper imageManager_openModal" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Thêm hình
											</div>
										</div>
									</li>

								</ul>
							</div>
						</div>
						<div class="dialog-actions">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick e-done"></div>
									<div class="button-icon fa fa-spin fa-refresh e-loading"></div>
									<span class="msg msg-action-default">Lưu</span>
								</div>
							</button>
							<button id="deleteUserService" class="button action action-default button-basic offer-archive" type="button">
								<div class="button-inner">
									<div class="button-icon icons-archive d-done"></div>
									<div class="button-icon fa fa-spin fa-refresh d-loading"></div>
									<span class="msg msg-action-default">Xóa bỏ dịch vụ</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Hủy</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Image Manager Modal -->
<div class="modal" id="imageManager_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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

<!-- ui-dialog -->
<div id="dialog-delUS" title="Xóa dịch vụ">
	<p>Bạn có chắc muốn xóa dịch vụ này không?</p>
</div>

<div id="dialog-delGUS" title="Xóa nhóm dịch vụ">
	<p>Bạn có chắc muốn xóa nhóm dịch vụ này không?</p>
</div>

<div id="dialog-editUS" title="Sửa dịch vụ">
	<p>Bạn có chắc muốn sửa dịch vụ này không?</p>
</div>
