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
    <title>@yield('title')</title>
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/front/base.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
</head>
<body>
    <div id="background">
        <div class="left"></div>
        <div class="right">
            <div class='footer'></div>
        </div>
        <div class="screen">
            <div class="first-box">
                <div class="header">
                    <div class="logo-box">
                        <span class="text">Backend |</span>
                        <span class="logo"></span>
                    </div>
                    <div class='search'>
                        <input id='search' type="text" name="search" placeholder="search..">
                        <span class="search-btn"></span>
                    </div>
                    <div class='user-box'>
                        <div class="userinfo" id='userinfo'>
                            <ul class="meun-down">
                                <li class="item"><a href="{{ route('userinfo') }}">个人资料</a></li>
                                <li class="item"><a href="{{ route('reset') }}">修改密码</a></li>
                                <li class="item"><a href="{{ route('setting') }}">后台设置</a></li>
                                <li class="item"><a href="{{ route('logout') }}">注销登录</a></li>
                            </ul>
                            <span class="switch"></span>
                            <span class="name">{{ isset($user['nickname']) ? $user['nickname'] : $user['name'] }}</span>
                            <div class="personsign">{{ isset($user['intro']) ? $user['intro'] : '这个人很懒什么简介都不写' }}</div>
                            <div class="circle">
                                <img src="{{ $user['avatar'] }}" align="center" width="40" height="40">
                            </div>
                        </div>
                        <ul class="setting">
                            <li class="items letter">
                                <img src="{{ url('img/front/message.png') }}" align="center" width="22" height="16">
                                <span class="numbs">2</span>
                            </li>
                            <li class="items skin">
                                <img src="{{ url('img/front/suit.png') }}"  align="center" width="22" height="16">
                                <span class="numbs">2</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <span class="message" id="warn"></span>
                <div class="second-box">
                    <div class="left-side">
                        <div class="navigation">
                            <ul class="list" id="navigation">
                                <li class="item">
                                    <span class="title">欢迎使用</span>
                                    <span class="switch"></span>
                                    <ul class="meun-right">
                                        <li class="item"><a href="{{ route('home') }}">首页</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <span class="title">内容管理</span>
                                    <span class="switch"></span>
                                    <ul class="meun-right">
                                        <li class="item"><a href="{{ route('write') }}">新建文章</a></li>
                                        <li class="item"><a href="{{ route('list') }}">文章列表</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <span class="title">用户管理</span>
                                    <span class="switch"></span>
                                </li>
                                <li class="item">
                                    <span class="title">数据统计</span>
                                    <span class="switch"></span>
                                </li>
                                <li class="item">
                                    <span class="title">开发相关</span>
                                    <span class="switch"></span>
                                </li>
                                <li class="item">
                                    <span class="title">个人空间</span>
                                    <span class="switch"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="third-box" id='content'>
                        @yield('content')
                    </div>
                </div>
                <div class="footer-box">
                    <div class="info">© 2018 razy. All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="{{ URL::asset('js/submeun.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/drag.js') }}"></script>
<script type="text/javascript">
$('#userinfo').find('.circle').mouseover(function(){
    $(this).siblings('.personsign').fadeIn(400);
}).mouseleave(function(){
    $(this).siblings('.personsign').fadeOut(400);
});
</script>
@yield('scripts')