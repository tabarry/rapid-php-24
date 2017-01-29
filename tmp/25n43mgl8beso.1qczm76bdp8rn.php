<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $pageInfo['title']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php echo $this->render('header.html',$this->mime,get_defined_vars(),0); ?>
        <h1><?php echo $pageInfo['heading']; ?></h1>
    </body>
</html>
