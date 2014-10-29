
var LoadMoreInfo = function() {
    var xhrGet_group_user_service = function() {
        // 
        var list_gus = $('.list_gus'); //

        var optgroup = '<optgroup data-id=":group_service_id" label=":group_service_name">';
            optgroup += ':list_user_service';
            optgroup += '</optgroup>';

        var option_s = '<option value=":user_service_id">:user_service_name</option>';
            option_s += ':list_user_service';

        var url = URL + 'spaCMS/menu/xhrGet_group_user_service';
        var out = '';
        $.get(url, function(data){
            // console.log(data);
            $.each(data, function(index, group_us){
                out = optgroup.replace(':group_service_id', group_us['group_service_id']);
                out = out.replace(':group_service_name', group_us['group_service_name']);

                if( typeof group_us['list_user_service'] !== 'undefined' ){
                    $.each(group_us['list_user_service'], function(index, us){
                        out = out.replace(':list_user_service', option_s);
                        out = out.replace(':user_service_id', us['user_service_id']);
                        out = out.replace(':user_service_name', us['user_service_name']);
                    });
                }

                // remove final element 
                out = out.replace(':list_user_service', '');

                list_gus.append(out);
            });
        }, 'json');
    }

    // Thời gian mở cửa của Spa
    var xhrGet_user_open_hour = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_open_hour';

        $.get(url, function(data){
            // console.log(data);
        }, 'json')
        .done(function() {
        });
    }

    return {
        init: function(){
            xhrGet_group_user_service();
            // xhrGet_user_open_hour();
        }
    }
}();


var Calendar = function(){
    /////////// DANH SÁCH CÁC ĐỐI TƯỢNG CỦA VIEW SẼ GÂY RA ACTION CONTROLLER ///////
    // confirmedAppointment
    var cA_modal = $("#confirmedAppointment_modal");
    // DOM button action
    var edit_appointment_action = cA_modal.find('.edit_appointment_action');
    var delete_appointment_action = cA_modal.find('.delete_appointment_action');
    var complete_appointment_action = cA_modal.find('.complete_appointment_action');

    var eCA_modal = $("#editConfirmedAppointment_modal");
    ////////////////////// DANH SÁCH CONTROLLER ĐƯỢC GỌI ///////////////////////////

    var xhrGet_calendar = function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
            },
            disableDragging: true,
            // hiddenDays: [0, 6], // [2, 4] hide Tuesdays and Thursdays
            defaultDate: moment(),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: {
                // url: URL + 'Views/spaCMS/calendar/php/get-events.php?URL=' + URL,
                url: URL + 'spaCMS/calendar/xhrGet_calendar',
                error: function() {
                    $('#script-warning').show();
                }
            },
            
            loading: function(bool) {
                $('#loading').toggle(bool);
            },
            dayClick: function(date, jsEvent, view) {

                var aA_modal            = $('#addAppointment_modal');
                var select_list_us      = $('.list_gus'); // Selectbox user_service
                var select_app_start    = aA_modal.find('.appointment_time_start'); // DOM của appointment_time_start 
                var user_service_duration = aA_modal.find('.user_service_duration'); // user_service_duration

                var app_date    = $('input[name=appointment_date]', aA_modal);
                var app_date_2  = aA_modal.find('.appointment_date');
                var app_created = $('input[name=appointment_created]', aA_modal);
                var appointment_time_end_2  = aA_modal.find('.appointment_time_end');
                var appointment_time_end    = $('input[name=appointment_time_end]', aA_modal);
                var appointment_price       = $('input[name=appointment_price]', aA_modal);

                // Kiểm tra ngày này spa có mở cửa hay không?
                var weekly = convert_num2dayval(date.format('d'));
                var url = URL + 'spaCMS/calendar/xhrGet_user_open_hour';
                $.get(url, function(data){
                    // console.log(data);

                    var isOpen = data[weekly][0];
                    var openHour = data[weekly][1]; // Giờ mở cửa
                    var closeHour = data[weekly][2]; // Giờ đóng cửa

                    // Không đặt lịch hẹn nếu ngày này spa không có lịch mở cửa
                    if(!isOpen) {
                        alert("Không có lịch làm việc vào ngày này!");
                        return false;
                    } 

                    // Điều chỉnh giờ bắt đầu phù hợp với dịch vụ được chọn,
                    // và thông báo giờ kết thúc
                    select_list_us.change(function(){
                        var self = $(this);

                        var us_id           = self.val(); // user_service_id
                        var us_duration     = null; // user_service_duration
                        var us_price        = null; // user_service_sale_price
                        var app_time_end    = null; // appointment_time_end
                        var app_time_start  = null; // appointment_time_start

                        // html cho option chọn thời gian bắt đầu
                        var op_app_start = '<option value=":appointment_time_start" :isScheduled>:appointment_time_start</option>';
                        var out_op_app_start = '';

                        // Lấy thời gian thực hiện của dịch vụ được chọn
                            // Nếu không có dịch vụ được chọn thì dừng
                        if(us_id === '') 
                            return false;
                        var url = URL + 'spaCMS/calendar/xhrGet_user_service';
                        $.get(url, {'user_service_id':us_id}, function(data){

                            if(data[0]['user_service_sale_price'] !== '') {
                                us_price = data[0]['user_service_sale_price'];
                            } else {
                                us_price = data[0]['user_service_full_price'];
                            }

                            us_duration = data[0]['user_service_duration']; // Thời gian thực hiện dịch vụ
                            us_duration = parseInt(us_duration);

                            // Tính các khoảng thời gian phù hợp để bắt đầu dịch vụ
                            // openHour <= openHour + duration <= closeHour
                            select_app_start.html(''); // Clear danh sách giờ bắt đầu mặc định

                            // Tạo danh sách giờ bắt đầu mới phù hợp với giờ mở cửa của spa và thời gian thực hiện dịch vụ
                            var timeStart_begin = openHour*60; // Chuyển giờ sang phút để so sánh
                            var timeStart_end   = closeHour*60;
                            var timeStart_value = timeStart_begin;

                            // ??? Tìm trong Appointment và Booking_detail
                            //// Dịch vụ này (us_id), ngày này (date) có danh sách thời gian đã đặt chỗ
                            var url = URL + "spaCMS/calendar/xhrGet_appointment_confirmed";
                            $.get(url, {'us_id':us_id, 'date':date.format()}, function(data_schedule){
                                // console.log(data_schedule);
                                while( timeStart_value < timeStart_end )
                                {   
                                    // Kiểm tra: thời gian này đã được đặt trước đó chưa?
                                    var isScheduled = false;
                                    $.each(data_schedule, function(key, value){
                                        // Chuyển sang kiểu phút trước khi so sánh:
                                        var schedule_time_start = convert_Hour2Min(value["schedule_time_start"]);
                                        var schedule_time_end   = convert_Hour2Min(value["schedule_time_end"]);

                                        // schedule_time_start <= timeStart_value < schedule_time_end
                                        if( timeStart_value >= schedule_time_start && timeStart_value < schedule_time_end ) {
                                            isScheduled = true;
                                        }
                                    });

                                    // Chuyển từ phút sang kiểu hour:minute
                                    timeStart_hourValue = convert_Min2Hour(timeStart_value);
                                    out_op_app_start += op_app_start.replace(/:appointment_time_start/g, timeStart_hourValue);

                                    // Nếu khoảng thời gian này đã được đặt trước đó thì disable thời gian này lại, để không cho người khác đặt trùng
                                    if(isScheduled) {
                                        out_op_app_start = out_op_app_start.replace(':isScheduled', 'disabled="disabled"');
                                    } else {
                                        out_op_app_start = out_op_app_start.replace(':isScheduled', '');
                                    }

                                    timeStart_value += us_duration; // Thời gian tiếp theo
                                }
                            },'json')
                            .done(function(){
                                // Hiển thị danh sách thời gian bắt đầu phù hợp với ngày và dịch vụ này
                                select_app_start.html(out_op_app_start);
                            });

                            // Khởi tạo thời gian kết thúc dịch vụ
                                // = thời gian bắt đầu (timeStart_begin) + duration 
                            app_time_start  = timeStart_begin;
                            app_time_end    = convert_Min2Hour(app_time_start + us_duration);

                        },'json')
                        .done(function(){
                            // Thông báo thời gian phục vụ của dịch vụ này
                            user_service_duration.text(us_duration);
                            // Thông báo khởi tạo thời gian kết thúc dịch vụ
                            appointment_time_end_2.text(app_time_end);
                            appointment_time_end.val(app_time_end);
                            // Thông báo ngầm giá tiền dịch vụ
                            appointment_price.val(us_price);
                        });
                    });

                }, 'json')
                .done(function(){
                    // Thông báo ngày đặt hẹn (appointment_date)
                    app_date.val(date.format());
                    app_date_2.val(date.format('DD/MM/YYYY'));
                    app_created.val(date.format());

                    // Hiển thị modal
                    $('#addAppointment_modal').modal('show');
                });

                // alert('Clicked on: ' + (date.format('d')));

                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                // alert('Current view: ' + view.name);
                
                // change the day's background color just for fun
                // $(this).css('background-color', 'red');
          
            },
            eventClick: function(e) {
                // // confirmedAppointment
                // var cA_modal = $("#confirmedAppointment_modal");
                // // DOM button action
                // var edit_appointment_action = cA_modal.find('.edit_appointment_action');
                // var delete_appointment_action = cA_modal.find('.delete_appointment_action');
                // var complete_appointment_action = cA_modal.find('.complete_appointment_action');
                

                // DOM thời gian
                var weekday = cA_modal.find('.weekday');
                var day     = cA_modal.find('.day');
                var month   = cA_modal.find('.month');
                var year    = cA_modal.find('.year');
                var time    = cA_modal.find('.time');
                // DOM thông tin dịch vụ
                var us_name     = cA_modal.find('.user_service_name');
                var us_duration = cA_modal.find('.user_service_duration');
                var us_price    = cA_modal.find('.user_service_price');
                var us_price_st_0 = cA_modal.find('.status-unpaid');
                var us_price_st_1 = cA_modal.find('.status-prepaid');
                var us_price_st_2 = cA_modal.find('.status-paid');
                // DOM trạng thái lịch hẹn
                var app_status_0  = cA_modal.find('.status-uncomplete');
                var app_status_1  = cA_modal.find('.status-complete');
                // DOM thông tin khách hàng
                var client_name   = cA_modal.find('.client_name');
                var client_phone  = cA_modal.find('.client_phone');
                var client_email  = cA_modal.find('.client_email');
                var client_note   = cA_modal.find('.client_note');
                // 
                var app_created   = cA_modal.find('.appointment_created');
                // var app_updated   = cA_modal.find('.appointment_updated');

                // Xác định url event của appointment hay booking_detail
                var url     = null;
                var data_id = null;
                var data_type = null;
                if (e.a_id) {
                    data_id = e.a_id;
                    data_type = "appointment";
                    url = URL + 'spaCMS/calendar/xhrGet_appointment';
                }

                if (e.b_id) {
                    data_id = e.b_id;
                    data_type = "booking_detail";
                    url = URL + 'spaCMS/calendar/xhrGet_booking';
                }

                // Lấy toàn bộ thông tin về event này
                $.get(url, {'data_id':data_id}, function(data) {
                    if(typeof data[0] == 'undefined') {
                        console.log("Không có data, có lẽ dữ liệu vào khiến sql gặp vấn đề");
                    }
                    console.log(data);
                    var date = new Date(data[0]['data_date']);

                    weekday.text("Thứ " + (date.getDay() + 1) );
                    day.text(date.getDate());
                    month.text(date.getMonth() + 1);
                    year.text(date.getFullYear());
                    time.text(data[0]['data_time_start']);

                    us_name.text(data[0]['data_us_name']);
                    us_duration.text(data[0]['data_us_duration'] + " phút");
                    us_price.text(data[0]['data_price'] + " đ");
                    if(data[0]['data_client_phone'] !== '') {
                        client_phone.text(data[0]['data_client_phone']);
                    } else {
                        client_phone.text('Chưa có số điện thoại');
                    }
                    client_name.text(data[0]['data_client_name']);
                    client_phone.text(data[0]['data_client_phone']);
                    client_email.text(data[0]['data_client_email']);
                    client_note.text(data[0]['data_client_note']);

                    // Thông báo trạng thái dịch vụ 
                    if(data[0]['data_status'] == '1') {
                        app_status_1.show();
                        app_status_0.hide();
                    } else {
                        app_status_1.hide();
                        app_status_0.show();
                    }

                    // 
                    if(data_type == "appointment") {
                        us_price_st_0.hide();
                        us_price_st_1.hide();
                        us_price_st_2.show();
                    }
                    if(data_type == "booking_detail") {
                        us_price_st_0.hide();
                        us_price_st_1.show();
                        us_price_st_2.hide();
                    }

                    //
                    app_created.text(data[0]['data_created']);
                    // app_updated.text(data[0]['data_update']);

                    // Xác định id lịch hẹn và appointment hay booking_detail cho việc edit lịch hẹn
                    // edit_appointment_action.attr("onClick", "editConfirmedAppointment_modal("+data[0]['data_id']+","+"'appointment'"+")");
                    edit_appointment_action.attr("data_id", data[0]['data_id']);
                    edit_appointment_action.attr("data_type", data_type);

                    // Xác định id lịch hẹn và appointment hay booking_detail cho việc xóa lịch hẹn
                    delete_appointment_action.attr("data_id", data[0]['data_id']);
                    delete_appointment_action.attr("data_type", data_type);

                    // Xác định id lịch hẹn và appointment hay booking_detail cho việc cập nhật lịch hẹn đã hoàn thành
                    complete_appointment_action.attr("data_id", data[0]['data_id']);
                    complete_appointment_action.attr("data_type", data_type);

                    /////////// EVENT 

                }, 'json').done(function() {
                    cA_modal.modal("show");
                });

                return false;
            }
        });
    }

    var xhrInsert_appointment = function() {
        $('#addAppointment_form').on('submit', function(){
            var aA_form = $(this);
            var aA_modal = $("#addAppointment_modal");

            var data = aA_form.serialize();
            // console.log(data);
            var loading = aA_form.find('.loading');
            var done = aA_form.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/calendar/xhrInsert_appointment';
            $.post(url, data, function(result){
                loading.fadeOut();
                done.fadeIn();

                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
            })
            .done(function(){
                aA_modal.modal("hide");
            });
            return false;
        });    
    }

    var xhrGetOF_appointment_for_edit = function() {
        var eCA_form = $('#editConfirmedAppointment_form');
        edit_appointment_action.on("click", function() {
            var self = $(this);
            var data_id = self.attr("data_id");
            var data_type = self.attr("data_type");

            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();
            
            var url = null;
            if(data_type == "appointment"){
            	url = URL + "spaCMS/calendar/xhrGet_appointment";
            }
            else if(data_type == "booking_detail") {
            	url = URL + "spaCMS/calendar/xhrGet_booking";
            }
            $.get(url, {"data_id":data_id}, function(data){
                // Action Btn sửa khách hàng
                var edit_client_action  = $('.edit_client_action');
                var client_id = null;

                // DOM 
                var data_client_name    = eCA_modal.find('.client_name');
                var data_client_phone   = eCA_modal.find('.client_phone');
                var data_client_note    = eCA_modal.find('.client_note');
                var data_us_id          = $('select[name=user_service_service_id]', eCA_modal);
                var data_price          = $('input[name=appointment_price]', eCA_modal);
                var data_date           = $('input[name=appointment_date]', eCA_modal);
                var data_date_2         = eCA_modal.find('.appointment_date');
                var data_time_start     = $('select[name=appointment_time_start]', eCA_modal);
                var data_time_end       = $('input[name=appointment_time_end]', eCA_modal);
                var data_time_end_2     = eCA_modal.find('.appointment_time_end');
                var data_us_duration    = eCA_modal.find('.user_service_duration');
                var data_note           = eCA_modal.find('.appointment_note');

                // import data to view
                data_client_name.text(data[0]['data_client_name']);
                data_client_phone.text(data[0]['data_client_phone']);
                data_client_note.text(data[0]['data_client_note']);
                data_us_id.val(data[0]['data_us_id']);
                data_price.val(data[0]['data_price']);
                data_date.val(data[0]['data_date']);
                data_date_2.val(data[0]['data_date']);
                data_time_start.val(data[0]['data_time_start']);
                data_time_end.val(data[0]['data_time_end']);
                data_time_end_2.text(data[0]['data_time_end']);
                data_us_duration.text(data[0]['data_us_duration']);
                data_note.text(data[0]['data_note']);   

                // Xác định client_id để sửa khách hàng
                //// Nếu là appointment thì thông tin client nằm trên bảng appointment => appointment_id
                //// Nếu là booking_detail thì thông tin client nằm trên bảng client => client_id
                if(data_type == "appointment") {
                    client_id = data[0]['data_id'];
                } else {
                    client_id = data[0]['data_client_id'];
                }
                edit_client_action.attr('data_id', client_id);
                edit_client_action.attr('data_type', data_type);

                //Xác định appointment id để cập nhật appointment
                $('input[name=data_id]', eCA_form).val(data_id);
                $('input[name=data_type]', eCA_form).val(data_type);

            }, 'json')
            .done(function(){
                loading.hide();
                done.fadeIn();
                eCA_modal.modal("show");
            });

            return false;
        });
    }

    var xhrUpdate_appointment = function() {
        var eCA_form = $('#editConfirmedAppointment_form');
        eCA_form.on('submit', function(){
            var self = $(this);
            var data = self.serialize();

            var warning_1 = self.find('.b-service-not-exist');
            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + "spaCMS/calendar/xhrUpdate_appointment";
            $.post(url, data, function(result){
                console.log(result);
            })
            .done(function(){
                loading.hide();
                done.fadeIn();
                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
                eCA_form.modal("hide");
            });

            return false;
        });
    }

    var xhrDelete_appointment = function() {
        delete_appointment_action.on("click", function() {
            var self = $(this);
            var data_id = self.attr("data_id");
            var data_type = self.attr("data_type");

            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + "spaCMS/calendar/xhrDelete_appointment";
            $.post(url, {"data_id":data_id, "data_type":data_type}, function(result){
                console.log(result);
            })
            .done(function(){
                loading.hide();
                done.fadeIn();
                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
                cA_modal.modal("hide");
            });

            return false;
        });
    }

    var xhrUpdate_appointment_status = function() {
        complete_appointment_action.on("click", function() {
            var self = $(this);
            var data_id = self.attr("data_id");
            var data_type = self.attr("data_type");

            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + "spaCMS/calendar/xhrUpdate_appointment_status";
            $.post(url, {"data_id":data_id, "data_type":data_type}, function(result){
                console.log(result);
            })
            .done(function(){
                loading.hide();
                done.fadeIn();
                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
                cA_modal.modal("hide");
            });

            return false;
        });
    }


    var xhrGetOF_client_for_edit = function() {
        var edit_client_action = $('#editConfirmedAppointment_form').find('.edit_client_action');
        var eC_modal = $('#editClient_modal');
        edit_client_action.on('click', function() {
            var self = $(this);
            var data_id = self.attr('data_id');
            var data_type = self.attr('data_type');

            var loading = self.find('.e-loading');
            loading.fadeIn();

            var url = null;
            if(data_type == "appointment"){
                url = URL + "spaCMS/calendar/xhrGet_appointment";
            }
            else if(data_type == "booking_detail") {
                url = URL + "spaCMS/calendar/xhrGet_booking";
            }

            $.get(url, {"data_id":data_id}, function(data){

                // DOM 
                var data_client_name    = $('input[name=client_name]', eC_modal);
                var data_client_phone   = $('input[name=client_phone]', eC_modal);
                var data_client_email   = $('input[name=client_email]', eC_modal);
                var data_client_sex     = $('input[name=client_sex]', eC_modal);
                var data_client_birth   = $('input[name=client_birthYear]', eC_modal);
                var data_client_note    = $('textarea[name=client_note]', eC_modal);

                // import data to view
                data_client_name.val(data[0]['data_client_name']);
                data_client_phone.val(data[0]['data_client_phone']);
                data_client_email.val(data[0]['data_client_email']);
                data_client_sex.val(data[0]['data_client_sex']);
                data_client_birth.val(data[0]['data_client_birth']);
                data_client_note.val(data[0]['data_client_note']);

                // Xác định id cho update client
                $('input[name=data_id]', eC_modal).val(data_id);
                $('input[name=data_type]', eC_modal).val(data_type);


            }, 'json')
            .done(function(){
                loading.hide();
                eC_modal.modal("show");
            });

            return false;
        });
    }

    var xhrUpdate_appointment_client = function() {
        var eC_modal = $('#editClient_modal');
    	$('#editClient_form').on("submit", function(){
    		var self = $(this);
    		var data = self.serialize();
    		
    		var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();
    		
            var url = URL + "spaCMS/calendar/xhrUpdate_appointment_client";
            $.post(url, data, function(result){
                console.log(result);
            })
            .done(function(){
                loading.hide();
                done.fadeIn();
                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
                eC_modal.modal("hide");
            });
            
    		return false;
    	}) 
    }

    return {
        init: function() {
            xhrGet_calendar();
            xhrInsert_appointment();
            xhrDelete_appointment();
            xhrUpdate_appointment_status();
            xhrGetOF_appointment_for_edit();
            xhrUpdate_appointment();
            xhrGetOF_client_for_edit();
            xhrUpdate_appointment_client();
            
        }
    }
}();


function convert_num2dayval(num) {
    switch(num) {
        case '1': return 2;
        case '2': return 3;
        case '3': return 4;
        case '4': return 5;
        case '5': return 6;
        case '6': return 7;
        case '0': return 8;
        default: return false;
    }
}

// Convert Minute to Hours
function convert_Min2Hour(time) {
    time = parseInt(time);
    if (time < 1) {
        return;
    }
    var hours = Math.floor(time / 60);
    var minutes = (time % 60);

    if(hours < 10)
        hours = "0" + hours;
    if(minutes < 10)
        minutes = "0" + minutes;

    var format = hours +":"+minutes;
    return format;
}

// Convert Time to Minutes
function convert_Hour2Min(time) {
    var data    = null;
    var hour    = null;
    var minute  = null;
    var minutes = null;

    data = time.split(":");
    hour = parseInt(data[0]);
    minute = parseInt(data[1]);

    minutes = hour*60 + minute;
    return minutes;
}


$(document).ready(function(){
    // 
    $('.appointment_time_start').change(function(){
        var self = $(this);
        var app_time_start_choice   = self.val();
        var app_time_end_choice     = null;
        var us_duration = $('#addAppointment_form .user_service_duration').text();
        us_duration = parseInt(us_duration);
        
        app_time_start_choice   = convert_Hour2Min(app_time_start_choice);
        app_time_end_choice     = app_time_start_choice + us_duration;
        app_time_end_choice     = convert_Min2Hour(app_time_end_choice);
        
        var aA_modal = $('#addAppointment_modal');
        var appointment_time_end = aA_modal.find('.appointment_time_end');
        appointment_time_end.text(app_time_end_choice);
        $('input[name=appointment_time_end]', aA_modal).val(app_time_end_choice);
    });
});

LoadMoreInfo.init();
Calendar.init();