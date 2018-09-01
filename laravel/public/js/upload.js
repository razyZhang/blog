$(function() {
	var URL = window.URL || window.webkitURL;
	var $image = $('#image');
	var originalImageURL = $image.attr('src');
	var uploadedImageName = 'cropped.jpg';
	var uploadedImageType = 'image/jpeg';
	var options = {
				viewMode: 1,
				aspectRatio: 1 / 1,
				minContainerHeight: 160,
				crop: function(event) {
					}
				};

	var uploadedImageURL;
	//init cropper
	$image.cropper(options);
	var cropper = $image.data('cropper');
	// Import image
	var $inputImage = $('#avatar');
	var $uploadImage = $('#upload');

	if (URL) {
		$inputImage.change(function () {

			if ($uploadImage.hasClass('disabled')) {
				$image.next().remove();
				$image.cropper(options);
				$uploadImage.removeClass('disabled');
			}

			var files = this.files;
			var file;

			if (!$image.data('cropper')) {
			    return;
			}

			if (files && files.length) {
			    file = files[0];

			    if (/^image\/\w+$/.test(file.type)) {
			        uploadedImageName = file.name;
			        uploadedImageType = file.type;

			        if (uploadedImageURL) {
			            URL.revokeObjectURL(uploadedImageURL);
			        }

			        uploadedImageURL = URL.createObjectURL(file);
			        $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
			        cropper = $image.data('cropper');
			        $inputImage.val('');
			    } else {
			        window.alert('Please choose an image file.');
			    }
			}
		});

		$uploadImage.click(function(){//uploadimage
			if (!$(this).hasClass('disabled')) {
				canvas = cropper.getCroppedCanvas({  //使用canvas绘制一个宽和高200的图片
		            width: 120,
		            height: 120,
		        });
		        uploadedImageURL = canvas.toDataURL("image/png", 0.3);
		        $image.cropper('destroy').attr('src', uploadedImageURL);
		        $('#avatar_src').attr('value', uploadedImageURL);
		        $(this).addClass('disabled');
		        var progress = "<div style='margin:10px auto;width:120px;height:5px;'><div style='float:left;width:10%;height:100%;border-bottom: #FFF solid 2px;'></div></div>"
		        var warning = "<p style='margin:10px auto;'>upload success</p>";
		        $image.after(progress);
		        $image.next().find("div").animate({
			      width:"100%"
			    },2000,function(){
			    	$(this).append(warning);
			    });
			}else{
				alert('图片已上传');
			}
	        //base64转png文件
	  		// var file = dataURLtoBlob($image.attr("src")); //将base64格式图片转换为文件形式
			// var formData = new FormData();
			// var filename = new Date().getTime() + '.png'; //给图片添加文件名 如果没有文件名会报错
			// formData.append('file', file, filename); //formData对象添加文件
			// $.ajax({
			// 	type: "POST",
			// 	url: url + "/res/upload",
			// 	data: formData,
			// 	processData: false, // 不处理数据
			// 	contentType: false, // 不设置内容类型
			// 	success: function (data) {
			// 		var data = JSON.parse(data);
			// 		alert('上传成功');
			// 	}
			// });
		});
	} else {
		$inputImage.prop('disabled', true).parent().addClass('disabled');
	}

	//将base64格式图片转换为文件形式
	function dataURLtoBlob(dataurl) {
		var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
			while (n--) {
				u8arr[n] = bstr.charCodeAt(n);
			}
		return new Blob([u8arr], { type: mime });
	}

});