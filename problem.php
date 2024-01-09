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
}
if(!isset($_SESSION['username']) || ($role != 'user')){
	header("Location:login.php");
}
?>



<?php
      if(isset($_POST['send'])){
      	$p_type = $_POST['p_type'];
      	$target_area= $_POST['target_area'];
        $description=$_POST['description'];
          $target="problem/".basename($_FILES['image']['name']);
          $picture=$_FILES['image']['name'];
   $pendsql="INSERT INTO `problem`(`P_type`,`target_area`,`description`, `file`, `sender_id`, `status`) VALUES
         ('$p_type','$target_area','$description','$picture','$id','1')";

   move_uploaded_file($_FILES['image']['tmp_name'],$target);
                    $result = $con->query($pendsql);
                    if($result ){
                        header("Location:final.php");  
                    }else{
                        $msg= "Something goes wrong";    
                    }	
      }
 ?>







<!DOCTYPE html>
<html>
<head>
<title>

</title>

<link href="fontawesome.min.css" rel="stylesheet">
<link href="bootstrap.min.css" rel="stylesheet">
<link href="problem.css" rel="stylesheet">
</head>
<body class="m">
  <br>   <br> <br>   <br> 
  <form method="POST" action="" enctype="multipart/form-data">
 
   <h1 class="container">PROBLEM SUBMISSION FORM</h1>
   
    <div class="form-group">
        
        <h3>problem type:</h3><select name="p_type" class="form-control" id="exampleFormControlSelect2" required >
          <option selected>Choose...</option>
          <option value="HARDWARE PROBLEM" >HARDWARE PROBLEM</option>
          <option value="SOFTWARE PROBLEM">SOFTWARE PROBLEM</option>
          
        </select>
      </div>
      <div class="form-control">
        <h3>TARGET AREA: </h3> <input type="text" placeholder="TARGET AREA" style="width: 80%;" required name="target_area">
        
    </div>
    <BR>
    <div class="form-group">
      <label for="exampleFormControlTextarea1"> <h3>DESCRIIPTION ABOUT THE PROBLEM </h3></label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    </div>
    <br>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required name="image">
        <label class="custom-file-label" for="inputGroupFile01">Choose file related with the problem</label>
      </div>
    </div>

     
     <br>
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
    <button type="submit" class="btn btn-success" name="send">SUBMIT</button>
    <br>
  </form>
</body>

</html>