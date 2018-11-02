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
    die("Connection failed: " . mysqli_connect_error);
} 
function checkEmail($email) {
   if ( strpos($email, '@') !== false ) {
      $split = explode('@', $email);
      return (strpos($split['1'], '.') !== false ? true : false);
   }
   else {
      return false;
   }
}
if(!checkEmail(htmlspecialchars($_POST["email"],ENT_QUOTES))){
	die("Invalid email!");
}
$result = mysqli_query($conn,"SELECT `email` FROM `users` WHERE `email` = '".htmlspecialchars($_POST["email"],ENT_QUOTES)."'");
if (!mysqli_num_rows($result)){
$result = mysqli_query($conn,"SELECT `username` FROM `users` WHERE `username` = '".htmlspecialchars($_POST["username"],ENT_QUOTES)."'");
if (!mysqli_num_rows($result)){
$msg = "http://thatmadhacker.org/forums/verify.php?username=".htmlspecialchars($_POST["username"],ENT_QUOTES)."&email=".htmlspecialchars($_POST["email"],ENT_QUOTES)."&password=".password_hash(htmlspecialchars($_POST["password"],ENT_QUOTES)
, PASSWORD_DEFAULT);
$msg = wordwrap($msg,70);
shell_exec("java -jar mailer.jar \"".htmlspecialchars($_POST["email"],ENT_QUOTES)."\" \"Verify your email for thatmadhacker.org\" \"".$msg."\"");
echo "Check your email to verify your account!";
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