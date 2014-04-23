$(function() {
	
	$('.login_btn').click(function() {
		var form = $('#loginForm');
		var account = $('#account').val();
		var password = $('#password').val();
		var remember = $('#remember').is(":checked") ? true : false;
		
		$.ajax({
			type: "POST",
			url: form.attr('action'),
			data: 'account='+account+'&password='+password+'&remember='+remember,
			dataType: "JSON",
			success: function(data) {
				if(0 == data.code) {
					window.location = data.redirect;
				}else {
					alert(data.msg);
				}
			}
		})
	})
	
	
})