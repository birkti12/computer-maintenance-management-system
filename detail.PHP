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
}
if(!isset($_SESSION['username']) || ($role != 'user')){
	header("Location:login.php");
}
?>

<?php
if(isset($_GET['detail'])){
    $id = $_GET['detail'];
    $query = "SELECT * FROM `ticket_solution` WHERE `p_id`='$id'";
   $result= $con->query($query);
   $total=mysqli_num_rows($result);
 if($total==0){}
 else{
   $row = mysqli_fetch_object($result);
   $Aid=$row->id;
   $Ap_id=$row->p_id;
   $Asender_id = $row->sender_id;
   $solution = $row->solutiion;
   $solved_by=$row->solved_by;
   $sol = "<img  src='solution/image/".$row->image."' style=\"width: 50%;height:30%;margin-left:30% ;\">";
   $solVideo = "<video   controls src='solution/video/".$row->video."' style=\"width: 50%;height:30%;margin-left:30% ;\"></video>";
   $solved_by=$row->solved_by;
   $APcondition=$row->image;
   $AVcondition=$row->video;
    }  
  }
?>
<?php

  $sql="SELECT * FROM ticket where id='$id'";
 $result= $con->query($sql);
 $total=mysqli_num_rows($result);
 while($row = mysqli_fetch_array($result)){
  $Tid=$row['id'];
  $sub_system=$row['sub_system'];
  $target_area = $row['target_area'];
  $description = $row['detail'];
  $issue = $row['issue'];
  $sender_id = $row['sender_id'];
  $status=$row['status'];
  $creator=$row['creator'];
  $ticket_id=$row['ticket_id'];
  $image1 = "<img  src='problem/image/".$row['image']."' style=\"width: 50%;height:30%;margin-left:30% ;\">";
  $condition=$row['image'];
  $Vcondition=$row['video'];
  $video1 = "<video   controls src='problem/video/".$row['video']."' style=\"width: 50%;height:30%;margin-left:30% ;\"></video>";
   
}
?>


<!DOCTYPE html>
<html>
<head>

    <link href="style2.css" rel="stylesheet" type="text/css">
    <link href="bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="drop1.css" rel="stylesheet" type="text/css">
     
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>

<div class="row no-gutters">

    <div class="col no-gutters">
<div class="leftside b1">
    <BR>
    <h3 style="margin-left: 20%;color:black;">PROBLEM AND DETAILS</h3>
    
    <div class="card-group ap">
        <div class="card" style="width: 18rem;">
        <div class="card-body">
            
        <div class="alert alert-info" role="alert">
  <h4 class="alert-heading">SUB SYSTEM</h4>
  <p><?php echo $sub_system ?></p>
</div>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">COMPONENT</h4>
  <p><?php echo $target_area ?></p>
</div>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">ISSUE</h4>
  <p><?php echo $issue ?></p>
</div>
             <div class="alert alert-info" role="alert">
  <h4 class="alert-heading">problem detail</h4>
  <p><?php echo $description ?></p>
</div>
             <h5 class="card-title" style="color: rgb(215, 30, 178);">TICKET CREATED BY :<?php echo $creator ?> </h5>
             <?php if($condition==0 || $condition=="" ){
              echo "this problem doesn't have an image";
             } else{
              ?>
             <h3 style="color: rgb(26, 218, 22);">AN IMAGE RELATED WITH THE PROBLEM</h3>
             <?php echo $image1; } ?>
             <?php if($Vcondition==0 || $Vcondition=="" ){
              // echo "this problem doesn't have a video";
             } else{
              ?>
             <h3 style="color: rgb(26, 218, 22);">VIDEO RELATED WITH THE PROBLEM</h3>
             <?php echo $video1; } ?>
             <br><br><br><br><br>
             <a href="index.php"><button class="btn btn-success" style="margin-left: 30%;">GO BACK</button></a>
           </div>
        </div>  
         </div>
         
</div>

    </div>
    <div class="col no-gutters">
        <div class="rightside">
            <br>
          
      <h3 style="margin-left: 20%;color:rgb(204, 21, 24);">SOLUTION AND DETAILS</h3>
              <div class="card-group ap">
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                    
                <div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">SUB SYSTEM</h4>
  <p><?php echo $sub_system ?></p>
</div>
<div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">COMPONENT</h4>
  <p><?php echo $target_area ?></p>
</div>
<div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">ISSUE</h4>
  <p><?php echo $issue ?></p>
</div>
             <div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">problem detail</h4>
  <p><?php echo $description ?></p>
</div>
                     <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">POSSIBLE SOLUTION</h4>
  <p><?php echo $solution ?></p>
  <hr>
  <p class="mb-0">for further information you can contact <?php echo $solved_by ?></p>
</div>


         <?php if($APcondition==0 || $APcondition=="" ){
              echo "this problem doesn't have an image";
             } else{
              ?>
             <h3 style="color: rgb(26, 218, 22);">AN IMAGE RELATED WITH THE PROBLEM</h3>
             <?php echo $sol; } ?>
             <?php if($AVcondition==0 || $AVcondition=="" ){
              
             } else{
              ?>
             <h3 style="color: rgb(26, 218, 22);">VIDEO RELATED WITH THE PROBLEM</h3>
             <?php echo $solVideo; } ?>
             <div class="alert alert-primary" role="alert">
  <h3 class="alert-heading">PROBLEM SOLVED BY</h3>
  <p><?php echo $solved_by ?></p>
</div>
                    
                    
                   </div>
                </div>  
                 </div>
        </div>
    </div>


</div>



</body>
</html>