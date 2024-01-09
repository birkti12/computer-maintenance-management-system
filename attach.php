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
    $email=$row['email'];
}
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
?>



<?php
if(isset($_GET['attach'])){
    $id1 = $_GET['attach'];
    $sql="SELECT * FROM ticket where id='$id1'";
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
                         
   

  }    
?>
<?php

if(isset($_POST['p_answer'])){
 $sql3="SELECT * FROM `ticket` where id='$Tid'";
 $result3 = $con->query($sql3);
 $row2 = mysqli_fetch_object($result3);
 $image2=$row2->image;
   $video2=$row2->video;

    
    $target="problem/image/".basename($_FILES['image']['name']);
    $picture=$_FILES['image']['name'];


move_uploaded_file($_FILES['image']['tmp_name'],$target);

$target2="problem/video/".basename($_FILES['video']['name']);
$video=$_FILES['video']['name'];


move_uploaded_file($_FILES['video']['tmp_name'],$target2);
if($video!="" && $video!=0 && $picture!="" && $picture!=0){
  $sql2="UPDATE `ticket` SET `image`='$picture',`video`='$video' WHERE id='$Tid'";
  $result2 = $con->query($sql2);
}
else if(($picture=="" || $picture==0) && ($video=="" || $video==0)) {
  }
  else if(($picture=="" || $picture==0) && ($video!="" || $video!=0)) {
    $sql2="UPDATE `ticket` SET `video`='$video' WHERE id='$Tid'";
$result2 = $con->query($sql2);
  }
  else if(($picture!="" || $picture!=0) && ($video=="" || $video==0)) {
    $sql2="UPDATE `ticket` SET `image`='$picture' WHERE id='$Tid'";
$result2 = $con->query($sql2);
  }


   
                        header("Location:activity.php");

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
                 <h5 class="card-title">SUB SYSTEM :<?php echo $sub_system ?> </h5>
                 <h5 class="card-title">TARGET AREA  :<?php echo $target_area ?> </h5>
                 <h5 class="card-title">ISSUE  :<?php echo $issue ?> </h5>
                 <h5 class="card-title">PROBLEM DETAIL  :<?php echo $description ?> </h5>
                
                  <br>
                  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01"  name="image">
        <label class="custom-file-label" for="inputGroupFile01">UPLOAD IMAGE that help to solve the problem</label>
      </div>
    </div>
          <BR>
          <br>
                  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01"  name="video">
        <label class="custom-file-label" for="inputGroupFile01">UPLOAD VIDEO that help to solve the problem</label>
      </div>
    </div>
          <BR>
         
           <button class="btn btn-info" type="submit" name="p_answer"> ATTACH</button> 
          
               </div>
             </div>  
     
             </div>
             <br><br>
            </form>
    </body>
</html>



