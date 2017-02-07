<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title><?php echo $pageInfo['site_title']; ?></title>
    <?php echo $this->render('admin/inc-head.html',$this->mime,get_defined_vars(),0); ?>
    </head>
    <body>
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

                        <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $ADMIN_SUBMIT_URL; ?>authenticate">
                            <div id="ajax-response"></div>
                            <div class="form-group">
                                <label for="<?php echo $db['sulata_employees']['employee__Email']['name']; ?>"><?php echo $db['sulata_employees']['employee__Email']['star']; ?><?php echo $db['sulata_employees']['employee__Email']['label']; ?></label>
                                <input class="form-control" id="<?php echo $db['sulata_employees']['employee__Email']['name']; ?>" name="<?php echo $db['sulata_employees']['employee__Email']['name']; ?>" type="<?php echo $db['sulata_employees']['employee__Email']['type']; ?>" <?php echo $db['sulata_employees']['employee__Email']['required']; ?> maxlength="<?php echo $db['sulata_employees']['employee__Email']['length']; ?>" autocomplete="off" value="<?php echo $ckRememberLogin; ?>">
                            </div>
                            <div class="form-group">
                                <label for="<?php echo $db['sulata_users']['user__Password']['name']; ?>"><?php echo $db['sulata_users']['user__Password']['star']; ?><?php echo $db['sulata_users']['user__Password']['label']; ?></label>
                                <input class="form-control" id="<?php echo $db['sulata_users']['user__Password']['name']; ?>" name="<?php echo $db['sulata_users']['user__Password']['name']; ?>" type="<?php echo $db['sulata_users']['user__Password']['type']; ?>" <?php echo $db['sulata_users']['user__Password']['required']; ?> maxlength="<?php echo $db['sulata_users']['user__Password']['length']; ?>" autocomplete="off" >
                            </div>

                            <div class="checkbox">
                                <label>
                                    <?php if ($ckRememberLogin!=''): ?>
                                        
                                        <input type="checkbox" name="rememberLogin" id="rememberLogin" value="1" checked="checked"> <?php echo $DICT['rememberMe']; ?>

                                        
                                        <?php else: ?>
                                        <input type="checkbox" name="rememberLogin" id="rememberLogin" value="1"> <?php echo $DICT['rememberMe']; ?>

                                        
                                    <?php endif; ?>


                                </label>
                            </div>
                            <div class="submit-buttons">
                                <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                                <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                            </div>
                            <div class="processing-image hide"></div>
                        </form>

                    </div>


                    <div class="tab-pane fade" id="lost-password">

                        <!-- Lost Password Form -->

                        <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $ADMIN_URL; ?>lost-password">

                            <div class="form-group">
                                <label for="email"><?php echo $db['sulata_employees']['employee__Email']['star']; ?><?php echo $DICT['provideEmailBelow']; ?></label>
                                <input class="form-control" id="<?php echo $db['sulata_employees']['employee__Email']['name']; ?>" name="<?php echo $db['sulata_employees']['employee__Email']['name']; ?>" type="<?php echo $db['sulata_employees']['employee__Email']['type']; ?>" <?php echo $db['sulata_employees']['employee__Email']['required']; ?> maxlength="<?php echo $db['sulata_employees']['employee__Email']['length']; ?>" autocomplete="off" value="<?php echo $ckRememberLogin; ?>">
                            </div>
                            <div class="submit-buttons">
                                <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                                <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                            </div>
                            <div class="processing-image hide"></div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

        <!-- Javascript files -->
    <?php echo $this->render('admin/inc-footer-js.html',$this->mime,get_defined_vars(),0); ?>
        <!-- Javascript for this page -->
        <script>

            $(document).ready(function() {
                //Ajax Form submission
                suSubmit('suForm', 'ajax-response', '<?php echo $DICT['generalError']; ?>');
                //Keep session alive
                $(function() {
                    window.setInterval("suStayAlive('<?php echo $PING_URL; ?>')", 300000);
                });

            });

        </script>
        </body>

        </html>
