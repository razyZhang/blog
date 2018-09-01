$(function(){
	$('.choose').change(function(){
		var choose_image = document.getElementById("banner").files[0];
		var local_url = window.URL.createObjectURL(choose_image);
		$('.thumb').attr('src',local_url);
	});
});