<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>AJAX Contact Form Demo</title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Styles -->
        <link href="./css/jquery.filer.css" rel="stylesheet">

        <!-- Jvascript -->
        <script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>
        <script src="./js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="./js/custom.js" type="text/javascript"></script>
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
                        url: "ajax.php", // Url to which the request is send
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

            <form id="ajax-contact" method="post" action="ajax.php" enctype="multipart/form-data">
                <div class="field">
                    <p>Name:</p>
                    <input type="text" id="name" name="name" placeholder="Name">
                    <p>Email:</p>
                    <input type="text" id="email" name="email"  placeholder="Email">
                    <p>File:</p>
                   
                    <input type="file" name="files[]" id="filer_input" multiple="multiple"/>

                </div>

                <div class="field">
                    <button type="submit">Send</button>
                </div>
            </form>
    </body>
</html>