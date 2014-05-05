$(function() {
	
	var adminRegister = $('#adminRegister');
	
	adminRegister.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
			username: {
				userName: true
		    },
		    email: {
		    		isEmail:true
		    }
		},
		messages : {
			username: {
				required: "用户名不能为空",
				minlength: "用户名至少4个字符"
			},
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

	$('#adminRegister').ajaxForm({
		success : success,
		dataType: 'json'
	});
	
	
})