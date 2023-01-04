<?php
require_once ("../include/initialize.php");
  if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }



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
	case 'addcart' :

	addproduct();
	break;
	case 'removecart' :

	removeproduct();
	break;
	case 'updatecart' :

	updateproduct();
	break;
  
	case 'addorder' : 
	doOrder();
	break;
 
	}

   
function doInsert(){
	global $mydb;
	if(isset($_POST['save'])){

	 //    echo  $_POST['ORDERNO'];
		// echo date("Y-m-d H:i");
		// echo  $_POST['totalamount'];
		// echo  $_POST['tenderamount'];		 
		// echo  $_POST['sukli'];
		// echo  $_SESSION['ADMIN_FULLNAME'];	
		$remarks = isset($_POST['REMARKS'])	 ? $_POST['REMARKS'] : ''; 
		$tableno = isset($_POST['tableno']) ? $_POST['tableno'] : '';
		
		$autonumber = New Autonumber();
		$res = $autonumber->set_autonumber('CUSTOMER');
		$customer = $res->AUTO;


		$summary = New Summary();
		$summary->ORDERNO        		= $_POST['ORDERNO'];
		$summary->TRANSDATE     		= date("Y-m-d H:i");
		$summary->TOTALPAYMENT			= $_POST['totalamount'];
		$summary->TENDEREDAMOUNT 		= $_POST['tenderamount'];		 
		$summary->PCHANGE 				= $_POST['sukli'];
		$summary->USERSNAME       		= $_SESSION['ADMIN_FULLNAME'];	
		$summary->CUSTOMER       		= $customer;		
		$summary->TABLENO       		= $tableno;		
		$summary->REMARK        		= $remarks;					 
		$summary->create();

		$autonumber = New Autonumber();
		$autonumber->auto_update('CUSTOMER');

		$sql = "UPDATE tblorders SET STATUS='Paid' WHERE ORDERNO='".$_POST['ORDERNO']."' AND STATUS='Pending'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();


		 // redirect("index.php");
		redirect('receipt.php?orderno='.$_POST['ORDERNO']);
 

		 // redirect("index.php");
	}
}

function doEdit(){
	global $mydb; 

		$subtotal =  $_POST['PRICE'] * $_POST['QTY'];

		$sql = "UPDATE tblorders SET QUANTITY='".$_POST['QTY']."', SUBTOTAL='".$subtotal."' WHERE ORDERID='".$_POST['ORDERID']."'";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 
}

function doDelete(){
	global $mydb;  		
      
      $remarks = isset($_GET['rem']) ? $_GET['rem'] : '';
 		
 		// update order

		$sql = "UPDATE tblorders SET STATUS='Cancel' WHERE ORDERID='".$_GET['id']."'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();


 		// select order
		$sql = "SELECT * FROM tblorders WHERE ORDERID='".$_GET['id']."'";
		$mydb->setQuery($sql); 
		$result = $mydb->loadSingleResult();


		// select remaining order
		$sql = "SELECT * FROM tblorders WHERE STATUS='Pending' AND ORDERNO='".$result->ORDERNO."'";
		$mydb->setQuery($sql); 
		$cur = $mydb->executeQuery();

		$maxrow = $mydb->num_rows($cur);

	 

		if ($maxrow > 0 ) {
			# code...
			redirect("index.php?view=POS&orderno=".$result->ORDERNO."&tableno=".$result->TABLENO."&rem=".$remarks);
		}else{
			$sql ="UPDATE `tbltable` SET `STATUS`='Available' WHERE `TABLENO`='{$result->TABLENO}'";
			$mydb->setQuery($sql);
			$mydb->executeQuery();
			
			redirect("index.php");

		}  

  
}
 
 
 function addproduct(){
		$id = $_GET['mealid'];
		$meals = $_GET['meals'];
		$price = $_GET['price'];
		$qty = $_GET['qty'];
		$subtotal = $_GET['price'] * $_GET['qty'];

		admin_addtocart($id,$meals,$price,$qty,$subtotal);
		redirect("index.php?view=addorder");
 }
  function removeproduct(){
  	if(isset($_GET['id'])) {
	admin_removetocart($_GET['id']);
	$countcart =isset($_SESSION['admin_gcCart'])? count($_SESSION['admin_gcCart']) : "0";
	if($countcart==0){
		 
	unset($_SESSION['admin_gcCart']);

		message("Cart is empty.","success");
	}else{

		message("1 item has been removed in the cart.","success");
	} 
		redirect("index.php?view=addorder");
  
	}
 	
 }
  function updateproduct(){
  	 if (isset($_POST['mealid'])){   
   
      $mealid=$_POST['mealid'];
 
       $qty=intval(isset($_POST['QTY']) ? $_POST['QTY'] : ""); 
 
       admin_editproduct($mealid,$qty); 
     
   }
  	
 	
 }
 function doOrder(){
	if (isset($_POST['submit'])) {
		# code...
		$remarks = isset($_POST['REMARKS']) ? $_POST['REMARKS'] : '';
		 $autonum = New Autonumber();
         $orderno = $autonum->set_autonumber('ordernumber');

         $ordernumber = $orderno->AUTO; 
		 $tablenumber = $_POST['tableno'];


		 if (!empty($_SESSION['admin_gcCart'])){     
		 	$count_cart = count($_SESSION['admin_gcCart']); 
				for ($i=0; $i < $count_cart  ; $i++) { 

					$order = new Order();
					$order->DATEORDERED 		=  date('y-m-d H:i:s');	
					$order->ORDERNO 			=  $orderno->AUTO;
					$order->DESCRIPTION 		= $_SESSION['admin_gcCart'][$i]['meals'];	
					$order->PRICE 				= $_SESSION['admin_gcCart'][$i]['price'];	
					$order->QUANTITY 			= $_SESSION['admin_gcCart'][$i]['qty'];	
					$order->SUBTOTAL 			= $_SESSION['admin_gcCart'][$i]['subtotal'];	
					$order->TABLENO 			= $tablenumber;
					$order->MEALID 				= $_SESSION['admin_gcCart'][$i]['mealid'];
					$order->USERID 				= $_SESSION['ADMIN_USERID'];
					$order->STATUS 				= 'Pending';
					$order->REMARKS				= $remarks;
					$order->create();
				}
		 }
		 
		  date_default_timezone_set("ASIA/MANILA");

		 $tableno = new Tables();
		 $tableno->STATUS       = 'Occupied';
		 $tableno->RESERVEDDATE = date('Y-m-d');
		 $tableno->RESERVEDTIME = date('h:i A');
		 $tableno->updatestats($tablenumber);
 

		 $autonum = New Autonumber(); 
		 $autonum->auto_update('ordernumber');

		 unset($_SESSION['admin_gcCart']);

		 // message("Order successfully submited.","success");

		 redirect("index.php?view=POS&orderno=".$ordernumber."&tableno=".$tablenumber."&rem=".$remarks);
	}

}
?>