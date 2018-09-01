@extends('layouts.base')

@section('title','添加文章')

@section('head')
	<script src="{{ url('tinymce/js/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ url('js/jquery.form.min.js') }}"></script>
	<script type="text/javascript">
	tinymce.init({
		selector: '#textarea',
		themes: "advanced",
		min_height:300,
		menubar: false,
		images_upload_handler: function (blobInfo, success, failure) {

			var xhr, form, _token;
			_token = $('meta[name="csrf-token"]').attr('content');
		    xhr = new XMLHttpRequest();
		    xhr.withCredentials = true;
		    xhr.open('POST', "{{ route('upload') }}", true);

		    xhr.onload = function() {
			    var json;

			    if (xhr.status != 200) {
			        failure('HTTP Error: ' + xhr.status);
			        return;
			    }

			    json = JSON.parse(xhr.responseText);

			    if (!json.response) {
			        failure('Invalid JSON: ' + xhr.responseText);
			        return;
			    }

			    success(json.outlink);
		    };

		    form = new FormData();
			form.append('_token',_token);
    		form.append('image', blobInfo.blob(), blobInfo.filename());

		    xhr.send(form);
			
		},
		plugins: [
	      'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
	      'searchreplace wordcount visualblocks visualchars code codesample fullscreen insertdatetime media nonbreaking',
	      'save table contextmenu directionality emoticons template paste textcolor'
	    ],
	    language: 'zh_CN',
	    toolbar: 'insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | codesample | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
	    fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
	    font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats',
	    code_dialog_width: 500,
	    codesample_languages: [
	        {text: 'HTML/XML', value: 'markup'},
	        {text: 'JavaScript', value: 'javascript'},
	        {text: 'CSS', value: 'css'},
	        {text: 'PHP', value: 'php'},
	        {text: 'Ruby', value: 'ruby'},
	        {text: 'Python', value: 'python'},
	        {text: 'Java', value: 'java'},
	        {text: 'C', value: 'c'},
	        {text: 'C#', value: 'csharp'},
	        {text: 'C++', value: 'cpp'}
	    ],
	    });
	</script>
@endsection

@section('content')
	<form class="editor-form" id="editor" method="POST" action="{{ route('edit') }}" enctype="multipart/form-data">
		<div class="switch">Open</div>
		<div class="top-box">
			{{ csrf_field() }}
			<input type="hidden" name='id' value="{{ $editdata->id }}">
			<div class="input-box">
				<div class="title box">
					<label for="title">Title:</label>
					<input type="text" name="title" class="form-control title-ipt" value="{{ $editdata->title }}">
				</div>
				<div class="abstract box">
					<label for="abstract">Abstract:</label>
					<textarea class="form-control abs-ipt" rows="3" name="abstract" value="">{{ $editdata->abstract }}</textarea>
				</div>
			</div>
			<div class="image-box">
				<div class="btn-box">
					<label for="banner">Banner:</label>
					<a href="javascript:;" class="choose">Choose
				   		<input type="file" name="banner" id='banner' accept="image/gif, image/jpeg, image/jpg, image/png" value="{{ $editdata->abstract }}"/>
					</a>
				</div>
				<img src="{{ $editdata->banner }}" class='thumb' width="150" height="100">
			</div>
		</div>
	    <textarea name='article' id="textarea" value="">{{ $content }}</textarea>
	    <div class="submit">Submit</div>
	</form>
@endsection

@section('scripts')
	<script src="{{ url('js/upload_image.js') }}"></script>
	<script type="text/javascript">
		var sw = $('#editor').children('.switch');
		sw.click(function(){

			if ($(this).hasClass('chosen')) {
				sw.next().fadeOut(200,function(){
					sw.text('Open').removeClass('chosen');
				});

			}else{
				sw.next().fadeIn(200,function(){
					sw.text('Close').addClass('chosen');
				});
			}
			
		});

		var checkArray = new Array(".title-ipt",".abs-ipt","#textarea");
		var iptArray = new Array('标题','摘要','内容');

		$('#editor').find('.submit').click(function(){

			for(var i = 0;i<checkArray.length;i++)
			{
				var v = $('#editor').find(checkArray[i]).val();
				if (i == checkArray.length - 1) {
					v = tinymce.activeEditor.getContent();
				}

				if(v.length == 0){
					var t = iptArray[i]+'不能为空';
					$('#warn').slideDown(300,function(){
					 	$(this).text(t).click(function(){
					 		$(this).slideUp(300).unbind('click');
					 	});
					});

					return;
				}
			}

			$('#editor').submit();
		});
	</script>
@endsection