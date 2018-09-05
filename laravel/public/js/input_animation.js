$(function(){
  $('.input-box').each(function(){
    $(this).find('.cover').click(function(){ 
      if (!$(this).hasClass('chosen')) {
        $(this).addClass('chosen').fadeOut(500,function(){
          $(this).siblings('label').animate({
            left:"0px"
          },500,function(){});

          $(this).next('.field').css('display','block').animate({
            left:'30px',
            width:'140px'
          },500,function(){
            $(this).focus().siblings('.cover').removeClass('chosen');
          });
        });
      };
    });

    $(this).find('.field').blur(function(){

      if (!$(this).parent().hasClass('chosen')) {
        $(this).animate({
          left:"160px",
          width:'0px'
        },500,function(){
          $(this).css('display','none');
        });

        $(this).siblings('label').stop().animate({
            left:"140px"
        },500,function(){
          $(this).siblings('.cover').stop().fadeIn(500,function(){

            $(this).parent().removeClass('chosen');
          });
        }); 
      };
    });
    
  });

  $('.rmyn').click(function(){
    var hook = $(this).find('.hook');
    if (hook.hasClass('.chosen')) {
      hook.css('display','none').removeClass('.chosen').next().attr('value','0');
    }else{
      hook.css('display','block').addClass('.chosen').next().attr('value','1');
    }
  });

  $('.switch-box').click(function(){
    if ($(this).hasClass('chosen')) {

      $(this).removeClass('chosen').find('.left-leaf').css({"background-image":"url('../../img/front/left-leaf.png')",
        "color":"#22537f"}).next().css({"background-image":"none",
        "color":"#FFF"});

      $('.right-page').css({'border-radius':'0px',
      'border-top-right-radius': '20px',
      'border-bottom-right-radius': '20px'}).animate({
        width:"50%"
      },1000,function(){
        $(".type-box").fadeIn(800);
        $(this).siblings('.left-page').css('display','block');
      });

    }else{

      $(this).addClass('chosen').find('.left-leaf').css({"background-image":"none",
        "color":"#FFF"}).next().css({"background-image":"url('../../img/front/right-leaf.png')",
        "color":"#22537f"});

      $(".type-box").fadeOut(800);

      $(".left-page").css('display','none').siblings('.right-page').css('border-radius','20px').animate({
        width:"100%"
      },1000,function(){
        $('.regist-page').fadeIn(500);
        $(this).addClass('chosen');
      });

    }
    
  });

  $('.warning').each(function(){
    $(this).click(function(){
      if (!$(this).hasClass('chosen')) {
        $(this).fadeOut(500);
      }
    });
  });
});
