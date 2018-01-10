<!DOCTYPE html>
<html>
<head>
	<title>Login to CROWDFIX</title>
	<div id="head">
	<h1 align="center" id="sub1">WELCOME TO CROWD <a id="ad">FIX</a></h1>
</div>
<style>
	#head{
		color: white;
		text-align: left;
	}
	#ad{
	color: #ffd200;
	}
	body{
		font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
		background-color: #1d2120;
		margin: 0%;
	}
	form{
		padding-top: 3%;
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 3%;

		width: 270px;

		border-style: solid;
	    border-width: 2px;
	    border-radius: 5px;
	    border-color: white;

	    background-color: white;
	    color: #1d2120;
	    height: 100%;

	    text-align: left;

	    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
	}
	input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #ffd200;
    color: #1d2120;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #e6bb00;
}
h4{
	color: white;
}

a{
	text-decoration: none;
	color: #ffd200;
}
</style>
</head>
<body>
<center>
	<form action="login.php" method="POST">
		Username:<input type="text" name="username" placeholder="Username">
		<br>
		Password:<input type="Password" name="password" placeholder="Password">
		<br>
		<input type="submit" name="submit" value="Login">
	</form>
	<h4 align="center">Don't have an acoount?  <a href="register.php">Register</a></h4>
	</center>
</body>
</html>

<?php
session_start();
require('connect.php');
	$username = @$_POST['username'];
	$password = @$_POST['password'];

	if(isset($_POST['submit']))
	{
		if ($username && $password) 
		{
			$check = mysqli_query($connect,"SELECT * FROM users WHERE username='".$username."'");
			$rows = mysqli_num_rows($check);

			if (mysqli_num_rows($check) !=0) 
			{
				while($row = mysqli_fetch_assoc($check))
				{
					$db_username = $row['username'];
					$db_password = $row['password'];
				}
				if ($username == $db_username && sha1($password) == $db_password) 
				{
					@$_SESSION["username"] = $username;
					header("Location: index.php");
				}
				else{
					echo "<script type='text/javascript'>alert('Your password is wrong');</script>";
				}
			}
				else
				{
					die ("<script type='text/javascript'>alert('Username not found');</script>");
				}
		}
		else
		{
			echo "<script type='text/javascript'>alert('Please fill all the blanks');</script>";
		}
	}
?>