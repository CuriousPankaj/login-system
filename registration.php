<!doctype html>
<?php
session_start();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
</head>
<body>

<form action="registration.php" method="POST">
User Name :
<input type="text" name="user" /> <br />
Password :
<input type="password" name="pass" /> <br />

<input type="submit">
<a href="login.php">Go to Login</a>
</form>

<?php

if((!empty($_POST["user"])) && (!empty($_POST["pass"]))){
	require_once('conn/conn.php');
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$insert_query = "insert into login (user, pass) values (?, ?)";
	//echo $insert_query;
	if($stmt = $mysqli->prepare($insert_query)){
		$stmt->bind_param("ss", $user, $pass);

		if($stmt->execute()){
			echo "user created successfully!!";
		} else { echo "user NOT created!!"; }
		$stmt->close();
	}
	$mysqli->close();
}

?>


</body>
</html>