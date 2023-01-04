 <style type="text/css">
 	#story{
 		margin-top: -75px;
 		text-align: left;
 	}
 	#table{
 		font-size: 14px;
 		padding: 0px;
 	}

 	#placeorder{
 		width: 300px;
 		font-size: 18px;
 	}
 	#placeorder label {
 		margin-top: 5px;
 	}
 	#tableno { 
 	height: 40px;
 	width:100px;
 	}
 	.stot{
 		text-align: right;
 		font-size: 18px;
 		font-weight: bold;
 	} 
 </style>

 <section id="story" class="description_content">
    <div class="text-content container">

 <form id="contact-us" method="post" action="addcart.php?action=order">
    <h2 align="center" class="page-header">Cart</h2>
 <?php check_message(); ?>
	<table id="table" class="table table-responsive">
		<th>Meal</th>
		<th width="100">Price</th>
		<th width="100">Qty</th>
		<th width="100">Sub-total</th>
		<th width="100">Action</th>
		 <?php
			$cart = 0;
			$subtotal = 0;


              if (!empty($_SESSION['gcCart'])){   
                $count_cart = count($_SESSION['gcCart']); 
                    for ($i=0; $i < $count_cart  ; $i++) { 

                        	echo'<tr> 
                    				<td>'.$_SESSION['gcCart'][$i]['meals'].'</td>
                    				<td><input style="height:20px" type="hidden" name="price" id="'.$_SESSION['gcCart'][$i]['mealid'].'price"  value="'.$_SESSION['gcCart'][$i]['price'].'"/> '.$_SESSION['gcCart'][$i]['price'].'</td>
                    				<td><input style="height:25px;width:50px" type="number" name="qty" id="'.$_SESSION['gcCart'][$i]['mealid'].'qty" required class=" cartqty" data-id="'.$_SESSION['gcCart'][$i]['mealid'].'"   value="'.$_SESSION['gcCart'][$i]['qty'].'"/> </td>
                    				<td> <output id="Osubtot'.$_SESSION['gcCart'][$i]['mealid'].'">'.$_SESSION['gcCart'][$i]['subtotal'].'</output></td>
                    				<td><a class="btn btn-xs btn-danger" style="text-decoration:none;" href="addcart.php?action=delete&id='.$_SESSION['gcCart'][$i]['mealid'].'">Remove</a></td>
                        		</tr>';   

                    			$cart += $_SESSION['gcCart'][$i]['qty'];
                    			$subtotal += $_SESSION['gcCart'][$i]['subtotal'];
                   } 


                  }  
              echo  '<tfoot>
					<tr>
						<td colspan="3" ><p class="stot">Total</p></td>
						<td> &#8369 <span id="sum" class="stot">'. $subtotal.'</span></td>
						<td>
					</tr>
				</tfoot>';


                ?>  
					 
					
				</table>  
						<?php 
						  if ($subtotal > 0) { 
						 ?>

						 <div id="placeorder">
						 	<div class="row">
						 		<label class="col-xs-4" >Table No.</label>
						 		<div class="col-xs-4">
						 			<select class="form-control"  name="tableno" id="tableno"  >  

					                        <?php 
                            //Statement

												// $mydb->setQuery("SELECT * FROM `tbltable` where STATUS = 'Occupied' AND `RESERVEDDATE`='".date_create('Y-m-d')."' order by asc");
												// $cur = $mydb->loadResultList();
												// 	foreach ($cur as $result) {
					       //                   		 echo  '<option value='.$result->TABLENO.' >'.$result->TABLENO.'</option>';
												// }														
                          						?>
					                          <?php
					                            //Statement
					                          $mydb->setQuery("SELECT * FROM `tbltable` WHERE STATUS ='Available' order by TABLENO asc");
					                          $cur = $mydb->loadResultList();

					                        foreach ($cur as $result) {
					                          echo  '<option value='.$result->TABLENO.' >'.$result->TABLENO.'</option>';
					                          }
					                          ?> 
                                       </select>
						 		</div> 
						 		<div class="col-xs-4">
						 			 <button  style="height: 40px;text-align:  center; width: 140px;font-size: 15px"  type="submit" id="submit" name="submit" class="text-center btn btn-primary  btn-sm">Place Order</button> 
						 		</div>
						 	</div>
						 </div> 
					<div class="clear"></div>
					<?php } ?>
					</form> 
 
		</div>
</section>

