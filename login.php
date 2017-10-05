<!doctype html>
<?php
session_start();
if(!empty($_SESSION['userv'])){
	header('Location: index.php');
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div>
		<div class="col-md-12">
			<center><h2>Login System</h2></center>
		</div>
		<div class="col-md-12">
			<center>
				<form id="login">
					<div class="form-group">
					  <label for="user">User Name :</label>
					  <input type="text" id="user" name="user" />
					</div>
					<div class="form-group">
					  <label for="pass">Password :</label>
					  <input type="password" id="pass" name="pass"/>
					</div>
					<div class="btn-group">
						<a class="btn btn-success" id="sub" href="Javascript:void(0)">Login</a>
						<a class="btn btn-primary" href="registration.php">Go to Registration</a>
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
$(document).ready(function () {
	$('#sub').click(function (){
		$.ajax({
			dataType : "text",
			processData : false,
			method : 'post',
			data : "mydata=" + JSON.stringify($('#login').serializeArray()),
			url : "ajax/checklogin.php",
			beforeSend : function () {
				$("#response").html("<p class='text-center'><img style='width: 100px;' src='images/ajax-loading-2.gif'></p>");
			},
			success : function(data){
				if(data === "true"){
					location.reload();
					//$("#response").html("<p class='alert-success'>User Found</p>");
				} else if(data === "false"){
					$("#response").html("<p class='alert-danger'>User Not Found</p>");
				}
			},
			error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
			}
			});
	});
});
</script>
</body>
</html>
