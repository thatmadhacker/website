<html>

<body>

<?php
session_start();
$uploaddir = "profilepics/";
$uploadfile = $uploaddir . $_SESSION["element"].".jpg";
$moved = move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile );

if( $moved ) {
  header("Location:index.php");     
} else {
  echo "Not uploaded because of error";
}
?>

</body>

</html>