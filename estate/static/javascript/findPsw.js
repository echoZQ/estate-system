$(function() {
	
	var emailForm = $('#emailForm');
	
	emailForm.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
			email: {
		    		isEmail:true
		    }
		}
	});
	
	var success = function(data) {
		 if (data.code == '0') {
		 	window.location = data.redirect;
		 } else {
		 	alert(data.msg);
		 }
	};

	$('#emailForm').ajaxForm({
		success : success,
		dataType: 'json'
	});
	
	
})