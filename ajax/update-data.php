<?php
session_start();
require_once('../conn/conn.php');

$userdata = $_POST['update'];

$update_data = "UPDATE login set data = ? where login.user = ?";
if ($stmt = $mysqli->prepare($update_data)){
  $stmt->bind_param("ss", $userdata, $_SESSION['userv']);
  if($stmt->execute()){
    echo "true";
  } else { echo "false"; }
  $stmt->close();
}
$mysqli->close();

?>
