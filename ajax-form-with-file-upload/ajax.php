<?php

echo "<pre>";
//echo $_POST['name'].'--'.$_POST['email'];
print_r($_POST);
print_r($_FILES);
$sourcePath = $_FILES['files']['tmp_name'][0];       // Storing source path of the file in a variable
$targetPath = "./uploads/" . $_FILES['files']['name'][0]; // Target path where file is to be stored
move_uploaded_file($sourcePath, $targetPath);    // Moving Uploaded file
