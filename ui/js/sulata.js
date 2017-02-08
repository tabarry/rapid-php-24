//Submit form in AJAX
function suSubmit(frmName, generalError) {
// Get the form.
    var form = $('#' + frmName);
    // Get the messages div.
    var formMessages = $('#ajax-response');
    // Set up an event listener for the contact form.
    $(form).submit(function(e) {
// Stop the browser from submitting the form.
        e.preventDefault();
        // Serialize the form data.
        // Submit the form using AJAX.
        $.ajax({
            url: form.attr('action'), // Url to which the request is send
            type: form.attr('method'), // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false
        })
                .done(function(response) {
                    // Make sure that the formMessages div has the 'success' class.
                    formMessages.html(response);
                    $("html, body").animate({scrollTop: parent.$("html").offset().top}, "slow");
                })
                .fail(function(data) {
                    
                    if (formMessages) {
                        formMessages.html(generalError);
                        formMessages.addClass('ajax-error');
                    }
                    $("html, body").animate({scrollTop: parent.$("html").offset().top}, "slow");
                });
    });
}
//Delete a record
function suDelete(eleId, url, errorMsg) {
    c = confirm(errorMsg);
    if (c == true) {
        if ($('#ajax-response')) {
            $('#ajax-response').load(url);
        }
    }

}
//Toggle submit button
function suToggleButton(flag) {
    if (flag == true) {
        if ($('.submit-buttons')) {
            $('.submit-buttons').addClass('hide');
        }
        if ($('.processing-image')) {
            $('.processing-image').removeClass('hide');
        }
    } else {
        if ($('.submit-buttons')) {
            $('.submit-buttons').removeClass('hide');
        }
        if ($('.processing-image')) {
            $('.processing-image').addClass('hide');
        }
    }
}
//Keep session live
function suStayAlive(url) {
    $.post(url);
}