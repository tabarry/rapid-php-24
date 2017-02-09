<div class="main-head">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!-- Page title -->
                <h1><a href="<?php echo $pageInfo['site_url']; ?>"><?php echo $pageInfo['site_name']; ?></a>  <small><?php echo $pageInfo['site_tagline']; ?></small></h1>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <!-- Head user -->
                <div class="head-user dropdown pull-right">
                    <a href="#" data-toggle="dropdown" id="profile">
                        <!-- Icon
                        <i class="fa fa-user"></i>  -->
                        <?php if ($pageInfo['user_picture']!=''): ?>
                            
                                <img src="@pageInfo['user_picture']" alt="" class="img-responsive img-circle" />
                            
                            <?php else: ?>
                                <img src="<?php echo $BASE_URL; ?>views/img/user.png" alt="" class="img-responsive img-circle" />
                            
                        <?php endif; ?>


                        <!-- User name -->
                        <?php echo $pageInfo['user_name']; ?>

                        <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- Dropdown -->
                    <ul class="dropdown-menu" aria-labelledby="profile">
                        <li><a href="<?php echo $ADMIN_URL; ?>settings"><i class="fa fa-gears"></i> Settings</a></li>
                        <li><a href="<?php echo $ADMIN_URL; ?>users-update"><i class="fa fa-user"></i> Update Profile</a></li>
                        <li><a href="<?php echo $ADMIN_URL; ?>logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div>
