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
<title>
</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="actiity.css" rel="stylesheet">
<link href="drop1.css" rel="stylesheet">
<link rel="icon" type="image/text" href="logo.jpeg">
<link rel="stylesheet" href="styles2.css">
</head>
<body class="container m">
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
			<li><a href="activity.php" class="a_parent">
				<div class="wrap">
					
					<span class="text">MY ACTIVITY</span>
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
    
   

              <?php
                    $qr = "SELECT * FROM ticket where `solver`='$email' and `status`='1'";
                    $result = $con->query($qr);
                    $row = mysqli_num_rows($result);
                    if($row==0){
?>
	                <H3 style="color:red;margin-left:30%;">for now there is no question related with you</H3>
                  <?php
                    }
                    else{
                      ?>
                      <br> <br>
                      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">SUB SYSTEM</th>
            <th scope="col">TARGET ARE</th>
            <th scope="col">ISSUE</th>
            <th scope="col">DESCRIPTION</th>
            <th scope="col">ACTION</th>
           
          </tr>
        </thead>
       
          <?php $order = 1;
          while($row = mysqli_fetch_object($result)){
            $Tid=$row->id;
            $sub_system=$row->sub_system;
            $target_area = $row->target_area;
            $description = $row->detail;
            $issue = $row->issue;
            $sender_id = $row->sender_id;
            $status=$row->status;
?>
<tr>
            <th><?php echo $order ?></th>
            <td><?php echo  $sub_system ?></td>
            <td><?php echo $target_area ?></td>
            <td><?php echo $issue ?></td>
            <td><?php echo $description ?></td>
            <td> <a href="answer.php?answer=<?php echo $Tid?>"> <button class="btn btn-success"> START ANSWERING </button>   </a></td>
  </tr>
<?php
          $order=$order+1;
          
          ?>
         
       
      <?php
                    }
                }
	                    ?>
    
    
      </table>
</body>

</html>