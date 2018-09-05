@extends('layouts.base_box')

@section('css')
<link  href="{{ url('css/front/cropper.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="switch-box">
  <div class="left-leaf">reg</div>
  <div class="right-leaf">ist</div>
</div>
<form id="loginform" class="type-box" action="{{ $login }}" method="POST" autocomplete="on">
  {{ csrf_field() }}
  <div class="user input-box">
    <label for="user" class="user-icon"></label>
    <div class="cover"></div>
    <input id="user" class="field" type="text" name="user" placeholder="username" maxlength="20" required="required" attr-checkurl='{{ $check }}'
     attr-vaild=''/>
    <span class="draw"></span>
    <span class="check-icon"></span>
  </div>
  <div class="pswd input-box">
    <label for="pswd" class="pswd-icon"></label>
    <div class="cover"></div>
    <input id="pswd" class="field" type="password" name="password" placeholder="password" maxlength="20" required="required" attr-vaild=''/>
    <span class="draw"></span>
    <span class="check-icon"></span>
  </div>
  <div class="rmyn">
    <small>remember your name</small>
    <div class="check-box">
      <span class="hook"></span>
      <input type="text" name="remember" value="0" hidden="hidden"/>
    </div>
  </div>
  <div class="button-box">
    <div class="login" id='login'>Login</div>
    <div class="front" id='front'>Front</div>
  </div>
</form>
<span class="warning" {{ $hidden }}>{{ $warning }}</span>
</div>
<div class="regist-page">
<form id="registform" action="{{ $regist }}" method="POST" autocomplete="on">
  <div class="regist-info">
    {{ csrf_field() }}
    <input id="reg-user" class="field" type="text" name="user" placeholder="username" maxlength="20" attr-ready='' attr-checkurl='{{ $check }}'/>
    <input id="reg-pswd" class="field" type="password" name="password" placeholder="password" maxlength="20" attr-ready=''/>
    <input id="reg-retype" class="field" type="password" name="retype" placeholder="type again" maxlength="20"/>
    <input id="reg-mail" class="field" type="email" name="mail" placeholder="E-mail" maxlength="20" attr-ready=''/>
    <input id="reg-key" class="field" type="text" name="key" placeholder="key" maxlength="100" attr-ready='' 
    attr-url='{{ $getkey }}'/>
    <input id="avatar_src" class="field" type="text" name="avatar" hidden="hidden" value="" attr-ready='1'/>
  </div>
</form>
<div class="regist-box">
  <div class="img-box">
    <img id="image" attr-cropper="" src="{{ url('img/front/stamp.png') }}"/>
  </div>
  <div class="upload reg-btn" id='upload'>Upload</div>
  <a href="javascript:;" class="choose reg-btn">Choose
      <input type="file" name="avatar" id='avatar' accept="image/gif, image/jpeg, image/jpg, image/png"/>
  </a>
  <div class="regist reg-btn" id='regist'>Regist</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('js/circle-progress.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/input_animation.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/cropper.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/upload.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/input_check.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/base64.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/rsa.js') }}"></script>
<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
<script type="text/javascript">
var localIP = returnCitySN["cip"];
var logtoken = $('#user').parent().prev().val();

$('#user').change(function(){

  currentname = $(this).val();
  url = $(this).attr('attr-checkurl');
  field = $(this);

  $.post(url,
  {
    'user':currentname,
    'type':'exist',
    '_token':logtoken
  },function(data,status){
      if (data == "exist") {
        field.attr('attr-vaild','1');
        field.siblings('.check-icon').css('display',"none");
        field.next().css("display","block").circleProgress({
          value: 100,
          size: 20,
          thickness: 3.5,
          fill: { color: '#f1f1f1' },
          animation: {
              duration: 10000,
              easing: 'swing'
          },
        });
      }else{
        field.attr('attr-vaild','0');
        field.next().css("display","none");
        field.siblings('.check-icon').css('display',"block");
      }
    }
  );
});

$('#pswd').change(function(){
  var value = $(this).val();
  var pswd_pattern = /^[A-Za-z0-9_]{4,20}$/;
  if (value == '') {
    return;
  }

  if (value.length > 3 && pswd_pattern.test(value)) {
    $(this).attr('attr-vaild','1');
    $(this).siblings('.check-icon').css('display',"none");
    $(this).next().css("display","block").circleProgress({
      value: 100,
      size: 20,
      thickness: 3.5,
      fill: { color: '#f1f1f1' },
      animation: {
          duration: 10000,
          easing: 'swing'
      },
    });
  }else{
    $(this).next().css("display","none");
    $(this).siblings('.check-icon').css('display',"block");
    $(this).attr('attr-vaild','0');
  }
});

$('#front').click(function(){
  var url = "/";
  location.href = url;
});

</script>
@endsection
