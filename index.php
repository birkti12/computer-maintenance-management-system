<?php
session_start();
include 'connection.php';
$username  = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username' and `type`='user'";
$result = $con->query($sql);
while($row = mysqli_fetch_array($result)){
    $un=$row['username'];
    $id=$row['id'];
    $role=$row['type'];
	$email=$row['email'];
}
if(!isset($_SESSION['username']) || ($role != 'user')){
	header("Location:login.php");
}
?>
<?php $qr = "SELECT * FROM ticket where `solver`='$email' and `status`='1'";
$noti="";
                    $result = $con->query($qr);
                    $row = mysqli_num_rows($result);
					if($row==0){
						
					}
					else{
						$noti=$row;
					}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="styles2.css">
	
	<link rel="icon" type="image/text" href="logo.jpeg">
</head>
<body>
	<br>
<div class="wrapper">
	<div class="navbar">
		<ul>
			<li><a href="ticket.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">CREATE TICKET</span>
				</div>
			</a></li>
            <li><a href="search.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">SEARCH TICKET</span>
				</div>
			</a></li>
			
			
			<li><a href="activity.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">MY ACTIVITY</span>
				</div>
			</a></li>
			<li><a href="forme.php" class="a_parent">
				<div class="wrap">
					<span class="text">QUESTION FOR ME<sup style="color:red;"><b><?php echo $noti ?></b></sup></span>
				</div>
			</a></li>
        </li>
        <li><a href="viewResource.php" class="a_parent">
            <div class="wrap">
                <span class="text">RESOURCES</span>
            </div>
        </a></li>
		<li><a href="logout.php" class="a_parent">
            <div class="wrap">
                <span class="text">LOGOUT</span>
            </div>
        </a></li>
			</ul>
	</div>
</div>
<h1 style="margin-left:35%;margin-top:3%;color:gray;">ESSTI TICKETING SYSTEM</h1>
<div class="alert alert-success" role="alert" style="width: 50%;margin-left:25%;margin-top:4%;">
<h4 class="alert-heading">Well COME TO ESSTI TICKETING SYSTEM!</h4>
	<br>
    <h3 class="alert-heading">DEAR <?php echo $un ?></h3>
	<br>
    <br><br>
	<h4>IN THIS SYSTEM YOU CAN SEARCH PREVIOUSLY SOLVED QUESTIONS AND YOU CAN ALSO CREAT YOUR OWN TICKET</h4>
	<hr>
    <br><br>
    <h4>YOU CAN ALSO SEE RESOURCES THAT MAY HELP YOU </h4>
	
	<br><br><br><br><br><br><br><br>
  </div>

</body>
</html>