$(document).ready(function() {
	$('.eu-cookies button').click(function() {
		var date = new Date();
		date.setFullYear(date.getFullYear() + 10);
		document.cookie = 'eu-cookies=1; path=/; expires=' + date.toGMTString();
		$('.eu-cookies').hide();
	});
});
