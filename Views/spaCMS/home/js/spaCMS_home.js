$(document).ready(function() {
	
	$("#bookings, #venue, #phone , #sale").tooltip({
		placement : 'top',
		html : true,
		container : 'body',
		delay : 0
	});

	$("#e_voucher_id").inputmask("A-*****-******-*****", {
        placeholder: "E-xxxxx-xxxxxx-xxxxx",
        clearMaskOnLostFocus: true
    }); //default



    $("#redeemVoucher_form").on("submit", function(){
    	var self = $(this);
        var rV_modal = $('#redeemVoucher_modal');
    	// Lấy mã eVoucher
    	var e_voucher_id = $('input[name=e_voucher_id]', self).val();
    	e_voucher_id = e_voucher_id.replace(/-/g, '');
        e_voucher_id = e_voucher_id.insert(1, '-');
        
    	// Xác thực mã
        var isNotFound = false; // status
        var voucher_start     = rV_modal.find('.voucher-start');
        var voucher_searching = rV_modal.find('.voucher-searching');
        var voucher_not_found = rV_modal.find('.voucher-not-found');
        var voucher_info      = rV_modal.find('.voucher-info');
    	var url = URL + "spaCMS/home/xhrGet_redeem_voucher";
    	$.post(url, {'e_voucher_id':e_voucher_id}, function(data){

            // loading...
            voucher_start.hide();
            voucher_searching.show();

            if(data.length == 0) {
                isNotFound = true;
                return false;
            } 

            var evoucher_expiry = rV_modal.find('.evoucher-expiry');
            var evoucher_recipient = rV_modal.find('.evoucher-recipient');
            var e_voucher_booking_id = rV_modal.find('.e_voucher_booking_id');
            // Action xác thực
            var redeem_action = rV_modal.find('.redeem-action');
            redeem_action.show();

            evoucher_expiry.text();
            evoucher_recipient.text();
            e_voucher_booking_id.text();
            

            console.log(data);

    	}, 'json')
    	.done(function(){
            if(isNotFound) {
                // warning status
                voucher_searching.hide();
                voucher_not_found.show();
            } else {
                // success status
                voucher_searching.hide();
                voucher_info.show();
            }
    	});

    	return false;
    });
    
    String.prototype.insert = function (index, string) {
      if (index > 0)
        return this.substring(0, index) + string + this.substring(index, this.length);
      else
        return string + this;
    };

}); 