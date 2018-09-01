$(function(){
	$('#reg-key').change(function(){
		var inviteCode = $(this).val();
		var decoded = BASE64.decode(inviteCode);
		var decode_array = decoded.split('||');
		var host = decode_array[0];
		var origin = decode_array[1];
		var url = $(this).attr('attr-url');
		var _token = $('#reg-user').prev().val();
		var publicKey = '';
		$.post(url,
		{
		    'host':host,
		    'origin':inviteCode,
		    '_token':_token
		},function(data,status){
			if (status == 'success') {
				var secret = host + '||' + data;
				$('#reg-key').val(secret).css('border-bottom','#4AE2C9 solid 1px').attr('attr-ready','1');
			}else{
				$('#reg-key').css('border-bottom','#F1677D solid 1px').attr('attr-ready','0');
			}
		});
	});
});