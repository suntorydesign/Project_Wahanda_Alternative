$(document).ready(function() {
	loadTopServiceList();
	loadNewServiceList();
	loadLocation();
	
	$('#user_description_see_more').on('click', function() {
		$('#user_description').css({
			'white-space' : 'normal',
			'overflow' : 'auto'
		});
		$(this).hide();
	});
	$('#service_detail').on('hide.bs.modal', function() {
		CHOOSEN_DATE = '';
		CHOOSEN_DATE_STORE = '';
		CHOOSEN_TIME = '';
		CHOOSEN_PRICE = '';
		WEEK_PAGE = 1;
		$('#user_description').css({
			'white-space' : 'nowrap',
			'overflow' : 'hidden',
		});
		$('#user_description_see_more').show();
	});
});
$(document).on('click', '#login_btn', function() {
	//alert(window.location.href);
	//alert(URL);
	$('#email_login').val('');
	$('#pass_login').val('');
	$('#footer_login').children('i').remove();
	$('#footer_login').children('span').remove();
});
$('#login_modal').on('shown.bs.modal', function() {
	$('#email_login').focus();
});
