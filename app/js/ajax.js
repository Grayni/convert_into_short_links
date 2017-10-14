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

        let
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
                    $('.ajax-loader').hide();

                });
            });
        }
    };

    let params = ['long-link','link-default'];

    function inputId(a) {
        return document.getElementById(a);
    }

    // note: encode - against conflict (&) params&params => server
    params = params.map(L => inputId(L).name + '=' + encodeURIComponent(inputId(L).value));
    params = params.join('&');

    $('#long-link').keyup(function() {
      console.log(params);
    });

    request.open('POST', 'script', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);
}



