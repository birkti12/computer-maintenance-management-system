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
    $sql="DELETE FROM `user_approve` WHERE `id`='$id'";
    $result= $con->query($sql);
    header("Location:aprove.php");
}

?>


<?php
if(isset($_GET['accept'])){
    $id = $_GET['accept'];
    $sql="SELECT * FROM user_approve where id=$id";
   $result= $con->query($sql);
   $row = mysqli_fetch_object($result);


   $fname = $row->fname;
   $id = $row->id;
   $lname=$row->lname;
   $email=$row->email;
   $picture=$row->picture;
   $gender=$row->gender;
   $department=$row->department;
   $id_number = $row->id_number;
   $username = $row->username;
   $nickname = $row->nickname;
   $password = $row->password;
   $pic = "<img  src='picture/".$row->picture."'>";


   $sql = "INSERT INTO `user`(`fname`, `lname`, `email`, `picture`, `gender`, `department`, `id_number`, `username`, `nickname`, `password`, `status`, `type`) VALUES
    ('$fname','$lname','$email','0','$gender','$department','$id_number','$username','$nickname','$password','1','user')";

   $result = $con->query($sql);

   $sql2 ="DELETE FROM `user_approve` WHERE `id`='$id'";
   $result2 = $con->query($sql2);
   


   
header("Location:aprove.php");



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
        <link rel="stylesheet" type="text/css" href="approve.css">
        <link rel="icon" type="image/text" href="logo.jpeg">
    </head>
    <body >

        <nav >
            <div class="nav-left container">
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN USER APPROVAL</h1>
               
                
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
            <?php 
             $qr = "SELECT * FROM user_approve where `status`='1'";
             $result = $con->query($qr);
             $row = mysqli_num_rows($result);
             if($row==0){
                echo "THERE IS NO NEW REGISTRATION REQUEST";
                }
                else{
                    $order = 1;
	                while($row = mysqli_fetch_object($result)){
                        $fname = $row->fname;
                        $id = $row->id;
                        $lname=$row->lname;
                        $email=$row->email;
                        $picture=$row->picture;
                        $gender=$row->gender;
                        $department=$row->department;
                        $id_number = $row->id_number;
                        $username = $row->username;
                        $nickname = $row->nickname;
                        $password = $row->password;
                        $pic="<img  src='picture/".$row->picture."' >"
                       

                        ?>
                         <br><br>
                
                <div class="card-group ap">
                    <div class="card" style="width: 18rem;">
                      <?php echo $pic ?>
                       
                       <div class="card-body">
                         <h5 class="card-title">FIRST NAME :<?php echo $fname ?> </h5>
                         <h5 class="card-title">LAST NAME :<?php echo $lname ?> </h5>
                         <h5 class="card-title">EMAIL :<?php echo $email ?> </h5>
                         <h5 class="card-title">GENDER :<?php echo $gender ?> </h5>
                         <h5 class="card-title">DEPARTMENT :<?php echo $department ?> </h5>
                         <h5 class="card-title">ID NUMBER :<?php echo $id_number ?> </h5>
                         <h5 class="card-title">USER NAME :<?php echo $username ?> </h5>
                         <h5 class="card-title">NICK NAME :<?php echo $nickname ?> </h5>
                         
                  
                         <a href="aprove.php?accept=<?php echo $id; ?>"> <button class="btn btn-danger"> ACCEPT</button> </a>
                         <a href="aprove.php?delete=<?php echo $id; ?>"> <button class="btn btn-info"> DELETE</button> </a>
                  
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


   