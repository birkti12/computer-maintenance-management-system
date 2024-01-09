<?php
session_start();
include 'connection.php';
$msg = "";
$msg1 = "";
$username  = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $con->query($sql);
while($row = mysqli_fetch_array($result)){
    $un=$row['username'];
    $id=$row['id'];
    $role=$row['type'];	
    $email=$row['email'];
}
if(!isset($_SESSION['username']) || ($role != 'user')){
	header("Location:login.php");
}
?>

<?php
if(isset($_POST['create'])){
    $sub_system = $_POST['sub_system'];
    $target_area = $_POST['target_area'];
    $issue = $_POST['issue'];
    $detail = $_POST['detail'];
    $priority = $_POST['priority'];
    $year1=date('d-m-y-h:i:s');

    $target="problem/image/".basename($_FILES['image']['name']);
    $picture=$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],$target);

$target2="problem/video/".basename($_FILES['video']['name']);
$video=$_FILES['video']['name'];
move_uploaded_file($_FILES['video']['tmp_name'],$target2);
   
    
   
$ad="SELECT * FROM `component` WHERE `sub_system`='$sub_system' and `c_name`='$target_area'";
    $check="SELECT * FROM `ticket` WHERE `sub_system`='$sub_system' and `target_area`='$target_area' and `issue`='$issue' and `detail`='$detail' and `priority`='$priority' ";
    $result = $con->query($check);
      $total=mysqli_num_rows($result);
      if($total>0){
        $msg =" this question already exist please see it in the solution list";
      }
      else{
        $result = $con->query($ad);
      $total=mysqli_num_rows($result);
      if($total==0){
        $msg =" the component $target_area is not the part of the $sub_system sub system";
      }
        else{

    $sql="INSERT INTO `ticket`(`sub_system`, `target_area`, `issue`, `detail`, `priority`, `issue_date`, `creator`, `solver`, `status`, `ticket_id`,`sender_id`,`image`,`video`,`pdf`) VALUES
     ('$sub_system','$target_area','$issue','$detail','$priority','$year1','$email','0','1','0','$id','$picture','$video','0')";

     $result2 = $con->query($sql);

     $check2="SELECT * FROM `ticket` WHERE `sub_system`='$sub_system' and `target_area`='$target_area' and `issue`='$issue' and `detail`='$detail' and `priority`='$priority'
      and `creator`='$email' and `issue_date`='$year1'";
       $result3 = $con->query($check2);
       while($row = mysqli_fetch_array($result3)){
        $id = $row['id'];
        
}
$ta="SSGI";
$year=date('Y');
$year=$year-2000;

$r=$id;
$r2=(string)$r;
$cv="$ta$r2/$year";

     $sql2="UPDATE `ticket` SET `ticket_id`='$cv' where `sub_system`='$sub_system' and `target_area`='$target_area' and `issue`='$issue' and `detail`='$detail' and `priority`='$priority'
     and `creator`='$email' and  `issue_date`='$year1'";
     $result4=$con->query($sql2);
     header("Location:popup.php?popup=$cv");
    }    
}
}
?>


<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/text" href="logo.jpeg">
    </head>
    <body style="background-color: rgb(223, 223, 202);">
        <div class="card" style="width: 50%;margin-left: 25%;">
            
            <div class="card-body">
            <?php  echo $msg?>
            <?php  echo $msg1?>
                <h3 style="margin-left: 25%;color:blueviolet">CREATE A NEW TICKET</h3>
                <form method="POST" action="ticket.php" enctype="multipart/form-data">
                <div class="form-group">
           <label for="exampleFormControlInput1">SELECT SUB SYSTEM</label>
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
                  <br>
                  <div class="form-group">
           <label for="exampleFormControlInput1">SELECT COMPONENT</label>
                            <select required name="target_area" class="form-control">
                                <option disabled selected>Select component</option>
                                <?php $sql3="SELECT * FROM `component`";
                                $result3= $con->query($sql3);
                                while($row3 = mysqli_fetch_array($result3)){   
                                    $id3=$row3['id'];
                                    $c_name=$row3['c_name'];
                                    ?>
<option value="<?php echo $c_name ?>" ><?php echo $c_name ?></option>

                              <?php  
                                }
                           
                                ?>
                            </select>
                        </div>
                  <br>
                <div class="form-group">
                    <label for="formGroupExampleInput" style="color:rgb(214, 32, 187);">ISSUE</label>
                    <input type="text" name="issue" class="form-control" required  placeholder="Example input placeholder" 
                    pattern="[a-zA-Z]{5,20}" title="5 to 20 only alpahabet letters" >
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1" style="color:rgb(214, 32, 187);">DESCRIPTION</label>
                    <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3" required
                    minlength="10" maxlength="100" ></textarea>
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
        <label class="custom-file-label" for="inputGroupFile01">UPLOAD VIDEO that help to solve the problem</label>
      </div>
    </div>
          <BR>
                  <label for="formGroupExampleInput" style="color:rgb(214, 32, 187);">PRIORITY</label>
                  <select class="form-control" required name="priority">
                      <option>select PRIIORITY</option>
                      <option value="HIGH RISK">HIGH RISK</option>
                      <option value="MIDDIUM RISK">MIDDIUM RISK</option>
                    </select>
                    
                     
                 
                 
                  <button type="submit" class="btn btn-success" name="create" style="margin-left: 40%;">CREATE</button>
                </form>
            </div>
          </div>
    </body>
</html>


