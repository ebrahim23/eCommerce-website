$(function(){

  $('input').each(function(){

    if($(this).attr('required') === 'required'){
      $(this).after('<span class="astrisk">*</span>');
    }

  });

  $('.confirm').click(function(){
    return confirm('Do you want to delete this member?');
  });

  $(".cat h3").click(function(){
    $(this).next(".hide-view").fadeToggle();
  })

  $(".plus-icon").click(function(){
    $(this).toggleClass('select').parent().next('.card-body').fadeToggle(100);
    if($(this).hasClass('select')){
      $(this).html('<i class="fa fa-minus fa-lg"></i>');
    } else{
      $(this).html('<i class="fa fa-plus fa-lg"></i>');
    }
  });


});
