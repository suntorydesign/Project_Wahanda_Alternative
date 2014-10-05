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

var LoadMoreInfo = function() {

    var xhrGet_service_system = function() {
        // HTML of Quick menu setup
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

        // HTML of Add service
        var optgroup = '<optgroup data-service_type_id=":service_type_id" label=":service_type_name">';
            optgroup += ':list_service_system';
            optgroup += '</optgroup>';

        var option_s = '<option value=":service_id">:service_name</option>';
            option_s += ':list_service_system';

        // xhrGet_service_system
        var url = URL + 'spaCMS/menu/xhrGet_service_system';
        $.get(url, function(data){
            // Declare
            var out_gs = '';
            var out_ls = '';
            var out_optgroup = '';

            $.each(data, function(index, group_s){
                // Append to Quick menu setup
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

                // Append to Add service
                out_optgroup = optgroup.replace(/:service_type_id/g, group_s['service_type_id']);
                out_optgroup = out_optgroup.replace(/:service_type_name/g, group_s['service_type_name']);

                if(typeof group_s['list_service_system'] !== 'undefined'){
                    $.each(group_s['list_service_system'], function(index, s){
                        // Append to Quick menu setup
                        out_ls = out_ls.replace(':list_service_system', html_s);
                        out_ls = out_ls.replace(/:service_id/g, s['service_id']);
                        out_ls = out_ls.replace(/:service_name/g, s['service_name']);

                        // Append to Add service
                        out_optgroup = out_optgroup.replace(/:list_service_system/g, option_s);
                        out_optgroup = out_optgroup.replace(/:service_id/g, s['service_id']);
                        out_optgroup = out_optgroup.replace(/:service_name/g, s['service_name']);
                    });
                }
                // remove final element of Quick setup menu
                out_ls = out_ls.replace(':list_service_system', '');
                // remove final element of Add service
                out_optgroup = out_optgroup.replace(':list_service_system', '');

                // Append to Quick menu setup
                $('.multiple-service-items').append(out_ls);
                $('.multiple-services-groups-list').append(out_gs);
                // Append to Add service
                $('#select2_service').append(out_optgroup);
            }); 
            
            // Run select 2
            $('#select2_service').select2({
                placeholder: "Select an option",
                allowClear: true
            }).on("select2-selecting", function(e) {
                // console.log("selecting val=" + e.val + " choice=" + e.object.text);
                $('input[name=user_service_name]', $('#addUserService_form')).val(e.object.text);
                $('input[name=user_service_service_id]', $('#addUserService_form')).val(e.val); //
            });
        }, 'json');
    }

    return {
        init: function(){
            xhrGet_service_system();
        }
    }
}();


var MenuGroupService = function () {

    var xhrGet_group_user_service = function() {
        var html = '<div class="offer-group">';
            html += '<div class="icon icons-drag"></div>';
                html += '<h2 class="group-title">';
                html += '<a class="aEditGroup" href="javascript:;" data-group_service_id=":group_service_id" data-group_service_name=":group_service_name" data-toggle="modal" data-target="#editGroupName_modal"> ';
                html += ':group_service_name </a>';
                html += '<button class="button button-basic button-mini add-offer" type="button" data-group_service_id=":group_service_id" data-toggle="modal" data-target="#addUserServices_modal">';
                    html += '<div class="button-inner">';
                        html += '<div class="button-icon icons-plus4"></div>';
                        html += 'Thêm dịch vụ';
                    html += '</div>';
                html += '</button></h2>';
                html += ':list_user_service';
            html += '</div>';

        var html_us = '<div class="offers ui-sortable">';
                html_us += '<div class="offer edit-offer" data-user_service_id=":user_service_id" data-toggle="modal" data-target="#addUserServices_modal">';
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
            $('#list_group_user_service').html('');

            $.each(data, function(index, group_us){
                out = html.replace(/:group_service_id/g, group_us['group_service_id']);
                out = out.replace(/:group_service_name/g, group_us['group_service_name']);

                if(typeof group_us['list_user_service'] !== 'undefined'){
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
                }
                
                out = out.replace(':list_user_service', '');
                $('#list_group_user_service').append(out);
            });
            
            // Set group_service_id to editGroupName_form
            $('.aEditGroup').on('click', function() {
                var group_service_id = $(this).attr('data-group_service_id');
                var group_service_name = $(this).attr('data-group_service_name');
                $('input[name=group_service_id]', $('#editGroupName_form') ).val(group_service_id);
                $('input[name=group_service_name]', $('#editGroupName_form') ).val(group_service_name);
            });

            // Set group_service_id to addUserService_form
            $('.add-offer').on('click', function() {
                var group_service_id = $(this).attr('data-group_service_id');
                $('input[name=user_service_group_id]', $('#addUserService_form') ).val(group_service_id);
            })

            // Get info user service for edit this
            $('.edit-offer').on('click', function() {
                $('.offer-archive').fadeIn();
            });
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
                if(result === 'success') {
                    loading.fadeOut();
                    done.fadeIn();
                    $("#addGroupName_form")[0].reset();
                    // Refresh list
                    xhrGet_group_user_service();
                    alert('Thêm thành công!')
                } else {
                    alert('Can not create menu group! :(');
                }
            });
            return false;
        });
        
    }

    var xhrDelete_group_service = function() {
        $('#editGroupName_form .aDeleteGroup').on('click', function(){
            var self    = $(this);
            var loading = self.find('.delete-action .loading');
            var done    = self.find('.delete-action .done');
            
            var group_service_id = $('input[name=group_service_id]', self).val();
            var url = URL + 'spaCMS/menu/xhrDelete_group_service';
            loading.fadeIn();
            done.hide();
            $.post(url, {'group_service_id':group_service_id}, function(result) {
                if(result === 'success') {
                    $('.button-cancel', self).click();
                    // Refresh list
                    xhrGet_group_user_service();
                    alert('Xóa thành công!');
                } else {
                    alert('Can not delete menu group! :(');
                }
                loading.fadeIn();
                done.hide();
            });
        });
    }

    var xhrUpdate_group_service = function() {
        $('#editGroupName_form').on('submit', function() {
            var data = $(this).serialize();
            var loading = $(this).find('.save-action .loading');
            var done = $(this).find('.save-action .done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/menu/xhrUpdate_group_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    loading.fadeOut();
                    done.fadeIn();
                    // Refresh list
                    xhrGet_group_user_service();
                    // Hide Modal
                    $('.button-cancel',$('#editGroupName_form')).click();
                    alert('Sửa thành công!');
                } else {
                    loading.fadeOut();
                    done.fadeIn();
                    alert('Can not edit menu group! :(');
                }
                
            });
            return false;        
        });
    }

    /////////////// User Service
    var xhrInsert_user_service = function() {
        $("#addUserService_form").on('submit', function() {
            var self    = $(this);
            var data    = self.serialize();
            var loading = self.find('.loading');
            var done    = self.find('.done');
            loading.fadeIn();
            done.hide();
            console.log(data);
            var url = URL + 'spaCMS/menu/xhrInsert_user_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    self[0].reset(); // Refresh form
                    // Refresh list
                    xhrGet_group_user_service();
                    // Hide Modal
                    $('.button-cancel', self).click();
                    alert('Thêm dịch vụ thành công!');
                } else {
                    alert('Sorry! Can not create this service! :(');
                }
                loading.fadeOut();
                done.fadeIn();
            });
            return false;
        });
    }

    return {
        init: function() {
            xhrGet_group_user_service();
            xhrInsert_group_service();
            xhrUpdate_group_service();
            xhrDelete_group_service();

            /////////////// User Service
            xhrInsert_user_service();
        }
    }
}();

var ImageManager = function () {
    return {
        init: function() {
            $('#iM_user_logo').click(function(){
                $('#imageManager_saveChange').attr('cover_id','user_logo');
            });

            $('#iM_user_slide').click(function(){
                $('#imageManager_saveChange').attr('cover_id','user_slide');
            });

            // <!-- Save Change -->
            $('#imageManager_saveChange').on('click', function(evt) {
                // Truong hop dac biet, ktra so luong hinh anh da co 
                var childrens = $('#list_user_service_image').children().length + 1;
                if(childrens == 5) {
                    $('#iM_user_slide').hide();
                }

                // 
                evt.preventDefault();
                // Define position insert to image
                var cover_id = $(this).attr('cover_id');
                // Define selected image 
                var radio_checked = $("input:radio[name='iM-radio']:checked"); // Radio checked
                // image and thumbnail_image
                var image = radio_checked.val();
                var thumbnail = radio_checked.attr('data-image');

                // Truong hop dac biet
                if(cover_id == 'user_slide') {
                    var out = null;
                    var list_image = $('#list_user_service_image');
                    var html = '<li class="single-picture">';
                        html += '<div class="single-picture-wrapper">';
                        html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
                        html += '<input type="hidden" name="user_service_image[]" value=":image">';
                        html += '</div>';
                        html += '<div class="del_image icons-delete2"></div>';
                        html += '</li>';

                    out = html.replace(':img_thumbnail', thumbnail);
                    out = out.replace(':image', image);

                    list_image.append(out);

                    // del image 
                    $('.del_image').on("click", function(){
                        var self = $(this).parent();
                        // self.attr("disabled","disabled");
                        self.remove();

                        // Truong hop dac biet, ktra so luong hinh anh da co 
                        var childrens = $('#list_user_service_image').children().length;
                        if(childrens < 5) {
                            $('#iM_user_slide').fadeIn();
                        }
                    });
                } else {
                    $('#' + cover_id + '_thumbnail').attr('src', thumbnail);
                    $('input[name=' + cover_id + ']').val(image);
                }

                // Hide Modal
                $("#imageManager_modal").modal('hide'); 
            });
        }
    }
}();

var UserService = function() {
    var xhrInsert_user_service = function() {
        $("#addUserService_form").on('submit', function() {
            var self    = $(this);
            var data    = self.serialize();
            var loading = self.find('.loading');
            var done    = self.find('.done');
            loading.fadeIn();
            done.hide();
            console.log(data);
            var url = URL + 'spaCMS/menu/xhrInsert_user_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    self[0].reset(); // Refresh form
                    // Refresh list
                    xhrGet_group_user_service();
                    // Hide Modal
                    $('.button-cancel', self).click();
                    alert('Thêm dịch vụ thành công!');
                } else {
                    alert('Sorry! Can not create this service! :(');
                }
                loading.fadeOut();
                done.fadeIn();
            });
            return false;
        });
    }

    return {
        init: function(){
            xhrInsert_user_service();
        }
    }
}();


LoadMoreInfo.init();
MenuGroupService.init();
ImageManager.init();
// UserService.init();