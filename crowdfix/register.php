<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<div id="head">
	<h1 align="center" id="sub1">WELCOME TO CROWD <a id="ad">FIX</a></h1>
</div>
	<style>
	#head{
		color: white;
		text-align: left;
		padding-left: 0;
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
	<form action="register.php" method="POST">

	Username:<input type="text" name="username">
	<br>
	Password:<input type="Password" name="password">
	<br>
	Conform Password:<input type="password" name="repassword">
	<br>
	Email:<input type="text" name="email">
	<br>
	<input type="submit" name="submit" value="Register">

	</form>
	</center>
	<h4 align="center">Already have an acoount?  <a href="login.php">Login</a></h4>

</body>
</html>

<?php
require('connect.php');
	$username = @$_POST['username'];
	$password = @$_POST['password'];
	$repass = @$_POST['repassword'];
	$email = @$_POST['email'];
	$date = date("Y-m-d");
	$pass_en = sha1($password);

	if (isset($_POST['submit'])) 
	{
		if($username && $password && $repass && $email)
		{
			if (strlen($username)>=5 && strlen($username) < 25 && strlen($password) > 6) 
			{
				if ($repass == $password) {

					if ($query = mysqli_query($connect,"INSERT INTO crowdfix.users(id, username, password, email, date) VALUES ('','$username','$pass_en','$email','$date')")) 
					{
					echo "You have been Registered as $username. Click <a href='login.php'>here</a> to login";
					}
					else
					{
					echo "Failure".mysql_error();
					}

				}
				else{
					echo "Passwords do not match.";
				}
			}
			else
				echo "Incorrect Username. ";
			{
				if (strlen($username)<5 || strlen($username) > 25)
				{
					echo "Username must be between 5 and 25 charactors. ";
				}

				if (strlen($password) < 6) 
				{
					echo "Password must be longer than 6 charactors. ";
				}
			}
		}
		else
		{
			echo("please fill all the blanks");
		}
	}
?>