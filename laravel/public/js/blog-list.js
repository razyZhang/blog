$(function(){
	var items = $('#title-list').children('.title-box');
	var total = items.toArray().length;
	var limit = 10;
	loopfadeIn(0,limit);

	$('#catalog').find('.toright').click(function(){
		var current = $('#catalog').attr('attr-index');
		var current_index = (current + 1) * limit;
		var next_index = (current + 2) * limit; 
		if (current_index < total) {
			items.slice(current * limit, current_index).fadeOut(500,function(){
				if (next_index < total) {
					loopfadeIn(current_index, next_index);
				}else{
					loopfadeIn(current_index, total);
				}
			});
			$('#catalog').attr('attr-index', parseInt(current) + 1);
		}
	});

	$('#catalog').find('.toleft').click(function(){
		var current = $('#catalog').attr('attr-index');
		var current_index = (current + 1) * limit;
		var next_index = (current - 1) * limit;
		if (current > 0) {

			if (current_index > total) {
				current_index = total;
			}

			items.slice(current * limit, current_index).fadeOut(500,function(){
				loopfadeIn(next_index, current * limit);
			});
			$('#catalog').attr('attr-index', parseInt(current) - 1);
		}
	});

	function loopfadeIn(c,l){

		function loop(c){
			if (c < l) {
				items.eq(c).fadeIn(200,function(){
					c++;
					loop(c);
				});
			}
		};
		loop(c);
	}

	function loopfadeOut(c,l){

		function loop(c){
			if (c >= l) {
				items.eq(c).fadeOut(150,function(){
					c--;
					loop(c);
				});
			}
		};
		loop(c);
	}

	items.each(function(){
		var hide_html = $(this).find('.hide-box').html();
		var hide_box = $('#catalog').find('.left-box');

		$(this).mouseover(function(){
			if (hide_box.attr('attr-show') == '0') {
				hide_box.append(hide_html).attr('attr-show','1');
			}
		});

		$(this).mouseleave(function(){
			hide_box.empty().attr('attr-show','0');
		});

		$(this).click(function(){
			var url = $(this).attr('attr-url');
			hide_box.empty().attr('attr-show','0');
			$('#catalog').find('.main-box').fadeOut(500,function(){
				location.href = url;
			});
		})
	});
});