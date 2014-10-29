$(document).ready(function() {
	
	$("#bookings, #venue, #phone , #sale").tooltip({
		placement : 'top',
		html : true,
		container : 'body',
		delay : 0
	});

	$("#e_voucher_id").inputmask("A-*****-******-*****", {
        placeholder: "_-_____-______-_____",
        clearMaskOnLostFocus: true
    }); //default

    String.prototype.insert = function (index, string) {
      if (index > 0)
        return this.substring(0, index) + string + this.substring(index, this.length);
      else
        return string + this;
    };
}); 


var redeemVoucher = function() {
    var rV_modal = $('#redeemVoucher_modal');
    var voucher_start     = rV_modal.find('.voucher-start');
    var voucher_searching = rV_modal.find('.voucher-searching');
    var voucher_not_found = rV_modal.find('.voucher-not-found');
    var voucher_info      = rV_modal.find('.voucher-info');
    var voucher_redeem_success = rV_modal.find('.voucher-redeem-success');
    // Action xác thực
    var redeem_action = rV_modal.find('.redeem-action');

    // Open model redeem
    var redeem = $('#redeem');
    redeem.on("click", function(){
        hide_all_screen();
        voucher_start.show();
        rV_modal.modal('show');
    });

    // e_voucher status
    e_voucher_status_1 = rV_modal.find('.e_voucher_status_1');
    e_voucher_status_0 = rV_modal.find('.e_voucher_status_0');

    var xhrGet_redeem_voucher = function() {
        $("#redeemVoucher_form").on("submit", function(){
            var self = $(this);
            hide_all_screen();
            // Lấy mã eVoucher
            var e_voucher_id = $('input[name=e_voucher_id]', self).val();
            e_voucher_id = e_voucher_id.replace(/-/g, '');
            e_voucher_id = e_voucher_id.insert(1, '-');
            
            // Xác thực mã
            var isNotFound = false; // status
            var url = URL + "spaCMS/home/xhrGet_redeem_voucher";
            $.post(url, {'e_voucher_id':e_voucher_id}, function(data){

                // loading...
                voucher_start.hide();
                voucher_searching.show();

                if(data.length == 0) {
                    isNotFound = true;
                    return false;
                } 

                var booking_id = rV_modal.find('.booking_id');
                var client_name = rV_modal.find('.client_name');
                var client_phone = rV_modal.find('.client_phone');
                var user_service_name = rV_modal.find('.user_service_name');
                var e_voucher_due_date = rV_modal.find('.e_voucher_due_date');
                var e_voucher_price = rV_modal.find('.e_voucher_price');
                
                booking_id.text(data[0]['booking_id']);
                client_name.text(data[0]['client_name']);
                client_phone.text(data[0]['client_phone']);
                user_service_name.text(data[0]['user_service_name']);
                e_voucher_due_date.text(data[0]['e_voucher_due_date']);
                e_voucher_price.text(data[0]['e_voucher_price'] + " vnđ");

                // Status của evoucher
                //// Nếu chưa được sử dụng
                if(data[0]['e_voucher_status'] == 0){
                    e_voucher_status_0.show();
                    e_voucher_status_1.hide();

                    // Xác định id evoucher cho việc sử dụng nó
                    redeem_action.attr('data_id', data[0]['e_voucher_id'] );
                    // Hiện nút action xác thực
                    redeem_action.fadeIn();
                } else {    
                    e_voucher_status_0.hide();
                    e_voucher_status_1.show();

                    // Ẩn nút action xác thực
                    redeem_action.hide();
                }

            }, 'json')
            .done(function(){
                if(isNotFound) {
                    // warning status
                    voucher_searching.hide();
                    voucher_not_found.fadeIn();
                    voucher_info.hide();
                } else {
                    // success status
                    voucher_searching.hide();
                    voucher_not_found.hide();
                    voucher_info.fadeIn();
                }
            });

            return false;
        });
    }    
    
    var xhrUpdate_e_voucher = function() {
        redeem_action.on("click", function(){
            var self = $(this);
            var data_id = self.attr('data_id');

            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + "spaCMS/home/xhrUpdate_e_voucher";
            $.post(url, {'data_id':data_id}, function(result){
                if(result == 'success') {
                    hide_all_screen();
                    voucher_redeem_success.fadeIn();
                }
            })
            .done(function(){
                loading.hide();
                done.fadeIn();
            });

            return false;
        })
    }
    
    var hide_all_screen = function(){
        voucher_start.hide();
        voucher_searching.hide();
        voucher_not_found.hide();
        voucher_info.hide();
        voucher_redeem_success.hide();
        redeem_action.hide();
    }


    return {
        init: function() {
            xhrGet_redeem_voucher();
            xhrUpdate_e_voucher();
        }
    }
}();


redeemVoucher.init();