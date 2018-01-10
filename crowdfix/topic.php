<?php
	session_start();
	require('connect.php');
	if (@$_SESSION["username"]) {
?>

<?php
if ($_POST) 
{
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$handle = fopen("comments.php", "a");
	fwrite($handle, "<b><i>". $name . "</b></i> said: <br/>" . $comment . "<br/><br/>");
	fclose($handle);
}
?>

<!DOCTYPE html>
<html>

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

	#comment{
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 3%;
		margin-top: 0%;

		width: 50%;

		border-style: solid;
	    border-width: 2px;
	    border-color: white;

	    background-color: white;
	    color: #1d2120;
	    height: 100%;
	    text-align: left;
	}

	#topic{
		padding-top: 3%;
		padding-left: 5%;
		padding-right: 5%;
		

		width: 50%;

		border-style: solid;
	    border-width: 2px;
	    border-top-left-radius: 5px;
		border-top-right-radius: 5px;
	    border-color: white;

	    background-color: white;
	    color: #1d2120;
	    height: 100%;

	    text-align: left;

	    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
	}
		button {
			font-weight: bold;
		    background-color: #e6bb00;
		    border: none;
		    color: white;
		    border-radius: 5px;
		    padding: 16px 32px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 16px;
		    margin: 4px 2px;
		    -webkit-transition-duration: 0.4s;
		    transition-duration: 0.4s;
		    cursor: pointer;
		    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
		}

		button:hover {
		    background-color: green;
		    color: white;
			}
		h4{
			color: black;
		}
	</style>
</head>
<body>
<center>
	<br>
<a href="post.php"><button>Post a Topic</button></a>
</center>
<br>
<center>
	<form id="topic">

<?php
if (isset($_GET['id'])) 
{
	
	if ($_GET["id"]) 
	{
		$check = mysqli_query($connect,"SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");

		if (mysqli_num_rows($check)) 
		{
			while ($row = mysqli_fetch_assoc($check)) 
			{
				echo "<h1 style='color:black;'>".$row['topic_name']."</h1>";
				echo "<hr>";
				echo "<h2 style='color:black;'>".$row['topic_content']."</h2>";
				
				echo "<h4>by <a href='profile.php?id=$id'>".$row['topic_creator']."</a> on ".$row['date']."</h4>";

				echo "<hr>";

				//echo "<h3> on ".$row['date']."</h3>";

				//".$row['username']."</a>
			}
		}
			else
			{
				echo "topic not found";
			}
	}
	
}
?>
<h4>Leave a Comment</h4>
</form>
</center>

<center>
<form id="comment" action="" method="POST">
<input style="width: 50%;" type='text' name='name' placeholder="Input Your name">
<br>
<textarea placeholder="Enter your comment here" name="comment" style="resize: none; width: 100%; height: 50px;"></textarea>
<input type='submit' value="Post comment">
<h4>Other Comments :</h4>
<?php
include "comments.php";
?>
</form>



</center>

</body>
</html>

<?php

	}
	else
	{
		echo "You must be Logged in.";
	}
?>

