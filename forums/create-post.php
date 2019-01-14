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
$result = mysqli_query($conn,"SELECT * FROM `posts`");
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);
$id = 1;
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
	$id = intval($row["id"])+1;
}
$name = $_SESSION["user"];
$title = htmlspecialchars($_POST["title"],ENT_QUOTES);
$body = htmlspecialchars($_POST["body"],ENT_QUOTES);

$sql = "INSERT INTO `posts`(`id`, `title`, `body`, `reg_date`, `username`) VALUES (\"".$id."\",\"".$title."\",\"".$body."\",\"".date("Y/m/d h/i/s")."\",\"".$name."\")";
if(mysqli_query($conn,$sql) == true){
}else{
	 echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close();
header("Location: main.php");
?>
</body>

</html>