<?php 
include 'connection.php';
if (empty($_POST['regNo'])) {
	echo "<div class='alert alert-info'>Registration number is required</div>";
}else{	
if ($con->query("SELECT username from users where username='".$_POST['regNo']."'")->fetch_object()) {
	echo "<div class='alert alert-danger'>You have already created account </div>";
}else{
	echo "<div class='alert alert-success'>Registration number available</div>";
}
}
?>