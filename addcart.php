<?php 
require_once ("include/initialize.php");
  // if (!isset($_SESSION['USERID'])){
  //     redirect("index.php");
  //    }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break; 

	case 'order' :
	doOrder();
	break;
	}


   
	function doInsert(){
	 

if(isset($_POST['submit'])){
		$remarks = isset($_POST['REMARKS']) ? $_POST['REMARKS'] : '';
   	  	$id = $_POST['mealid'];
		$meals = $_POST['meals'];
		$price = $_POST['price'];
		$qty = $_POST['qty'];
		$subtotal = $_POST['price'] * $_POST['qty'];

		addtocart($id,$meals,$price,$qty,$subtotal);

		 $category = isset($_GET['category']) ? $_GET['category'] : "ALL";

		redirect("index.php?view=menu&category=".$category."&rem=".$remarks);
    
	}
}
		 

 

function doEdit(){

  if (isset($_POST['mealid'])){   
   
      $mealid=$_POST['mealid'];
 
       $qty=intval(isset($_POST['QTY']) ? $_POST['QTY'] : ""); 
 
       editproduct($mealid,$qty); 
     
   }
}
   
 

function doDelete(){ 
if(isset($_GET['id'])) {
	$remarks = isset($_GET['rem']) ? $_GET['rem'] : '';
	removetocart($_GET['id']);
	$countcart =isset($_SESSION['gcCart'])? count($_SESSION['gcCart']) : "0";
	if($countcart==0){
		 
	unset($_SESSION['gcCart']);

		message("Cart is empty.","success");
	}else{

		message("1 item removed in cart.","success");
	} 
		// redirect(web_root."index.php?view=cart");
	redirect(web_root."index.php?view=menu&rem=".$remarks);
  
	}

}

function doOrder(){
	if (isset($_POST['submit'])) {
		# code...
		 $autonum = New Autonumber();
         $orderno = $autonum->set_autonumber('ordernumber');

         $remarks = isset($_POST['rem']) ? $_POST['rem'] : '';

		 if (!empty($_SESSION['gcCart'])){     
		 	$count_cart = count($_SESSION['gcCart']); 
				for ($i=0; $i < $count_cart  ; $i++) { 

					$order = new Order();
					$order->DATEORDERED 		=  date('y-m-d H:i:s');	
					$order->ORDERNO 			=   date('Y'). '-'.$orderno->AUTO;
					$order->DESCRIPTION 		= $_SESSION['gcCart'][$i]['meals'];	
					$order->PRICE 				= $_SESSION['gcCart'][$i]['price'];	
					$order->QUANTITY 			= $_SESSION['gcCart'][$i]['qty'];	
					$order->SUBTOTAL 			= $_SESSION['gcCart'][$i]['subtotal'];	
					$order->TABLENO 			= @$_POST['tableno'];
					$order->MEALID 				= $_SESSION['gcCart'][$i]['mealid'];
					$order->USERID 				= $_SESSION['WAITER_USERID'];
					$order->STATUS 				= 'Pending';
					$order->REMARKS 			= $remarks;
					$order->create();
				}
		 }

		 $tableno = new Tables();
		 $tableno->STATUS       = 'Occupied';
		 $tableno->RESERVEDDATE = date('Y-m-d');
		 $tableno->updatestats(@$_POST['tableno']);

		 $autonum = New Autonumber(); 
		 $autonum->auto_update('ordernumber');

		 unset($_SESSION['gcCart']);

		 message("Order successfully submitted.","success");

		 redirect(web_root."index.php");
	}

}
	 
?>
