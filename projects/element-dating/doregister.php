<html>

<body>

<?php
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "element-dating";
session_start();
unset($_SESSION["element"]);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 
$result = mysqli_query($conn,"SELECT `username` FROM `users` WHERE `username` = '".htmlspecialchars($_POST["username"],ENT_QUOTES)."'");
if (!mysqli_num_rows($result)){
unset($_SESSION["element"]);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
}
$sql = "INSERT INTO users (id, username, password, element, bio, details)
VALUES (\"".
(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"))+1)
."/"/""
.htmlspecialchars($_POST["username"],ENT_QUOTES)
."\", \""
.password_hash(htmlspecialchars($_POST["password"],ENT_QUOTES)
, PASSWORD_DEFAULT).",\"".htmlspecialchars($_POST["element"],ENT_QUOTES)."\",\"\",\"\")";
echo $sql;
    
	if (mysqli_query($conn,$sql) === TRUE) {
$cookie_value = htmlspecialchars($_POST["username"],ENT_QUOTES);
$_SESSION["element"] = $cookie_value;
mysqli_close($conn);
header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
mysqli_close($conn);
?>


</body>

</html>