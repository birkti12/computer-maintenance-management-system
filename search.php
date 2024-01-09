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

<!DOCTYPE html>
<html>
<head>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="testSearch.css" rel="stylesheet">
    <link href="drop.css" rel="stylesheet">
    <link rel="icon" type="image/text" href="logo.jpeg">
</head>
<body style="background-color:white;">
  
    <br><br><br>
    <h2>search previously solved problems</h2>
    <div class="dropdown1">
        <button class="dropbtn1">
          ACTIVITIES
        </button>
        <div class="dropdown-content1">
        <button class="btn btn-secondary"><?php echo $un?></button>
                  <br>
                  <a href="index.php"><button class="btn btn-info">HOME PAGE</button></a>
                  <br>
          <a href="ticket.php"><button class="btn btn-primary">CREATE A NEW TICKET</button></a>
          <br>
          <a href="forme.php"><button class="btn btn-info">QUESTION FOR ME</button></a>
          <br>
          <a href="activity.php"><button class="btn btn-info">SEE MY ACCTIVITY</button></a>
          <br>
          <a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
        </div>
      </div>
    <form method="POST" action="">
        <div class="search">
<input type="text" placeholder="search solution for hardware" required name="text">
<button type="submit" class="btn btn-primary" name="search">search</button>
</div>
    </form>
    <?php
if(isset($_POST['search'])){
  $ToBeSearched = $_POST['text'];
//   $query = "SELECT * FROM `ticket` WHERE  CONCAT(`sub_system`,`target_area`,`ticket_id`) LIKE '%$ToBeSearched%';";
  $query = "SELECT * FROM `ticket` WHERE CONCAT(`sub_system`,`target_area`,`issue`,`ticket_id`,`detail`) LIKE '%$ToBeSearched%';";
      $result = $con->query($query);
      $total=mysqli_num_rows($result);
      if($total==0){
        ?>
        <br> <br> <br> <br> <br> <br>
          <p style="margin-left:35%;color:red;"><b>THERE IS NO SUCH THING SEARCH AGAIN</b></p>
          <?php
      }else{
        ?>
        <div class="cv">
    <table class="table" >
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">SUB SYSTEM</th>
            <th scope="col">COMPONENT</th>
            <th scope="col">ISSUE</th>
            <th scope="col">DETAIL</th>
            <th scope="col">STATUS</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $order=1;
        while($row = mysqli_fetch_array($result)){
          
            $id = $row['id'];
            $sub_system=$row['sub_system'];
            $target_area = $row['target_area'];
            $description = $row['detail'];
            $issue = $row['issue'];
            $sender_id = $row['sender_id'];
            $status=$row['status'];
            

            ?>
<?php if($total<=2){
  ?>
  <br><br>
<?php  } 
else if($total==3){  ?>

  <?php
  }  else{}
  ?>
<br>
    
        
          <tr>
            <th scope="row"><?php echo $order ?></th>
            <td><?php echo $sub_system ?></td>
            <td><?php echo $target_area ?></td>
            <td><?php echo $issue ?></td>
            <td><?php echo $description ?></td>
            <?php if($status==0){ ?>
            <td> <a href="detail.php?detail=<?php echo $id; ?>"> <button class="btn btn-success">  VIEW DETAIL </button>   </a></td>
            <?php }if($status==-1){ ?>
            <td>  <button class="btn btn-info">  DELETED </button>   </td>
            
            <?php }if($status==1){
                ?>
               <td> <button class="btn btn-danger">  PENDING </button></td>
                <?php
            } ?>
          </tr>
       
   <?php
     $order++;       
   }

    
}
}
?>
  </tbody>
      </table>
    </div>   
</body>




</html>