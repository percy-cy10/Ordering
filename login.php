 <?php
require_once("include/initialize.php");

 ?>
  <?php
 // login confirmation
  if(isset($_SESSION['WAITER_USERID'])){
    redirect(web_root."index.php");
  }
  ?>
  


<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
  <title>
    <?php
        $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
        $mydb->setQuery($sql);
        $viewTitle = $mydb->loadSingleResult();
        echo $viewTitle->Title;
    ?>

  </title>  
  
  <!--<link rel="icon" href="<?php echo web_root; ?>favicon-1.ico" type="image/x-icon">-->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo web_root; ?>admin/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>

    body {
      background-image: url('img/fondo.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
  </style>
  
</head>

<body>
  <body>
<div class="container">
  <section id="content">
  <?php check_message(); ?>
    <form action="" method="POST">
      <h1>Login</h1>
      <div>
        <input style="font-size: 15px;" type="text" placeholder="Username" required="" id="username"  name="user_email" />
        
      </div>
      <br>
      <div>
        <input style="font-size: 15px;" type="password" placeholder="Password" required="" id="password" name="user_pass" />
      </div>
      <br>
      <div>
        <button style="width: 50%;"  type="submit" class="btn btn-primary" name="btnLogin"> 
        <i class="fas fa-arrow-alt-circle-right"></i>  &nbsp;&nbsp;<b>Iniciar Sesión</b></button>
      </div>
    <br>
    </form><!-- form -->

    <div class="card-footer text-muted">
        
        <a href="registro.php">
          <button style="width: 35%;"  type="submit" class="btn btn-success" name="btnLogin"> 
           &nbsp;&nbsp;<b>Crear cuenta</b></button>
        
        </a>
       
    </div>

  </section><!-- content -->
</div><!-- container -->
</body>
  
    <script src="js/index.js"></script>

</body>
</html>

 


 <?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['user_email']);
  $upass  = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Usuario o contraseña invalido", "error");
      redirect("login.php");
         
    } else {  
  //it creates a new objects of member
    $user = new User();
    //make use of the static function, and we passed to parameters
    $res = $user::userAuthentication($email, $h_upass);
    if ($res==true) { 
      if ($_SESSION['ROLE']=='Waiter'){

        $_SESSION['WAITER_USERID'] = $_SESSION['USERID'];
        $_SESSION['WAITER_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['WAITER_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['WAITER_ROLE'] = $_SESSION['ROLE'];

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );

       message("You logon as ".$_SESSION['WAITER_ROLE'].".","success");
       redirect(web_root."index.php");
      }else{

        $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
        $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['ADMIN_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );
        
         message("You logon as ".$_SESSION['ADMIN_ROLE'].".","success");
         redirect(web_root."admin/index.php");
      } 
    }else{
      message("¡La cuenta no existe!", "error");
       redirect(web_root."login.php"); 
    }
 }
 } 
 ?> 
 


