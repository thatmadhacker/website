<html>

<body>

<?php
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "users";

if(isset($_SESSION["user"])){
	header("Location: main.php");
}
session_start();
unset($_SESSION["user"]);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 

$user = htmlspecialchars($_POST["username"],ENT_QUOTES);
$password = htmlspecialchars($_POST["password"],ENT_QUOTES);

$result = $conn->query("SELECT `password` FROM `users` WHERE `username` = \"".$user."\"");
	$row = $result->fetch_assoc();
	$hash = $row["password"];
	if($password != ""){
	if(password_verify($password,$hash)){
$cookie_value = $user;
$_SESSION["user"] = $cookie_value;
mysqli_close($conn);
header("Location: main.php");
	}else{
		echo "Password invalid";
	}
	}else{
		echo "Password invalid";
	}
mysqli_close($conn);
?>
</body>

</html>