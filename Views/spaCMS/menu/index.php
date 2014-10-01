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
				<button class="button button-primary add-group" type="button" data-toggle="modal" data-target="#addGroupName_modal">
					<div class="button-inner">
						<div class="button-icon icons-plus"></div>
						Add a group
					</div>
				</button>
			</div>
			<a class="button-link add-multiple-services b-action" data-toggle="modal" data-target="#servicesList_modal" href="javascript:;">Quick menu setup wizard</a>
		</div>
		<div class="top-shadow" style="top: 32px; left: 0px; width: 1067px;"></div><div class="bottom-shadow hidden" style="top: 193px; left: 0px; width: 1067px;"></div>
	</div>

	<div class="section-aside2 featured-services">
		<h2 class="section-title">Featured services</h2>

		<div class="listing listing-enhanced">
			<div class="view-standard">
				<div class="intro">
					<p>
						You need to switch to Enhanced plan to feature your services on Wahanda.com
					</p>
					<p>
						Featured services attract more customer attention. Start selling through Wahanda!
					</p>
				</div>
				<button class="button button-primary" id="upgrade-to-enhanced" type="button">
					<div class="button-inner">
						<div class="button-icon icons-upgrade"></div>
						Upgrade
					</div>
				</button>
			</div>

			<div class="view-enhanced">
				<div class="intro">
					<p>
						Featured services are shown on top of your listing on Wahanda and our partners' sites.
					</p>
					<p>
						Get more attention to top offers by featuring them.
					</p>
				</div>

				<div class="featured">
					<div data-id="593323" class="offer state-act">
						<div tabindex="-1" class="offer-content">
							<img class="pic" alt="" src="https://connect.wahanda.com/api/v2.0.0/media/venue/285925/gallery/image/10411?width=100&amp;height=70">
							<div class="title">
								<span class="icon icons-act"></span>
								TEst
							</div>

						</div>
						<div class="offer-delete">
							<div class="icons-delete2 unfeature"></div>
						</div>
					</div>
					<div data-id="593319" class="offer state-act">
						<div tabindex="-1" class="offer-content">
							<img class="pic" alt="" src="https://connect.wahanda.com/api/v2.0.0/media/venue/285925/gallery/image/10437?width=100&amp;height=70">
							<div class="title">
								<span class="icon icons-act"></span>
								Body Exfoliation Treatments
							</div>

						</div>
						<div class="offer-delete">
							<div class="icons-delete2 unfeature"></div>
						</div>
					</div>
					<div class="offer offer-empty">
						<p>
							Empty slot
						</p>
					</div>

					<div class="offer offer-empty">
						<p>
							Empty slot
						</p>
					</div>

					<div class="offer offer-empty">
						<p>
							Empty slot
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit group name -->
<div id="editGroupName_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-802" aria-hidden="true">
	<div class="modal-dialog" style="width: 700px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all no-title ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-802">Menu group</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"> <span class="ui-icon ui-icon-closethick">close</span> </a>
				</div>
				<div class="menu-group-form ui-dialog-content ui-widget-content" id="802" scrolltop="0" scrollleft="0">
					<form novalidate="novalidate">
						<ul class="offer-type-selection">
							<li class="menu-name">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="cat-name" style="padding-top: 3px;">Menu group name</label></td>
											<td class="input-part">
											<div class="txt-input form-element-wrapper">
												<input type="text" maxlength="100" name="name" id="cat-name">
											</div></td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>

						<div class="dialog-actions" style="border-top: medium none;">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick"></div><span class="msg msg-action-default">Save</span><span class="msg msg-action-doing">Saving...</span>
								</div>
							</button>
							<button class="button action action-default button-secondary delete-action" type="button">
								<div class="button-inner">
									<div class="button-icon icons-delete"></div><span class="msg msg-action-default">Delete</span><span class="msg msg-action-doing">Deleting...</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal add group name -->
<div id="addGroupName_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-8023" aria-hidden="true">
	<div class="modal-dialog" style="width: 700px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all no-title ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-8023">Menu group</span>
					<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"> <span class="ui-icon ui-icon-closethick">close</span> </a>
				</div>
				<div class="menu-group-form ui-dialog-content ui-widget-content" id="8023" scrolltop="0" scrollleft="0">
					<form id="addGroupName_form" novalidate="novalidate">
						<ul class="offer-type-selection">
							<li class="menu-name">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part"><label for="cat-name" style="padding-top: 3px;">Menu group name</label></td>
											<td class="input-part">
											<div class="txt-input form-element-wrapper">
												<input type="text" maxlength="100" name="group_service_name" id="cat-name">
											</div></td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>

						<div class="dialog-actions" style="border-top: medium none;">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick done"></div>
									<div class="button-icon fa fa-spin fa-refresh loading" style="display:none;"></div>
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
									<li id="treatment-type-2" class="ui-state-default ui-corner-top">
										<a href="#treatment-type-cat-2" role="tab" data-toggle="tab"> 
											Body <span class="count">0</span> 
										</a>
									</li>
									<li id="treatment-type-41" class="ui-state-default ui-corner-top">
										<a href="#treatment-type-cat-41" role="tab" data-toggle="tab"> 
											Counselling &amp; Holistic <span class="count hidden">0</span>
										</a>
									</li>
								</ul>
							</div>
							<div class="multiple-service-items tab-content">
								<div class="multiple-services-list ui-tabs-panel ui-widget-content ui-corner-bottom tab-pane fade" id="treatment-type-cat-2">
									<ul>
										<li>
											<input type="checkbox" value="633" id="treatment-633">
											<label for="treatment-633">24 Carat Gold Body Treatment</label>
										</li>
										<li>
											<input type="checkbox" value="265" id="treatment-265">
											<label for="treatment-265">Acoustic Wave Therapy</label>
										</li>
										<li>
											<input type="checkbox" value="2" id="treatment-2">
											<label for="treatment-2">Acupuncture</label>
										</li>
										<li>
											<input type="checkbox" value="275" id="treatment-275">
											<label for="treatment-275">Akasuri</label>
										</li>
										<li>
											<input type="checkbox" value="463" id="treatment-463">
											<label for="treatment-463">Arasys Toning and Inch Loss Treatment</label>
										</li>
										<li>
											<input type="checkbox" value="246" id="treatment-246">
											<label for="treatment-246">Backcials</label>
										</li>
										<li>
											<input type="checkbox" value="316" id="treatment-316">
											<label for="treatment-316">Bikini Facial</label>
										</li>
										<li>
											<input type="checkbox" value="184" id="treatment-184">
											<label for="treatment-184">Body Exfoliation Treatments</label>
										</li>
										<li>
											<input type="checkbox" value="525" id="treatment-525">
											<label for="treatment-525">Body Treatments</label>
										</li>
									</ul>
								</div>
								<div class="multiple-services-list ui-tabs-panel ui-widget-content ui-corner-bottom tab-pane fade" id="treatment-type-cat-41">
									<ul>
										<li>
											<input type="checkbox" value="440" id="treatment-440">
											<label for="treatment-440">Acustaple</label>
										</li>
										<li>
											<input type="checkbox" value="343" id="treatment-343">
											<label for="treatment-343">Addictions Counselling</label>
										</li>
										<li>
											<input type="checkbox" value="14" id="treatment-14">
											<label for="treatment-14">Angel Therapy</label>
										</li>
										<li>
											<input type="checkbox" value="491" id="treatment-491">
											<label for="treatment-491">Anger Management</label>
										</li>
										<li>
											<input type="checkbox" value="15" id="treatment-15">
											<label for="treatment-15">Aromatherapy</label>
										</li>
										<li>
											<input type="checkbox" value="18" id="treatment-18">
											<label for="treatment-18">Ayurvedic</label>
										</li>
										<li>
											<input type="checkbox" value="19" id="treatment-19">
											<label for="treatment-19">Bach Flower Remedies</label>
										</li>
										<li>
											<input type="checkbox" value="613" id="treatment-613">
											<label for="treatment-613">BioMeridian Analysis</label>
										</li>
										<li>
											<input type="checkbox" value="563" id="treatment-563">
											<label for="treatment-563">Bioresonance Therapy</label>
										</li>
										<li>
											<input type="checkbox" value="383" id="treatment-383">
											<label for="treatment-383">BodyTalk</label>
										</li>
										<li>
											<input type="checkbox" value="391" id="treatment-391">
											<label for="treatment-391">Coaching</label>
										</li>
										<li>
											<input type="checkbox" value="385" id="treatment-385">
											<label for="treatment-385">Cognitive Behaviour Therapy</label>
										</li>
										<li>
											<input type="checkbox" value="38" id="treatment-38">
											<label for="treatment-38">Colour Therapy</label>
										</li>
										<li>
											<input type="checkbox" value="120" id="treatment-120">
											<label for="treatment-120">Combined Decongestive Therapy</label>
										</li>
									</ul>
								</div>
								
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

<!-- Modal Edit group name -->
<div id="editGroupName_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-685" aria-hidden="true">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all no-title ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-685">Menu group</span><a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
				</div>
				<div class="menu-group-form ui-dialog-content ui-widget-content" id="685" scrolltop="0" scrollleft="0">
					<form novalidate="novalidate">
						<ul class="offer-type-selection">
							<li class="menu-name">
								<table cellspacing="0" cellpadding="0" class="default-form">
									<tbody>
										<tr class="form-row">
											<td class="label-part">
												<label for="cat-name" style="padding-top: 3px;">Menu group name</label>
											</td>
											<td class="input-part">
											<div class="txt-input form-element-wrapper">
												<input type="text" maxlength="100" name="name" id="cat-name" class="valid">
											</div></td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>

						<div class="dialog-actions" style="margin-top: 0px;">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick"></div><span class="msg msg-action-default">Save</span><span class="msg msg-action-doing">Saving...</span>
								</div>
							</button>
							<button class="button action action-default button-secondary delete-action" type="button">
								<div class="button-inner">
									<div class="button-icon icons-delete"></div><span class="msg msg-action-default">Delete</span><span class="msg msg-action-doing">Deleting...</span>
								</div>
							</button>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add services -->
<div id="addServices_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-1" aria-hidden="true">
	<div class="modal-dialog" style="width: 800px;">
		<div class="modal-content">
			<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
				<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
					<span class="ui-dialog-title" id="ui-dialog-title-1">Dịch vụ</span><a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
				</div>
				<div class="offer-form ui-dialog-content ui-widget-content" style="height: 550px;" scrolltop="0" scrollleft="0">
					<form novalidate="novalidate">
						<div class="dialog-content clearfix">
							<div class="offer-form-main">
								<div class="offer-type">
									<div class="icon icons-treatment-big"></div>
									<div class="type-select">
										<select id="select2_service" name="service" class="form-control select2" data-placeholder="Please select service type">
											<option value=""></option>
											<optgroup data-id="2" label="Body">
												<option value="633">24 Carat Gold Body Treatment</option>
												<option value="265">Acoustic Wave Therapy</option>
												<option value="2">Acupuncture</option>
												<option value="275">Akasuri</option>
												<option value="463">Arasys Toning and Inch Loss Treatment</option>
												<option value="246">Backcials</option>
												<option value="316">Bikini Facial</option>
												<option value="184">Body Exfoliation Treatments</option>
												<option value="525">Body Treatments</option>
												<option value="205">Body Treatments - CACI</option>
												<option value="25">Body Wraps</option>
												<option value="40">Cellulite Treatments</option>
											</optgroup>
											<optgroup data-id="41" label="Counselling &amp; Holistic">
												<option value="440">Acustaple</option>
												<option value="343">Addictions Counselling</option>
												<option value="14">Angel Therapy</option>
												<option value="491">Anger Management</option>
												<option value="15">Aromatherapy</option>
												<option value="18">Ayurvedic</option>
												<option value="19">Bach Flower Remedies</option>
												<option value="613">BioMeridian Analysis</option>
												<option value="563">Bioresonance Therapy</option>
												<option value="383">BodyTalk</option>
											</optgroup>
										</select>
										<div id="selF0G_chzn" class="chzn-container chzn-container-single" style="width: 534px;">
											<div style="left: -9000px; width: 532px; top: 34px;" class="chzn-drop">
												<div class="chzn-search">
													<input type="text" autocomplete="off" style="width: 485px;" placeholder="Look up service type by typing in a name" tabindex="-1">
												</div>
												<ul class="chzn-results" style="max-height: 431.9px;">
													<li class="group-result" id="selF0G_chzn_g_1" style="display: list-item;">
														Body
													</li>
													<li style="" class="active-result group-option result-selected" id="selF0G_chzn_o_2">
														24 Carat Gold Body Treatment
													</li>
													<li style="" class="active-result group-option" id="selF0G_chzn_o_3">
														Acoustic Wave Therapy
													</li>
													<li style="" class="active-result group-option" id="selF0G_chzn_o_4">
														Acupuncture
													</li>
													<li style="" class="active-result group-option" id="selF0G_chzn_o_5">
														Akasuri
													</li>
													<li style="" class="active-result group-option" id="selF0G_chzn_o_6">
														Arasys Toning and Inch Loss Treatment
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="service_name" title="<strong>Service name</strong> - Type in the name of the service. Avoid using pricing or discount rate in the name as we will calculate and show them based on pricing information below." class="tooltips tooltips-bottom b-select-valid txt-input txt-input-big form-element-wrapper" aria-describedby="ui-tooltip-1">
										<input type="text" value="" maxlength="150" placeholder="Service name" class="offer-name" name="offer-name">
									</div>
								</div>
								<div tabindex="-1" class="offer-content">
									<div class="warning warning-archived hidden">
										<div class="icon icons-archive-medium"></div>
										<span class="title"> This service is archived. It will not be visible to your clients. <a class="offer-activate" href="javascript:;">Move this service back to your menu</a> </span>
										<span class="info"></span>
									</div>
									<div class="warning warning-locked hidden">
										<div class="icon icons-lock"></div>
										<span class="title">You can only edit limited information for this menu item.</span>
										<span class="info"></span>
									</div>
									<div class="warning warning-pending hidden">
										<div class="icon icons-clock"></div>
										<span class="title">Menu item is waiting for approval.</span>
										This item is not published on Wahanda.com as a featured offer yet, as it needs to be reviewed by our support team.
									</div>
									<div class="warning warning-chain hidden">
										<div class="icon icons-lock"></div>
										<span class="title">Menu item is defined at a chain level.</span>
										You can only edit limited information for this menu item. Contact Wahanda's support team if you need to modify anything else.
									</div>
									<div class="warning warning-permissions hidden">
										<div class="icon icons-lock"></div>
										<span class="title">You are not allowed to edit this item.</span>
									</div>

									<div class="skus-pricing group-dependancy">
										<h2 class="part-title">Price</h2>

										<table cellspacing="0" cellpadding="0" class="skus-list hidden"></table>
										<div class="single-sku-container">
											<table cellspacing="0" cellpadding="0" class="default-form skus-edit">
												<tbody>
													<tr class="form-row sku-duration">
														<td class="label-part"><label>Duration</label></td>
														<td class="input-part">
														<select name="duration[view730]">
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
														<td class="label-part sku-rrp"><label>Full price, £</label></td>
														<td data-tooltips="&lt;strong&gt;Full and Sale price&lt;/strong&gt; - Full price is the pricelist price of your service. If you are offering a special price on this offer, add it to Sale price." class="tooltips tooltips-top input-part">
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="text" min="1" class="required number" value="" name="fullPriceAmount[view730]" more-than="#sku-discountPriceAmount-view730">
														</div><label class="optional">Sale price, £</label>
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="text" class="number sku-amount" value="" name="discountPriceAmount[view730]" id="sku-discountPriceAmount-view730">
														</div></td>
													</tr>
													<tr class="form-row sku-stock inventory-managed hidden">
														<td class="label-part"><label>Inventory left</label></td>
														<td class="input-part">
														<div class="txt-input txt-input-mini form-element-wrapper">
															<input type="text" min="0" class="number" value="" name="stockAmount[view730]">
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
												<input type="checkbox" name="featured" id="service-feature">
												Feature service (max 5 per venue) </label>
										</div>
										<div class="fullfilment">
											<div class="empty not-purchasable hidden">
												<p class="intro">
													<span class="icons-attention-small"></span>
													Your menu is currently set up to only sell featured services. Fancy selling your non-featured offers on Wahanda? Make your menu purchasable now.
												</p>
												<button class="button button-basic make-purchasable" type="button">
													<div class="button-inner">
														<div class="button-icon icons-tick4"></div>
														Make my menu purchasable
													</div>
												</button>

											</div>

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
														<select id="fulfillment-expiry-type" name="expiryType">
															<option value="">Hoạt động</option>
															<option value="after">Ngưng hoạt động</option>
														</select>
													</tr>
													<tr id="sold_as" title="<strong>Sell as</strong> - Service can be fulfilled as: <strong><em>Appointment</em></strong> - customers book in directly by finding available slots in your calendar. It’s much more convenient both for you and your customers. <strong><em>eVoucher</em></strong> - customers receive vouchers that they can redeem in your venue." class="form-row">
														<td class="label-part"><label for="service-type">Sold as</label></td>
														<td class="input-part">
														<select id="fulfillment-types" name="fulfillmentTypes">
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
											<h2 class="part-title">Description</h2>
											<!-- bb code -->
											<textarea max-text-lines="4" id="user_description" name="user_description" cols="5" rows="4" class="full required"></textarea>
										</div>
									</div>
								</div>
								<div class="top-shadow"></div>
								<div class="bottom-shadow"></div>
							</div>
							<div class="offer-form-aside pictures ui-sortable">
								<h2 class="part-title">Menu item images</h2>
								<ul class="menu-item-pictures">
									<li class="single-picture empty">
										<div class="single-picture-wrapper" style="position: relative;">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Add image
											</div>
										</div>
										<div class="single-picture-title">
											<span>Primary image</span>
										</div>
									</li>

									<li class="single-picture empty not-editable">
										<div class="single-picture-wrapper" style="position: relative;">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Add image
											</div>
										</div>
										<div class="single-picture-title">
											<span>Primary image</span>
										</div>
									</li>

									<li class="single-picture empty not-editable">
										<div class="single-picture-wrapper" style="position: relative;">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Add image
											</div>
										</div>
										<div class="single-picture-title">
											<span>Primary image</span>
										</div>
									</li>

									<li class="single-picture empty not-editable">
										<div class="single-picture-wrapper" style="position: relative;">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Add image
											</div>
										</div>
										<div class="single-picture-title">
											<span>Primary image</span>
										</div>
									</li>

									<li class="single-picture empty not-editable">
										<div class="single-picture-wrapper" style="position: relative;">
											<div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
												<div class="icon icons-plus3"></div>
												Add image
											</div>
										</div>
										<div class="single-picture-title">
											<span>Primary image</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="dialog-actions">
							<button class="button action action-default button-primary save-action" type="submit">
								<div class="button-inner">
									<div class="button-icon icons-tick"></div><span class="msg msg-action-default">Save</span><span class="msg msg-action-doing">Saving...</span>
								</div>
							</button>
							<button class="button action action-default button-basic offer-archive" type="button">
								<div class="button-inner">
									<div class="button-icon icons-archive"></div>
									<span class="msg msg-action-default">Move to archive</span>
									<span class="msg msg-action-doing">Archiving...</span>
								</div>
							</button>
							<a target="_blank" class="button-link listing-link" href="javascript:;">View on Wahanda.com</a>
							<a class="button-cancel" href="javascript:;" data-dismiss="modal">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>