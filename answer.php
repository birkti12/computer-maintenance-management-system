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
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
?>



<?php
if(isset($_GET['answer'])){
    $id = $_GET['answer'];
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

if(isset($_POST['p_answer'])){
    $answer = $_POST['answer'];
    $target="solution/image/".basename($_FILES['image']['name']);
    $picture=$_FILES['image']['name'];

    $target2="solution/video/".basename($_FILES['video']['name']);
    $Avideo=$_FILES['video']['name'];

    $sql="INSERT INTO `ticket_solution`( `sender_id`, `p_id`, `solutiion`, `image`,`solved_by`,`video`) VALUES
     ('$id1','$Tid','$answer','$picture','$email','$Avideo')";

move_uploaded_file($_FILES['image']['tmp_name'],$target);
move_uploaded_file($_FILES['video']['tmp_name'],$target2);

$result = $con->query($sql);

$sql2="UPDATE `ticket` SET `status`='0' WHERE id='$Tid'";
$result2 = $con->query($sql2);
   
                        header("Location:forme.php");

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
                 
                 <div class="form-group">
                    <label for="exampleFormControlTextarea1"> <h3 style="color: red;">POSSIBLE SOLUTION ABOUT THE PROBLEM </h3></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="answer"></textarea>
                  </div>
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
        <label class="custom-file-label" for="inputGroupFile01">UPLOAD video that help to solve the problem</label>
      </div>
    </div>
          <BR>
           <button class="btn btn-danger" type="submit" name="p_answer"> POST ANSWER</button> 
          
               </div>
             </div>  
     
             </div>
             <br><br>
            </form>
    </body>
</html>



