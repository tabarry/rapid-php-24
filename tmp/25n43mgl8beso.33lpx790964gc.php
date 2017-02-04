<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title><?php echo $pageInfo['title']; ?></title>

    <?php echo $this->render('inc-head.html',$this->mime,get_defined_vars(),0); ?>
    <script>
        function suSubmit(frmName, outputEle) {
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
                    url: "<?php echo $BASE; ?>/authenticate", // Url to which the request is send
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
            suSubmit('suForm', 'server-results', 'server-results');

        });

    </script>
</head>
<body>
    <div id="server-results"></div>

    <div class="outer-page">
        <!-- Login page -->
        <div class="login-page">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#login" data-toggle="tab" class="br-lblue"><i class="fa fa-sign-in"></i> <?php echo $DICT['logIn']; ?></a></li>
                <li><a href="#lost-password" data-toggle="tab" class="br-lblue"><i class="fa fa-key"></i> <?php echo $DICT['lostPassword']; ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="login">

                    <!-- Login form -->

                    <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $BASE; ?>/authenticate">
                        <div class="form-group">
                            <label for="<?php echo $db['sulata_users']['user__Email']['name']; ?>"><?php echo $db['sulata_users']['user__Email']['star']; ?><?php echo $db['sulata_users']['user__Email']['label']; ?></label>
                            <input class="form-control" id="<?php echo $db['sulata_users']['user__Email']['name']; ?>" name="<?php echo $db['sulata_users']['user__Email']['name']; ?>" type="<?php echo $db['sulata_users']['user__Email']['type']; ?>" <?php echo $db['sulata_users']['user__Email']['required']; ?> maxlength="<?php echo $db['sulata_users']['user__Email']['length']; ?>" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $db['sulata_users']['user__Password']['name']; ?>"><?php echo $db['sulata_users']['user__Password']['star']; ?><?php echo $db['sulata_users']['user__Password']['label']; ?></label>
                            <input class="form-control" id="<?php echo $db['sulata_users']['user__Password']['name']; ?>" name="<?php echo $db['sulata_users']['user__Password']['name']; ?>" type="<?php echo $db['sulata_users']['user__Password']['type']; ?>" <?php echo $db['sulata_users']['user__Password']['required']; ?> maxlength="<?php echo $db['sulata_users']['user__Password']['length']; ?>" autocomplete="off" >
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> <?php echo $DICT['rememberMe']; ?>

                            </label>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                        <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                    </form>

                </div>


                <div class="tab-pane fade" id="lost-password">

                    <!-- Lost Password Form -->

                    <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $BASE; ?>/lost-password">

                        <div class="form-group">
                            <label for="email"><?php echo $db['sulata_users']['user__Email']['star']; ?><?php echo $DICT['provideEmailBelow']; ?></label>
                            <input class="form-control" id="<?php echo $db['sulata_users']['user__Email']['name']; ?>" name="<?php echo $db['sulata_users']['user__Email']['name']; ?>" type="<?php echo $db['sulata_users']['user__Email']['type']; ?>" <?php echo $db['sulata_users']['user__Email']['required']; ?> maxlength="<?php echo $db['sulata_users']['user__Email']['length']; ?>" autocomplete="off" >
                        </div>

                        <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                        <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                    </form>

                </div>
            </div>

        </div>

    </div>

    <!-- Javascript files -->
<?php echo $this->render('inc-footer-js.html',$this->mime,get_defined_vars(),0); ?>
<!-- Javascript for this page -->
</body>

</html>
