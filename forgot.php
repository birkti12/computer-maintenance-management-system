<?php
session_start();
include 'connection.php';
$msg = "";
?>


<?php
if(isset($_POST['change'])){
  $nickname = $_POST['nickname'];
  
    
    

  $query = "SELECT * FROM user WHERE nickname = '$nickname'";
      $result = $con->query($query);
      $total=mysqli_num_rows($result);
      if($total==0){
          $msg="nick name does not exist";
      }
      
      else{
        $_SESSION['nickname']=$nickname;
        header("location:passwordchange.php");
      }
      
    }
?>
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
                   <b> FORGOT PASSWORD </b>
                </div>
                
                <div class="panel-body">
                    <form class="myfor" name="for" method="POST" action=""> 
                        <fieldset>
                            <div class="form-group card-body"  >
                            <P><?php echo $msg?></P>  
                            <P>INSERT YOUR NICK NAME TO CHANGE PASSWORD</P>
                            <input type="text" class="form-control userr" name="nickname" id="usrname" placeholder="INSERT YOUR NICK NAME" required >
                            </div>
                            <div class="form-group card-body">
                                
                                <a href="login.php" >login</a>&nbsp;&nbsp;&nbsp;
                                <a href="register1.php" >Create an account </a>
                            </div>

                                <div class="card-footer">
                               
                                <button class="btn btn-primary" type="submit" name="change">
                                 SUBMIT
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




