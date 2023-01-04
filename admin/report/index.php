<?php
require_once("../../include/initialize.php");
 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php"); 
 }else{
 	 if ($_SESSION['ADMIN_ROLE']!='Administrator') {
      	# code...
      	 redirect(web_root."admin/orders/");
      }
 }
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title ='Report';
switch ($view) {
	case 'list' :

		$content    = 'list.php';		
		break;
	case 'senior' :
		$content    = 'seniorReport.php';		
		break;	
			
	default :
		$content    = 'list.php';		
}
  // include '../modal.php';
require_once '../theme/Templates.php';
?>


  
