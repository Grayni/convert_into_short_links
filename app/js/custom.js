
$('ducument').ready(function() {

  // load window
  $('body .card').css({'display':'flex'}).hide().fadeIn(1000);


  // tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });


  // popovers
  $(function () {
    $('.popover-error').popover({
      container: 'body'
    });
  });


  // copy buffer
  new Clipboard('.icon-docs');

  $('#copy-click').on('click', function() {
    $('.tooltip-inner b').fadeOut(200, function() {
      $(this).html('Ссылка скопирована').fadeIn(200, function() {
        $('#copy-click').attr('data-original-title','<b style="font-size:16px">Ссылка скопирована</b>');
      });
    });
  });


  // validation form
  var
      long        = $('#long-link'),
      linkDef     = $('#link-default'),
      hyper       = new RegExp ('^https?://'),
      hyperLength = new RegExp ('^([a-z\\d][\\w-]{1,30}[a-z\\d])$', 'i');


  function addStyleForm(typeLink) {

    typeLink.addClass('is-invalid');

    setTimeout(function() {
      typeLink.popover('hide').popover('dispose');
    }, 3500);

  }


  function popoverSet(typeLink, title, description) {

    typeLink.popover({
                            title: title,
                          content: description, 
                        placement: "top",
                            delay: { "show": 300, "hide": 300 }
                      })
            .popover('enable')
            .popover('show');

    addStyleForm(typeLink);

  }


  // first input validation
  function testedFirst () {
    if (!long.val())
      popoverSet(long, "Пустое поле", "Данное поле обязательно для заполнения. Вставьте URL");

    else if (!hyper.test(long.val()))
      popoverSet(long, "http:// и https://", "Ссылка должна начинаться с http:// или https://");

    else if (long.val().length<11)
      popoverSet(long, "Короткий URL", "Разрешенная длина ссылки от 11 символов.");

    else {
      long.addClass('is-valid');
      return true;
    }
  }

  // second input validation
  function testedSecond() {

    if (linkDef.val().length<3 && linkDef.val().length>0)
      popoverSet(linkDef, "Короткая строка", "Разрешенная длина строки ввода от 3 символов.");

    else if (!hyperLength.test(linkDef.val()) && linkDef.val())
      popoverSet(linkDef, "Недопустимый формат", "Допускаются: латинские буквы, цифры и соединительные знаки «-» или «_» .");

    else if (linkDef.val().length>30)
      popoverSet(linkDef, "Длина ссылки", "Максимальная длина строки ввода не должна превышать 30 символов");

    else if (linkDef.val().length>2 && linkDef.val().length<31 || linkDef.val().length == 0) {
      linkDef.addClass('is-valid');
      return true;
    }
  }


  // form actions
  $('.btn-success').on('click', function() {

    // for popover order run - nested condition
    if (testedFirst()) {
      if (testedSecond()) {
        $('#copy-click').hide();
        $('#responce').fadeOut(200);
        $('.card').animate({'height': '300px'});
        $('.ajax-loader').show();
        showNewLink(); // ajax request
      }
    }

  });

  long.on('blur', function() {
    testedFirst();
  });

  linkDef.on('blur', function() {

    if (testedFirst()) {
        testedSecond(); // order popover actions
    }

  });

  linkDef.add(long).on('click', function () {
    $(this).removeClass('is-invalid , is-valid');
  });

});