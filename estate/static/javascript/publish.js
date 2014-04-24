$(function() {
	$('#stepone_btn').click(function() {
		$('.publish_firststep').css("animation","firstAnimation 1s forwards");
		$('.publish_secondstep').css("animation","secondAnimation 1s forwards");
	})
	
	$('.type').bind('click', function() {
		var text = $(this).text();
		$('.type').each(function() {
			$(this).removeClass("isChosed");
		})
		$(this).addClass("isChosed");
		$('#housetype').attr("value", text);
	})
	
	$('.face').bind('click', function() {
		var text = $(this).text();
		$('.face').each(function() {
			$(this).removeClass("isChosed");
		})
		$(this).addClass("isChosed");
		$('#houseface').attr("value", text);
	})
	
var publishForm = $('#publishForm');
	
	publishForm.validate({
		errorPlacement : function(error, element) { 
			par = element.parent().find(".err_box");  
	        par.empty();  
	        error.appendTo(par);  
		}, 
		onfocusout: function(element) { 
		    $(element).valid(); 
		},
		rules: {
			housename: {
				estateName: true
		    },
		    houseprice: {
		    		isNum: true
		    },
		    shi: {
		    		isNum: true
		    },
		    ting: {
		    		isNum: true
		    },
		    wei: {
		    		isNum: true
		    },
		    housearea: {
		    		isNum: true
		    },
		    ownermobile: {
		    		isTel: true
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

	$('#publishForm').ajaxForm({
		success : success,
		dataType: 'json'
	});
})