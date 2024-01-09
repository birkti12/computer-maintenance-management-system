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



<!DOCTYPE html>
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
        <link rel="stylesheet" type="text/css" href="approve.css">
        <link rel="icon" type="image/text" href="logo.jpeg">
    </head>
    <body >

        <nav >
            <div class="nav-left container">
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN VIEW REPORT PAGE</h1>
               
                
            </div>
           
               
        </nav>
        <div class="container1 ">
            <!-- left side bar -->
           <div class="left-sidebar ">
              <div class="imp-links ">
              <br><br><br><br><br><br>
                <a href="admin.php"><img src="user.png">manage user</a>
                <a href="aprove.php"><img src="approve.jpg">Approve user</a>
                 
                  <a href="problemRequest.php"><img src="event.png">NEW QUESTION</a>
                  <a href="subSystem.php"><img src="event.png">MANAGE SUB SYSTEM</a>
                  <a href="component.php"><img src="event.png">MANAGE COMPONENT</a>
                  <a href="uploadResource.php"><img src="event.png">upload Resource</a>
                  <a href="report.php"><img src="event.png">VIEW REPORT</a>
                  
                 
              </div>
           </div>
            <!-- main content -->
           <div class="main-content ">
           <table class="table table-striped">
           <thead class="thead-dark">
    <tr>
      <th scope="col" colspan="4" >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      OVER ALL SYSTEM REPORT</th>
      
    </tr>
  </thead>
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">ABOUT</th>
      <th scope="col" colspan="2">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      REPORT</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <?php $sql1="SELECT * FROM `user`"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?>
      <td COLSPAN="2">TOTAL NUMBER OF USERS OF THE SYSTEM</td>
      <td><?php echo $total1 ?></td>
      
    </tr>
    <tr>
    <th scope="row">2</th> 
    <td COLSPAN="2">TOTAL NUMBER OF TICKET CREATED</td>
    <?php $sql1="SELECT * FROM `ticket`"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
      <td><?php echo $total1 ?></td>
    </tr>
    

    <tr>
<td></td>

<td><h6>RATIO OF TICKET SUB-SYSTEM WISE</h6></td>
<td></td>
</tr>
<?php $sql1="SELECT * FROM `sub_system`"; 
      $result1=$con->query($sql1);
      while($row3 = mysqli_fetch_array($result1)){   
        $sub_system1=$row3['sub_system'];

        $bm="SELECT * FROM `ticket` where `sub_system`='$sub_system1'"; 
        $result9=$con->query($bm);
        $total1=mysqli_num_rows($result9); 
?>
           <tr> 
        <td></td>
        <td><?php echo $sub_system1  ?></td>
<td><?php echo $total1 ?></td>
      </tr>    
      <?php } ?>

    
    <tr>
<td></td>

<td><h6>RATIO OF TICKET COMPONENT WISE</h6></td>
<td></td>
</tr>
<?php $sql1="SELECT * FROM `component`"; 
      $result1=$con->query($sql1);
      while($row3 = mysqli_fetch_array($result1)){   
        $c_name=$row3['c_name'];

        $bm="SELECT * FROM `ticket` where `target_area`='$c_name'"; 
        $result9=$con->query($bm);
        $total1=mysqli_num_rows($result9);  ?>
        <tr> 
        <td></td>

<td><?php echo $c_name  ?></td>
<td><?php echo $total1 ?></td>
        </tr>
<?php
      }
        ?>

<?php $sql1="SELECT * FROM `ticket` where `sub_system`='GAS'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?>




    <tr>
    <th scope="row">3</th> 
    <td COLSPAN="2">TOTAL NUMBER OF SOLVED TICKET</td>
    <?php $sql1="SELECT * FROM `ticket` where `status`='0'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
      <td><?php echo $total1 ?></td>
    </tr>
    <tr>
    <th scope="row">4</th> 
    <td COLSPAN="2">TOTAL NUMBER OF UNSOLVED TICKET</td>
    <?php $sql1="SELECT * FROM `ticket` where `status`='1'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
      <td><?php echo $total1 ?></td>
    </tr>
    <tr>
    <th scope="row">5</th> 
    <td COLSPAN="2">TOTAL NUMBER OF DELETED TICKET</td>
    <?php $sql1="SELECT * FROM `ticket` where `status`='-1'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
      <td><?php echo $total1 ?></td>
    </tr>
    <tr>
    <th scope="row">6</th> 
    <td COLSPAN="2">TOTAL NUMBER OF SUB SYSTEM</td>
    <?php $sql1="SELECT * FROM `sub_system`"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
      <td><?php echo $total1 ?></td>
    </tr>
    <tr>
    <th scope="row">7</th>
    <?php $sql1="SELECT * FROM `component`"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?> 
    <td >TOTAL NUMBER OF COMPONENT=<?php echo $total1 ?></td>
    <?php $sql1="SELECT * FROM `component` where `sub_system`='GCS'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?>
    <td>COMPONENT OF GCS=<?php echo $total1 ?></td>
    <?php $sql1="SELECT * FROM `component` where `sub_system`='GAS'"; 
      $result1=$con->query($sql1);
      $total1=mysqli_num_rows($result1);  ?>
      <td>COMPONENT OF GAS=<?php echo $total1 ?></td>
    </tr>
  </tbody>
</table>
           </div>
            <!-- right side bar -->
           <div class="right-sidebar ">
            <br>
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
  
