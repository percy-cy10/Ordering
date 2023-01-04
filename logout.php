<?php 
require_once 'include/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
// unset( $_SESSION['USERID'] );
// unset( $_SESSION['FULLNAME'] );
// unset( $_SESSION['USERNAME'] );
// unset( $_SESSION['PASS'] );
// unset( $_SESSION['ROLE'] );
 

unset($_SESSION['WAITER_USERID']);  
unset($_SESSION['WAITER_FULLNAME']); 
unset($_SESSION['WAITER_USERNAME']);  
unset($_SESSION['WAITER_ROLE']); 
unset($_SESSION['message']);
unset($_SESSION['gcCart']);
// 4. Destroy the session
// session_destroy();
redirect(web_root."login.php?logout=1");
?>