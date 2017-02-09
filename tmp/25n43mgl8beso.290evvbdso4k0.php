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
                                    <?php if ($ADD_ACCESS): ?>
                                        
                                        <div class="breads pull-right">
                                            <a href="<?php echo $ADMIN_URL.'settings-add'; ?>" class="action-box"><i class="fa fa-file-text"></i> <?php echo $DICT['addNew']; ?></a>

                                        </div>
                                        
                                    <?php endif; ?>

                                    <div class="clearfix"></div>
                                    <hr/>
                                    <div id="ajax-response"></div>
                                    <!-- Content starts -->
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
                                    <?php if ($pageInfo['error']==''): ?>
                                        

                                        <div class="table-responsive">
                                            <!-- arrow directioning starts -->
                                            <?php if ($GET['sort']=='setting__Setting-asc'): ?>
                                                
                                                <?php $setting__Setting_arrow='up'; ?>
                                                
                                            <?php endif; ?>
                                            <?php if ($GET['sort']=='setting__Setting-desc'): ?>
                                                
                                                <?php $setting__Setting_arrow='down'; ?>
                                                
                                            <?php endif; ?>
                                            <?php if ($GET['sort']=='setting__Key-asc'): ?>
                                                
                                                <?php $setting__Key_arrow='up'; ?>
                                                
                                            <?php endif; ?>
                                            <?php if ($GET['sort']=='setting__Key-desc'): ?>
                                                
                                                <?php $setting__Key_arrow='down'; ?>
                                                
                                            <?php endif; ?>
                                            <!-- arrow directioning ends -->
                                            <table class="table table-hover table-bordered">
                                                <thead class="table-head">
                                                    <tr>
                                                        <th style="width:5%"><?php echo $DICT['sr']; ?></th>
                                                        <th style="width:42%">
                                                            <a href="<?php echo $ADMIL_URL; ?>settings?q=<?php echo $GET['q']; ?>&sort=setting__Setting-<?php echo $nextSort; ?>"><?php echo $db['sulata_settings']['setting__Setting']['label']; ?> <i class="fa fa-arrow-<?php echo $setting__Setting_arrow; ?>"></i></a>
                                                        </th>
                                                        <th style="width:43%">
                                                            <a href="<?php echo $ADMIL_URL; ?>settings?q=<?php echo $GET['q']; ?>&sort=setting__Key-<?php echo $nextSort; ?>"><?php echo $db['sulata_settings']['setting__Key']['label']; ?> <i class="fa fa-arrow-<?php echo $setting__Key_arrow; ?>"></i></a>
                                                        </th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $cnt=0; foreach (($pageInfo['result']?:[]) as $value): $cnt++; ?>
                                                    <tr id="tr_<?php echo $value['setting__ID']; ?>">
                                                        <td><?php echo $cnt+$GET['sr']; ?>.</td>
                                                        <td><?php echo \Sulata::strip($value['setting__Setting']); ?></td>
                                                        <td><?php echo \Sulata::strip($value['setting__Key']); ?></td>

                                                        <td style="width:15%; text-align: center;">
                                                            <!-- Restore -->
                                                    <?php if ($RESTORE_ACCESS): ?>
                                                        
                                                        <span id="restore_<?php echo $value['setting__ID']; ?>" class="hide">
                                                            <a class="btn btn-xs btn-primary" onclick="return suDelete('<?php echo $value['setting__ID']; ?>','<?php echo $ADMIN_URL.'settings-restore'; ?>/<?php echo $value['setting__ID']; ?>','<?php echo $DICT['confirmationMessage']; ?>');" title="<?php echo $DICT['restore']; ?>" href="javascript:;"><i class="fa fa-undo"></i> </a>
                                                        </span>
                                                        
                                                    <?php endif; ?>
                                                    <!-- // -->

                                                    <!-- Edit, duplicate, delete  -->
                                                    <span id="actions_<?php echo $value['setting__ID']; ?>">
                                                        <!-- Edit -->
                                                        <?php if ($EDIT_ACCESS): ?>
                                                            
                                                            <a class="btn btn-xs btn-warning" href="<?php echo $ADMIN_URL; ?>settings-update/<?php echo $value['setting__ID']; ?>" title="<?php echo $DICT['edit']; ?>"><i class="fa fa-pencil"></i> </a>
                                                            
                                                        <?php endif; ?>
                                                        <!-- // -->
                                                        <!-- Duplicate -->
                                                        <?php if ($DUPLICATE_ACCESS): ?>
                                                            
                                                            <a class="btn btn-xs btn-success" href="<?php echo $ADMIN_URL; ?>settings-add/<?php echo $value['setting__ID']; ?>" title="<?php echo $DICT['duplicate']; ?>"><i class="fa fa-copy"></i> </a>
                                                            
                                                        <?php endif; ?>
                                                        <!-- // -->
                                                        <!-- Delete -->
                                                        <?php if ($DELETE_ACCESS): ?>
                                                            
                                                            <a class="btn btn-xs btn-danger" onclick="return suDelete('<?php echo $value['setting__ID']; ?>','<?php echo $ADMIN_URL.'settings-delete'; ?>/<?php echo $value['setting__ID']; ?>','<?php echo $DICT['confirmationMessage']; ?>');" title="<?php echo $DICT['delete']; ?>" href="javascript:;"><i class="fa fa-times"></i> </a>
                                                            
                                                        <?php endif; ?>
                                                        <!-- // -->
                                                    </span>
                                                    <!-- // -->
                                                    </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <!-- Pagnation starts -->
                                            <?php echo \Sulata::paginate($totalRecs); ?>

                                            <!-- Pagnation ends -->
                                        </div>
                                        
                                        <?php else: ?>
                                        <div id="no-record-found" class="ajax-error"><?php echo $pageInfo['error']; ?></div>

                                        
                                    <?php endif; ?>
                                    <p>&nbsp;</p>
                                    <!-- Download CSV -->
                                    <?php if ($DOWNLOAD_ACCESS_CSV): ?>
                                        
                                        <p><a href="<?php echo $ADMIL_URL; ?>settings-csv" class="btn btn-black pull-right"><i class="fa fa-download"></i> <?php echo $DICT['download']; ?> CSV</a></p>
                                        
                                    <?php endif; ?>
                                    <!-- // -->
                                    <div class="clearfix"></div>
                                    <p>&nbsp;</p>
                                    <!-- Download PDF -->
                                    <?php if ($DOWNLOAD_ACCESS_PDF): ?>
                                        
                                    <p><a href="<?php echo $ADMIL_URL; ?>settings-pdf" class="btn btn-black pull-right"><i class="fa fa-download"></i> <?php echo $DICT['download']; ?> PDF</a></p>
                                    
                                    <?php endif; ?>
                                    <!-- // -->
                                    <p>&nbsp;</p>
                                    <div class="clearfix"></div>
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
