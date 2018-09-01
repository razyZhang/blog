<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-dns-prefetch-control" content="on" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="True"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="format-detection" content="email=no" />
    <title>@yield('title')</title>
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('less/blog/base.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>
<body>
    <div id="background">
        <div class="header">
            <span class="logo"></span>
            <div class="nevigation">
                <div class="box">
                    <a href="{{ route('blog.home') }}" onclick="link()">Home</a>
                </div>
                <div class="box">
                    <a href="{{ route('blog.catalog') }}" onclick="link()">Article</a>
                </div>
                <div class="box">
                    <a href="{{ route('blog.about') }}" onclick="link()">About</a>
                </div>
                <div class="box">
                    <a href="#" onclick="link()">Other</a>
                </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            <span class="copyright">© 2018 razy and Dinghy All rights reserved</span>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    
    function link(){
        $('.content').fadeOut(1000,function(){
            return true;
        });
    }
</script>
@yield('scripts')

