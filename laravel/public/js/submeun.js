$(function(){
	$('#userinfo').find('.switch').mouseover(function(){
		$(this).siblings('ul').fadeIn(200,function(){
			$(this).addClass('shown');
		});
	});

	$('#userinfo').find('ul').mouseleave(function(){
		if ($(this).hasClass('shown')) {
			$(this).fadeOut(200,function(){
				$(this).removeClass('shown');
			})
		}
	});

	$('#navigation').children('.item').each(function(){
		$(this).find('.switch').mouseover(function(){
			$(this).siblings('ul').fadeIn(200,function(){
				$(this).addClass('shown');
			});
		});
	});
	
	$('#navigation').children('.item').each(function(){
		$(this).find('ul').mouseleave(function(){
			if ($(this).hasClass('shown')) {
				$(this).fadeOut(200,function(){
					$(this).removeClass('shown');
				})
			}
		});
	});
})