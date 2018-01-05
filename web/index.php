<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div id="head">
	<h1 id="sub1">CROWD <a id="ad">FIX</a></h1>
</div>

<ul>
	<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
	<li><a href="#"><i class="fa fa-address-card"></i> About</a></li>
	<li><a href="#"><i class="fa fa-phone"></i> Contact</a></li>
	<li style="float: right;"><a href="register.php"><i class="fa fa-plus"></i> Sign Up</a></li>
	<li style="float: right;"><a class="active" href="index.php"><i class="fa fa-sign-in"></i> Login</a></li>
</ul>

<div>
	<h1 align="center">Login to CROWD <a id="ad">FIX</a></h1>
</div>

	<form action='login.php' method='post'>
		Username <input type="text" name="username" placeholder="Username">
		<br>
		Password <input type="Password" name="password" placeholder="Password">
		<br>
		<input type="submit" name="login" value="Log In">
	</form>

	<h4 align="center">Don't have an account? <a href="register.php">Sign Up</a></h4>

</body>
</html>