<?php
session_start();
include 'connection.php';
$msg = "";
?>


<?php
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
    
    $pwd = md5($password);

  $query = "SELECT * FROM user WHERE username = '$username' AND password = '$pwd'";
      $result = $con->query($query);
      $total=mysqli_num_rows($result);

      if($total==0){
          $msg="incorrect user name or password";
      }else{

        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $status = $row['status'];
            $role = $row['type'];
            $username = $row['username'];
   }


   





  
$_SESSION['username'] = $username;

$row = mysqli_num_rows($result);
if($row>0){
  if($role == 'admin'){
     if($status == 0){
       $msg = "Sorry, You are deactivated!";
     }else{
       header("Location:admin.php");
     }
  }

  else if ($role == 'user' ){
     if($status == 0){
       $msg = "Sorry, You are deactivated!";
      // header("Location:loogin.php");
     }else{
         header("Location:index.php");
     }
  }



}
else{

       $msg =  "Username or password incorrect";
       header("Location:login.php");
}
      }
      
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LOGIN FORM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/text" href="logo.jpeg">
</head>
<body>
<h1 style="margin-left:37%;margin-top:7%;">ESSTI TICKETING SYSTEM</h1>
<div class="center">
<p style="color: red;"> <?php echo $msg?></p>
    <h1>Login</h1>
    <form method="post" action="login.php">
<div class="txt_field">
    <input type="text" required name="username" >
    <label>Username</label>
</div>

<div class="txt_field">
    <input type="password" required name="password">
    <label>Password</label>
</div>

<div class="signup_link">
<a href="forgot.php">FORGOT PASSWORD</a>
    <br>
    <br>
    
    <input type="submit" value="login" name="login">
    
    <div class="signup_link">
        Not a member? <a href="register1.php">Signup</a>
    </div>
</div>
    </form>
</div>


</body>







</html>