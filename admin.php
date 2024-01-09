<?php
session_start();
include 'connection.php';
$username  = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username' and `type`='admin'";
$result = $con->query($sql);
while($row = mysqli_fetch_array($result)){
    $un=$row['username'];
    $id=$row['id'];
    $role=$row['type'];
}
if(!isset($_SESSION['username']) || ($role != 'admin')){
	header("Location:login.php");
}
?>


<?php
 if(isset($_GET['deactivate'])){
    $id = $_GET['deactivate'];
    $sql = "UPDATE user SET status = 0 WHERE id = $id";
    $con->query($sql);
    echo "<meta http-equiv=\"refresh\" content=\"0, admin.php\"";
    }
    
    
    
    if(isset($_GET['activate'])){
    $id = $_GET['activate'];
    $sql = "UPDATE user SET status = 1 WHERE id = $id";
    $con->query($sql);
    echo "<meta http-equiv=\"refresh\" content=\"0, admin.php\"";
    }
?>


<?php  
$approve="SELECT * FROM `user_approve`";
$result_approve = $con->query($approve);
$total=mysqli_num_rows($result_approve);
?>


<?php  
$newq="SELECT * FROM `ticket` WHERE `status`='1'";
$result_question = $con->query($newq);
$total2=mysqli_num_rows($result_question);
?>






<html>
    <head>
        <meta charset="UTF-8">
        <META http-equiv="X-UA-COMPAtible" content="IE=EDGE">
            <MEta name="viewport" content="width=device-width, initial-scale=1.o">
        <title>
            
        </title>
        <link rel="stylesheet" type="text/css" href="admin1.css">
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <link rel="stylesheet" type="text/css" href="drop.css">
        <link rel="icon" type="image/text" href="logo.jpeg">
       
        
    </head>
    <body >

        <nav >
            <div class="nav-left container">
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN PAGE</h1>
               
                
            </div>
           
               
        </nav>
        <div class="container1 ">
            <!-- left side bar -->
           <div class="left-sidebar ">
              <div class="imp-links ">
              <br><br><br><br><br><br>
                <a href="admin.php"><img src="user.png">manage user</a>
                <a href="aprove.php"><img src="approve.jpg">Approve user<sup style="color:red;"><b><?php echo $total ?></b></sup></a>
                 
                  <a href="problemRequest.php"><img src="event.png">NEW QUESTION<sup style="color:red;"><b><?php echo $total2 ?></b></sup></a>
                  <a href="subSystem.php"><img src="event.png">MANAGE SUB SYSTEM</a>
                  <a href="component.php"><img src="event.png">MANAGE COMPONENT</a>
                  <a href="uploadResource.php"><img src="event.png">upload Resource</a>
                  <a href="report.php"><img src="event.png">VIEW REPORT</a>
                  
                 
              </div>
           </div>
            <!-- main content -->
           <div class="main-content ">
           
<br>
           <table class="table table-striped" style="width:90%;margin-left:10%;">
        <thead>
          <tr>
            <th >#</th>
            <th >user name</th>
            <th >status</th>
            <th >manage user</th>
            
          </tr>
        </thead>
   <?php
$qr = "SELECT * FROM user where `type`='user'";
$result = $con->query($qr);
$order = 1;
while($row = mysqli_fetch_object($result)){
    $un=$row->username;
    $status=$row->status;
    $id=$row->id;
    if($status==1){
        $stat =  "<b style=\"color:green\"> Active </b>";
    }
    else{
        $stat =  "<b style=\"color:brown\"> Deactivated </b>";
    }
    ?>
     <tr>
            <td ><?php echo $order  ?></td>
            <td ><?php echo $un ?></td>
            <td ><?php echo $stat ?></td>
            <?php
     if($status == 0) {
		  ?>
		 <td> <a href="admin.php?activate=<?php echo $id; ?>"> <button class="btn btn-success">  Activate  </button>   </a> </td>
       <?php
		 } else {
              ?>
              
		 <td> <a href="admin.php?deactivate=<?php echo $id; ?>"> <button class="btn btn-dark">  Deactivate  </button>   </a> </td>
	 <?php }
			  ?>
            
          </tr>
    <?php
    $order++;
}

?>

    
    
      </table>


                     
                         </div>  
                 
                          
               
           
            <!-- right side bar -->
           <div class="right-sidebar ">
            <br><br>
            <div class="dropdown1">
                <button class="dropbtn1">
                  ACTIVITIES
                </button>
                <div class="dropdown-content1">
                    <button class="btn btn-secondary"><?php echo $username?></button>
                  <br>
                  
                  <a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
                </div>
              </div>
           </div>
       </div>

    </body>






    </html>