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
                                    <a href="#">
                                        <span class="action-box"><i class="fa fa-file-text"></i></span>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
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
    </body>

</html>
