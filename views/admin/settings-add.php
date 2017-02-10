<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title><?php echo $pageInfo['site_title']; ?></title>
        <?php include('inc-head.php'); ?>
    </head>

    <body>
        <div class="outer">
            <!-- Sidebar starts -->
            <div class="sidebar">
                <div class="sidey">
                    <!-- Sidebar navigation starts -->
                    <!-- Responsive dropdown -->
                    <?php include('inc-sidebar.php'); ?>
                    <!-- Sidebar navigation ends -->
                </div>
            </div>
            <!-- Sidebar ends -->

            <!-- Mainbar starts -->
            <div class="mainbar">

                <!-- Mainbar header starts -->
                <?php include('inc-header.php'); ?>

                <!-- Mainbar header ends -->

                <div class="main-content">
                    <div class="container">

                        <div class="page-content">

                            <!-- Heading -->
                            <div class="single-head">
                                <!-- Heading -->
                                <h3 class="pull-left"><i class="fa fa-desktop purple"></i> <?php echo $pageInfo['page_title']; ?></h3>
                                <!-- Bread crumbs -->

                                <div class="breads pull-right">
                                    <a href="<?php echo $ADMIN_URL . 'settings'; ?>" class="action-box"><i class="fa fa-table"></i> <?php echo $DICT['manage']; ?></a>
                                </div>


                                <div class="clearfix"></div>
                                <hr/>
                                <div id="ajax-response"></div>
                                <!-- Content starts -->
                                <form role="form" method="post" name="suForm" id="suForm" action="<?php echo $ADMIN_SUBMIT_URL; ?>settings-add">		
                                    <div class="gallery clearfix">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $db['sulata_settings']['setting__Setting']['star']; ?><?php echo $db['sulata_settings']['setting__Setting']['label']; ?>:</label>
                                                <input name="<?php echo $db['sulata_settings']['setting__Setting']['name']; ?>" id="<?php echo $db['sulata_settings']['setting__Setting']['name']; ?>" autocomplete="off" maxlength="<?php echo $db['sulata_settings']['setting__Setting']['length']; ?>" class="form-control" type="<?php echo $db['sulata_settings']['setting__Setting']['type']; ?>" <?php echo $db['sulata_settings']['setting__Setting']['required']; ?>>
                                            </div>


                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $db['sulata_settings']['setting__Key']['star']; ?><?php echo $db['sulata_settings']['setting__Key']['label']; ?>:</label>
                                                <input name="<?php echo $db['sulata_settings']['setting__Key']['name']; ?>" id="<?php echo $db['sulata_settings']['setting__Key']['name']; ?>" autocomplete="off" maxlength="<?php echo $db['sulata_settings']['setting__Key']['length']; ?>" class="form-control" type="<?php echo $db['sulata_settings']['setting__Key']['type']; ?>" <?php echo $db['sulata_settings']['setting__Key']['required']; ?>>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label><?php echo $db['sulata_settings']['setting__Value']['star']; ?><?php echo $db['sulata_settings']['setting__Value']['label']; ?>:</label>
                                                    <input name="<?php echo $db['sulata_settings']['setting__Key']['name']; ?>" id="<?php echo $db['sulata_settings']['setting__Value']['name']; ?>" autocomplete="off" maxlength="<?php echo $db['sulata_settings']['setting__Value']['length']; ?>" class="form-control" type="<?php echo $db['sulata_settings']['setting__Value']['type']; ?>" <?php echo $db['sulata_settings']['setting__Value']['required']; ?>>                                                </div>


                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label>*Type:</label>

                                                    <?php echo $setting__Type; ?>

                                                </div>
                                            </div>
                                            <div class="lineSpacer clear"></div>
                                            <p>
                                            <div class="pull-right">
                                                <div class="submit-buttons">
                                                    <button type="submit" class="btn btn-info btn-sm"><?php echo $DICT['submit']; ?></button>
                                                    <button type="reset" class="btn btn-default btn-sm"><?php echo $DICT['reset']; ?></button>
                                                </div>
                                                <div class="processing-image hide"></div>
                                            </div>
                                            </p>
                                        </div>
                                </form>
                                <!-- Content ends -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- Footer Starts -->
                        <?php include('inc-footer.php'); ?>
                        <!-- Footer Ends -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- Mainbar ends -->

            <div class="clearfix"></div>
        </div>

        <!-- Javascript files -->
        <?php include('inc-footer-js.php'); ?>
        <!-- Javascript for this page -->
        <script>
            $(document).ready(function() {
                //Ajax Form submission
                suSubmit('suForm', '<?php echo $DICT['generalError']; ?>');
            });
        </script>
    </body>

</html>
