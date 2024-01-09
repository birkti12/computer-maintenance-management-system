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
    $sql="DELETE FROM `component` WHERE id=$id";
   $result= $con->query($sql);  
header("Location:component.php");
    } 
?>


<?php
if(isset($_POST['add'])){
    $ToBeAdd = $_POST['text'];
    $subToBeAdd=$_POST['sub_system'];
    $insert="INSERT INTO `component`( `c_name`, `sub_system`) VALUES ('$ToBeAdd','$subToBeAdd')";
    $result= $con->query($insert);

    header("Location:component.php");
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
                <img src="admin.png" class="logo "><h1>ESSTI ADMIN COMPONENT ADDITION</h1>
               
                
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
          
           <form method="POST" action="component.php">
           <div class="form-group">
           <label for="exampleFormControlInput1">SUB SYSTEM</label>
                            <select required name="sub_system" class="form-control">
                                <option disabled selected>Select Sub System</option>
                                <?php $sql3="SELECT * FROM `sub_system`";
                                $result3= $con->query($sql3);
                                while($row3 = mysqli_fetch_array($result3)){   
                                    $id3=$row3['id'];
                                    $sub_system3=$row3['sub_system'];
                                    ?>
<option value="<?php echo $sub_system3 ?>" ><?php echo $sub_system3 ?></option>

                              <?php  
                                }
                           
                                ?>
                            </select>
                        </div>
           <div class="form-group">
    <label for="exampleFormControlInput1">COMPONENT</label>
    <input type="text" class="form-control" required name="text" placeholder="inter the COMPONENT" 
    pattern="[A-Z]{3,10}" title="YOU CAN ONLY USE UPPER CASE LETTERS">
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" name="add" class="btn btn-primary">ADD</button>
  </div>
</form>
<?php $sql2="SELECT * FROM `component`";
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
      LIST OF COMPONENT</th>
    </tr>
    <tr>
    <th scope="col">#</th>
    <th scope="col"> COMPONENT</th>
    <th scope="col"> SUB SYSTEM</th>
      <th scope="col">MANAGE</th>
      
    </tr>
    </thead>
    <tbody>
        <?php $order=1;
    while($row = mysqli_fetch_array($result2)){   
    $id=$row['id'];
    $sub_system=$row['sub_system'];
    $c_name=$row['c_name'];

?>
<tr>
<td><?php echo $order ?></td>
<td><?php echo $c_name ?></td>
<td><?php echo $sub_system ?></td>
<td> <a href="component.php?delete=<?php echo $id; ?>"> <button class="btn btn-success">  DELETE  </button>   </a> </td>

<?php $order++;
?>
</tr>
<?php
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
   


