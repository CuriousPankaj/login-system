<!doctype html>
<?php
session_start();
require_once('conn/conn.php');
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login System</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/jquery.min.js"></script>
	<script src="/ckeditor/ckeditor.js"></script>
	<script src="/ckeditor/adapters/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
$select_query = "select login.data from login where user = ?";
if($stmt = $mysqli->prepare($select_query)){
	$stmt->bind_param("s", $_SESSION['userv']);

	if($stmt->execute()){
		$stmt->bind_result($data);
		$stmt->store_result();
		while($stmt->fetch()){
			$userdata = $data;
		}
	}
	$stmt->close();
}
$mysqli->close();
?>

<div class="container-fluid">
	<div>
		<div class="col-md-12">
			<center><h2>Login System</h2></center>
		</div>
		<div class="col-md-12">
			<center>
				<form>
					<div class="form-group">
					  <label>
							<?php  if (!empty($_SESSION['userv'])){
									echo "Welcome <strong>" . $_SESSION['userv'] . "</strong><br />";
								} else {
									header('Location: login.php');
								}
							?>
						</label>
					</div>
					<div class="form-group">
					  <textarea name="userdata" id="userdata" rows="20" cols="30"></textarea><br />
					</div>
					<div class="btn-group">
						<a class="btn btn-success" id="update-data" href="Javascript:void(0)">Update</a>
						<a class="btn btn-danger" href="logout.php">Logout</a>
					</div>

				</form>
			</center>
		</div>
		<div class="col-md-12">
			<center><div id="response"></div></center>
		</div>
	</div>
</div>

<script>

$('document').ready(function () {
	var data;
	$.ajax({
		dataType: "text",
		processData: false,
		method: "POST",
		data: "getDataAjax=" + true,
		url: "ajax/get-data.php",
		success: function(returnedData) {
			$('#userdata').text(returnedData);
		}
	});


	CKEDITOR.editorConfig = function (config) {
    config.language = 'en';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;
	};
	CKEDITOR.replace('userdata');



	$('#update-data').click(function () {
		var data = CKEDITOR.instances.userdata.getData();
		$.ajax({
			dataType: "text",
			processData: false,
			method: "POST",
			data: "update=" + data,
			url: "ajax/update-data.php",
			beforeSend: function(){
				$('#response').html("<p class='text-center'><img style='width: 100px;' src='images/ajax-loading-2.gif'></p>");
			},
			success: function(data) {
				if(data === "true") {
					$('#response').html("<p class='text-center alert-success'>Data updated in database.</p>");
				} else if (data === "false"){
					$('#response').html("<p class='text-center alert-danger'>Data NOT updated in the database. There was a problem.</p>");
				} else {
					$('#response').html(data);
				}
			}
		});
	});
});


</script>



</body>
</html>
