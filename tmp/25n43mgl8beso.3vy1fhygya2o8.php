<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageInfo['title']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>

        <script>
function suSubmit(frmName, outputEle, errorEle) {
    // Get the form.
    var form = $('#' + frmName);

    // Get the messages div.
    var formMessages = $('#' + outputEle);

    // Set up an event listener for the contact form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        //////var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            url: "<?php echo $BASE; ?>/users-remote", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false
        })
                .done(function(response) {
                    // Make sure that the formMessages div has the 'success' class.
                    formMessages.html(response);
                })
                .fail(function(data) {
                    alert('error');
                });

    });
}
$(document).ready(function() {
    suSubmit('ajax-contact', 'server-results', 'server-results');

});

        </script>
    </head>
    <body>
        <div id="server-results"></div>
        <h1><?php echo $pageInfo['title']; ?></h1>
        <form id="ajax-contact" name="suForm" method="post" action="<?php echo $BASE; ?>/users-remote">
            <div>Name:</div>
            <div><input type="text" name="name"/></div>
            <div>Email</div>
            <div><input type="email" name="email"/></div>
            <div>Phone</div>
            <div><input type="text" name="phone"/></div>
            <p><input type="submit" value="Submit"/></p>
        </form>
    </body>
</html>
