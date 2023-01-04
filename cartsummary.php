 <style type="text/css">
 	#story{
 		/*margin-top: -75px;*/
 		/*text-align: left;*/
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
 	width:70px;
 	}
 	.stot{
 		text-align: right;
 		font-size: 15px;
 		font-weight: bold;
 	} 
 	 .scrolly {
   /*width: auto;*/
    height:100%;
    /*border: thin solid black;*/
    overflow-x: hidden; 
    /*background-color: #eee;*/
    padding: 2px;
    /*overflow-y: hidden;*/
    margin-left: 0;
}

th{
	font-size: 10px;
	text-align: center;
}
 </style>
 
 <form id="contact-us" method="post" action="addcart.php?action=order" class="scrolly">
    <h2 align="center" class="page-header">Resumen de Pedido</h2>
 <?php 
 $remarks = isset($_GET['rem']) ? $_GET['rem'] : ''; 
 check_message();
 ?>
 <input type="hidden" name="rem" value="<?php echo $remarks; ?>">
	<table id="table" class="table table-responsive" style="font-size:10px;padding: 0px;font-weight:bolder;">
		<th>Comida</th>
		<th width="50">Precio</th>
		<th width="50">Qty</th>
		<th width="60">Sub-total</th>
		<th width="20">Accion</th>
			<?php
				$cart = 0;
				$subtotal = 0;

			        if (!empty($_SESSION['gcCart'])){   
			            $count_cart = count($_SESSION['gcCart']); 
				        for ($i=0; $i < $count_cart  ; $i++) { 

				        echo '<tr> 
				                <td>'.$_SESSION['gcCart'][$i]['meals'].'</td>
				                <td align="center">
				                	<input style="height:20px;font-size:15px;" type="hidden" name="price" id="'.$_SESSION['gcCart'][$i]['mealid'].'price"  value="'.$_SESSION['gcCart'][$i]['price'].'"/> '.$_SESSION['gcCart'][$i]['price'].'
				                </td>
				                <td align="center"><input style="height:25px;width:40px; font-size:15px;" type="number" min="1" name="qty" id="'.$_SESSION['gcCart'][$i]['mealid'].'qty" required class=" cartqty" data-id="'.$_SESSION['gcCart'][$i]['mealid'].'"   value="'.$_SESSION['gcCart'][$i]['qty'].'"/> </td>
				                <td align="center"> <output id="Osubtot'.$_SESSION['gcCart'][$i]['mealid'].'">'.$_SESSION['gcCart'][$i]['subtotal'].'</output></td>
				                <td><a class="btn btn-xs btn-danger" style="text-decoration:none;" href="addcart.php?action=delete&id='.$_SESSION['gcCart'][$i]['mealid'].'&rem='.$remarks.'"><i class="fa fa-trash"></i></a></td>
				             </tr>';   

				                    $cart += $_SESSION['gcCart'][$i]['qty'];
				                    $subtotal += $_SESSION['gcCart'][$i]['subtotal'];
				                    } 

 
				                          }  
			                          echo  '<tfoot>
											<tr>
												<td colspan="3" ><p class="stot">Total</p></td>
												<td style="font-size: 15px;"> &#8369 <span id="sum" class="stot">'. $subtotal.'</span></td>
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
						 		<label class="col-xs-4" style="font-size: 15px; text-align: center;" >Mesa No.</label>
						 		<div class="col-xs-3">
						 			<select class="" style="font-size: 20px;height: 100%; width: 50px; text-align: center;" name="tableno" id="tableno"  >   
					                          <?php
					                            //Statement
					                          $mydb->setQuery("SELECT * FROM `tbltable`  WHERE STATUS='Available'   order by TABLENO asc");
					                          $cur = $mydb->loadResultList();

					                        foreach ($cur as $result) {
					                          echo  '<option value='.$result->TABLENO.' >'.$result->TABLENO.'</option>';
					                          }
					                          ?> 
                                       </select>
						 		</div> 
						 		<div class="col-xs-4">
						 			 <button  style="height: 30px;text-align:  center; width: 140px;font-size: 15px"  type="submit" id="submit" name="submit" class="text-center btn btn-primary  btn-xs">Realizar Pedido</button> 
						 		</div>
						 	</div>
						 </div> 
					<div class="clear"></div>
					<?php } ?>
					</form> 
					<hr>

