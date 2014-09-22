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