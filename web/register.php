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
	<li style="float: right;"><a class="active" href="register.php"><i class="fa fa-plus"></i> Sign Up</a></li>
	<li style="float: right;"><a href="index.php"><i class="fa fa-sign-in"></i> Login</a></li>
</ul>

<div>
	<h1 align="center">Sign Up to CROWD <a id="ad">FIX</a></h1>
</div>

	<form action='register_parse.php' method='post'>
		Enter a Username <input type="text" name="username" placeholder="Enter a Username">
		<br>
		Enter a Password <input type="Password" name="password" placeholder="Enter a Password">
		<br>
		<input type="submit" name="login" value="Sign Up">
	</form>

	<h4 align="center">Already have an account? <a href="index.php">Log In</a></h4>

</body>
</html>