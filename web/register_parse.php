<?php
	include("connect.php");

	$username = $_POST['username'];
	$password = $_POST['password'];


	$sql = "INSERT INTO forum.users(username, password)
			VALUES ('$username','$password');
			";

	$res = mysqli_query($link,$sql);

	if ($res) {
		echo " Successesfully Registered As : ".$username;
	} 
	else {
		echo "failed to register, please try again. (Plaese make sure that you've filled in all of the blanks in the forum. )<br/>";
		echo "Mysql Error : ".mysql_error();
	}
?>