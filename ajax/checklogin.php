<?php
session_start();
require_once('../conn/conn.php');

$i = 0;
$decodedJSONObject = json_decode($_POST['mydata'], true);
foreach($decodedJSONObject as $values){
	$var[$i] = $values['value'];
	$i++;
}

$insert_query = "select user from login where user = ? and pass = ?";
if($stmt = $mysqli->prepare($insert_query)){
	$stmt->bind_param("ss", $var[0], $var[1]);

	if($stmt->execute()){
		$stmt->bind_result($count);
		$stmt->store_result();
		if($stmt->num_rows > 0){
			$_SESSION['userv'] = $var[0];
			echo 'true';
		} else { echo 'false'; }
	}
	$stmt->close();
}
$mysqli->close();

?>
