$('#start_domain').click(function() {
	if( ! $(this).attr('checked')) {
		$('#start_client_div div:first').slideUp();
		$('#start_admin_div div:first').slideUp();
		if( ! $('#start_client_div input[type=checkbox]').attr('checked')) {
			$('#client_api_div').slideDown();
		}
		if( ! $('#start_admin_div input[type=checkbox]').attr('checked')) {
			$('#admin_api_div').slideDown();
		}
	}
	else {
		$('#start_client_div div:first').slideDown();
		$('#start_admin_div div:first').slideDown();
		if( ! $('#start_client_div input[type=checkbox]').attr('checked')) {
			$('#client_api_div').slideUp();
		}
		if( ! $('#start_admin_div input[type=checkbox]').attr('checked')) {
			$('#admin_api_div').slideUp();
		}
	}
});

$('.toggle').click(function() {
	$('#' + $(this).attr('name') + '_div').slideToggle();
});