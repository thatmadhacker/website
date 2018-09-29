<html>

<body>

<?php
$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "element-dating";
session_start();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
}
$sql = "UPDATE `details` SET `bio`=\"".htmlspecialchars($_POST["bio"],ENT_QUOTES)."\" WHERE `username` = \"".$_SESSION["element"]."\"";
	if (mysqli_query($conn,$sql) === TRUE) {
mysqli_close($conn);
header("Location: index.php");
	}else{
		 echo "Error: " . $sql . "<br>" . $conn->error;
	}
mysqli_close($conn);
?>


</body>

</html>