// le viet
$("#venue_name, #venue_type, #venue_location_1, #venue_location_2, #venue_address, #loc_map, #phone, #email, #website, #face, #google, #description").tooltip({
    placement : 'right',
    html : true,
    container : 'body'
});

$(document).ready(function(){
    
});

function get_day_vi(day_en) {
    switch(day_en) {
        case '2': return "Thứ 2";
        case '3': return "Thứ 3";
        case '4': return "Thứ 4";
        case '5': return "Thứ 5";
        case '6': return "Thứ 6";
        case '7': return "Thứ 7";
        case '8': return "Chủ nhật";
        default: return false;
    }
}



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
                    var list_image = $('div.list_user_slide');
                    var html = '<li class="single-picture">';
                        html += '<div class="single-picture-wrapper">';
                        html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
                        html += '<input type="hidden" name="user_slide[]" value=":user_slide_val">';
                        html += '</div>';
                        html += '<div class="del_image icons-delete2"></div>';
                        html += '</li>';

                    out = html.replace(':img_thumbnail', thumbnail);
                    out = out.replace(':user_slide_val', image);

                    list_image.append(out);

                    // del image 
                    $('.del_image').on("click", function(){
                        var self = $(this).parent();
                        self.attr("disabled","disabled");
                        self.fadeOut();
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

var GetMoreInfo = function () {
    var xhrGet_type_business = function() {
        var url = URL + 'spaCMS/settings/xhrGet_type_business';
        var options_type_business = '';
        user_type_business_id
        $.get(url, function(data){
            $.each(data, function(index, value){
                options_type_business += '<option value="' + value['type_business_id'] + '">' + value['type_business_name'] + '</option>';
            });
            //
            $('#user_type_business_id').html(options_type_business);
        }, 'json');
    }

    var xhrGet_country = function() {
        var url = URL + 'spaCMS/settings/xhrGet_country';
        var options_country = '';
        $.get(url, function(data){
            $.each(data, function(index, value){
                options_country += '<option value="' + value['country_id'] + '">' + value['country_name'] + '</option>';
            });
            //
            $('#user_country_id').html(options_country);
            $('#user_company_country_id').html(options_country);
        }, 'json');
    }

    var xhrGet_district = function() {
        var url = URL + 'spaCMS/settings/xhrGet_district';
        var options_district = '';
        $.get(url, function(data){
            $.each(data, function(index, value){
                options_district += '<option value="' + value['district_id'] + '">' + value['district_name'] + '</option>';
            });
            //
            $('#user_district_id').append(options_district);
        }, 'json');
    }

    return {
        init: function() {
            xhrGet_type_business();
            xhrGet_country();
            xhrGet_district();
        }
    }
}();

var UserDetail = function (){

    var xhrGet_user_detail = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_detail';
        $.get(url, function(data){
            // get image thumbnail
            if(data[0]['user_logo'] != ""){
                var url_thumbnail = get_thumbnail(data[0]['user_logo'], user_id);
            }

            $('#user_logo_thumbnail').attr('src', url_thumbnail);
            $('input[name=user_logo]').val(data[0]['user_logo']);
            $('input[name=user_business_name]').val(data[0]['user_business_name']);
            $('textarea[name=user_address]').val(data[0]['user_address']);
            $('input[name=user_phone]').val(data[0]['user_phone']);
            $('input[name=user_facebook]').val(data[0]['user_facebook']);
            $('input[name=user_website]').val(data[0]['user_website']);
            $('input[name=user_googleplus]').val(data[0]['user_googleplus']);
            $('input[name=user_email]').val(data[0]['user_email']);
            $('textarea[name=user_description]').val(data[0]['user_description']);
            // $('select[name=user_country_id]').val(data[0]['user_country_id']);
            $('select[name=user_district_id]').find('option[value="'+data[0]['user_district_id']+'"]').prop("selected", true);
            $('select[name=user_type_business_id]').find('option[value="'+data[0]['user_type_business_id']+'"]').prop("selected",true);
        }, 'json');
    }

    var xhrUpdate_user_detail = function() {
        $('#user_detail_form').on('submit', function(){
            var data = $(this).serialize();
            
            var isSuccess = false;
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_detail';

            $.post(url, data, function(result) {
                if(result["success"] == true) {
                    isSuccess = true;
                }
            }, 'json')
            .done(function() {
                loading.hide();
                done.show();

                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update user detail error!");
                }
            });
            return false;
        });
    }

    var xhrGet_user_is_use_voucher = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_voucher';
        $.get(url, function(data){
            if(data){
                $('input[name=user_is_use_voucher]').attr('checked', true);
            } else {
                $('input[name=user_is_use_voucher]').attr('checked', false);
            }
            
        }, 'json');
    }

    var xhrUpdate_user_is_use_voucher = function () {
        $('#user_is_use_voucher_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_is_use_voucher';
            $.post(url, data, function(result) {
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    var xhrGet_user_slide = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_slide';
        
        var html = '<li class="single-picture">';
            html += '<div class="single-picture-wrapper">';
            html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
            html += '<input type="hidden" name="user_slide[]" value=":user_slide_val">';
            html += '</div>';
            html += '<div class="del_image icons-delete2"></div>';
            html += '</li>';

        var images = null;
        var out = null;
        var list_image = $('div.list_user_slide');
        
        $.get(url, function(data){
            if(typeof data !== 'undefined'){
                images = data[0]['user_slide'].split(",");
                // console.log(images[0]);
                for(var i=0; i<images.length; i++) {
                    var url_thumbnail = get_thumbnail(images[i], user_id);
                    out = html.replace(':img_thumbnail', url_thumbnail);
                    out = out.replace(':user_slide_val', images[i]);
                    list_image.append(out);
                }
            }

            // del image 
            $('.del_image').on("click", function(){
                var self = $(this).parent();
                self.fadeOut();
                self.html('');
            });
        }, 'json');
    }

    var xhrGet_user_map = function() {
        var loc_map = $("#loc_map");
        var input_ulat = $('input[name=user_lat]', loc_map);
        var input_ulong = $('input[name=user_long]', loc_map);
        var staticmap_img = $("#staticmap_img");

        var url = URL + "spaCMS/settings/xhrGet_user_map";
        var staticmap_src = "https://maps.googleapis.com/maps/api/staticmap?sensor=false&zoom=15&size=397x98&maptype=roadmap&markers=icon%3Ahttps%3A%2F%2Fconnect.wahanda.com%2Fassets%2Fmap-marker.png%7C:user_lat%2C:user_long";
        $.get(url, function(data) {
            staticmap_src = staticmap_src.replace(":user_lat", data["user_lat"]);
            staticmap_src = staticmap_src.replace(":user_long", data["user_long"]);
            staticmap_img.attr("src", staticmap_src);

            input_ulat.val(data["user_lat"]);
            input_ulong.val(data["user_long"]);
        }, "json");
    }

    var xhrGetOM_edit_user_map = function() {
        var vdm_modal = $("#venueDetailsMap_modal");
        var input_ulat = $('input[name=user_lat]', vdm_modal);
        var input_ulong = $('input[name=user_long]', vdm_modal);

        var btnOM_eum = $("#btnOM_editUserMap");
        btnOM_eum.on("click", function() {
            var url = URL + "spaCMS/settings/xhrGet_user_map";
            $.get(url, function(data) {

            }, "json")
            .done(function(){
                if(isSuccess) {
                    vdm_modal.modal("show");
                } else {
                    alert("Open modal edit user map error!");
                }
                
            });

            return false;
        });
        
        // Get du lieu truoc khi Open Modal
        // var map;
        // var geocoder;
        // var xCurr;
        // var yCurr;
        // var marker;
        // function initialize() {
        //     directionsDisplay = new google.maps.DirectionsRenderer();
        //     geocoder = new google.maps.Geocoder();
        //     //default position these function in google map
        //     var mapOptions = {
        //         zoom: 16,
        //         center: new google.maps.LatLng(0, 0),

        //         panControl: true,
        //         panControlOptions: {
        //             position: google.maps.ControlPosition.TOP_LEFT
        //         },
        //         zoomControl: true,
        //         zoomControlOptions: {
        //             style: google.maps.ZoomControlStyle.SMALL,
        //             position: google.maps.ControlPosition.LEFT_CENTER
        //         },
        //         mapTypeControl: true,
        //         mapTypeControlOptions: {
        //             style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        //             position: google.maps.ControlPosition.TOP_RIGHT
        //         }
        //     };
        //     var map = new google.maps.Map(document.getElementById('venue-details-map-container'),mapOptions);
        //     directionsDisplay.setMap(map);
        //     var LNG = '';
        //     var LAT = '';
        //     if(LNG == '' && LAT == ''){
        //         if (navigator.geolocation) {
        //             navigator.geolocation.getCurrentPosition(function (position) {
        //                 initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        //                 map.setCenter(initialLocation);

        //                 marker = new google.maps.Marker({
        //                     position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        //                     map : map,
        //                 });
        //                 marker.setAnimation(google.maps.Animation.BOUNCE);
        //                 //Get address name based on coordinate
        //                 var lat = position.coords.latitude;
        //                 var lng = position.coords.longitude;
        //                 var latlng = new google.maps.LatLng(lat, lng);
        //                 geocoder.geocode({ 'latLng': latlng }, function (results, status) {
        //                     console.log(results);
        //                     if (status == google.maps.GeocoderStatus.OK) {
        //                         //document.getElementById("streetName").innerHTML = (results[1].formatted_address);
        //                         for(i = 0;i<7;i++){
        //                             // alert(results[i].formatted_address);
        //                         }
        //                         //.substring(0,34) + '...'
        //                     } else {
        //                         alert('Geocoder failed due to: ' + status);
        //                     }
        //                 });
        //                 xCurr = position.coords.latitude;
        //                 yCurr = position.coords.longitude;
        //                 //alert(xCurr +', '+ yCurr);
        //                 marker.setMap(map);
        //             });
        //         }
        //     }else{
        //         initialLocation = new google.maps.LatLng(LAT, LNG);
        //         map.setCenter(initialLocation);
        //         marker = new google.maps.Marker({
        //             position: new google.maps.LatLng(LAT, LNG),
        //             map : map,
        //         });
        //         marker.setAnimation(google.maps.Animation.BOUNCE);
        //     }
            
        //     google.maps.event.addListener(map, 'click', function (event) {
        //         // marker.setVisible(true);
        //         //alert(Math.sqrt(Math.abs(Math.pow(xCurr, 2) - Math.pow(event.latLng.lat(), 2))) + Math.sqrt(Math.abs(Math.pow(yCurr, 2) - Math.pow(event.latLng.lng(), 2))));
        //         //if (Math.abs(event.latLng.lat() - xCurr) < 200 && Math.abs(event.latLng.lng()) < 200)
        //         // if (Math.sqrt(Math.abs(Math.pow(xCurr, 2) - Math.pow(event.latLng.lat(), 2))) + Math.sqrt(Math.abs(Math.pow(yCurr, 2) - Math.pow(event.latLng.lng(), 2))) < 0.5) {
        //         // console.log(event);
        //         placeMarker(event.latLng);
        //         marker.setAnimation(google.maps.Animation.BOUNCE);
        //         // setTimeout(function () { document.getElementById('report').submit(); }, 1000);
        //         // }
        //     });
        // }
        // function placeMarker(location) {
        //     if (marker) {
        //         marker.setPosition(location);

        //     } else {
        //         marker = new google.maps.Marker({
        //             position: location,
        //             map: map,
        //         });
        //     }
        //     console.log(location.lat());
        //     console.log(location.lng());
        // }
        // google.maps.event.addDomListener(window, 'load', initialize);

    }

    return {
        init: function(){
            xhrGet_user_detail();
            xhrUpdate_user_detail();
            xhrGet_user_is_use_voucher();
            xhrUpdate_user_is_use_voucher();
            xhrGet_user_slide();
            xhrGet_user_map();
            xhrGetOM_edit_user_map();
        }
    }
}();

var UserOpenHour = function (){
    var xhrGet_user_open_hour = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_open_hour';
        $.get(url, function(data){
            var status = null;
            var checked = null;
            var disabled = null;
            var selected = null;
            var open_hour = null;
            var close_hour = null;
            var option_open_hour = '';
            var option_close_hour = '';
            // $('input[name=user_open_hour_old').val(data);

            var out_html = '<li class=":status">';
                out_html += '<div>';
                out_html += '<input class="user_open_hour_checked" type="checkbox" :checked id=":day">';
                out_html += '<label for=":day">:vi_day</label>';
                out_html += '<select :disabled name="user_open_hour_from[:day]">';
                out_html += ':option_open_hour';
                out_html += '</select> - ';
                out_html += '<select :disabled name="user_open_hour_to[:day]">';
                out_html += ':option_close_hour';
                out_html += '</select>';
                out_html += '</div>';
                out_html += '</li>';

            var weekly = $('#opening-hours ul.week');
            $.each(data, function(day, hour){
                var vi_day = get_day_vi(day);
                var open_hour = hour[1];
                var close_hour = hour[2];
                option_open_hour = '';
                option_close_hour = '';

                if(hour[0] == 0) {
                    status  = 'off';
                    checked = '';
                    disabled = 'disabled="disabled"';
                } else {
                    status  = 'on';
                    checked = 'checked="checked"';
                    disabled = '';
                }

                var out = out_html.replace(':status', status);
                    out = out.replace(/:checked/g, checked);
                    out = out.replace(/:disabled/g, disabled);
                    out = out.replace(/:day/g, day);
                    out = out.replace(/:vi_day/g, vi_day);

                    for (var i = 0; i < 24; i++) {
                        if(i == open_hour) {
                            selected = 'selected="selected"';
                        } else {
                            selected = null;
                        }

                        if(i<10) {
                            option_open_hour += '<option '+selected+' value="'+i+'">0'+i+':00</option>';
                        }
                        if(i>10) {
                            option_open_hour += '<option '+selected+' value="'+i+'">'+i+':00</option>';
                        }
                    }

                    for (var i = 0; i < 24; i++) {
                        if(i == close_hour) {
                            selected = 'selected="selected"';
                        } else {
                            selected = null;
                        }

                        if(i<10) {
                            option_close_hour += '<option '+selected+' value="'+i+'">0'+i+':00</option>';
                        }
                        if(i>10) {
                            option_close_hour += '<option '+selected+' value="'+i+'">'+i+':00</option>';
                        }
                    }
                    out = out.replace(':option_open_hour', option_open_hour);
                    out = out.replace(':option_close_hour', option_close_hour);

                weekly.append(out);
            });

            $('.user_open_hour_checked').change(function() {
                if ($(this).is(':checked')) {
                    var li = $(this).parent().parent();
                    li.removeClass('off');
                    li.addClass('on');
                    li.find('select').removeAttr('disabled');
                }
                else {
                    var li = $(this).parent().parent();
                    li.removeClass('on');
                    li.addClass('off');
                    li.find('select').attr('disabled','disabled');
                }
            });
        }, 'json');
    }

    var xhrUpdate_user_open_hour = function() {
       $('#user_open_hour_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_open_hour';

            $.post(url, data, function(result) {
                // console.log(result);
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    return {
        init: function(){
            xhrGet_user_open_hour();
            xhrUpdate_user_open_hour();
        }
    }
}();

var UserFinance = function (){
    var xhrGet_user_company = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_company';
        $.get(url, function(data){
            if(data.length > 0) {
                $('input[name=user_company_name]').val(data[0]['user_company_name']);
                $('input[name=user_company_delegate]').val(data[0]['user_company_delegate']);
                $('textarea[name=user_company_address]').val(data[0]['user_company_address']);
                $('input[name=user_company_tax_code]').val(data[0]['user_company_tax_code']);
                $('select[name=user_company_country_id]').find('option[value="'+data[0]['user_company_country_id']+'"]').prop("selected", true);
                $('input[name=user_contact_name]').val(data[0]['user_contact_name']);
                $('input[name=user_contact_email]').val(data[0]['user_contact_email']);
                $('input[name=user_contact_phone]').val(data[0]['user_contact_phone']);
                $('input[name=user_contact_role]').val(data[0]['user_contact_role']);
            }
        }, 'json');
    }

    var xhrUpdate_user_company = function () {
        $('#user_company_form').on('submit', function(){
            var data = $(this).serialize();
            var isSuccess = false;
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_company';
            $.get(url, data, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
                
            })
            .done(function() {
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert('Cập nhật thành công!');
                } else {
                    alert('Update finance error!');
                }
            });
            return false;
        });
    }

    var xhrGet_user_bank_acc = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_bank_acc';
        $.get(url, function(data){
            $('input[name=user_bank_acc_owner]').val(data[0]['user_bank_acc_owner']);
            $('input[name=user_bank_acc]').val(data[0]['user_bank_acc']);
            $('textarea[name=user_bank_address]').val(data[0]['user_bank_address']);
            $('input[name=user_bank_branch]').val(data[0]['user_bank_branch']);
            $('input[name=user_bank_name]').val(data[0]['user_bank_name']);
        }, 'json');
    }

    var xhrUpdate_user_bank_acc = function () {
        $('#user_bank_acc_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_bank_acc';
            $.get(url, data, function(result) {
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    return {
        init: function(){
            xhrGet_user_company();
            xhrUpdate_user_company();
            xhrGet_user_bank_acc();
            xhrUpdate_user_bank_acc();
        }
    }
}();

var UserNotification = function() {
    var un_form = $('#user_notification_form');
    var input_une = $('input[name=user_notification_email]', un_form);

    var xhrGet_user_notification_email = function() {
        var url = URL + "spaCMS/settings/xhrGet_user_notification_email";
        $.get(url, function(data){
            input_une.val(data[0]['user_notification_email']);
        }, 'json')
        .done(function(){
            // input_une.fadeIn();
        });
    }

    var xhrUpdate_user_notification = function() {
        un_form.on('submit', function(e){
            e.preventDefault();
            var self = $(this);
            var data = input_une.val();
            // var data = $(this).serialize();
            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_notification';
            $.post(url, {'user_notification_email':data}, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update Email notification error!");
                }
            });

        });
    }

    return {
        init: function() {
            xhrGet_user_notification_email();
            // Update email
            xhrUpdate_user_notification();
        }
    }
}();

var OnlineBooking = function() {
    var editOBs_form = $('#editOBs_form');
    var xhrUpdate_online_booking = function() {
        editOBs_form.on("submit", function(e) {
            e.preventDefault();
            var self = $(this);
            var data = self.serialize();

            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/settings/xhrUpdate_online_booking';
            $.post(url, data, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update Online Booking error!");
                }
            });

            return false;
        });
    }

    var xhrGet_user_is_use_gvoucher = function() {
        var ckbox_uiugv = $('input[name=user_is_use_gvoucher]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_gvoucher';
        $.get(url, function(data){
            if(data['user_is_use_gvoucher'] == 1) {
                ckbox_uiugv.prop( "checked", true );
            } else {
                ckbox_uiugv.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_is_use_evoucher = function() {
        var ckbox_uiuev = $('input[name=user_is_use_evoucher]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_evoucher';
        $.get(url, function(data){
            if(data['user_is_use_evoucher'] == 1) {
                ckbox_uiuev.prop( "checked", true );
            } else {
                ckbox_uiuev.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_is_use_appointment = function() {
        var ckbox_uiua = $('input[name=user_is_use_appointment]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_appointment';
        $.get(url, function(data){
            if(data['user_is_use_appointment'] == 1) {
                ckbox_uiua.prop( "checked", true );
            } else {
                ckbox_uiua.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_limit_before_booking = function() {
        var input_ulbb = $('input[name=user_limit_before_booking]', editOBs_form);
        var select_ulbs = $('select[name=user_limit_before_service]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_limit_before_booking';
        $.get(url, function(data){
            input_ulbb.val(data['user_limit_before_booking']);
            select_ulbs.find('option[value="'+data['user_limit_before_service']+'"]').prop("selected",true);
        }, 'json');
    }

    return {
        init: function(){
            xhrGet_user_is_use_gvoucher();
            xhrGet_user_is_use_evoucher();
            xhrGet_user_is_use_appointment();
            xhrGet_user_limit_before_booking();

            xhrUpdate_online_booking();
        }
    }
}();

var Sercurity = function (){
    var sp_form = $("#security_password_form");
    var xhrUpdate_user_password = function() {
        sp_form.on("submit", function(e){
            e.preventDefault();
            var self = $(this);
            var input_up = $('input[name=user_password]').val();
            var input_up_new = $('input[name=user_password_new]').val();
            var input_up_newc = $('input[name=user_password_new_confirm]').val();

            var isNotMatch = false;
            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            var warning_notmatch = $('.warning_notmatch');
            var warning_error = $('.warning_error');

            warning_notmatch.hide();
            warning_error.hide();
            loading.fadeIn();
            done.hide();

            if(input_up_new == input_up_newc) {
                var url = URL + 'spaCMS/settings/xhrUpdate_user_password';
                $.post(url, {'user_password':input_up, 'user_password_new':input_up_new}, function(result){
                    if(result == 'password_error') {
                        isNotMatch = true;
                        return false;
                    }

                    if(result == 'success') {
                        isSuccess = true;
                    }
                })
                .done(function(){
                    if(isSuccess) {
                        sp_form[0].reset();
                        alert("Cập nhật thành công!");
                    } 
                    else if(isNotMatch) {
                        warning_error.fadeIn();
                    }
                    else {
                        alert("Update Password error!");
                    }
                });
            } else {
                warning_notmatch.fadeIn();
            }

            loading.hide();
            done.show();
        });
        
        
    }

    return {
        init: function(){
            xhrUpdate_user_password();
        }
    }
}();


GetMoreInfo.init();
UserDetail.init();
UserOpenHour.init();
UserFinance.init();
UserNotification.init();
OnlineBooking.init();
Sercurity.init();

ImageManager.init();