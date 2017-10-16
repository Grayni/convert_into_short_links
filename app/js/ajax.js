function showNewLink () {

    // test browser
    function getXMLHttpRequest() {

        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        return new ActiveXObject('Microsoft.XMLHTTP');

    }

    var request = getXMLHttpRequest();

    request.onreadystatechange = function() {

        var
            copy = $('#copy-click'),
            resp = $('#responce'),
            card = $('.card');

        if (request.readyState == 4 && request.status == 200) {

            card.animate({'height': '300px'}, function() {

                card.animate({'height': '340px'}, function() {

                    resp.html(request.responseText).css('display', 'flex').hide().fadeIn(200);

                    if ($('#new-link').length>0) {
                        copy.fadeIn(300);
                    }
                    $('.btn-success').prop('disabled',false).css({'cursor':'pointer'});
                    $('.ajax-loader').hide();
                    if ($('.inp-invalid').length) {
                        $('#long-link').removeClass('is-valid').addClass('is-invalid');
                    }

                });
            });
        }
    };

    var params = ['long-link','link-default'];

    function inputId(a) {
        return document.getElementById(a);
    }

    // note: encode - against conflict (&) params&params => server
    params = params.map(function(L){
        return inputId(L).name + '=' + encodeURIComponent(inputId(L).value);
    });
    params = params.join('&');

    $('#long-link').keyup(function() {
      console.log(params);
    });

    request.open('POST', 'script', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
}



