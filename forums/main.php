<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/style.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php
session_start();
set_error_handler('exceptions_error_handler');

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}
try{
$string = "Welcome, ".$_SESSION["user"]." to thatmadhacker.org";
echo "<h1>";
echo $string;
echo "</h1>";
}catch(Exception $e){
	header("Location: index.html");
}
?>
<form action="create-post.html" method="post">
<input type="submit" value="Create a post">
</form>
<form action="search.php" method="post">
<input type="text" name="title">
<input type="submit" value="Search">
</form>
<?php
try{
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
if($permission > 0){
	echo "<form action=\"admin-panel.php\"> &#13;&#10;
<input type=\"submit\" value=\"Admin Panel\"> &#13;&#10;
</form> &#13;&#10;";
}
}catch(Exception $e){
	echo $e;
}
?>
<form action="logout.php" method="post">
<input type="submit" value="Logout">
</form>
<?php
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
$sql = "INSERT INTO connections (remote_addr, forwarded_for, date, username) VALUES (\"".$_SERVER['REMOTE_ADDR']."\",\"\",\" ".date("Y/m/d h/i/s")." \" ,\"".$_SESSION["user"]."\")";
$result = $conn->query($sql);
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$num = 0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$split = explode("\n",$row["body"]);
		$length = sizeof($split)+6;
		if($num == 0){
			$num = intval($row["id"]);
		}
		if(intval($row["id"]) > ($num-3)){
echo "<textarea name=\"body\" form=\"create-post\" rows=\"".(2*$length)."\" cols=\"40\" readonly> &#13;&#10;";
echo ("ID: ".str_replace("\n","&#13;&#10;",$row["id"])." &#13;&#10;");
echo ("Title: ".str_replace("\n","&#13;&#10;",$row["title"])." &#13;&#10;");
echo ("Posted by: ".$row["username"]." &#13;&#10;");
echo ("Date posted: ".$row["reg_date"]." &#13;&#10; &#13;&#10;");
echo ("Body: &#13;&#10;".str_replace("\n","&#13;&#10;",$row["body"])." &#13;&#10;");
echo ("</textarea> <br>");
	}
	}
}
?>
</body>
</html>