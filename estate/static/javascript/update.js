$(function() {
	
	var updateForm = $('#updateForm');
	
	updateForm.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
		    houseprice: {
		    		isNum: true
		    },
		    ownermobile: {
		    		isTel: true
		    }
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

	$('#updateForm').ajaxForm({
		success : success,
		dataType: 'json'
	});

})