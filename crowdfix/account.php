<?php
	session_start();
	require('connect.php');
	if (@$_SESSION["username"]) {
?>

<!DOCTYPE html>
<html>

<head>
	<title>CROWD FIX</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<div id="head">
	<h1 id="sub1">CROWD <a id="ad">FIX</a></h1>
	</div>

	<ul>
	<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
	<li><a class="active" href="account.php"><i class="fa fa-address-card"></i> My Account</a></li>
	<li><a href="members.php"><i class="fa fa-users"></i> Members</a></li>
	<li style="float: right;"><a href="index.php?action=logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
	<li style="float: right;">
		<?php 
		$check = mysqli_query($connect,"SELECT * FROM users WHERE username='".$_SESSION['username']."'");
		$row = mysqli_num_rows($check);
		while ($row = mysqli_fetch_assoc($check)) {
			$id = $row['id'];
		}
		echo "<a href='profile.php?id=$id'><i class='fa fa-user'></i> "; echo @$_SESSION['username']; 
		?></a></li>
</ul>
<style>

	form{
		padding-top: 3%;
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 3%;

		width: 25%;

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
a{
	text-decoration:none;
	color: white;
}
	#popup{
		position: absolute;
		top: 0;
		z-index: 1;
		padding-top: 3%;
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 3%;

		top: 25%;
		left: 30%;

		width: 30%;

		border-style: solid;
		border-color: #ffd200;
	    border-width: 2px;
	    border-radius: 5px;

	    background-color: white;
	    color: #1d2120;
	    height: 20%;

	    text-align: left;

	    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
	}
	#pwpopup{
		position: absolute;
		top: 0;
		z-index: 1;
		padding-top: 3%;
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 3%;

		top: 25%;
		left: 30%;

		width: 30%;

		border-style: solid;
		border-color: #ffd200;
	    border-width: 2px;
	    border-radius: 5px;

	    background-color: white;
	    color: #1d2120;
	    height: 40%;

	    text-align: left;

	    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
	}
	button {
	
    background-color: #e6bb00;
    border: none;
    border-radius: 5px;
    padding: 1%;
    text-align: center;
    font-size: 16px;
    margin: 1%;
    width: 100%;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    cursor: pointer;
}
button:hover {
		    background-color: green;
		    color: white;
			}
</style>
</head>
<body>
	<br>
	<center>
	<form style="text-align: center;">
	<?php

		$check = mysqli_query($connect,"SELECT * FROM users WHERE username='".$_SESSION['username']."'");
		$row = mysqli_num_rows($check);
		while ($row = mysqli_fetch_assoc($check)) {
			$username = $row['username'];
			$email = $row['email'];
			$date = $row['date'];
			$replies = $row['replies'];
			$score = $row['score'];
			$topics = $row['topics'];
			$propic = $row['propic'];
		}

	?>
	<?php echo "<img src='$propic' width='200'>"; ?><br/><br>
	<button><a href="account.php?action=ci">Change Profile Picture</a></button><br/><br>
	Username: <?php echo $username; ?> <br>
	Email: <?php echo $email; ?> <br>
	Date Registered: <?php echo $date; ?> <br>
	Replies: <?php echo $replies; ?> <br>
	Score(src): <?php echo $score; ?> <br>
	Topics: <?php echo $topics; ?> <br><br>
	<button><a href="account.php?action=cp">Change Password</a></button>
</form>
</center>
</body>
</html>

<?php
if(@$_GET['action'] == "logout")
{
	session_destroy();
	header("Location: login.php");
}

if (@$_GET['action'] == "ci") {
	echo '<center><form id="popup" action="account.php?action=ci" method="POST" enctype="multipart/form-data">
	<br/>
	Available file extension: <b>.PNG .JPG .JPEG</b><br/><br/>
	<input type="file" name="image"><br/>
	<input type="submit" name="change_pic" value="Change">

	';
	if (isset($_POST['change_pic'])) {
		$errors = array();
		$allowed_e = array('png','jpg','jpeg');

		$file_name = $_FILES['image']['name'];
		$file_e = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		$file_s = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];

		if(in_array($file_e,$allowed_e)===false){
			$errors[] = 'This file extension is not allowed.';
		}
		if($file_e > 2097152){
			$errors[]='Files must be under 2MB';
		}
		if(empty($errors)){
			move_uploaded_file($file_tmp, 'images/'.$file_name);
			$image_up = 'images/'.$file_name;

			if ($quary = mysqli_query($connect,"UPDATE users SET propic='".$image_up."' WHERE username='".$_SESSION['username']."'")) {
				echo "<script type='text/javascript'>alert('Your Profile Picture Successfully Changed.');</script>";
			}
		}
		else{
			foreach ($errors as $error) {
				echo $error,'<br/>';
			}
		}
	}
	echo '</form>';
}

if (@$_GET['action'] == "cp") {
	echo "<form id='pwpopup' action='account.php?action=cp' method='POST'>";
	echo"
	Current Password: <input type='text' name='curr_pass'><br/>
	New Password: <input type='Password' name='new_pass'><br/>
	Re-type Password: <input type='text' name='re_pass'><br/>
	<input type='submit' name='change-pass' value='change'>
	";

	$curr_pass = @$_POST['curr_pass'];
	$new_pass = @$_POST['new_pass'];
	$re_pass = @$_POST['re_pass'];

	if (isset($_POST['change-pass'])) {
		$check = mysqli_query($connect,"SELECT * FROM users WHERE username='".$_SESSION['username']."'");
		$row = mysqli_num_rows($check);
		while ($row = mysqli_fetch_assoc($check)) {
			$get_pass = $row['password'];
		}
		if (sha1($curr_pass) == $get_pass) {
			if (strlen($new_pass)>6) {
				
			if($re_pass == $new_pass){
				if ($quary = mysqli_query($connect,"UPDATE users SET password='".sha1($new_pass)."' WHERE username='".$_SESSION['username']."'"))
				{
					echo "Password Changed.";
				}
			}
			else
			{
				echo "New password do not match.";
			}
		}else{
			echo "New password must be longer than 6 charactors.";
		}
		}
		else
		{
			echo "Your current password do not match with your real password";
		}
	}
	echo "</form>";
}
}
	else
	{
		echo "You must be Logged in.";
	}
?>