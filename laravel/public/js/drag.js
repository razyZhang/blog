$(function(){
	var div_array = new Array('navigation');
	for (var i = 0; i < div_array.length; i++) {
		var drag = $('.'+div_array[i]);
		drag.mousedown(function(event){
			var mouse_x = event.pageX;
			var mouse_y = event.pageY;

			$(this).mousemove(function(event){
				var distanceX = event.pageX - mouse_x;
				mouse_x = mouse_x + distanceX;
				var distanceY = event.pageY - mouse_y;
				mouse_y = mouse_y + distanceY;
				var attr_x = $(this).css('left').replace('px','');
				var attr_y = $(this).css('top').replace('px','');
				$(this).css('left',Number(distanceX)+Number(attr_x)+'px');
				$(this).css('top',Number(distanceY)+Number(attr_y)+'px');
			});

			$(this).mouseup(function(){
				$(this).unbind('mousemove');
				$(this).unbind('mouseup');
			});
		});

	}
});