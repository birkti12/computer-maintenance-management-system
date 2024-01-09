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
			<li><a href="forme.php" class="a_parent">
				<div class="wrap">
					<span class="text">QUESTION FOR ME<sup style="color:black;"><b><?php echo $noti ?></b></sup></span>
				</div>
			</a></li>
       
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
    <!-- <h1 style="margin-left: 30%;">MY actiity SO FAR</h1> -->
    <!-- <div class="dropdown1" style="margin-left: 105%;">
                <button class="dropbtn1">
                ACTIVITIES
                </button>
                <div class="dropdown-content1">
                  <button class="btn btn-secondary"><?php echo $un?></button>
                  <br>
                  <a href="index.php"><button class="btn btn-info">HOME PAGE</button></a>
                  <br>
                  <a href="ticket.php"><button class="btn btn-primary">CREATE A NEW TICKET</button></a>
                  <br>
                  <a href="activity.php"><button class="btn btn-info">SEE MY ACCTIVITY</button></a>
                  <br>
                  <a href="forme.php"><button class="btn btn-info">QUESTION FOR ME</button></a>
                  <br>
                  <a href="search.php"><button class="btn btn-primary">SEARCH</button></a>
                  <br>
                  <a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
                </div>
              </div> -->

              <?php
                    $qr = "SELECT * FROM ticket where sender_id=$id order by -id";
                    $result = $con->query($qr);
                    $row = mysqli_num_rows($result);
                    if($row==0){

	                echo "you didn't ask anything until now so you can ask if you want";
                    }
                    else{
                      ?>
                      <br><br>
                      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">SUB SYSTEM</th>
            <th scope="col">TARGET ARE</th>
            <th scope="col">ISSUE</th>
            <th scope="col">DESCRIPTION</th>
            <th scope="col">STATUS</th>
            <th scope="col">ATTACH FILE</th>
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
            
            <?php
     if($status == 0) {
      $detail = "SELECT * FROM `ticket_solution` where `p_id`=$Tid";
      $result2 = $con->query($detail);
      $row2 = mysqli_fetch_object($result2);
        $id2=$row2->id;      
		  ?>
  <td> <a href="detail.php?detail=<?php echo $Tid?>"> <button class="btn btn-success"> solved </button>   </a></td>
            <?php }
            else if($status == -1){ ?>
<td><button type="submit" class="btn btn-success">DELETED</button></td>
<?php
            }
            else{?>
              <td><button type="submit" class="btn btn-danger">PENDING</button></td>
              <?php }
              $order=$order+1; 
              if($status==1){ ?>
              <td><a href="attach.php?attach=<?php echo $Tid?>"> <button class="btn btn-info"> ATTACH RELATED FILE </button>   </a> </td>
          </tr>
<?php
          }}
          
          ?>
         
       
      <?php
                    }
	                    ?>
    
    
      </table>
</body>

</html>