$(function() {
	
	var loginForm = $('#registertForm');
	
	loginForm.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
			account: {
				userName: true
		    },
		    email: {
		    		isEmail:true
		    },
		    mobile: {
		    		isTel: true
		    },
		    qq: {
		    		isQq: true
		    }
		},
		messages : {
			account: {
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

	$('#registertForm').ajaxForm({
		success : success,
		dataType: 'json'
	});
	
	
})