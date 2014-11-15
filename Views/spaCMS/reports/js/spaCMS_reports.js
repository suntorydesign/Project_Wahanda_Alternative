
var BookingReport = function() {
    var table_lob = $("#listOfBooking_table");
    var xhrGet_booking_report = function() {
        var lob = table_lob.find('tbody');
        var html = '<tr>'
                +   '<td>:booking_id</td>'
                +   '<td>:client_name</td>'
                +   '<td>:user_service_name</td>'
                +   '<td>:booking_detail_price đ</td>'
                +   '<td>:booking_date</td>'
                +   '<td>:booking_detail_status</td>'
                +   '</tr>';

        var status_0 = '<span class="label label-sm label-info">Pending</span>';
        var status_1 = '<span class="label label-sm label-success">Approve</span>';
        var status_2 = '<span class="label label-sm label-danger">Block</span>';

        var url = URL + 'spaCMS/reports/xhrGet_booking_report';
        var out = '';
        $.get(url, function(data){
            $.each(data, function(key, booking){
                out = html.replace(':booking_id', booking['booking_id']);
                out = out.replace(':client_name', booking['client_name']);
                out = out.replace(':user_service_name', booking['user_service_name']);
                out = out.replace(':booking_detail_price', booking['booking_detail_price']);
                out = out.replace(':booking_date', booking['booking_date']);
                out = out.replace(':booking_detail_status', booking['booking_detail_status'] == 0 ? status_0 : booking['booking_detail_status'] == 1 ? status_1 : status_2 );
                lob.append(out);
            })
        }, 'json')
        .done(function() {
            table_lob.dataTable({
                "aoColumns": [
                    { "sWidth": "15%" },
                    { "sWidth": "15%" },
                    { "sWidth": "30%", "sClass": "center", "bSortable": true },
                    null,
                    null,
                    { "sWidth": "9%", "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],

                // set the initial value
                "iDisplayLength": 10,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                }
            });

            jQuery('#listOfBooking_table_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#listOfBooking_table_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
            jQuery('#listOfBooking_table_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
        });
    }

    return {
        init: function() {
            xhrGet_booking_report();
        }
    }
}();

var SaleReport = function () {
    return {
        //main function
        init: function () {
           $('#dashboard-report-range').daterangepicker({
                opens: (App.isRTL() ? 'right' : 'left'),
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2014',
                dateLimit: {
                    days: 60
                },
                showDropdowns: false,
                showWeekNumbers: false,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '7 Ngày trước': [moment().subtract('days', 6), moment()],
                    '30 Ngày trước': [moment().subtract('days', 29), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'blue',
                cancelClass: 'default',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Chọn',
                    fromLabel: 'Từ',
                    toLabel: 'Đến',
                    customRangeLabel: 'Tùy chọn',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                    firstDay: 1
                }
            },
            // Chuyển định dạng ngày trước khi gửi request
            function (start, end) {
                var from = start.format('YYYY-MM-DD');
                var to = end.format('YYYY-MM-DD');
                var url = URL + 'spaCMS/reports/xhrGet_sale_report';

                $('#dashboard-report-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $('.period').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

                var sr_bsg = $("#sale_report_by_service_group").find('tbody');
                var sr_ts = $("#sale_report_top_service").find('tbody');

                var html = '<tr>'
                        +   '<td>:name</td>'
                        +   '<td>:value</td>'
                        +   '<td>:count</td>'
                        + '</tr>';

                var out = '';

                $.get(url, {'from':from, 'to':to}, function(data){
                    $(".totalSale_value").text(data['totalSale']['value']);
                    $(".totalSale_count").text(data['totalSale']['count']);

                    $.each(data['groupServiceSale'], function(index, groupService){
                        out = html.replace(':name', groupService['name']);
                        out = out.replace(':value', groupService['value']);
                        out = out.replace(':count', groupService['count']);
                        sr_bsg.append(out);
                    });

                    $.each(data['topServiceSale'], function(index, topService){
                        out = html.replace(':name', topService['name']);
                        out = out.replace(':value', topService['value']);
                        out = out.replace(':count', topService['count']);
                        sr_ts.append(out);
                    });
                }, 'json');
            }
        );


        $('#dashboard-report-range span').html(moment().format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
        $('#dashboard-report-range').show();
        }
    };
}();

BookingReport.init();
SaleReport.init();
