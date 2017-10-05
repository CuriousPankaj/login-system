<?php
session_start();
require_once('../conn/conn.php');

$get_data = "SELECT login.data from login where login.user = ? LIMIT 1";
if ($stmt = $mysqli->prepare($get_data)){
  $stmt->bind_param("s", $_SESSION['userv']);
  if($stmt->execute()){
    $stmt->bind_result($data);
		$stmt->store_result();
    while($stmt->fetch()){
      //echo "true";
      $userdata = $data;
    }
    echo $userdata;
  }
  $stmt->close();
}
$mysqli->close();
?>
