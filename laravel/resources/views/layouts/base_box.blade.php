<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-dns-prefetch-control" content="on" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="HandheldFriendly" content="True"/>
  <meta name="format-detection" content="telephone=no"/>
  <meta name="format-detection" content="address=no"/>
  <meta name="format-detection" content="email=no" />
  <title>{{ $title }}</title>
  <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ url('css/front/regist.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  @yield('css')
</head>
<body>
  <div id="background" class="container">
    <div class="left col-md-6">
    </div>
    <div class="right col-md-6"></div>
    <div class="box">
      <div class="right-page">
        @yield('content')
      </div>      
      <div class="left-page">
        <div class="animate-box" id="animation">
          <div class="cloud article"></div>
          <div class="cloud math"></div>
          <div class="cloud relax"></div>
          <div class="cloud technology"></div>
          <div class="cloud game"></div>
          <div class="cloud music"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
          <div class="leafs"></div>
        </div>
        <div class="word-box">Once you miss the chance<br/>NO one can give you twice even the God.</div>
      </div>
    </div>
  </div>
</body>
</html>
<script type="text/javascript" src="{{ URL::asset('js/leavesfall.js') }}"></script>
@yield('script')