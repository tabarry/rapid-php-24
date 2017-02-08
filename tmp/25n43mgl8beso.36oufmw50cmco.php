<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Styles -->
<!-- Bootstrap CSS -->
<link href="<?php echo $BASE_URL; ?>views/css/bootstrap.min.css" rel="stylesheet">
<!-- Font awesome CSS -->
<link href="<?php echo $BASE_URL; ?>views/css/font-awesome.min.css" rel="stylesheet">

<!-- Custom Color CSS -->
<link href="<?php echo $BASE_URL; ?>views/css/less-style.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo $BASE_URL; ?>views/css/style.css" rel="stylesheet">
<?php if ($SESSION['userInfo']['user__Theme']!=''): ?>
    
    <link href="<?php echo $BASE_URL; ?>views/css/theme/<?php echo $SESSION['userInfo']['user__Theme']; ?>.css" rel="stylesheet" type="text/css"/>
    
    <?php else: ?>
    <link href="<?php echo $BASE_URL; ?>views/css/theme/default.css" rel="stylesheet" type="text/css"/>
    
<?php endif; ?>
<link href="<?php echo $BASE_URL; ?>views/css/sulata.css" rel="stylesheet">
<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php echo $BASE_URL; ?>favicon.png" />
