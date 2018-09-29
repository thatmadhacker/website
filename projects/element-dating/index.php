<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="index.css" rel="stylesheet" type="text/css">

</head>

<body style="background-image:url(background.png)">

<div id="x">
<form action="changeprofilepic.php" method="post" id="profilepic">
</form>
</div>

<?php

if(isset($_GET["username"])){
	
session_start();

$username = $_GET["username"];
echo "<div class=\"profilepic\" >";
echo "<img src=\"profilepics/".$username.".jpg\" width=\"240\" height=\"240\">"; 
echo "</div>";

}
?>

<?php
if(isset($_GET["username"])){
$user = $_GET["username"];

$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "element-dating";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 

$result = $conn->query("SELECT * FROM `users` WHERE `username` = \"".$user."\"");
$row = $result->fetch_assoc();

echo "<h3>Element: ".$row["element"]."</h3><br>";

$result = $conn->query("SELECT * FROM `details` WHERE `username` = \"".$user."\"");
$row = $result->fetch_assoc();
echo "<div class=\"main\">";
echo "<div class=\"left\">";
echo "<h3>Bio: </h3>";
echo "<textarea readonly rows=\"20\" cols=\"40\">".$row["bio"]." </textarea>";
echo "</div>";
echo "<div class=\"left2\">";
echo "<h3>Details:</h3>";
echo " <textarea readonly rows=\"20\" cols=\"40\">".$row["details"]." </textarea>";
echo "</div> </div>";

}
?>

<?php
if(!isset($_GET["username"])){
session_start();

if(!isset($_SESSION["element"])){
	header("Location: index.html");
}

$username = $_SESSION["element"];
echo "<div class=\"profilepic\" >";
echo "<img src=\"profilepics/".$username.".jpg\" width=\"240\" height=\"240\">"; 
echo "</div>";


echo "<h1> Welcome, ".$username."! </h1> <br>";
}
?>
<?php
if(!isset($_GET["username"])){
echo "<h2>";

echo "My Profile: <br>";

echo "</h2>";
}
?>

<?php
if(!isset($_GET["username"])){
$user = $_SESSION["element"];

$servername = "localhost";
$username = "finlay";
$password = "pass";
$dbname = "element-dating";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error);
} 

$result = $conn->query("SELECT * FROM `users` WHERE `username` = \"".$user."\"");
$row = $result->fetch_assoc();

echo "<h3>Element: ".$row["element"]."</h3><br>";

$result = $conn->query("SELECT * FROM `details` WHERE `username` = \"".$user."\"");
$row = $result->fetch_assoc();
echo "<div class=\"main\">";
echo "<div class=\"left\">";
echo "<h3>Bio: </h3>";
echo "<form action=\"edit-bio.php\" method=\"post\" id=\"editbio\" name=\"editbio\">";
echo "<input type=\"submit\" value=\"Save\" form=editbio>";
echo "<textarea method=\"post\" name=\"bio\" form=\"editbio\" rows=\"20\" cols=\"40\">".$row["bio"]." </textarea>";
echo "</form>";
echo "</div>";
echo "<div class=\"left2\">";
echo "<h3>Details:</h3>";
echo "<form action=\"edit-details.php\" method=\"post\" id=\"editdetails\" name=\"editdetails\">";
echo "<input type=\"submit\" value=\"Save\" form=editdetails>";
echo "<textarea method=\"post\" name=\"details\" form=\"editdetails\" rows=\"20\" cols=\"40\">".$row["details"]." </textarea>";
echo "</form>";
echo "</div> </div>";
}

?>

<form action="logout.php" method="post">
<div class="footer">
<input type="submit" value="Logout" style="float: right;">
<?php
if(!isset($_GET["username"])){
echo "<input type=\"submit\" value=\"Change Profile Picture\" style=\"width:58%\" form=\"profilepic\">";
}
?>
</div>
</form>

<div class="search">
<form action="search.php" method="get">
Username: <input type="text" name="username">
<input type="submit" value="Search">
</form>
</div>

</div>

<p> Created by Finlay Maroney 2018</p>

</body>

</html>