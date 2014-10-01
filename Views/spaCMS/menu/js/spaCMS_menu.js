$(document).ready(function() {
    $("#service_name, #price, #sell_service, #sold_as").tooltip({
        placement : 'right',
        html : true,
        container : 'body'
    });
    $("#menu_group").tooltip({
        placement : 'top',
        html : true,
        container : 'body'
    });

	// // After checked Check box on Edit group name modal form, show/hidden settings correspondence
 //    $("input#jit-checkbox").change(function(){
 //        if(this.checked) {
 //            $("li.jit .settings").removeClass('hidden');
 //        } else {
 //            $("li.jit .settings").addClass('hidden');
 //        }
 //    });

 //    $("input#off-peak-checkbox").change(function(){
 //        if(this.checked) {
 //            $("li.off-peak .settings").removeClass('hidden');
 //        } else {
 //            $("li.off-peak .settings").addClass('hidden');
 //        }
 //    });

    $('#select2_service').select2({
        placeholder: "Select an option",
        allowClear: true
    });
 
});

var MoreInfo = function() {

    var get_service_system = function() {
        var html = '<li id="treatment-type-:service_type_id" class="ui-state-default ui-corner-top :is_first_gs">';
            html += '<a href="#treatment-type-cat-:service_type_id" role="tab" data-toggle="tab"> ';
                    html += ':service_type_name <span class="count hidden">0</span>';
                html += '</a>';
            html += '</li>';

        var html_ls = '<div id="treatment-type-cat-:service_type_id" class="multiple-services-list ui-tabs-panel ui-widget-content ui-corner-bottom tab-pane fade :is_first_s">';
            html_ls += '<ul>';
            html_ls += ':list_service_system';
            html_ls += '</ul>';
            html_ls += '</div>';

        var html_s = '<li>';
                html_s += '<input type="checkbox" value=":service_id" id="treatment-:service_id">';
                html_s += '<label for="treatment-:service_id">:service_name</label>';
            html_s += '</li>';
            html_s += ':list_service_system';

        var url = URL + 'spaCMS/menu/xhrGet_service_system';

        $.get(url, function(data){
            var out_gs = '';
            var out_ls = '';

            console.log(data);
            // for(var i = 0; i < data.length; i++) {

            // }

            $.each(data, function(index, group_s){
                out_gs = html.replace(/:service_type_id/g, group_s['service_type_id']);
                out_gs = out_gs.replace(/:service_type_name/g, group_s['service_type_name']);

                out_ls = html_ls.replace(/:service_type_id/g, group_s['service_type_id']);
                if(index == 0) {
                    out_gs = out_gs.replace(/:is_first_gs/g, 'active');
                    out_ls = out_ls.replace(/:is_first_s/g, 'in active');
                } else {
                    out_gs = out_gs.replace(/:is_first_gs/g, '');
                    out_ls = out_ls.replace(/:is_first_s/g, '');
                }

                $.each(group_s['list_service_system'], function(index, s){
                    out_ls = out_ls.replace(':list_service_system', html_s);
                    out_ls = out_ls.replace(/:service_id/g, s['service_id']);
                    out_ls = out_ls.replace(/:service_name/g, s['service_name']);
                });
                out_ls = out_ls.replace(':list_service_system', '');
                console.log(out_ls);
                $('.multiple-service-items').append(out_ls);
                $('.multiple-services-groups-list').append(out_gs);
            }); 
            
        }, 'json');
    }

    return {
        init: function(){
            get_service_system();
        }
    }
}();


var Menu = function () {

    var xhrGet_group_user_service = function() {
        var html = '<div class="offer-group">';
            html += '<div class="icon icons-drag"></div>';
                html += '<h2 class="group-title"><a href="javascript:;" data-group-service-id=":group_service_id" data-group-service-name=":group_service_name" data-toggle="modal" data-target="#editGroupName_modal"> :group_service_name </a>';
                html += '<button class="button button-basic button-mini add-offer" type="button" data-offer-group-id=":group_service_id" data-toggle="modal" data-target="#addServices_modal">';
                    html += '<div class="button-inner">';
                        html += '<div class="button-icon icons-plus4"></div>';
                        html += 'Thêm dịch vụ';
                    html += '</div>';
                html += '</button></h2>';
                html += ':list_user_service';
            html += '</div>';

        var html_us = '<div class="offers ui-sortable">';
                html_us += '<div class="offer ">';
                    html_us += '<div class="offer-in">';
                        html_us += '<div class="main clearfix">';
                            html_us += '<div class="icon icons-treatment"></div>';
                            html_us += '<div class="title">';
                                html_us += '<a href="javascript:;"> ';
                                    html_us += '<span class="offer-name">:user_service_name</span> ';
                                    // html_us += '<span class="label label-type v-fulfillment">Appointment or eVoucher</span> ';
                                    // html_us += '<span class="label label-type v-fulfillment">Appointment</span> ';
                                    // html_us += '<span class="label label-type v-fulfillment">eVoucher</span> ';
                                html_us += '</a>';
                            html_us += '</div>';
                            html_us += '<div class="custom-info">';
                                html_us += ':user_service_duration phút';
                            html_us += '</div>';
                            html_us += '<div class="price sku-price">';
                                html_us += '<span class="sku-price--previous">:user_service_full_price vnđ</span>';
                                html_us += '<span class="sku-price--discount">:user_service_sale_price vnđ</span>';
                            html_us += '</div>';
                        html_us += '</div>';
                    html_us += '</div>';
                html_us += '</div>';
            html_us += '</div>';
            html_us += ':list_user_service';

        // user_id;
        var url = URL + 'spaCMS/menu/xhrGet_group_user_service';
        var out = '';
        $.get(url, function(data){
            $.each(data, function(index, group_us){
                out = html.replace(/:group_service_id/g, group_us['group_service_id']);
                out = out.replace(/:group_service_name/g, group_us['group_service_name']);
                $.each(group_us['list_user_service'], function(index, us){
                    out = out.replace(':list_user_service', html_us);
                    out = out.replace(/:user_service_id/g, us['user_service_id']);
                    out = out.replace(/:user_service_name/g, us['user_service_name']);
                    out = out.replace(/:user_service_duration/g, us['user_service_duration']);
                    if( us['user_service_sale_price'] == '' ) {
                        out = out.replace(/:user_service_full_price/g, '');
                        out = out.replace(/:user_service_sale_price/g, us['user_service_full_price']);
                    } else {
                        out = out.replace(/:user_service_full_price/g, us['user_service_full_price']);
                        out = out.replace(/:user_service_sale_price/g, us['user_service_sale_price']);
                    }
                });
                out = out.replace(':list_user_service', '');
                $('#list_group_user_service').append(out);
            });
            //
           
        }, 'json');
    }

    var xhrInsert_group_service = function() {
        $("#addGroupName_form").on('submit', function() {
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/menu/xhrInsert_group_service';
            $.post(url, data, function(result) {
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
        
    }

    return {
        init: function() {
            xhrGet_group_user_service();
            xhrInsert_group_service();
        }
    }
}();


MoreInfo.init();
Menu.init();