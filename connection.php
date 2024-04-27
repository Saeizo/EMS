<?php 
$con=mysqli_connect("localhost","root","","attendance");
if (!$con) {
	echo "<script>alert('Connection failed')</script>";
}
?>