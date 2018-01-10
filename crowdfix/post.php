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
	<head>
	<title>CROWD FIX</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>CROWD FIX</title> 
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div id="head">
	<h1 id="sub1">CROWD <a id="ad">FIX</a></h1>
	</div>

	<ul>
	<li><a class='active' href="index.php"><i class="fa fa-home"></i> Home</a></li>
	<li><a href="account.php"><i class="fa fa-address-card"></i> My Account</a></li>
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

		margin-left: 20%;

		width: 50%;

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

</style>
</head>
<body>
	<br>
<div>
<form action="post.php" method="POST">
	Topic Name : <input type="text" name="topic_name" style="width: 100%;"><br/>
	Content :<br/>
	<textarea name="con" style="resize: none; width: 100%; height: 250px;"></textarea>
	<br/>
	<input type="submit" name="submit" value="Post">
</form>
</div>
</body>
</html>

<?php
	$t_name = @$_POST['topic_name'];
	$content = @$_POST['con'];
	$date = date("Y-m-d");


	if (isset($_POST['submit'])) {
		if ($t_name && $content) {
			if (strlen($t_name) >= 10 && strlen($t_name) <= 100) 
			{
				if ($query = mysqli_query($connect,"INSERT INTO crowdfix.topics(topic_id, topic_name, topic_content, topic_creator, date) VALUES ('', '$t_name', '$content', '".$_SESSION["username"]."','$date')")) 
				{
					echo "Success";
				}
				else{
					echo "Fail";
				}
			}
			else{
				echo "<script type='text/javascript'>alert('Topic name must be between 10 and 100 charactors long.');</script>";
			}
		}
		else{
			echo "<script type='text/javascript'>alert('Please fill all the fields.');</script>";
		}
	}
	}
	else
	{
		echo "You must be Logged in.";
	}
?>