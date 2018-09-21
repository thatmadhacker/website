<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/style.css" rel="stylesheet" type="text/css">

</head>

<body>
<h1> News </h1>
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
$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$split = explode("\n",$row["body"]);
		$length = sizeof($split)+6;
echo "<textarea name=\"body\" form=\"create-post\" rows=\"".(2*$length)."\" cols=\"40\" readonly> &#13;&#10;";
echo ("Title: ".str_replace("\n","&#13;&#10;",$row["title"])." &#13;&#10;");
echo ("Posted by: ".$row["username"]." &#13;&#10;");
echo ("Date posted: ".$row["reg_date"]." &#13;&#10; &#13;&#10;");
echo ("Body: &#13;&#10;".str_replace("\n","&#13;&#10;",$row["body"])." &#13;&#10;");
echo ("</textarea> <br>");
	}
}
?>

</body>

</html>