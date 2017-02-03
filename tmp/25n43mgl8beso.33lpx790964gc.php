<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title><?php echo $pageInfo['title']; ?></title>
    <?php echo $this->render('inc-head.html',$this->mime,get_defined_vars(),0); ?>
</head>

<body>
    <div class="outer-page">

        <!-- Login page -->
        <div class="login-page">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#login" data-toggle="tab" class="br-lblue"><i class="fa fa-sign-in"></i> <?php echo $DICT['loginForm']['logIn']; ?></a></li>
                <li><a href="#lost-password" data-toggle="tab" class="br-lblue"><i class="fa fa-key"></i> <?php echo $DICT['loginForm']['lostPassword']; ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="login">

                    <!-- Login form -->

                    <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $BASE; ?>/authenticate">
                        <div class="form-group">
                            <label for="email">*<?php echo $DICT['loginForm']['email']; ?></label>
                            <input class="form-control" id="email" type="email" autocomplete="off" required="required">
                        </div>
                        <div class="form-group">
                            <label for="password">*<?php echo $DICT['loginForm']['password']; ?></label>
                            <input class="form-control" id="password" type="password" autocomplete="off" required="required">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> <?php echo $DICT['loginForm']['rememberMe']; ?>

                            </label>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                        <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                    </form>

                </div>


                <div class="tab-pane fade" id="lost-password">

                    <!-- Lost Password Form -->

                    <form role="form" action="index.html">

                        <div class="form-group">
                            <label for="email">*<?php echo $DICT['loginForm']['provideEmailBelow']; ?></label>
                            <input class="form-control" id="email" type="text" autocomplete="off" required="required">
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
