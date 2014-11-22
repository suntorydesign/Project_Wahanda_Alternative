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
                $('#select2_addService').append(out_optgroup);
                $('#select2_editService').append(out_optgroup);
            }); 
            
            // Run select 2
            $('#select2_addService').select2({
                placeholder: "Vui lòng chọn loại dịch vụ",
                allowClear: true,
            }).on("select2-selecting", function(e) {
                // console.log("selecting val=" + e.val + " choice=" + e.object.text);
                $('input[name=user_service_name]', $('#addUserService_form')).val(e.object.text);
                $('input[name=user_service_service_id]', $('#addUserService_form')).val(e.val); //
            });

            $('#select2_editService').select2({
                placeholder: "Vui lòng chọn loại dịch vụ",
                allowClear: true,
            }).on("select2-selecting", function(e) {
                // console.log("selecting val=" + e.val + " choice=" + e.object.text);
                $('input[name=user_service_name]', $('#editUserService_form')).val(e.object.text);
                $('input[name=user_service_service_id]', $('#editUserService_form')).val(e.val); //
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

    var refresh_addUS_form = function() {
        $('#addUserService_form')[0].reset();
        $('#select2_addService').select2("val", "");
        $('#ListIM_addUS').html('');
        $('#addUserService_form').find('.warning').hide();
    }

    // Khai báo DOM
    var aGN_modal = $('#addGroupName_modal'); // Add group modal
    var btn_add_group = $('.add-group'); // button open Add group modal
    var select_gsn = $('#group_service_name'); // Select box at Add group modal
    var xhrGetOM_add_group = function () {
        btn_add_group.on("click", function(){
            // Refresh
            select_gsn.html('<option></option>');
            var self = $(this);
            var url = URL + "spaCMS/menu/xhrGetOM_add_group";
            var opt = '<option value=":service_type_name">:service_type_name</option>';
            var out = null;

            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            $.get(url, function(data){
                $.each(data, function(key, value){
                    out = opt.replace(/:service_type_name/g, value['service_type_name']);
                    select_gsn.append(out);
                });

                select_gsn.select2({
                    placeholder: "Chọn nhóm dịch vụ",
                    allowClear: true
                });
            }, 'json')
            .done(function(){
                loading.hide();
                done.show();
                aGN_modal.modal("show");
            });

        });
    }

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
                html_us += '<div class="offer edit-offer" data-sid=":user_service_service_id" data-id=":user_service_id" data-gid=":user_service_group_id"';
                html_us += 'data-name=":user_service_name" data-duration=":user_service_duration" data-price=":user_service_full_price" data-sale=":user_service_sale_price" data-featured=":user_service_is_featured" ';
                html_us += 'data-status=":user_service_status" data-description=":user_service_description" data-image=":user_service_image" data-toggle="modal" data-target="#editUserServices_modal">';
                    html_us += '<div class="offer-in">';
                        html_us += '<div class="main clearfix">';
                            html_us += '<div class="icon icons-treatment"></div>';
                            html_us += '<div class="title">';
                                html_us += '<a href="javascript:;"> ';
                                    html_us += '<span class="offer-name">:user_service_name</span> ';
                                    // html_us += '<span class="label label-type v-fulfillment">Appointment or eVoucher</span> ';
                                    html_us += ':featured_label';
                                html_us += '</a>';
                            html_us += '</div>';
                            html_us += '<div class="custom-info">';
                                html_us += ':user_service_duration phút';
                            html_us += '</div>';
                            html_us += '<div class="price sku-price">';
                                html_us += ':price';
                            html_us += '</div>';
                        html_us += '</div>';
                    html_us += '</div>';
                html_us += '</div>';
            html_us += '</div>';
            html_us += ':list_user_service';

        var html_price1 = '<span class="">:full_price đ</span>';
        var html_price2 = '<span class="sku-price--previous">:full_price đ</span>';
            html_price2 += '<span class="sku-price--discount">:sale_price đ</span>';

        var html_featured_label = '<span class="label label-featured v-fulfillment">Đặc trưng</span> ';

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
                        out = out.replace(/:user_service_service_id/g, us['user_service_service_id']);
                        out = out.replace(/:user_service_group_id/g, us['user_service_group_id']);
                        out = out.replace(/:user_service_id/g, us['user_service_id']);
                        out = out.replace(/:user_service_name/g, us['user_service_name']);
                        out = out.replace(/:user_service_duration/g, us['user_service_duration']);
                        out = out.replace(/:user_service_status/g, us['user_service_status']);
                        if(us['user_service_is_featured'] == 1){
                            out = out.replace(':featured_label', html_featured_label);
                        } else {
                            // us['user_service_is_featured'] == 0;
                            out = out.replace(':featured_label', '');
                        }
                        out = out.replace(/:user_service_is_featured/g, us['user_service_is_featured']);
                        out = out.replace(/:user_service_description/g, us['user_service_description']);
                        out = out.replace(/:user_service_image/g, us['user_service_image']);
                        out = out.replace(/:user_service_full_price/g, $.number( us['user_service_full_price'] ));
                        out = out.replace(/:user_service_sale_price/g, $.number( us['user_service_sale_price'] ));
                        if( us['user_service_sale_price'] == '' ) {
                            out = out.replace(':price', html_price1);
                            out = out.replace(':full_price', $.number( us['user_service_full_price'] ));
                        } else {
                            out = out.replace(':price', html_price2);
                            out = out.replace(':full_price', $.number( us['user_service_full_price'] ));
                            out = out.replace(':sale_price', $.number( us['user_service_sale_price'] ));
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
                // Refresh form
                refresh_addUS_form();
                var group_service_id = $(this).attr('data-group_service_id');
                $('input[name=user_service_group_id]', $('#addUserService_form') ).val(group_service_id);

            });

            // Get info user service for edit this
            $('.edit-offer').on('click', function() {
                // Clear old info
                $('#ListIM_editUS').html('');

                var self = $(this);
                var editUserService_form = $('#editUserService_form');

                // get data
                var user_service_group_id   = self.attr('data-gid');
                var user_service_service_id = self.attr('data-sid');
                var user_service_id         = self.attr('data-id');
                var user_service_name       = self.attr('data-name');
                var user_service_duration   = self.attr('data-duration');
                var user_service_sale_price = self.attr('data-sale');
                var user_service_full_price = self.attr('data-price');
                var user_service_status     = self.attr('data-status');
                var user_service_image      = self.attr('data-image');
                var user_service_is_featured = self.attr('data-featured');
                var user_service_description = self.attr('data-description');

                // set data
                $('#select2_editService').select2("val", user_service_service_id);
                $('input[name=user_service_group_id]', editUserService_form).val(user_service_group_id);
                $('input[name=user_service_service_id]', editUserService_form).val(user_service_service_id);
                $('input[name=user_service_id]', editUserService_form).val(user_service_id);
                $('input[name=user_service_name]', editUserService_form).val(user_service_name);
                $('select[name=user_service_duration]', editUserService_form).val(user_service_duration);
                // $('input[name=user_service_is_featured]', editUserService_form).val(user_service_is_featured);
                $('input[name=user_service_sale_price]', editUserService_form).val(user_service_sale_price);
                $('input[name=user_service_full_price]', editUserService_form).val(user_service_full_price);
                $('select[name=user_service_status]', editUserService_form).val(user_service_status);
                $('textarea[name=user_service_description]', editUserService_form).val(user_service_description);
                if( user_service_is_featured === '1') {
                    $('input[name=user_service_is_featured]', editUserService_form).attr('checked', true);
                } else {
                    $('input[name=user_service_is_featured]', editUserService_form).attr('checked', false);
                }
                
                if(user_service_image != ''){
                    var images = user_service_image.split(',');
                    var out_leUS = null;
                    var html_leUS = '<li class="single-picture">';
                        html_leUS += '<div class="single-picture-wrapper">';
                        html_leUS += '<img src=":img_thumbnail">';
                        html_leUS += '<input type="hidden" name="user_service_image[]" value=":image">';
                        html_leUS += '</div>';
                        html_leUS += '<div class="del_image icons-delete2"></div>';
                        html_leUS += '</li>';

                    for(var i = 0; i < images.length; i++) {
                        var thumbnail = get_thumbnail(images[i], user_id);
                        out_leUS = html_leUS.replace(':img_thumbnail', thumbnail);
                        out_leUS = out_leUS.replace(':image', images[i]);
                        $('#ListIM_editUS').append(out_leUS);
                    }

                    // del image 
                    $('.del_image').on("click", function(){
                        var self = $(this).parent();
                        // self.attr("disabled","disabled");
                        self.remove();

                        // ktra so luong hinh anh da co 
                        var childrens = $('#ListIM_editUS').children().length;
                        if(childrens < 5) {
                            $('#iM_editUS').fadeIn();
                        }
                    });

                    if( images.length >= 5 ) {
                        $('#iM_editUS').hide();
                    }
                }
                

            });

        }, 'json');
    }

    // Khai báo DOM
    var aGN_form = $("#addGroupName_form");
    var xhrInsert_group_service = function() {
        aGN_form.on('submit', function() {
            var self = $(this);
            var data = self.serialize();
            var isSuccess = false;
            var loading = self.find('.s-loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/menu/xhrInsert_group_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    // Refresh list
                    xhrGet_group_user_service(); 
                    aGN_form[0].reset();
                    isSuccess = true;
                } else {
                    
                }
            })
            .done(function(){
                loading.fadeOut();
                done.fadeIn();
                if(isSuccess){
                    aGN_modal.modal("hide");
                    alert('Thêm thành công!'); 
                } else {
                    alert('Can not create menu group! :(');
                }
            });
            return false;
        });
    }

    var eGN_modal = $('#editGroupName_modal');
    var eGN_form = $('#editGroupName_form');
    var btnAct_dGN = eGN_form.find('.aDeleteGroup');
    var xhrDelete_group_service = function() {
        btnAct_dGN.on('click', function(){
            var self    = $(this);

            var isSuccess = false;
            var loading = self.find('.loading');
            var done    = self.find('.done');
            loading.fadeIn();
            done.hide();

            var group_service_id = $('input[name=group_service_id]', eGN_form).val();
            var url = URL + 'spaCMS/menu/xhrDelete_group_service';
            
            $.post(url, {'group_service_id':group_service_id}, function(result) {
                if(result === 'success') {
                    // Refresh list
                    xhrGet_group_user_service();
                    isSuccess = true;
                }
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess) {
                    eGN_modal.modal("hide");
                    alert('Xóa thành công!');
                }
                else {
                    alert('Can not delete menu group! :(');
                }
            });
        });
    }

    var xhrUpdate_group_service = function() {
        eGN_form.on('submit', function() {
            var data = $(this).serialize();

            var isSuccess = false;
            var loading = $(this).find('.e-loading');
            var done = $(this).find('.e-done');

            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/menu/xhrUpdate_group_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    // Refresh list
                    xhrGet_group_user_service();
                    isSuccess = true;
                } 
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess){
                    eGN_modal.modal('hide');
                    alert('Sửa thành công!');
                } else {
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
            var loading = self.find('.s-loading');
            var done    = self.find('.done');
            var warning = self.find('.warning');
            loading.fadeIn();
            done.hide();
            warning.hide();

            var url = URL + 'spaCMS/menu/xhrInsert_user_service';
            $.post(url, data, function(result) {
                if(result === 'success') {
                    self[0].reset(); // Refresh form
                    // Refresh list
                    xhrGet_group_user_service();
                    xhrGet_user_service_featured();
                    // Hide Modal
                    $('.button-cancel', self).click();
                    alert('Thêm dịch vụ thành công!');
                } 
                else if(result === 'max_us_featured') {
                    warning.fadeIn();
                }
                else {
                    alert('Sorry! Can not create this service! :(');
                }
                loading.fadeOut();
                done.fadeIn();
            });
            return false;
        });
    }

    var xhrUpdate_user_service = function() {
        $("#editUserService_form").on('submit', function() {
            var self    = $(this);
            var data    = self.serialize();
            var loading = self.find('.e-loading');
            var done    = self.find('.e-done');
            var warning = self.find('.warning');
            loading.fadeIn();
            done.hide();
            warning.hide();

            var url = URL + 'spaCMS/menu/xhrUpdate_user_service';
            $.post(url, data, function(result) {
                console.log(result);
                if(result === 'success') {
                    // Refresh list
                    xhrGet_group_user_service();
                    xhrGet_user_service_featured();
                    // Hide Modal
                    $('.button-cancel', self).click();
                    alert('Sửa thành công!');
                } 
                else if(result === 'max_us_featured') {
                    warning.fadeIn();
                }
                else {
                    alert('Sorry! Can not edit this service! :(');
                }
                loading.fadeOut();
                done.fadeIn();
            });
            return false;
        });
    }

    var xhrDelete_user_service = function() {
        $("#deleteUserService").on('click', function() {
            var form    = $('#editUserService_form')
            var self    = $(this);
            var loading = self.find('.d-loading');
            var done    = self.find('.d-done');
            var user_service_id = $('input[name=user_service_id]', form).val();
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/menu/xhrDelete_user_service';
            $.post(url, {'user_service_id':user_service_id}, function(result) {
                if(result === 'success') {
                    // Refresh list
                    xhrGet_group_user_service();
                    xhrGet_user_service_featured();
                    // Hide Modal
                    $('.button-cancel', form).click();
                    alert('Xóa thành công!');
                } else {
                    alert('Sorry! Can not edit this service! :(');
                }
                loading.fadeOut();
                done.fadeIn();
            });
            return false;
        });
    }

    var xhrGet_user_service_featured = function() {
        var html = '<div data-id=":user_service_id" class="offer state-act">';
            html += '<div tabindex="-1" class="offer-content">';
                    html += '<img class="pic" alt="" src=":user_service_image">';
                    html += '<div class="title">';
                        html += '<span class="icon icons-act"></span>';
                        html += ':user_service_name';
                    html += '</div>';
                html += '</div>';
                html += '<div class="offer-delete" data-id=":user_service_id">';
                    html += '<div class="icons-delete2 unfeature"></div>';
                html += '</div>';
            html += '</div>';

        var html_empty = '<div class="offer offer-empty">';
                html_empty += '<p>';
                    html_empty += 'Empty slot';
                html_empty += '</p>';
            html_empty += '</div>';

        var url = URL + 'spaCMS/menu/xhrGet_user_service_featured';
        $.get(url, function(data){
            $('.featured').html('');
            var out = '';
            var num_ept = 5 - data.length;
            var primary_img = '';

            $.each(data, function(index, us_featured) {
                primary_img = us_featured['user_service_image'].split(',');
                primary_img = get_thumbnail(primary_img[0], user_id);

                out = html.replace(/:user_service_id/g, us_featured['user_service_id']);
                out = out.replace(/:user_service_name/g, us_featured['user_service_name']);
                out = out.replace(/:user_service_image/g, primary_img);

                $('.featured').append(out);
            });

            if(num_ept > 0) {
                for (var i = 0; i < num_ept; i++) {
                    $('.featured').append(html_empty);
                };
            }

            // delete user service featured
            $('.offer-delete').on('click', function() {
                var self = $(this);
                var data_id = self.attr('data-id');
                
                var url = URL + 'spaCMS/menu/xhrDelete_user_service_featured';
                $.post(url, {'user_service_id':data_id}, function(rs) {
                    if(rs === 'success'){
                        xhrGet_group_user_service();
                        var parent = self.parent();
                        parent.fadeOut();
                        $('.featured').append(html_empty);
                    }
                });
            });
        },'json');
    }

    return {
        init: function() {
            xhrGet_group_user_service();
            xhrInsert_group_service();
            xhrUpdate_group_service();
            xhrDelete_group_service();
            xhrGetOM_add_group();
            /////////////// User Service
            xhrInsert_user_service();
            xhrUpdate_user_service();
            xhrDelete_user_service();

            xhrGet_user_service_featured();
        }
    }
}();

var ImageManager = function () {
    return {
        init: function() {
            // Gán thuộc tính cover_id tương ứng
            $('#iM_editUS').click(function(){
                $('#imageManager_saveChange').attr('cover_id','editUS');
            });

            $('#iM_addUS').click(function(){
                $('#imageManager_saveChange').attr('cover_id','addUS');
            });


            // <!-- Save Change -->
            $('#imageManager_saveChange').on('click', function(evt) {
                evt.preventDefault();
                // Define position insert to image
                var cover_id = $(this).attr('cover_id');
                // Define selected image 
                var radio_checked = $("input:radio[name='iM-radio']:checked"); // Radio checked
                // image and thumbnail_image
                var image = radio_checked.val();
                var thumbnail = radio_checked.attr('data-image');

                // Truong hop dac biet
                if(cover_id == 'addUS') {
                    var caller = $('#iM_addUS');
                    var items = $('#ListIM_addUS');
                } 
                else if(cover_id == 'editUS') {
                    var caller = $('#iM_editUS');
                    var items = $('#ListIM_editUS');
                }


                // ktra so luong hinh anh da co 
                var childrens = items.children().length + 1;
                if(childrens == 5) {
                    caller.hide();
                }

                var out = null;
                var html = '<li class="single-picture">';
                    html += '<div class="single-picture-wrapper">';
                    html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
                    html += '<input type="hidden" name="user_service_image[]" value=":image">';
                    html += '</div>';
                    html += '<div class="del_image icons-delete2"></div>';
                    html += '</li>';

                out = html.replace(':img_thumbnail', thumbnail);
                out = out.replace(':image', image);

                items.append(out);

                // del image 
                $('.del_image').on("click", function(){
                    var self = $(this).parent();
                    // self.attr("disabled","disabled");
                    self.remove();

                    // Truong hop dac biet, ktra so luong hinh anh da co 
                    var childrens = items.children().length;
                    if(childrens < 5) {
                        caller.fadeIn();
                    }
                });
                
                // else {
                //     $('#' + cover_id + '_thumbnail').attr('src', thumbnail);
                //     $('input[name=' + cover_id + ']').val(image);
                // }

                // Hide Modal
                $("#imageManager_modal").modal('hide'); 
            });
        }
    }
}();

var UserServiceFeatured = function() {
    

    // var xhrInsert_user_service = function() {
        
    // }

    return {
        init: function(){
            // xhrGet_user_service_featured();
            // xhrInsert_user_service();
        }
    }
}();


LoadMoreInfo.init();
MenuGroupService.init();
ImageManager.init();
// UserServiceFeatured.init();