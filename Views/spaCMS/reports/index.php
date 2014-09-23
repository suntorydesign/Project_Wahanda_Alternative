<div id="reports-holder" class="content-holder">
    <div id="reports-tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
        <div class="section-aside">
            <ul id="nav2" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                <li class="ui-state-default ui-corner-top active" id="bookings-tab" style="display: list-item;">
                    <a href="#bookings" style="position: relative;" role="tab" data-toggle="tab">
                        <div class="title vertically-centered" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">List of Bookings</div>
                    </a>
                </li>
                <li class="ui-state-default ui-corner-top" id="sales-tab" style="display: list-item;">
                    <a href="#sales" style="position: relative;" role="tab" data-toggle="tab">
                        <div class="title vertically-centered" style="position: absolute; height: 17px; top: 50%; margin-top: -8.5px;">Sales Report</div>
                    </a>
                </li>
            </ul>
        </div>


        <div class="tab-content section-main ui-widget-content ui-corner-bottom">
            <!-- Bookings -->
            <div class="tab-pane active" id="bookings">
                <div class="reports-bookings">
                    <div class="home-filters">
                        <div class="filter-wrapper" id="filter-type">
                            <div id="bookings-menu" class="filter-current dropdown-toggle"  data-toggle="dropdown">
                                All bookings and enquiries
                                <div class="handler">
                                    <div class="icons-arrow-bottom2"></div>
                                </div>
                            </div>
                            <ul class="filter-ddown dropdown-menu dropdown-menu-fix" role="menu" aria-labelledby="bookings-menu">
                                <li data-value="ALL" class="on" role="menuitem" tabindex="-1" >
                                    All bookings and enquiries
                                </li>
                                <li class="subitem" data-value="AAP" role="menuitem" tabindex="-1">
                                    Appointment bookings
                                </li>
                                <li class="subitem" data-value="DBO" role="menuitem" tabindex="-1">
                                    Dated bookings
                                </li>
                                <li class="subitem" data-value="ANV" role="menuitem" tabindex="-1">
                                    eVoucher bookings
                                </li>
                                <li class="subitem" data-value="LDS" role="menuitem" tabindex="-1">
                                    Customer enquiries
                                </li>
                            </ul>
                        </div>

                        <div class="filter-wrapper" id="filter-subtype">
                            <div id="bookings-menu-type" class="filter-current dropdown-toggle"  data-toggle="dropdown">All types<span class="count">3</span>
                                <div class="handler">
                                    <div class="icons-arrow-bottom2"></div>
                                </div>
                            </div>
                            <ul class="filter-ddown dropdown-menu dropdown-menu-fix" role="menu" aria-labelledby="bookings-menu-type">
                                <li class="on" role="menuitem" tabindex="-1">All types</li>
                                <li data-value="UNC" role="menuitem" tabindex="-1">Unconfirmed</li>
                                <li data-value="BCX" role="menuitem" tabindex="-1">Cancelled</li>
                                <li data-value="BRJ" role="menuitem" tabindex="-1">Rejected</li>
                                <li data-value="BFU" role="menuitem" tabindex="-1">Scheduled in the future</li>
                            </ul>
                        </div>

                        <div class="filter-wrapper short" id="filter-date">
                            <div id="bookings-menu-time" class="filter-current dropdown-toggle"  data-toggle="dropdown">
                                Last 3 months
                                <div class="handler">
                                    <div class="icons-arrow-bottom2"></div>
                                </div>
                            </div>
                            <ul class="filter-ddown dropdown-menu dropdown-menu-fix" role="menu" aria-labelledby="bookings-menu-time">
                                <li data-value="1M" class="" role="menuitem" tabindex="-1">
                                    Last 30 days
                                </li>
                                <li data-value="2M" role="menuitem" tabindex="-1">
                                    Last 60 days
                                </li>
                                <li data-value="3M" class="on" role="menuitem" tabindex="-1">
                                    Last 3 months
                                </li>
                                <li data-value="6M" role="menuitem" tabindex="-1">
                                    Last 6 months
                                </li>
                                <li data-value="12M" role="menuitem" tabindex="-1">
                                    Last 12 months
                                </li>
                                <li data-value="CUST" role="menuitem" tabindex="-1">
                                    Custom range
                                </li>
                            </ul>
                        </div>

                        <div class="filter-wrapper date-range hidden">
                            <form novalidate="novalidate">
                                <div class="txt-input txt-input-mini"><input type="text" name="filter-date-from" id="filter-date-from" class="date-format-default hasDatepicker" placeholder="From" value="" date-format="dd/mm/yy">
                                </div>
                                <span class="sep">-</span>
                                <div class="txt-input txt-input-mini"><input type="text" name="filter-date-to" id="filter-date-to" class="date-format-default hasDatepicker" placeholder="Until" value="" date-format="dd/mm/yy">
                                </div>
                                <button class="button button-basic refresh a-custom-filter" type="button">
                                    <div class="button-inner">
                                        <div class="button-icon icons-refresh"></div>&nbsp;
                                    </div>
                                </button>
                            </form>
                        </div>

                        <div class="top-search reports-search">
                            <div class="txt-input">
                                <input type="text" placeholder="Search: client, phone#, order#..." id="top-search" name="top-search" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                <a class="clear-search" href="#" style="display: none;"><div class="icons-clear-search-mini"></div></a>
                                <div class="search-loader" style="display: none;"></div>
                            </div>
                            <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all search-results" role="listbox" aria-activedescendant="ui-active-menuitem" style="top: 0px; left: 0px; display: none;"></ul>
                        </div>
                    </div>
                    <div class="home-data">
                        <div class="portlet-body" style="margin-bottom: 30px">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="10%">
                                        Booking ID</br>
                                        Order ref# 
                                    </th>
                                    <th width="15%">
                                        Ngày hóa đơn
                                    </th>
                                    <th width="15%">
                                        Khách hàng
                                    </th>
                                    <th width="30%">
                                        Dịch vụ
                                    </th>
                                    <th width="10%">
                                        Giá
                                    </th>
                                    <th width="10%">
                                        Trạng thái
                                    </th>
                                    <th width="10%">
                                        Actions
                                    </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="booking_detail_id">
                                    </td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="booking_date_from" placeholder="From">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                            <input type="text" class="form-control form-filter input-sm" readonly name="booking_date_to" placeholder="To">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="booking_client_name">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="booking_user_service_name">
                                    </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <input type="text" class="form-control form-filter input-sm" name="booking_detail_price_from" placeholder="From"/>
                                        </div>
                                        <input type="text" class="form-control form-filter input-sm" name="booking_detail_price_to" placeholder="To"/>
                                    </td>
                                    <td>
                                        <select name="booking_detail_status" class="form-control form-filter input-sm">
                                            <option value="">Select...</option>
                                            <option value="1">Completed</option>
                                            <option value="2">Deleted</option>
                                            <option value="3">Confirmed</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm kiếm</button>
                                        </div>
                                        <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                    </td>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sales reports -->
            <div class="tab-pane" id="sales">
                <div class="report-actions">
                    <div class="date-range-selector">
                        <div id="dashboard-report-range" class="dashboard-date-range tooltips current" data-placement="top" data-original-title="Change dashboard date range">
                            <div class="icon icons-date-selector"></div>
                            <span>
                            </span>
                            <!-- <i class="fa fa-angle-down"></i> -->
                            <div class="arrow icons-arrow-bottom2"></div>
                        </div>
                    </div>
                    
                </div>
                <div class="report-content">
                    <div class="printed-date hidden">
                        <span class="title">Printed date</span>
                        <span class="date">2014-08-13 14:46</span>
                    </div>
                    <h1>Sales summary</h1>
                    <h2><?php echo Session::get('user_business_name');?></h2>
                    <div class="stats-group general">
                        <table>
                            <tbody>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>
                                        Total value
                                    </th>
                                    <th>Count</th>
                                </tr>
                                <tr class="important">
                                    <td>
                                        <h3 class="period">Thursday</h3>
                                        <span class="date">2014-08-07</span>
                                    </td>
                                    <td>
                                        <span class="highlighted">£40</span>
                                        <div class="change positive hidden">
                                            <div class="icon icons-change-up"></div>
                                            <div class="value">17%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>1</span>
                                        <!--<div class="change positive">
                                        <div class="icon icons-change-up"></div>
                                            <div class="value">17%</div>
                                        </div> -->
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <span class="period">Last Wednesday</span>
                                        <span class="date">2013-12-11</span>
                                    </td>
                                    <td>
                                        <span>£1,343.00</span>
                                    </td>
                                    <td>
                                        <span>£1,343.00</span>
                                    </td>
                                    <td>
                                        <span>£1,343.00</span>
                                    </td>
                                    <td>
                                        <span>25</span>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="stats-group">
                        <table>
                            <tbody><tr>
                                <th><h3>By employee</h3></th>
                                <th>Total value</th>
                                <th>Count</th>
                            </tr>
                            <tr>
                                <td><span>Sunspa Resort</span></td>
                                <td><span>£40</span></td>
                                <td><span>1</span></td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="stats-group">
                        <table>
                            <tbody><tr>
                                <th><h3>By service group</h3></th>
                                <th>Total value</th>
                                <th>Count</th>
                            </tr>
                            <tr>
                                <td><span>Body</span></td>
                                <td><span>£40</span></td>
                                <td><span>1</span></td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="stats-group">
                        <table>
                            <tbody><tr>
                                <th><h3>Top services</h3></th>
                                <th>Total value</th>
                                <th>Count</th>
                            </tr>
                            <tr>
                                <td><span>Body Wraps</span></td>
                                <td><span>£40</span></td>
                                <td><span>1</span></td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="stats-group">
                        <table>
                            <tbody><tr>
                                <th><h3>By channel</h3></th>
                                <th>Total value</th>
                                <th>Count</th>
                            </tr>
                            <tr>
                                <td><span>Direct sales</span></td>
                                <td><span>£40</span></td>
                                <td><span>1</span></td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="confirmedAppointment_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="width: 800px;">
                <div class="modal-content">
                    <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix status-scheduled">
                            <span id="ui-dialog-title-1" class="ui-dialog-title">Confirmed Appointment</span>
                            <a role="button" class="ui-dialog-titlebar-close ui-corner-all" href="#">
                                <span class="ui-icon ui-icon-closethick" data-dismiss="modal">close</span>
                            </a>
                        </div>   
                        <div scrollleft="0" scrolltop="0" class="ui-dialog-content ui-widget-content">
                            <div class="calendar-appointment-wrapper">
                                <div class="dialog-content">
                                    <div class="form-intro warning b-no-employee">
                                        <div class="icon icons-attention"></div>
                                        <p>
                                            <span class="warning-title">Please assign employee for this appointment</span>
                                        </p>
                                    </div>
                                    <div class="clearfix appointment-info">
                                        <div class="calendar-time">
                                            <div class="weekday">Thứ 3 weekday</div>
                                            <div class="day">19 day</div>
                                            <div class="year-month">
                                                <span class="month">Tháng 8 month</span>, <span class="year">2014 year</span>
                                            </div>
                                            <div class="time">13:00 time</div>
                                        </div>
                                        <div class="title-and-sku">
                                            <div class="title service_name">Service name</div>
                                            <div class="sku hidden"></div>
                                        </div>
                                        <table class="default-data-table" cellpadding="0" cellspacing="0">
                                            <tbody><tr class="b-venue-name hidden">
                                                <th>Venue name</th>
                                                <td><span class="v-venue-name"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Thời gian</th>
                                                <td><span class="duration">1 h </span></td>
                                            </tr>
                                            <tr class="hidden b-price">
                                                <th class="v-price-title">Giá</th>
                                                <td>
                                                    <span class="price v-price"></span>
                                                    <span class="status-prepaid label label-confirmed hidden">Prepaid</span>
                                                    <span class="b-status status status-discounted hidden"></span>
                                                </td>
                                            </tr>
                                            <tr class="hidden b-additional-price">
                                                <th class="v-additional-price-title">Additional Price</th>
                                                <td>
                                                    <span class="price v-additional-price"></span>
                                                    <span class="status-paid label label-confirmed hidden">Paid at venue</span>
                                                </td>
                                            </tr>
                                            <tr class="b-total">
                                                <th class="v-total-price-title">Giá</th>
                                                <td>
                                                    <span class="price v-total-price">-</span>
                                                    <span class="status status-unpaid">Unpaid</span>
                                                    <span class="status-prepaid label label-confirmed hidden">Prepaid</span>
                                                    <span class="status-paid label label-confirmed hidden">Paid at venue</span>

                                                    <span class="b-status status status-discounted hidden"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><span class="status-paid label label-confirmed hidden">Prepaid</span><span class="b-status status payment-status hidden"></span></td>
                                            </tr> 
                                            <tr class="b-view-in-calendar hidden">
                                                <td colspan="2"><a class="v-view-in-calendar" href="/calendar#venue/285925/appointment/appointment/549569">View in calendar</a></td>
                                            </tr>
                                        </tbody></table>
                                        <div class="appointment-actions">
                                            <button type="button" class="button button-primary accept-action"><div class="button-inner"><div class="button-icon icons-tick5"></div>Accept</div></button>
                                            <button type="button" class="button button-attention smart-reschedule-action hidden"><div class="button-inner"><div class="button-icon icons-edit2"></div>Smart reschedule</div></button>
                                            <button type="button" class="button button-secondary reject-action"><div class="button-inner"><div class="button-icon icons-reject2"></div>Reject</div></button>
                                        </div>
                                    </div>
                                    <div class="appointment-notes has-notes hidden">
                                        <span class="notes-title">Appointment notes:</span>
                                        <span class="notes v-notes"></span>
                                        <div style="display: none;" class="wahanda-notes b-verification-notes hidden">
                                            <span class="icon icons-attention-small2"></span>
                                            <span class="notes-title">Notes from Wahanda:</span>
                                            <span class="notes v-verification-notes"></span>
                                        </div>
                                    </div>
                                    <div class="client-info clearfix">
                                        <div class="icons-customer"></div>
                                        <ul class="person-info">
                                            <li class="person-name">
                                                <a href="javascript:;" class="a-view-consumer"><span class="client_name">0903676222</span></a>
                                                <a href="javascript:;" class="edit-link a-rebook">
                                                    Rebook
                                                </a>
                                            </li>
                                            <li class="consumer-phone-row">
                                                <div class="icon icons-phone"></div>
                                                <span class="consumer-phone">+84 90 367 62 22</span>
                                            </li>
                                            <li class="consumer-email-row">
                                                <div class="icon icons-email"></div>
                                                <a class="consumer-email" href="mailto:vietnt134@gmail.com">vietnt134@gmail.com</a>
                                            </li>
                                        </ul>

                                        <div class="client-note">

                                            <span class="note-wrapper v-note">hello</span>

                                            <div class="icons-note-tip2"></div>
                                        </div>
                                    </div>
                                    <div class="appointment-meta">
                                        Booked at: <span class="full-date">19/08/2014, 13:40</span>
                                        <span class="separator">|</span>
                                        Source:<span class="source">Added in Connect by minhnhat</span>
                                        <span class="order-ref-part hidden">
                                            <span class="separator">|</span>
                                            Order ref#: <a href="javascript:;" class="order-ref">null</a>
                                        </span>
                                        <div class="b-evoucher-ref hidden">
                                            Created by using eVoucher: <a href="javascript:;" class="v-evoucher-ref"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dialog-actions b-standard-actions">
                                    <button type="button" class="button button-primary a-ok"><div class="button-inner"><div class="button-icon icons-tick"></div>OK</div></button>
                                    <button type="button" class="button button-edit change-only-this edit-appointment" data-toggle="modal" data-target="#appointment_modal">
                                        <div class="button-inner"><div class="button-icon icons-edit2"></div>Edit / Reschedule</div>
                                    </button>
                                    <button type="button" class="button a-no-show button-secondary delete-action hidden"><div class="button-inner"><div class="button-icon icons-no-show"></div>No show</div></button>
                                    <button type="button" class="button action action-default a-delete button-secondary delete-action"><div class="button-inner"><div class="button-icon icons-delete"></div><span class="msg msg-action-default">Delete</span><span class="msg msg-action-doing">Deleting...</span></div></button>
                                    <button type="button" class="button button-other a-checkout"><div class="button-inner"><div class="button-icon icons-tick"></div>Complete</div></button>

                                    <div class="sub-actions">
                                        <a href="javascript:;" class="button-cancel" data-dismiss="modal">Close</a>
                                    </div>
                                </div>
                                <div class="dialog-actions b-unassigned-actions hidden">
                                    <button type="submit" class="button action action-default button-primary save-action">
                                        <div class="button-inner">
                                            <div class="button-icon icons-tick"></div>
                                            <span class="msg msg-action-default">Save</span>
                                        </div>
                                    </button>
                                    <a href="javascript:;" class="button-cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>


        <div id="appointment_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ui-dialog-title-appointment-dialog">
            <div class="modal-dialog" style="width: 615px;">
                <div class="modal-content">
                    <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                            <span id="ui-dialog-title-appointment-dialog" class="ui-dialog-title">Appointment</span>
                            <a role="button" class="ui-dialog-titlebar-close ui-corner-all" href="#">
                                <span class="ui-icon ui-icon-closethick">close</span>
                            </a>
                        </div>
                        <div scrollleft="0" scrolltop="0" class="ui-dialog-content ui-widget-content" id="appointment-dialog">
                        <form novalidate="novalidate">
                            <div class="dialog-content clearfix">
                                <table class="default-form part-one" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr class="form-row client-select">
                                            <td class="label-part">
                                                <label for="">Khách hàng</label>
                                            </td>
                                            <td class="input-part b-consumer">
                                                <!-- search -->
                                                <div class="txt-input b-consumer-autocomplete hidden">
                                                    <input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" id="consumer-block-search" name="consumer-block-search" class="ui-autocomplete-input" placeholder="Search by phone number or name" type="text">
                                                    <input id="consumer-block-anonymous-comment" class="hidden" placeholder="Walk-in comment" type="text">
                                                </div>
                                                <!-- end search -->
                                                <!-- client -->
                                                <ul class="person-info b-person-info">
                                                    <li class="person-name">
                                                        <span class="b-consumer-name">
                                                            <a href="javascript:;" class="f-consumer-name a-show-customer">0903676222</a>
                                                        </span>
                                                        <a href="javascript:;" class="edit-link a-consumer-edit" data-toggle="modal" data-target="#client_modal">Sửa</a>
                                                        <a style="display: none;" href="javascript:;" class="edit-link a-change-consumer">Change client</a>
                                                    </li>
                                                    <li class="consumer-phoneNumber-row b-consumer-phone">
                                                        <div class="icon icons-phone"></div>
                                                        <span class="v-consumer-phone">+84 90 367 62 22</span>
                                                    </li>
                                                    <li style="display: list-item;" class="consumer-email-row b-consumer-email hidden">
                                                        <div class="icon icons-email"></div>
                                                        <span class=""><a href="mailto:" class="v-consumer-email">vietnt134@gmail.com</a></span>
                                                    </li>
                                                    <li class="consumer-note-row b-customer-note">
                                                        <div class="client-note">

                                                            <span class="note-wrapper v-customer-note">hello</span>

                                                            <div class="icons-note-tip2"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- end client -->
                                                <!-- buttons -->
                                                <div class="client-buttons b-consumer-buttons hidden">
                                                    <button type="button" class="button button-basic button-mini a-new-consumer"><div class="button-inner"><div class="button-icon icons-plus4"></div>Create new</div></button>
                                                    <button type="button" class="button button-basic button-mini a-walk-in"><div class="button-inner"><div class="button-icon icons-walkin"></div>Walk-in</div></button>
                                                </div>
                                                <!-- end buttons -->
                                                <!-- walkin -->
                                                <div class="client-walkin b-walkin hidden">
                                                    <a href="javascript:;" class="edit-link a-change-consumer">Change client</a>
                                                    <span class="walkin-status"><span class="icon icons-walkin2"></span> Walk-in</span>
                                                </div>
                                                <!-- end walkin -->
                                            </td>
                                        </tr>

                                        <tr class="form-row b-service-not-exist form-element-wrapper hidden">
                                            <td class="label-part"></td>
                                            <td class="input-part">
                                                <div class="form-note">
                                                    <span class="icon icons-attention-small2"></span>
                                                    <span class="notes">Service on eVoucher is no longer available. Select another service.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="form-row appointment-service form-element-wrapper">
                                            <td class="label-part">
                                                <label for="appointment-offerId">Dịch vụ</label>
                                            </td>
                                            <td class="input-part">
                                                <select id="appointment-offerId" class="v-appointment-service required" name="appointment-offerId"><option value="">Not set</option><optgroup label="aaa" data-group-id="24287"><option value="offer:601975" class="offer" data-sku-id="341263" data-duration="60">A kas su ki (1 h )</option></optgroup><optgroup label="fgfhg" data-group-id="23664"><option value="offer:598645" class="offer" data-sku-id="335484" data-duration="60">ghgfhgfh (1 h )</option></optgroup><optgroup label="Body" data-group-id="22810"><option value="offer:593322" class="offer" data-sku-id="325832" data-duration="60">abcxyz (1 h )</option><option value="offer:598354" class="offer" data-duration="60">Acoustic Wave Therapy</option><option value="offer:598353" class="offer" data-duration="60">Acupuncture</option><option value="offer:598349" class="offer" data-duration="60">Body Exfoliation Treatments</option><option value="offer:598350" class="offer" data-duration="60">Heat Treatments</option><option value="offer:593319" class="offer" data-sku-id="325829" data-duration="60">Body Exfoliation Treatments (1 h )</option></optgroup><optgroup label="Spa" data-group-id="22811"><option value="offer:597142" class="offer" data-sku-id="333239" data-duration="60">dfdfdsfdf (1 h )</option></optgroup><optgroup label="Counselling &amp; Holistic" data-group-id="23622"><option value="offer:598351" class="offer" data-duration="60">Reiki</option><option value="offer:598352" class="offer" data-duration="60">Aromatherapy</option><option value="offer:598955" class="offer" data-duration="60">Addictions Counselling</option></optgroup><optgroup label="Dance" data-group-id="23662"><option value="offer:598488" class="offer" data-duration="60">Ballet</option><option value="offer:598644" class="offer" data-duration="60">Ballroom Dancing</option></optgroup><optgroup label="Fitness" data-group-id="24286"><option value="offer:598355" class="offer" data-duration="60">Acrobatics</option></optgroup></select>
                                            </td>
                                        </tr>
                                        <tr class="form-row appointment-sku form-element-wrapper hidden">
                                            <td class="label-part">
                                                <label for="appointment-skuId">SKU</label>
                                            </td>
                                            <td class="input-part">
                                                <select id="appointment-skuId" class="v-appointment-sku" name="appointment-skuId"><option value="">Not set</option></select>
                                            </td>
                                        </tr>
                                        <tr class="form-row form-element-wrapper">
                                            <td class="label-part">
                                                <label for="cv-appointment-appointmentDate">Ngày</label>
                                            </td>
                                            <td class="input-part">
                                                <div class="txt-input date-input">
                                                    <input date-format="dd/mm/yy" class="datepicker required hasDatepicker" name="cv-appointment-appointmentDate" id="cv-appointment-appointmentDate" type="text">
                                                </div>
                                                <select name="appointment-startTime" id="appointment-startTime" class="required">
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
                                                </select>
                                                <span class="block-note b-rescheduled hidden">
                                                    <input class="" id="rescheduled-block-old-time" type="checkbox">
                                                    <label for="rescheduled-block-old-time">Block out original appointment time</label>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="form-row">
                                            <td class="label-part">
                                                <label for="cv-appointment-duration">Thời gian</label>
                                            </td>
                                            <td class="input-part">
                                                <select name="cv-appointment-duration" id="cv-appointment-duration" class="required">
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
                                                    <option value="60">1 h </option>
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
                                                    <option disabled="" value="660">11 h </option>
                                                    <option disabled="" value="720">12 h </option>
                                                </select>
                                                <span class="help-txt">Kết thúc lúc <span class="cv-end-time">14:00</span></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="default-form part-two" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr class="form-row">
                                            <td class="label-part">
                                                <label class="optional" for="appointment-notes">Ghi chú </label>
                                            </td>
                                            <td class="input-part">
                                                <textarea rows="6" cols="5" class="full" id="appointment-notes" name="appointment-notes"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="b-evoucher-redemption-note hidden">
                                    <div class="form-note">
                                        <span class="icon icons-attention-small2"></span>
                                        <span class="notes">Creating this appointment will lock the eVoucher. Make sure the customer understands that they will not be able to redeem it again.</span>
                                    </div>
                                </div>
                                <div class="b-reschedule-note hidden">
                                    <div class="form-note">
                                        <span class="icon icons-attention-small2"></span>
                                        <span class="notes">Please ensure that you have contacted the customer and confirmed that they are happy with the rescheduled time slot.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dialog-actions">
                                <button type="submit" class="button action action-default button-primary save-action">
                                    <div class="button-inner">
                                        <div class="button-icon icons-tick"></div>
                                        <span class="msg msg-action-default">Save</span>
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


        <div id="client_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ui-dialog-title-4">
            <div class="modal-dialog" style="width: 460px;">
                <div class="modal-content">
                    <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable">
                        <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                            <span id="ui-dialog-title-4" class="ui-dialog-title">Khách hàng</span>
                            <a role="button" class="ui-dialog-titlebar-close ui-corner-all" href="#">
                                <span class="ui-icon ui-icon-closethick">close</span>
                            </a>
                        </div>
                        <div scrollleft="0" scrolltop="0" class="client-info-dialog ui-dialog-content ui-widget-content">
                        <form novalidate="novalidate" class="edit-mode">
                            <div class="dialog-content clearfix">
                                <table class="default-form part-one" cellpadding="0" cellspacing="0">
                                    <tbody><tr class="form-row client-name-row">
                                        <td class="label-part">
                                            <label for="client_name">Tên</label>
                                        </td>
                                        <td class="input-part">
                                            <div class="txt-input txt-input-big">
                                                <input name="client_name" id="client_name" class="required valid" type="text">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-row">
                                        <td class="label-part">
                                            <label for="client_phone">Điện thoại</label>
                                        </td>
                                        <td class="input-part">
                                            <div class="txt-input">
                                                <input name="client_phone" id="client_phone" class="required phone-by-country" type="tel">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-row">
                                        <td class="label-part">
                                            <label class="optional" for="client_email">Email</label>
                                        </td>
                                        <td class="input-part">
                                            <div class="txt-input">
                                                <input name="client_email" id="client_email" class="email" type="email">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-row">
                                        <td class="label-part"></td>
                                        <td class="input-part">
                                            <input class="" name="client_sendMassEmails" id="client_sendMassEmails" type="checkbox">
                                            <label class="help-txt optional" for="client_sendMassEmails">Đồng ý nhận email thông báo lịch hẹn</label>
                                        </td>
                                    </tr>
                                    <tr class="form-row">
                                        <td class="label-part">
                                            <label class="optional">Giới tính</label>
                                        </td>
                                        <td class="input-part">
                                            <div class="several">
                                                <input class="" name="client_sex" id="client_sex-female" value="F" type="radio">
                                                <label for="client_sex-female">Nữ</label>

                                                <input class="" name="client_sex" id="client_sex-male" value="M" type="radio">
                                                <label for="client_sex-male">Nam</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-row">
                                        <td class="label-part">
                                            <label class="optional" for="client_birth">Ngày sinh</label>
                                        </td>
                                        <td class="input-part">
                                            <div class="txt-input txt-input-mini">
                                                <select class="" name="client_birthMonth" id="client_birthMonth"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option><option value="">Month</option></select>
                                                <input name="client_birthDay" pattern="\d*" id="client_birthDay" class="digits" require-with="#client_birthMonth" min="1" max="31" placeholder="day" type="number">
                                            </div>
                                            <a href="javascript:;" class="edit-link a-show-year hidden">Set year</a>
                                            <div class="txt-input txt-input-mini b-birthYear hidden">
                                                <input name="client_birthYear" pattern="\d*" id="client_birthYear" class="digits birthyear" placeholder="year" maxlength="4" type="number">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody></table>
                                <table class="default-form part-two" cellpadding="0" cellspacing="0">
                                    <tbody><tr class="form-row">
                                        <td class="label-part">
                                            <label class="optional" for="client_notes">Ghi chú</label>
                                        </td>
                                        <td class="input-part">
                                            <textarea rows="6" cols="5" class="full" id="client_notes" name="client_notes"></textarea>
                                        </td>
                                    </tr>

                                </tbody></table>
                            </div>
                            <div class="dialog-actions">
                                <button type="submit" class="button action action-default button-primary save-action">
                                    <div class="button-inner">
                                        <div class="button-icon icons-tick"></div>
                                        <span class="msg msg-action-default">Save</span>
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

        <!-- End Modal -->

    </div>
</div>