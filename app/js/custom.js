$(document).ready(function() {
	$('body .card').css({'display':'flex'}).hide().fadeIn(1000);

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  // Copy buffer
  new Clipboard('.icon-docs');

  $('#copy-click').on('click', function() {
    $('.tooltip-inner b').fadeOut(200,function() {
      $(this).html('Ссылка скопирована').fadeIn(200, function() {
        $('#copy-click').attr('data-original-title','<b style="font-size:16px">Ссылка скопирована</b>');
      });
    });
  });
  $('.btn-success').on('click', function() {
    $('.card').animate({'height': '340px'}); 
      $('.copy').css('display', 'flex').hide().fadeIn(200);
  });
});