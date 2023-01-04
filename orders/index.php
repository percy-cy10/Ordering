<?php
require_once("../include/initialize.php");
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }


$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
 $title="Orders";
 $header=$view; 
switch ($view) {
	case 'POS' :
		$content    = 'pos.php';		
		break;

	case 'addtocart' :
		$content    = 'addtocart.php';		
		break;

	case 'edit' :
		$content    = 'edit.php';		
		break;
    case 'view' :
		$content    = 'view.php';		
		break;

	 case 'addorder' :
		$content    = 'addorder.php';		
		break;

	case 'addmeal' :
		$content    = 'addmeal.php';		
		break;

	case 'billing' :
		$content    = 'billing.php';		
		break;

	case 'customerdetails' :
	 	$header = "Customer Details";
		$content    = 'customerdetail.php';		
		break;

	case 'orderedproduct' :
		$content    = 'orderedproduct.php';		
		break;

	default :
		redirect("index.php?view=POS");
		break;
}
require_once ("../theme/templates.php");
?>
  
