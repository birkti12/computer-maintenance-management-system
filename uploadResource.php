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
    $sql="DELETE FROM `resource` WHERE id=$id";
   $result= $con->query($sql);  
header("Location:uploadResource.php");
    } 
?>

<?php
if(isset($_POST['add'])){
   
    $target="resource/".basename($_FILES['image']['name']);
    $File=$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],$target);
$about=$_POST['text'];
    $insert="INSERT INTO `resource`( `resource`, `about`) VALUES ('$File','$about')";
    $result= $con->query($insert);
    header("Location:uploadResource.php");
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
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN RESOURCE UPLOADING</h1>
               
                
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
          <br>
           <form method="POST" action="uploadResource.php" enctype="multipart/form-data">
           <div class="form-group">
    <label for="exampleFormControlInput1">ABOUT</label>
    <input type="text" class="form-control" required name="text" placeholder="INTER DESCRIPTION ABOUT THE FILE">
    <br>
</div>
           <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01"  name="image" required>
        <label class="custom-file-label" for="inputGroupFile01">UPLOAD RESOURCES</label>
      </div>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" name="add" class="btn btn-primary">Upload</button>
  
</form>

<?php $sql2="SELECT * FROM `resource`";
$result2 = $con->query($sql2);
$total=mysqli_num_rows($result2);
if($total==0){}
else{
 ?>
<table class="table table-striped">
  <thead>
  <tr>
      <th scope="col"colspan="3" style="margin-left:30%;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      LIST OF RESOURCES</th>
    </tr>
    <tr>
    <th scope="col">ABOUT</th>
      <th scope="col">RESOURCE</th>
      <th scope="col">MANAGE</th>
      
    </tr>
    </thead>
    <tbody>
        <?php $order=1;
    while($row = mysqli_fetch_array($result2)){   
    $id=$row['id'];
    $resource=$row['resource'];
    $ab=$row['about'];

?>
<tr>
<td><?php echo $ab ?></td>
<?php
$pdf="<embed src='resource/".$row['resource']."' type='application/pdf' width='100%' height='10%' />"; ?>
<td><?php echo $pdf ?></td>
<td> <a href="uploadResource.php?delete=<?php echo $id; ?>"> <button class="btn btn-success">  DELETE  </button>   </a> </td>
    </tr>
<?php $order++;
  }  } ?>
  
  </tbody>
</table>
                
                       
  <?php  ?>                      
            
                 
               
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
  
