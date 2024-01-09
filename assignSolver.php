<?php
session_start();
include 'connection.php';
$username  = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $con->query($sql);
while($row = mysqli_fetch_array($result)){
    $un=$row['username'];
    $id1=$row['id'];
    $role=$row['type'];
    $email=$row['email'];
}
if(!isset($_SESSION['username']) || ($role != 'admin')){
	header("Location:login.php");
}
?>

<?php
if(isset($_GET['assign'])){
    $id = $_GET['assign'];
    $sql="SELECT * FROM ticket where id=$id";
   $result= $con->query($sql);
   $row = mysqli_fetch_object($result);

   $Tid=$row->id;
   $sub_system=$row->sub_system;
   $target_area = $row->target_area;
   $description = $row->detail;
   $issue = $row->issue;
   $sender_id = $row->sender_id;
   $status=$row->status;
   $ticket_id=$row->ticket_id;
   $image=$row->image;
   $video=$row->video;
   $pdf=$row->pdf;

   $image1 = "<img  src='problem/image/".$row->image."' style=\"width: 50%;height:30%;margin-left:30% ;\">";
   $video1 = "<video   controls src='problem/video/".$row->video."' style=\"width: 50%;height:30%;margin-left:30% ;\"></video>";
   $pdf1 = "<pdf   controller src='solution/".$row->pdf."' style=\"width: 50%;height:30%;margin-left:30% ;\">";
     $help=1;                         
   

  }    
?>
<?php

if(isset($_POST['p_solver'])){
    $solver=$_POST['solverP'];
    $sql="UPDATE `ticket` SET `solver`='$solver' WHERE `id`='$Tid'";
    $result= $con->query($sql);
    header("Location:problemRequest.php");

}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="admin1.css">
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <link rel="stylesheet" type="text/css" href="drop.css">
        <link rel="stylesheet" type="text/css" href="approve.css">
    </head>
    <body>
        <br><br>
            <form method="POST" action="" enctype="multipart/form-data">    
        <div class="card-group ap">
            <div class="card" style="width: 18rem;">
               
               <div class="card-body">
               <div class="alert alert-info" role="alert">
  <h4 class="alert-heading">SUB SYSTEM</h4>
  <p><?php echo $sub_system ?></p>
</div>
<div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">COMPONENT</h4>
  <p><?php echo $target_area ?></p>
</div>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">ISSUE</h4>
  <p><?php echo $issue ?></p>
</div>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">problem detail</h4>
  <p><?php echo $description ?></p>
</div>
                 <?php if($image==0||$image==""){
                  ?>
  <?php
                 } else{
                  echo $image1;
                 }
                 if($video==0||$video==""){ ?>
                 
                 <?php
                  
                 } 
                 else{
                   echo $video1;
                   
                 }
?>
              <form method="POST" action="problemRequest.php">
                      <div class="form-group">
           <label for="exampleFormControlInput1">ASSIGN SOLVER</label>
                            <select required name="solverP" class="form-control">
                                <option disabled selected>Select SOLVER</option>
                                <?php $sql3="SELECT * FROM `user`";
                                $result3= $con->query($sql3);
                                while($row3 = mysqli_fetch_array($result3)){   
                                    $fname=$row3['fname'];
                                    $lname=$row3['lname'];
                                    $username=$row3['username'];
                                    $email=$row3['email'];
                                    ?>
<option value="<?php echo $email ?>" ><?php echo "$fname $lname ($username)" ?></option>
 
                              <?php  
                                
                            } 
                                ?>
                            </select>
                           
                    <?php ?>
                        </div>
                       
                            </form>   
                 
          <BR>
           <button class="btn btn-success" type="submit" name="p_solver"> ASSIGN</button> 
          
               </div>
             </div>  
     
             </div>
             <br><br>
            </form>
    </body>
</html>



