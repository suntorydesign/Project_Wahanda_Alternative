

var GetMoreInfo = function () {

    var xhrGet_service = function() {
   		// user_id;
        var url = URL + 'spaCMS/settings/xhrGet_service';
        var options_type_business = '';
        $.get(url, function(data){
            $.each(data, function(index, value){
                options_type_business += '<option value="' + value['type_business_id'] + '">' + value['type_business_name'] + '</option>';
            });
            //
            $('#user_type_business_id').html(options_type_business);
        }, 'json');
    }

    return {
        init: function() {
            xhrGet_group_service();
        }
    }
}();

var TableAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleRecords = function() {

        var grid = new Datatable();
            grid.init({
                src: $("#datatable_ajax"),
                onSuccess: function(grid) {
                    // execute some code after table records loaded
                },
                onError: function(grid) {
                    // execute some code on network or other general error  
                },
                dataTable: {  // here you can define a typical datatable settings from http://datatables.net/usage/options 
                    /* 
                        By default the ajax datatable's layout is horizontally scrollable and this can cause an issue of dropdown menu is used in the table rows which.
                        Use below "sDom" value for the datatable layout if you want to have a dropdown menu for each row in the datatable. But this disables the horizontal scroll. 
                    */
                    // "sDom" : "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>r>>", 
                   
                    "aLengthMenu": [
                        [20, 50, 100, 150, -1],
                        [20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "iDisplayLength": 20, // default record count per page
                    "bServerSide": true, // server side processing
                    "sAjaxSource": URL + "spaCMS/reports/xhrGet_booking_detail", // ajax source
                    "aaSorting": [[ 1, "asc" ]] // set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function(e){
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.addAjaxParam("sAction", "group_action");
                    grid.addAjaxParam("sGroupActionName", action.val());
                    var records = grid.getSelectedRows();
                    for (var i in records) {
                        grid.addAjaxParam(records[i]["name"], records[i]["value"]);    
                    }
                    grid.getDataTable().fnDraw();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    App.alert({type: 'danger', icon: 'warning', message: 'Please select an action', container: grid.getTableWrapper(), place: 'prepend'});
                } else if (grid.getSelectedRowsCount() === 0) {
                    App.alert({type: 'danger', icon: 'warning', message: 'No record selected', container: grid.getTableWrapper(), place: 'prepend'});
                }
            });

    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();


var Index = function () {

    return {

        //main function
        init: function () {
            App.addResponsiveHandler(function () {
                jQuery('.vmaps').each(function () {
                    var map = jQuery(this);
                    map.width(map.parent().width());
                });
            });
        },

        initDashboardDaterange: function () {
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

            function (start, end) {
                var from = start.format('DD/MM/YYYY');
                var to = end.format('DD/MM/YYYY');
                var url = URL + 'spaCMS/reports/xhrGet_sales_report';

                $('#dashboard-report-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

                $.get(url, {'from':from, 'to':to}, function(data){
                    console.log(data);
                });
            }
            );


            $('#dashboard-report-range span').html(moment().format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
            $('#dashboard-report-range').show();
        },

    };

}();


App.init();
TableAjax.init();
Index.init();
Index.initDashboardDaterange();