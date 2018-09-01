$(function() {
	var name = $('#user');
	var password = $('#pswd');
	var logtoken = name.parent().prev().val();
	var loginform = $('#loginform');
	var login = $('#login');

	var user = $('#reg-user');
	var pswd = $('#reg-pswd');
	var retp = $('#reg-retype');
	var mail = $('#reg-mail');
	var key = $('#reg-key');
	var form = $('#registform');
	var input = $('.regist-info').children(".field");
	var regist = $('#regist');
	var token = user.prev().val();

	user.blur(function(){
		var value = $(this).val();
		var url = $(this).attr('attr-checkurl');
		var user_pattern = /^[A-Za-z0-9_]{4,20}$/;

		if (value == '') {
			return;
		}

		if (value.length > 3 && user_pattern.test(value)) {

	        $.post(url,
	        {
	          'user':value,
	          'type':'exist',
	          '_token':token
	        },

	        function(data,status){
	          if (data == "not exist") {
	          	user.css('border-bottom','#4AE2C9 solid 1px');
	          	user.attr('attr-ready','1');
	          }else{
	          	user.css('border-bottom','#FCD560 solid 1px');
	          	user.attr('attr-ready','0');
	          }
	        });

		}else{
			user.css('border-bottom','#F1677D solid 1px');
			user.attr('attr-ready','0');
		}
	});

	pswd.blur(function(){
		var value = $(this).val();
		var pswd_pattern = /^[A-Za-z0-9_]{4,20}$/;
		if (value == '') {
			return;
		}

		if (value.length > 3 && pswd_pattern.test(value)) {
			$(this).css('border-bottom','#4AE2C9 solid 1px');
			$(this).attr('attr-ready','1');
		}else{
			$(this).css('border-bottom','#F1677D solid 1px');
			$(this).attr('attr-ready','0');
		}
	});

	retp.blur(function(){
		var value = $(this).val();
		if (value == '') {
			return;
		}

		if (value == pswd.val()) {
			$(this).css('border-bottom','#4AE2C9 solid 1px');
			$(this).attr('attr-ready','1');
		}else{
			$(this).css('border-bottom','#F1677D solid 1px');
			$(this).attr('attr-ready','0');
		}
	});

	mail.blur(function(){
		var value = $(this).val();
		var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if (value == '') {
			return;
		}

		if (pattern.test(value)) {
			$(this).css('border-bottom','#4AE2C9 solid 1px');
			$(this).attr('attr-ready','1');
		}else{
			$(this).css('border-bottom','#F1677D solid 1px');
			$(this).attr('attr-ready','0');
		}
	});

	key.blur(function(){
		var value = $(this).val();
		var pattern = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
		if (value == '') {
			return;
		}

		if (pattern.test(value)) {
			$(this).css('border-bottom','#4AE2C9 solid 1px');
			$(this).attr('attr-ready','1');
		}else{
			$(this).css('border-bottom','#F1677D solid 1px');
			$(this).attr('attr-ready','0');
		}
	});

	regist.click(function(){
		var mark = true;
		input.each(function(){
			mark = $(this).attr('attr-ready') != '1'? false: mark; 
		});
		if (mark) {
			form.submit();
		}else{
			alert('please check your input');
		}
	});

	login.click(function(){
		if ((name.attr('attr-vaild') == '1')&&(password.attr('attr-vaild') == '1')&&(name.val() != '')) {
			loginform.submit();
		}else{
			alert('please check your input');
		}
	});
});