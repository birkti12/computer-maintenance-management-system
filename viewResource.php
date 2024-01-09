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
<html>
    <head>
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/text" href="logo.jpeg">
        <link rel="stylesheet" href="styles2.css">
    </head>
    <body>
      <br>
    <div class="wrapper" style="width:100%">
	<div class="navbar">
		<ul>
			<li><a href="index.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">GOTO HOME</span>
				</div>
			</a></li>
            <li><a href="ticket.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">CREAT TICKET</span>
				</div>
			</a></li>
			
			
			<li><a href="search.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">SEARCH TICKET</span>
				</div>
			</a></li>
			<li><a href="forme.php" class="a_parent">
				<div class="wrap">
					<span class="text">QUESTION FOR ME<sup style="color:black;"><b><?php echo $noti ?></b></sup></span>
				</div>
			</a></li>
       
      <li><a href="activity.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">MY ACTIVITY</span>
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
    <?php $sql2="SELECT * FROM `resource`";
$result2 = $con->query($sql2);
$total=mysqli_num_rows($result2);
if($total==0){
    ?>
    <br><br><br><br><br>
    <h2 style="color:red;margin-left:30%;">FOR NOW THER IS NO RESOURCE ATTACHED</h2>
    <br>
 <?php }
else{
?>


        <br>
      <table class="table table-striped" style="width: 50%;margin-left:25%;">
        <thead class="thead-dark">
            <tr>
                <th scope="col"colspan="4" >
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                RESOURCES that you may want to see</th>
              </tr>
              <tr class="thead-light">
                <td>#</td>
                <td>ABOUT</td>
<td colspan="2">FILE</td>
</tr>
            </thead>
            <?php $order=1;
    while($row = mysqli_fetch_array($result2)){   
    $id=$row['id'];
    $resource=$row['resource'];
    $ab=$row['about'];
    $pdf="<embed src='resource/".$row['resource']."' type='application/pdf' width='100%' height='10%' />";
?>
<tr>
<td><?php echo $order ?></td>
<td><?php echo $ab ?></td>
<td colspan="2"><?php echo $pdf ?></td>
    </tr>

   <?php $order++;
 }
    ?>
      </table>
      <br> <?php
    } ?>
      <a href="index.php"><button class="btn btn-primary" style="margin-left:45%;">GO BACK TO HOME PAGE</button></a>
    </body>
</html>
