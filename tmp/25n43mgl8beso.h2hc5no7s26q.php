<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Title here -->
        <title>Barnie</title>
    <?php echo $this->render('inc-head.html',$this->mime,get_defined_vars(),0); ?>
</head>
<body>
    <div class="outer">
        <!-- Sidebar starts -->
        <div class="sidebar">
            <div class="sidey">
                <!-- Sidebar navigation starts -->
                <!-- Responsive dropdown -->
                <?php echo $this->render('inc-sidebar.html',$this->mime,get_defined_vars(),0); ?>
                <!-- Sidebar navigation ends -->
            </div>
        </div>
        <!-- Sidebar ends -->

        <!-- Mainbar starts -->
        <div class="mainbar">

            <!-- Mainbar header starts -->
            <?php echo $this->render('inc-header.html',$this->mime,get_defined_vars(),0); ?>

            <!-- Mainbar header ends -->

            <div class="main-content">
                <div class="container">

                    <div class="page-content">

                        <!-- Heading -->
                        <div class="single-head">
                            <!-- Heading -->
                            <h3 class="pull-left"><i class="fa fa-desktop purple"></i> Your Page</h3>
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
                    <?php echo $this->render('inc-footer.html',$this->mime,get_defined_vars(),0); ?>
                    <!-- Footer Ends -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Mainbar ends -->

        <div class="clearfix"></div>
    </div>

    <!-- Javascript files -->
<?php echo $this->render('inc-footer-js.html',$this->mime,get_defined_vars(),0); ?>
<!-- Javascript for this page -->
</body>	
</html>