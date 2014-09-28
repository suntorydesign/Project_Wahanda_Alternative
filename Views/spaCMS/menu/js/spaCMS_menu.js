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
 
});

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

    return {
        init: function() {
            xhrGet_group_user_service();
        }
    }
}();

Menu.init();