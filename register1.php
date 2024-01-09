<?php
   session_start();
   include 'connection.php';
   $msg = "";
   $msg1 = "";
   $msg2 = "";
  ?>
<?php
      if(isset($_POST['register'])){
      	$fn = $_POST['fname'];
      	$ln = $_POST['lname'];
        $email=$_POST['email'];
       
        $gender=$_POST['gender'];
        $department=$_POST['department'];
       
        $user_name=$_POST['user_name'];
        $nick_name=$_POST['nick_name'];
        $password=$_POST['password'];
        $Cpassword=$_POST['Cpassword'];
          

          $target="picture/".basename($_FILES['image']['name']);
          $picture=$_FILES['image']['name'];
      	
          $query = "SELECT * FROM user WHERE `username` = '$user_name' ";
          $result = $con->query($query);
          $row = mysqli_num_rows($result);

          $query2 = "SELECT * FROM user WHERE `nickname` = '$nick_name' ";
          $result2 = $con->query($query2);
          $row2 = mysqli_num_rows($result2);

          $query3 = "SELECT * FROM user WHERE `email` = '$email' ";
          $result3 = $con->query($query3);
          $row3 = mysqli_num_rows($result3);

          if($row3>0 ){
            $msg2 =  "email already exist!";
           
          }else{
if($row>0 ){
            $msg =  "username exist!";
            
          }else{
            if($row2>0 ){
                $msg1 =  "nick name exist!";
               
              }
              else{
                if($password!=$Cpassword){
                    $msg =  "Password must match!";
                }else{
                $encpwd = md5($password);
    $pendsql="INSERT INTO `user_approve`(`fname`, `lname`, `email`, `picture`, `gender`, `department`, `id_number`, `username`, `nickname`, `status`, `password`) VALUES 
    ('$fn','$ln','$email','$picture','$gender','$department','0','$user_name','$nick_name',1,'$encpwd')";
    
    move_uploaded_file($_FILES['image']['tmp_name'],$target);
    
                    $result = $con->query($pendsql);
                    
                    if($result ){
                        header("Location:login.php");
                        
                    }else{
                        $msg= "Something goes wrong";
                        //header("Location:relregister.php");
                    }
                }
              }
          }
         
        }
     	
      }
 ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="register.css">
    <title> </title> 
    <link rel="icon" type="image/text" href="logo.jpeg">
</head>
<body>
    <div class="container">
        <header>Registration</header>

        <form action="register1.php" method="POST" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    
                   
                     <p style="color: red;"> <?php echo $msg?></p>
                     <p style="color: red;"> <?php echo $msg1?></p>
                     <p style="color: red;"> <?php echo $msg2?></p>
                    <div class="fields">
                        <div class="input-field">
                            <label style="color:green"><h2>First Name</h2></label>
                            <input type="text" name="fname" placeholder="Enter your first name" required  pattern="[a-zA-Z]{3,20}" title="3 to 20 only alpahabet letters" >
                        </div>

                        <div class="input-field">
                            <label style="color:green"><h2>last Name</h2></label>
                            <input type="text" name="lname" placeholder="Enter your last name" required pattern="[a-zA-Z]{3,20}" title="3 to 20 only alpahabet letters">
                        </div>

                        <div class="input-field">
                            <label style="color:green"><h2>Email</h2></label>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="input-field" style="color:green">
                            <label style="color:green"><h2>YOUR ID PICTURE</h2></label>
                            <input type="file" name="image" required>
                        </div>

                        <div class="input-field">
                            <label style="color:green"><h2>Gender</h2></label>
                            <select required name="gender" >
                                <option disabled selected>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label style="color:green"><h2>department</h2></label>
                            <input type="text" name="department" placeholder="Enter your department" required pattern="[a-zA-Z]{2,20}" title="2 to 20 only alpahabet letters">
                        </div>
                    </div>
                </div>
                <br>

                <div class="details ID">
                    

                    <div class="fields">
                       


                        <div class="input-field">
                            <label style="color:green"><h2>User Name</h2></label>
                            <input type="text" name="user_name" placeholder="Enter User Name" required minlength="5" >
                        </div>

                        <div class="input-field">
                            <label style="color:green"><h2>Nick Name</h2></label>
                            <input type="text" name="nick_name" placeholder="Enter Nick Name" required minlength="5">
                        </div>
                        <div class="input-field">
                            <label style="color:green"><h2>password</h2></label>
                            <input type="password" name="password" placeholder="Enter password" required minlength="5">
                        </div>
                        <div class="input-field">
                            <label style="color:green"><h2>confirm password</h2></label>
                            <input type="password" name="Cpassword" placeholder="confirm password" required minlength="5">
                        </div>

                      
                    </div>
<div class="miki">
    <button class="nextBtn" type="submit" name="register">
        <span class="btnText">REGISTER</span>
        <i class="uil uil-navigator"></i>
    </button>
</div>
                     
                </div> 
            </div>

            
        </form>
    </div>

   
</body>
</html>


















