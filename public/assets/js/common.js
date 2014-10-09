/*JUMP TO OTHER PAGE*/
function jumpToOtherPage(page) {
	window.location = page;
}

/*JUMP TO OTHER PAGE*/
/*-----------------------*/

/*CAN ONLY INPUT NUMBER*/
function inputNumbers(evt) {
	var e = evt || window.event;

	if ((e.charCode >= 48 && e.charCode <= 57) || e.charCode == 0) {
		return;
	} else {
		e.preventDefault();
	}
}

/*END CAN ONLY INPUT NUMBER*/
/*-----------------------*/

/*SHORTEN THE TEXT WITH ...*/
function shorten(text, maxLength) {
	var ret = text;
	if (ret.length > maxLength) {
		ret = ret.substr(0, maxLength - 3) + "...";
	}
	return ret;
}

/*END SHORTEN THE TEXT WITH ...*/
/*-----------------------*/

/*FORMAT DATE*/
function formatDate(date) {
	var date_format = new Date(date);
	re_date = date_format.getDate();
	re_month = parseInt(date_format.getMonth()) + 1;
	if (re_month < 10) {
		re_month = '0' + re_month;
	}
	if (date_format.getDate() < 10) {
		re_date = '0' + date_format.getDate();
	}
	re_year = date_format.getFullYear();
	return re_date + '/' + re_month + '/' + re_year;
}

/*END FORMAT DATE*/
/*-----------------------*/

/*CHECK SESSION IDLE*/
function checkSessionIdle() {
	$.ajax({
		url : URL + 'index/checkSessionIdle',
		type : 'post',
		//dataType : 'json',
		success : function(response) {
			if (response == 200) {
				alert('Bạn đã bị kick out vì không hoạt động quá lâu,bạn còn đó không, quay lại với chúng tôi nào!');
				location.reload();
			} else if (response == 0) {

			}
		},
		complete : function() {
			setTimeout(function() {
				checkSessionIdle();
			}, IDLE_CHECK);
		}
	});
}

/*END CHECK SESSION IDLE*/
/*-----------------------*/

/*END SHOW MORE*/
function showMore(cls, txt) {
	$('.' + cls).fadeToggle(function() {
		if ($('.' + cls).is(":visible")) {
			$('.' + txt).text('Ẩn đi');
		} else {
			$('.' + txt).text('Xem thêm');
		}
	});
}

/*END SHOW MORE*/
/*-----------------------*/