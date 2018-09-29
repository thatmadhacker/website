<html>

<body>

<?php
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "users";

session_start();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 

$id = htmlspecialchars($_POST["id"],ENT_QUOTES);
$sql = "SELECT * FROM `permissions` WHERE `username` = \"".$_SESSION["user"]."\"";
$result = $conn->query($sql) or die("Exception");
$row = $result->fetch_assoc();
$permission = intval($row["permission"]);
if($permission == 0){
	die("No permission");
}
$result = $conn->query("DELETE FROM `posts` WHERE `id` = ".$id);
mysqli_close($conn);
header("Location: main.php");
exit();
?>
</body>

</html>