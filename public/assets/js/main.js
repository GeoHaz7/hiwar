(function($) {
"use strict";

  $('#menuToggler').click(function(){
    $('#sidebarMenu').addClass('active')
    $('.offcanvas-overlay').addClass('active')

  });
  $('#menuClose').click(function(){
    $('#sidebarMenu').removeClass('active')
    $('.offcanvas-overlay').removeClass('active')
  });
  $('.offcanvas-overlay').click(function(){
    $('#sidebarMenu').removeClass('active')
    $(this).removeClass('active')
  });

})(jQuery);

$(function () {
  $('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    html: true
  })
})