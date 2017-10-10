$('document').ready(function() {

    // for old explore
    function getXMLHttpRequest() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        return new ActiveXObject('Microsoft.XMLHTTP');
    }

    request = getXMLHttpRequest();

    // require status query
    request.onreadystatechange = function() {
            if (request.readyState == 4) {
                var responseBody = request.responseText,
                    data = JSON.parse(responseBody);
                $('.btn-success').on('click', function() {
                    $('.card-body').append(data['.message']);
                });
            }
    };

    request.open('GET', '../script.php', true);
    request.send(null);

});