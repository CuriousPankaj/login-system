<?php
require_once('../conn/conn.php');

$json = "[{\"name\":\"user\",\"value\":\"test\"},{\"name\":\"pass\",\"value\":\"test\"}]";

$json_obj = json_decode($json, true);

echo $json . '<br />';
$i = 0;
foreach($json_obj as $values){
	//echo $values['name'] . '=' . $values['value'] . '<br />';
	$var[$i] = $values['value'];
	echo $var[$i];
	$i++;
	
}

$insert_query = "select count(user) from login where user = ? and pass = ?";
	//echo $insert_query;
	if($stmt = $mysqli->prepare($insert_query)){
		$stmt->bind_param("ss", $var[0], $var[1]);
		
		if($stmt->execute()){
			$stmt->bind_result($count);
			$stmt->store_result();
			//echo $var[0] . $var[1];
			echo $stmt->num_rows;	
			while($stmt->fetch()) {
				echo $count;
			}
			if($stmt->num_rows > 0){
				echo 'true';
			} else { echo 'false'; }
			
		}
		$stmt->close();
	}
	$mysqli->close();


//echo $json_obj;

?>