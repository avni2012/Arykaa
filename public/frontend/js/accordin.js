$('.accordion-header').toggleClass('inactive-header');
  
  //Set The Accordion Content Width
  // var contentwidth = $('.accordion-header').width();
  var contentwidth = '540px';
  $('.accordion-content').css({'width' : contentwidth });
  $('.accordion-content').css({ autoHeight: true });
  
  // The Accordion Effect
  $('.accordion-header').click(function () {
    if($(this).is('.inactive-header')) {
      $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
      $(this).toggleClass('active-header').toggleClass('inactive-header');
      $(this).next().slideToggle().toggleClass('open-content');
    }
    
    else {
      $(this).toggleClass('active-header').toggleClass('inactive-header');
      $(this).next().slideToggle().toggleClass('open-content');
    }
  });
  