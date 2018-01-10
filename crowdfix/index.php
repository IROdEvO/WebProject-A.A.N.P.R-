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

<style>
table {
    border: none;
    border-collapse: collapse;
    border-color: #e6bb00;
   	margin-left: 5%;
   	margin-right: 5%;
   	box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
}

td {
    text-align: left;
    padding: 8px;
    color: white;

}

tr {
    background-color: white;
    color: white;
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
a{
	text-decoration:none;
	color: black;
}
a:hover{
	text-decoration:none;
	color: green;
	font-weight: bold;
}
h2{
	color: white;
}
#Problem{
	color: #e6bb00;
}
</style>

</head>
<div id="head">
	<h1 id="sub1">CROWD <a id="ad">FIX</a></h1>
</div>
<ul>
	<li><a class="active" href="index.php"><i class="fa fa-home"></i> Home</a></li>
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
<body>
	<h1 align="center">Have a <a id="Problem">Problem</a>? Post it here</h1>
<center>
<a href="post.php"><button>Post a Topic</button></a>
</center>

<h2 align="center" >Frequently Added Topics</h2>

<?php echo '<table border="1px;">'; ?>
	<tr style="background-color:#e6bb00; font-weight: bold; ">
		<td width = 800px; style="text-align: center;">Topic</td>
		<td width = 400px; style="text-align: center;">Creator</td>
		<td width = 400px; style="text-align: center;">Date</td>
	</tr>

</body>
</html>

<?php
$check = mysqli_query($connect,"SELECT * FROM topics ");

	if (!@$_GET['date']) {
	
	if (mysqli_num_rows($check) !=0) {
		while ($row = mysqli_fetch_assoc($check)) {
			@$id = $row['topic_id'];
			echo "<tr>";
			echo "<td style='text-align:center;'><a href='topic.php?id=$id'>".$row['topic_name']."</td>";

			$check_u = mysqli_query($connect,"SELECT * FROM users WHERE username='".$row['topic_creator']."'");
			while ($row_u = mysqli_fetch_assoc($check_u)) {
				$user_id = $row_u['id'];
			}
			echo "<td style='text-align:center;'>"."<a href='profile.php?id=$user_id'>".$row['topic_creator']."</a>"."</td>";

			$get_date = $row['date'];
			echo "<td style='text-align:center;'><a href='index.php?date=$get_date'>".$row['date']."</a></td>";
			echo "</tr>";
		}
	}
	else{
		echo "No Topics Found";
	}
}


if (@$_GET['date']) {
	$check_d = mysqli_query($connect,"SELECT * FROM topics WHERE date='".$_GET['date']."'");

	while ($row_d = mysqli_fetch_assoc($check_d)) {
		@$id = $row_d['topic_id'];
			echo "<tr>";
			echo "<td style='text-align:center;'><a href='topic.php?id=$id'>".$row_d['topic_name']."</td>";

			$check_u = mysqli_query($connect,"SELECT * FROM users  WHERE username='".$row_d['topic_creator']."' ");
			while ($row_u = mysqli_fetch_assoc($check_u)) {
				$user_id = $row_u['id'];
			}
			echo "<td>"."<a href='profile.php?id=$user_id'>".$row_d['topic_creator']."</a>"."</td>";

			$get_date = $row_d['date'];
			echo "<td><a href='index.php?date=$get_date'>".$row_d['date']."</a></td>";
			echo "</tr>";
	}
}
echo "</table>";
if(@$_GET['action'] == "logout")
{
	session_destroy();
	header("Location: login.php");
}
	}
	else
	{
		echo "You must be Logged in.";
	}
?>