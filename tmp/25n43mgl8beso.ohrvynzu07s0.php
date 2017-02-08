<div class="sidebar-dropdown"><a href="#" class="br-red"><i class="fa fa-bars"></i></a></div>
<div class="side-nav">
    <div class="side-nav-block">
        <!-- Sidebar heading -->
        <!-- Sidebar links -->
        <ul class="list-unstyled">
            <li><a href="<?php echo $ADMIN_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo $ADMIN_URL; ?>profile"><i class="fa fa-user"></i> Update Profile</a></li>
            <li><a href="<?php echo $ADMIN_URL; ?>logout"><i class="fa fa-power-off"></i> Log Out</a></li>
            <li>&nbsp;</li>


            <!-- Mainmenu with submenu -->
            <li class="has_submenu">
                <a href="#"><i class="fa fa-th-large"></i> More.. <span class="nav-caret fa fa-caret-down"></span></a>
                <!-- Submenu -->
                <ul class="list-unstyled">

                    <?php $cnt=0; foreach (($sidebar?:[]) as $file): $cnt++; ?>
                        <li><a href="<?php echo $ADMIN_URL; ?><?php echo $file; ?>"><i class="fa fa-angle-double-right"></i> <?php echo ucwords($file); ?></a></li>
                    <?php endforeach; ?>

                </ul>
            </li>

        </ul>
    </div>

</div>
