<?php
require_once("../include/initialize.php");  
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }

	// if (isset($_POST['mealid'])) {
		# code...
	    $orderno = $_GET['orderno'];
	    $tableno = $_GET['tableno'];
	    $mealid  = $_POST['mealid'];
	    $remarks = $_GET['rem'];
		$subtotal = 0;
		$qty =0;

			 $query = "SELECT * FROM `tblorders` 
	          		   WHERE `ORDERNO`= '".$orderno."' AND MEALID= '".$mealid."' AND STATUS='Pending'"; 
				  	 $mydb->setQuery($query);
				  	 $row = $mydb->executeQuery(); 
				     $maxrow = $mydb->num_rows($row);

				  	if ($maxrow > 0) {
				  		# code...
				  		$res = $mydb->loadSingleResult(); 

				  		$qty = intval($res->QUANTITY) + 1;
					  	$subtotal = $res->PRICE * $qty; 

				  		$order = new Order(); 
						$order->QUANTITY 			= $qty;	
						$order->SUBTOTAL 			= $subtotal;	 
						$order->pupdate($orderno,$mealid); 


				  	}else{
				  		$query = "SELECT * FROM `tblmeals` WHERE MEALID='".$mealid."'";
				  	    $mydb->setQuery($query);
				  		$cur = $mydb->loadSingleResult(); 

					  	$subtotal = $cur->PRICE * 1;

						$order = new Order();
						$order->DATEORDERED 		= date('Y-m-d H:i');	
						$order->ORDERNO 			= $orderno;
						$order->DESCRIPTION 		= $cur->MEALS;	
						$order->PRICE 				= $cur->PRICE;	
						$order->QUANTITY 			= 1;	
						$order->SUBTOTAL 			= $subtotal;	
						$order->TABLENO 			= $tableno;
						$order->MEALID 				= $mealid;
						$order->USERID 				= $_SESSION['WAITER_USERID'];
						$order->STATUS 				= 'Pending';
						$order->REMARKS				= $remarks;
						$order->create(); 
				  	}


				   

					 // $tableno = new Tables();
					 // $tableno->STATUS       = 'Occupied';
					 // $tableno->RESERVEDDATE = date('Y-m-d');
					 // $tableno->updatestats($tablenumber);
	// }
?> 
<div class="scrolly">
<table id="table" class="table table-hover" style="font-size: 12px" >
    				<thead>
    					<tr> 
    					    <th>Meal</th>
							<th width="60">Price</th>
							<th width="50">Qty</th>
							<th width="100">Sub-total</th>
							<th width="30"  > </th>
    					</tr> 
    				</thead>
    				<tbody>
    					<?php 
    					$total = 0;
    						if (isset($_GET['orderno'])) {
    							# code...
    							$orderno = $_GET['orderno'];
    							$query = "SELECT * FROM `tblorders` o , `tblusers` u
	           					 WHERE  o.`USERID` = u.`USERID` AND `STATUS`='Pending' AND `ORDERNO` ='".$orderno."'";
						  		$mydb->setQuery($query);
						  		$cur = $mydb->loadResultList();

								foreach ($cur as $result) { 
						  		echo '<tr>'; 
						  		echo '<td>'.$result->DESCRIPTION.'</td>';
						  		echo '<td><input type="hidden" id="'.$result->ORDERID.'orderprice" value="'.$result->PRICE.'" >'.$result->PRICE.'</td>';
						  		echo '<td><input type="number" class="orderqty" data-id="'.$result->ORDERID.'" id="'.$result->ORDERID.'orderqty" value="'.$result->QUANTITY.'" style="width:50px"></td>';
						  		echo '<td> <output id="Osubtot'.$result->ORDERID.'">'.$result->SUBTOTAL.'</output></td>';
						  		// echo '<td></td>';
                               echo '<td><a title="Cancel Order" class="btn btn-xs btn-danger" style="text-decoration:none;" href="controller.php?action=delete&id='.$result->ORDERID.'&rem='.$result->REMARKS.'"><i class="fa fa-trash-o"></i></a></td>';
						  		echo '</tr>';

						  		$total += $result->SUBTOTAL; 

						  	 
						  		} 
    						}
					  		
				  		?> 
				  		<!-- <tr>
				  			<td colspan="4"></td>
				  		</tr> -->
    				</tbody>
    			</table>
    		 </div> 
    		<!-- <hr/> -->
    		<!-- end order details --> 
    			<table class="table table-bordered" >
    				<thead>
    					<tr>
    						<th >Total</th>
    						<th><input type="text" id="totamnt"  readonly="true" value="<?php echo number_format($total,2); ?>">
    						<input type="hidden" name="totalamount" id="totalamount"   value="<?php echo $total; ?>"></th>
    					</tr> 
    			</table>
    	 