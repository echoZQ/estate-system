$(function() {
	
	var updateAdminForm = $('#updateAdminForm');
	
	updateAdminForm.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
		    email: {
		    		isEmail:true
		    },
		    mobile: {
		    		isTel: true
		    }
		},
		messages : {
			password : "密码至少六位,不含空格"
		}
	});
	
	var success = function(data) {
		 if (data.code == '0') {
			alert(data.msg);
		 	window.location = data.redirect;
		 } else {
		 	alert(data.msg);
		 }
	};

	$('#updateAdminForm').ajaxForm({
		success : success,
		dataType: 'json'
	});
	
	
})