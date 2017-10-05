<?php
$user = "root";
$pass = "";
$database = "test";
$server_name = "localhost";

$mysqli = new mysqli($server_name, $user, $pass, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



?>