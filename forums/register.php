<html>

<body>

<?php
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "users";
session_start();
unset($_SESSION["user"]);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: ");
} 

$result = mysqli_query($conn,"SELECT `email` FROM `users` WHERE `email` = '".htmlspecialchars($_POST["email"],ENT_QUOTES)."'");
if (!mysqli_num_rows($result)){
$result = mysqli_query($conn,"SELECT `username` FROM `users` WHERE `username` = '".htmlspecialchars($_POST["username"],ENT_QUOTES)."'");
if (!mysqli_num_rows($result)){

$username = htmlspecialchars($_POST["username"],ENT_QUOTES);
$email = htmlspecialchars($_POST["email"],ENT_QUOTES);
$password = password_hash(htmlspecialchars($_POST["password"],ENT_QUOTES), PASSWORD_DEFAULT);
$result = mysqli_query($conn,"SELECT * FROM users");
$id = mysqli_num_rows($result);
$date = date("yyyy-MM-dd");
$query = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `reg_date`) VALUES (\"".$id."\",\"".$username."\",\"".$email."\",\"".$password."\",\"".date."\")";
$result = mysqli_query($conn,$query);
$_SESSION["user"] = $username;
header("Location: main.php");
}else{
	echo "Username ".htmlspecialchars($_POST["username"],ENT_QUOTES)." is already taken.";
}
}else{
	echo "E-Mail ".htmlspecialchars($_POST["email"],ENT_QUOTES)." is already in use.";
}

mysqli_close($conn);
?>
</body>

</html>
