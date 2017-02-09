<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title><?php echo $pageInfo['site_title']; ?></title>
    <?php echo $this->render('admin/inc-head.html',$this->mime,get_defined_vars(),0); ?>
    </head>

    <body>
        <div class="outer">
            <!-- Sidebar starts -->
            <div class="sidebar">
                <div class="sidey">
                    <!-- Sidebar navigation starts -->
                    <!-- Responsive dropdown -->
                    <?php echo $this->render('admin/inc-sidebar.html',$this->mime,get_defined_vars(),0); ?>
                        <!-- Sidebar navigation ends -->
                </div>
            </div>
            <!-- Sidebar ends -->

            <!-- Mainbar starts -->
            <div class="mainbar">

                <!-- Mainbar header starts -->
                <?php echo $this->render('admin/inc-header.html',$this->mime,get_defined_vars(),0); ?>

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
                                        <a href="<?php echo $ADMIN_URL.'settings'; ?>" class="action-box"><i class="fa fa-table"></i> <?php echo $DICT['manage']; ?></a>

                                    </div>


                                    <div class="clearfix"></div>
                                    <hr/>
                                    <div id="ajax-response"></div>
                                    <!-- Content starts -->
                                    <form class="form-horizontal" action="http://localhost/pos/_admin/settings-remote.php/add/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote">			
                                        <div class="gallery clearfix">
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label>*Setting:</label>
                                                    <input name="setting__Setting" id="setting__Setting" autocomplete="off" maxlength="50" class="form-control" type="text">                                            </div>


                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label>*Key:</label>
                                                    <input name="setting__Key" id="setting__Key" autocomplete="off" maxlength="50" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label>*Value:</label>
                                                    <input name="setting__Value" id="setting__Value" autocomplete="off" maxlength="256" class="form-control" type="text">                                            </div>


                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                    <label>*Type:</label>

                                                    <select id="setting__Type" name="setting__Type" class="form-control">


                                                        <option value="" selected="selected">
                                                            Select..
                                                        </option>


                                                        <option value="Private">
                                                            Private
                                                        </option>


                                                        <option value="Public">
                                                            Public
                                                        </option>


                                                        <option value="Site">
                                                            Site
                                                        </option>


                                                    </select>

                                                </div>
                                            </div>
                                            <div class="lineSpacer clear"></div>
                                            <p>
                                                <input name="Submit" id="Submit" value="Submit" class="btn btn-primary pull-right" type="submit">                              
                                            </p>
                                        </div>
                                    </form>
                                    <!-- Content ends -->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- Footer Starts -->
                            <?php echo $this->render('admin/inc-footer.html',$this->mime,get_defined_vars(),0); ?>
                                <!-- Footer Ends -->
                        </div>
                    </div>
                    <div class="clearfix"></div>
            </div>
            <!-- Mainbar ends -->

            <div class="clearfix"></div>
        </div>

        <!-- Javascript files -->
    <?php echo $this->render('admin/inc-footer-js.html',$this->mime,get_defined_vars(),0); ?>
        <!-- Javascript for this page -->
        </body>

        </html>
