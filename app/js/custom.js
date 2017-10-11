
$($('ducument').ready(function() {

  $('body .card').css({'display':'flex'}).hide().fadeIn(1000);

  // tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  //popovers
  $(function () {
    $('.popover-error').popover({
      container: 'body'
    });
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

  // if ($('#long-link').val()) {
  //   $('.btn-success').on('click', function() {
  //     $('.card').animate({'height': '340px'}); 
  //       $('.copy').css('display', 'flex').hide().fadeIn(200);
  //   });
  // }

  //validation form
  var long = $('#long-link'), linkDef = $('#link-default'),
      hyper = new RegExp ('^https://|^http://'),
      urlExp = new RegExp ('^(https?:\/\/)([\d0-9a-z\\.-]*)(\\.)([a-z]{1,6})([&a-z/\\.-_]*)*?(/)?([^._-]$)$', 'i'),
      hyperLength = new RegExp ('^([a-z0-9-_]{1,30}[a-z0-9])$', 'i');


  function addStyleForm(linkName) {
      linkName.addClass('is-invalid');
      setTimeout(function() {
        linkName.popover('hide').popover('dispose');
      }, 3500);
  }

  function testedFirst (ev) {
    if (!long.val()) {
      long.popover({title: "Пустое поле", content: "Данное поле обязательно для заполнения. Вставьте URL",
                    placement: "top", delay: { "show": 300, "hide": 300 }}).popover('enable').popover('show');
      addStyleForm(long);
      ev.preventDefault();
    }
    if (!hyper.test(long.val())) {
      long.popover({title: "http:// и https://", content: "Ссылка должна начинаться с http:// или https://",
                    placement: "top", delay: { "show": 300, "hide": 300 }}).popover('enable').popover('show');
      addStyleForm(long);
      ev.preventDefault();
    }
    if (!urlExp.test(long.val())) {
      long.popover({title: "Недопустимая комбинация", content: "Ваш URL содержит недопустимые символы или слишком короткий.",
                    placement: "top", delay: { "show": 300, "hide": 300 }}).popover('enable').popover('show');
      addStyleForm(long);
      ev.preventDefault();
    }
    else {
      long.addClass('is-valid');
    }
  }

  function testedSecond(ev) {
    if (linkDef.val().length>30) {

      linkDef.popover({title: "Длина ссылки", content: "Максимальная длина строки ввода не должна превышать 30 символов",
                    placement: "top", delay: { "show": 300, "hide": 300 }}).popover('enable').popover('show');
      addStyleForm(linkDef);
      ev.preventDefault();
    }
    if (!hyperLength.test(linkDef.val()) && linkDef.val()) {

      linkDef.popover({title: "Недопустимый формат", content: "Символы для применения: латинский алфавит, цифры и '-','_'",
                    placement: "top", delay: { "show": 300, "hide": 300 }}).popover('enable').popover('show');
      addStyleForm(linkDef);
      ev.preventDefault();
    }
    if (linkDef.val()) {
      linkDef.addClass('is-valid');
    }
  }

  $('#formLinks').on('submit', function(e) {
    if (!long.val()){
      testedFirst(e);
    }
    testedSecond(e);
  });

  long.on('blur', function(e) {
    testedFirst(e);
  });

  long.on('click', function() {
    $(this).removeClass('is-invalid , is-valid');
  });

  linkDef.on('blur', function(e) {
    testedSecond(e);
  });

  linkDef.on('click', function() {
    $(this).removeClass('is-invalid , is-valid');
  });
}));