<html>

<body>

<?php
session_start();
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 
$sql = "SELECT * FROM `permissions` WHERE `username` = \"".$_SESSION["user"]."\"";
$result = $conn->query($sql) or die("Exception");
$row = $result->fetch_assoc();
$permission = intval($row["permission"]);
if($permission == 0){
	die("No permission");
}
$result = mysqli_query($conn,"SELECT * FROM `news`");
$id = mysqli_num_rows($result)+1;
$name = $_SESSION["user"];
$title = htmlspecialchars($_POST["title"],ENT_QUOTES);
$body = htmlspecialchars($_POST["body"],ENT_QUOTES);

$sql = "INSERT INTO `news`(`id`, `title`, `body`, `reg_date`, `username`) VALUES (\"".$id."\",\"".$title."\",\"".$body."\",\"".date("Y/m/d h/i/s")."\",\"".$name."\")";
if(mysqli_query($conn,$sql) == true){
	
}else{
	 echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
header("Location: /forums/main.php");
?>
</body>

</html>