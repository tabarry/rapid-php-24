<!-- jQuery -->
<script src="<?php echo $BASE_URL ?>views/js/jquery.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo $BASE_URL ?>views/js/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo $BASE_URL ?>views/js/jquery-ui.min.js"></script>

<!-- Bootstrap wysihtml5 JS -->		
<script src="<?php echo $BASE_URL ?>views/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo $BASE_URL ?>views/js/prettify.js"></script>
<script src="<?php echo $BASE_URL ?>views/js/bootstrap-wysihtml5.min.js"></script>


<!-- jQuery slim scroll -->
<script src="<?php echo $BASE_URL ?>views/js/jquery.slimscroll.min.js"></script>

<!-- Pretty Photo JS -->
<script src="<?php echo $BASE_URL ?>views/js/jquery.prettyPhoto.js"></script>	


<!-- Respond JS for IE8 -->
<script src="<?php echo $BASE_URL ?>views/js/respond.min.js"></script>
<!-- HTML5 Support for IE -->
<script src="<?php echo $BASE_URL ?>views/js/html5shiv.js"></script>
<!-- Custom JS -->
<script src="<?php echo $BASE_URL ?>views/js/custom.js"></script>
<!-- Sulata JS -->
<script src="<?php echo $BASE_URL ?>views/js/sulata.js"></script>
<script src="<?php echo $BASE_URL ?>views/js/this-site.js"></script>
<!-- Default document onready event -->
<script>
    $(document).ready(function() {
        //Keep session alive
        $(function() {
            window.setInterval("suStayAlive('<?php echo $PING_URL; ?>')", 300000);
        });

    });
</script>