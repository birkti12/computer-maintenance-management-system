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
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql="UPDATE `ticket` SET `status`='-1' WHERE id=$id";
   $result= $con->query($sql);  
header("Location:problemRequest.php");
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
        <link rel="stylesheet" type="text/css" href="drop2.css">
        <link rel="stylesheet" type="text/css" href="approve.css">
        <link rel="icon" type="image/text" href="logo.jpeg">
    </head>
    <body >

        <nav >
            <div class="nav-left container">
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN QUESTION APPROVAL</h1>
               
                
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
           <?php 
             $qr = "SELECT * FROM ticket where `status`='1' order by -id";
             $result = $con->query($qr);
             $row = mysqli_num_rows($result);
             if($row==0){
                echo "THERE IS NO NEW QUESTION";
                }
                else{
                    $order = 1;
	                while($row = mysqli_fetch_object($result)){
                        $id = $row->id;
                        $sub_system=$row->sub_system;
                        $component=$row->target_area;
                        $issue=$row->issue;
                        $detail=$row->detail;
                        $creator=$row->creator;
                        $risk=$row->priority;
                        $solver=$row->solver;
                        $pic1=$row->image;
                        $pic="<img  src='problem/image/".$row->image."' >"
                       

                        ?>
                       
                        
                         <br><br>
                
                <div class="card-group ap ">
                    <div class="card " style="width: 18rem;">
                    <div class="card-body " >
                        <?php  if($risk=="HIGH RISK"){
                            ?>
<button class="btn btn-danger" style="width:100%;"> HIGH RISK PROBLEM</button>
                            <?php
                        }  ?>
                         <h5 class="card-title">SUB SYSTEM :<?php echo $sub_system ?> </h5>
                         <h5 class="card-title">COMPONENT :<?php echo $component ?> </h5>
                         <h5 class="card-title">ISSUE :<?php echo $issue ?> </h5>
                         <h5 class="card-title">DETAIL :<?php echo $detail ?> </h5>
                         <h5 class="card-title">TICKET CREATED BY :<?php echo $creator ?> </h5>
                         <h5 class="card-title">EXPECTED SOLVER :<?php echo $solver ?> </h5>
                       </div>
                      <?php
                      if($pic1=="" || $pic1==0){}
                       else{ echo $pic; } ?>
                      <div class="card-body">
                      <a href="AdminAnswer.php?answer=<?php echo $id; ?>"> <button class="btn btn-primary"> START ANSWERING</button> </a>
                      <a href="problemRequest.php?delete=<?php echo $id; ?>"> <button class="btn btn-danger"> DELETE</button> </a>
                      <?php if($solver==0 || $solver==""){ ?>
                      <br><br>
                      <a href="assignSolver.php?assign=<?php echo $id?>">
                        <button class="btn btn-info" type="submit"  name="assign"> ASSIGN SOLVER</button></a>
                <?php  } ?>
                    </div>
                       
                     </div>  
             
                     </div>
                     <br><br>
                        <?php
                    }

                }
            ?>    
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


   