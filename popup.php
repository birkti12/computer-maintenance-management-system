<?php
session_start();
include 'connection.php';
$username  = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $con->query($sql);
while($row = mysqli_fetch_array($result)){
    $un=$row['username'];
    $id=$row['id'];
    $role=$row['type'];	
}
if(!isset($_SESSION['username']) || ($role != 'user')){
	header("Location:login.php");
}
?>

<?php $id = $_GET['popup']; 
?>
<!DOCTYPE html>
<html>
<head>

    
<link href="bootstrap.min.css" rel="stylesheet">
<link href="popup.css" rel="stylesheet">
    
</head>
<body>
<div class="alert alert-success center" role="alert" style="width:50%;margin-left:25%;margin-top:10%;">
  <h4 class="alert-heading">Well done TICKET IS CREATED SUCCESSFULLY</h4><br>
  <h3>YOUR TICKET ID IS </h3> <br>
  <H1 style="margin-left:30%;"><?php echo $id ?></H1>
  <hr>
  <br><br><br>
  <a href="index.php"><button class="btn btn-success" style="margin-left:30%;">OK</button></a>
</div>
</body>
</html>