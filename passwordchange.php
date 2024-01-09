<?php
session_start();
include 'connection.php';
$nm=$_SESSION['nickname'];
$msg = "";
?>


<?php
if(isset($_POST['change'])){
  $Npassword = $_POST['npsw'];
  $password = $_POST['psw'];
    
    $pwd = md5($password);
if($Npassword!=$password){
    $msg ="password is not the same";
}else{





    $sql="UPDATE user set password='$pwd' where nickname='$nm' ";
    $con->query($sql);
    
    header("location:login.php");
}
}
?>

  
>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css.css">
    <link type="text/css" rel="stylesheet" href="bottomcss.css">
    <title>H-U Social media</title>
    
</head>

<body>
    
<div>
<br><br><br><br><br><br><br><br><br><br><br>
</div>
<div class="container card card-columns text-center bg-light w-25 p-3 ">
        
    <div class="login-panel panel panel-success">
                <div class="panel-heading card-header " style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
                   <b> change your password </b>
                </div>
                
                <div class="panel-body">
                    <form class="myfor" name="for" method="POST" action=""> 
                        <fieldset>
                            <div class="form-group card-body"  >
                            <P><?php echo $msg?></P>  
                            <input type="password" class="form-control userr" name="npsw" id="usrname" placeholder="new password" required minlength="5">
                            </div>
                            <div class="form-group card-body">
                                <input class="form-control" placeholder="confirm password" name="psw" id="psw"  type="password" value=""  
                                 required minlength="5"> <hr>
                                <a href="login.php" >LOGIN</a><hr>
                                <a href="register1.php" >Create an account </a>
                            </div>

                                <div class="card-footer">
                              
                                <button class="btn btn-primary" type="submit" name="change">
                                     CHANGE
                                </button> 
                                  
                                </div>
                             </div>
                
                        </fieldset>
                    </form>
                </div>
            </div>
            <br> <br><hr>
          
    </div>
    
</body>
<script src="loginscript.js"></script>

</html>




