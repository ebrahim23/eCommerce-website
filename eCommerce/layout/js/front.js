$(function(){

  $('input').each(function(){
    if($(this).attr('required') === 'required'){
      $(this).after('<span class="astrisk">*</span>');
    }
  });

  $('.log-page h1 span').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    $('.log-page form').hide();
    $('.' + $(this).data('class')).fadeIn(100);
  });

  $('.live-name').keyup(function(){
    $('.live-preview .caption h3').text($(this).val());
  });
  $('.live-desc').keyup(function(){
    $('.live-preview .caption p').text($(this).val());
  });
  $('.live-price').keyup(function(){
    $('.live-preview .price').text('$' + $(this).val());
  });

});
