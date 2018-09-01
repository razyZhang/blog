var circle = function (cloud,r,s,t,l,sd) {
  switch(s)
  {
    case 0:
      t = t +0.3;
      l = l +0.1;
      break;

    case 1:
      t = t +0.1;
      l = l +0.3;
      break;

    case 2:
      t = t -0.1;
      l = l +0.3;
      break;

    case 3:
      t = t -0.3;
      l = l +0.2;
      break;

    case 4:
      t = t -0.25;
      l = l -0.2;
      break;

    case 5:
      t = t -0.1;
      l = l -0.3;
      break;

    case 6:
      t = t +0.1;
      l = l -0.3;
      break;

    case 7:
      t = t +0.25;
      l = l -0.1;
      break;
  }

  s++;
  cloud.animate({
    top:r*t+"px",
    left:r*l+"px",
    width:16*t+24+"px",
    height:16*t+24+"px",
    opacity:0.8*t+0.3
  },sd,"linear",function(){
    if (s>7) {
      s = 0;
    }
    sd = 2000;
    a = $(this);
    circle(a,r,s,t,l,sd);
  });
}

var fall_leaves = function(aid,speed) {
  var id = $(aid);
  var tq = id.find('.leafs');
  var mw = id.width()-20;
  var mh = id.height();
  var cn = 0;
  var xd = 0;
  setInterval(function () {
    var ln = Math.round(Math.random()*5);
    var init_left = Math.round(Math.random()*mw);
    var x_change = (xd+init_left)*0.5;
    var init_opacity = 0.2+Math.random()*0.8;
    var init_size = 0.2+Math.random();
    var init_orientation = 360*Math.random();
    var dt = 3000+4000*Math.random();
    if (cn<15) {
      var l = tq.eq(cn);
      if (!l.hasClass("fall")) {
        l.addClass("fall");
        l.css({
          display:"block",
          left:init_left+"px",
          opacity: init_opacity,
          height: init_size*12+"px",
          width: init_size*24+"px",
          opacity:init_opacity,
          transform: "rotate(" + init_orientation + "deg)", 
          top:"0px"
        }).animate({
          top:mh,
          left:x_change,
          opacity:0.1
        },dt,"linear",function(){
          $(this).removeClass("fall");
          $(this).css("top",0);
          $(this).css("display","none");
          });
      }
      cn++;
      xd = init_left;
    }else{
      cn = 0;
    }
  }, speed);
}

fall_leaves("#animation",800);
var radius = $('#animation').width()-20;
var art = $('.article');
var init_left = 0;
var init_top = 0.4;
var al = new Array(init_left,init_left+0.1,init_left+0.4,init_left+0.7,init_left+0.9,init_left+0.7);
var at = new Array(init_top,init_top+0.2,init_top+0.4,init_top+0.3,init_top,init_top-0.25);
var sort = 0;
//悬浮动画
$('#animation').find('.cloud').each(function(){
  $(this).css('display','block');
  circle($(this),radius,sort,at[sort],al[sort],2000);
  sort++;
});