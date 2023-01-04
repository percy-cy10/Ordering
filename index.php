<?php
require_once("include/initialize.php");
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
 
 $header=$view; 
switch ($view) {
	case 'cart' :
		$content    = 'cart.php';		
		break;
	case 'menu' :
		$content    = 'menu.php';		
		break;

	case 'add' :
		$content    = 'addcart.php';		
		break;

	case 'edit' :
		$content    = 'edit.php';		
		break;
		
    case 'view' :
		$content    = 'view.php';		
		break;
	case 'menu' :
		$content    = 'menu.php';		
		break;
	case 'orders' :
		$content    = 'listoforders.php';		
		break;

	default :
		$content    = 'home.php';		
}
require_once ("theme/templates.php");
?>