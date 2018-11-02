<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<h1> Admin Panel </h1>
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

$sql = "SELECT * FROM `permissions` WHERE `username` = \"".$_SESSION["user"]."\"";
$result = $conn->query($sql) or die("Exception");
$row = $result->fetch_assoc();
$permission = intval($row["permission"]);
if($permission == 0){
	die("No permission");
}
mysqli_close($conn);
?>
<form action="main.php">
<input type="submit" value="Go Back"> <br>
</form>
<form action="/news/create-news.html" method="post">
<input type="submit" value="Post news"> <br>
</form>
<form action="delete-post.php" method="post">
ID: <input type="text" name="id">
<input type="submit" value="Delete post"> <br>
</form> <br>

</body>

</html>