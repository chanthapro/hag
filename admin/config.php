<?php
$conn = mysqli_connect("localhost","root","","hag");
if(!$conn){
	die("connection failed".mysqli_connect_error());
}else{
	echo "";
}

// function mres($conn,$text){
// 	return mysqli_real_escape_string($conn,$text);
// }
// 
?>