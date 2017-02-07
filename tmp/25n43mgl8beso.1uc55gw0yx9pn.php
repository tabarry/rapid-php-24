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
                                    <a href="#">
                                        <span class="action-box"><i class="fa fa-file-text"></i></span>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
                                <!-- Table starts -->
                                <?php if ($pageInfo['error']!=''): ?>
                                    
                                        <div id="ajax-response" class="ajax-error"><?php echo $pageInfo['error']; ?></div>
                                    
                                    <?php else: ?>
                                        <!-- Search form starts -->
                                        <form class="form-horizontal" name="searchForm" id="searchForm" method="get" action="">
                                            <fieldset>

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <input id="q" value="<?php echo $GET['q']; ?>" name="q" class="form-control" autocomplete="off" type="search" placeholder="<?php echo $DICT['searchBy']; ?> <?php echo $db['sulata_settings']['setting__Setting']['label']; ?>" autofocus>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                                                    <button class="btn btn-default" type="submit"><?php echo $DICT['search']; ?></button>
                                                    <?php if ($GET['q']!=''): ?>
                                                        
                                                            <a class="btn btn-default" href="<?php echo $ADMIL_URL; ?>settings"><?php echo $DICT['clearSearch']; ?></a>
                                                        
                                                    <?php endif; ?>
                                                </div>
                                                <p>&nbsp;</p>
                                            </fieldset>
                                        </form>
                                        <!-- Search form ends -->
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead class="table-head">
                                                    <tr>
                                                        <th style="width:5%"><?php echo $DICT['sr']; ?></th>
                                                        <th style="width:42%">
                                                            <?php if ($GET['sort']=='desc' && $GET['f']=='setting__Setting'): ?>
                                                                
                                                                    <a href="<?php echo $ADMIL_URL; ?>settings?q=<?php echo $GET['q']; ?>&f=setting__Setting&sort=desc"><?php echo $db['sulata_settings']['setting__Setting']['label']; ?> <i class="fa fa-arrow-up"></i></i></a>
                                                                

                                                            <?php endif; ?>
                                                            
                                                                <a href="<?php echo $ADMIL_URL; ?>settings?q=<?php echo $GET['q']; ?>&f=setting__Setting&sort=asc"><?php echo $db['sulata_settings']['setting__Setting']['label']; ?> <i class="fa fa-arrow-down"></i></a>
                                                            
                                                        </th>
                                                        <th style="width:43%">
                                                            <a href="<?php echo $ADMIL_URL; ?>settings?q=<?php echo $GET['q']; ?>&f=setting__Key&sort=asc"><?php echo $db['sulata_settings']['setting__Key']['label']; ?> <i class="fa fa-arrow-up"></i><i class="fa fa-arrow-down"></i></a>
                                                        </th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $cnt=0; foreach (($pageInfo['result']?:[]) as $value): $cnt++; ?>
                                                        <tr>
                                                            <td><?php echo $cnt; ?>.</td>
                                                            <td><?php echo \Sulata::strip($value['setting__Setting']); ?></td>
                                                            <td><?php echo \Sulata::strip($value['setting__Key']); ?></td>

                                                            <td style="width:15%">
                                                                <a class="btn btn-xs btn-warning" href="<?php echo $ADMIN_URL; ?>settings-update?id=<?php echo $value['setting__ID']; ?>" title="<?php echo $DICT['edit']; ?>"><i class="fa fa-pencil"></i> </a>
                                                                <a class="btn btn-xs btn-success" href="<?php echo $ADMIN_URL; ?>settings-add?id=<?php echo $value['setting__ID']; ?>" title="<?php echo $DICT['duplicate']; ?>"><i class="fa fa-copy"></i> </a>
                                                                <a class="btn btn-xs btn-danger" href="<?php echo $ADMIN_URL; ?>settings-delete?id=<?php echo $value['setting__ID']; ?>" title="<?php echo $DICT['delete']; ?>"><i class="fa fa-times"></i> </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    
                                <?php endif; ?>


                                <!-- Table ends -->
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
