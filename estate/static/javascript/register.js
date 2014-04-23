$(function() {
	$('.register_btn').click(function() {
		var form = $('#registertForm');
		var account = $('#account').val();
		var password = $('#password').val();
		var checkRead = $('#checkRead').is(":checked") ? true : false;
		
		$.ajax({
			type: "POST",
			url: form.attr('action'),
			data: 'account='+account+'&password='+password+'&checkRead='+checkRead,
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
