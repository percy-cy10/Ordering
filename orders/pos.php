
	<?php
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }


		// check_message();
			
    ?>
 <style type="text/css">
 .scrolly {
   /*width: auto;*/
    height:268px;
    /*border: thin solid black;*/
    overflow-x: hidden; 
    background-color: #eee;
    padding: 2px;
    /*overflow-y: hidden;*/
} 
 .scrollorder {
   /*width: auto;*/
    height:450px;
    /*border: thin solid black;*/
    overflow-x: hidden; 
    /*overflow-y: hidden;*/
} 
.page-header{
    font-size: 25px;
    font-weight: bold;
    margin-left: 0;
    margin-top: 90px;
}


 </style>
<form class="form" action="controller.php?action=add" method="POST"> 
<!-- orders -->
    <div class="col-lg-4">
    	<div class="col-lg-12">
    		<div class="row">
    			<div class="page-header">
    				List of Orders 
    			</div> 
                    <div id="reload" class="scrollorder">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr> 
                                    <th>Order No.</th> 
                                    <th>Table No.</th>
                                    <th>Cater</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                   $remarks = isset($_GET['rem']) ? $_GET['rem'] : "" ;
                                    $query = "SELECT * FROM `tblorders` o , `tblusers` u
                                         WHERE  o.`USERID` = u.`USERID` AND STATUS='Pending' AND u.`USERID`='".$_SESSION['WAITER_USERID']."' GROUP BY ORDERNO ORDER BY ORDERID ASC ";
                                    $mydb->setQuery($query);
                                    $cur = $mydb->loadResultList();

                                    foreach ($cur as $result) { 
                                    echo '<tr>'; 
                                    echo '<td><a href="index.php?view=POS&orderno='.$result->ORDERNO.'&tableno='.$result->TABLENO.'&rem='.$result->REMARKS.'" >'.$result->ORDERNO.'</a></td>'; 
                                    echo '<td align="center">'.$result->TABLENO.'</td>';
                                    echo '<td>'.$result->FULLNAME.'</td>';
                                    echo '<td>'.$result->REMARKS.'</td>';
                                    echo '</tr>';
                                 
                                    } 
                                ?> 
                            </tbody>
                        </table>
                </div>
            </div> 
    	</div> 
    </div>
<!-- end orders -->
 	<!-- SUMARRY -->
 	<div class="col-lg-8" style="border-left: 1px solid #ddd">
    	<div class="col-lg-12">
    	<!-- order details -->
    		<div class="row">
    			<div   style="font-size: 24px;font-weight: bold;margin-top: 90px;">
    				Order Details 
    				<small><?php echo isset($_GET['tableno']) ? " for Table Number ". $_GET['tableno'] : "" ?> <?php echo isset($_GET['rem']) ? "/ ". $_GET['rem'] : "" ?></small>
                    <span style="font-size: 15px;"><?php echo isset($_GET['orderno']) ?  '<a href="addmeal.php?view=addmeal&orderno='.$_GET['orderno'].'&tableno='.$_GET['tableno'].'&rem='.$remarks.'" data-toggle="lightbox" style="text-decoration: none;" class="btn btn-sm btn-primary" data-title="<b>Add Meal</b>">Add Meal</a>' : ''; ?></span>
    				<p style="text-align: right;font-size: 19px; margin-left: 50px; margin-bottom: 5px;">Order Number:<b style="text-decoration: underline;"> <?php echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?></b>
    					<input type="hidden" name="ORDERNO" id="ORDERNO"   value="<?php echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?>">
                        <input type="hidden" name="tableno" id="tableno"   value="<?php echo isset($_GET['tableno']) ?  $_GET['tableno'] : "NONE" ?>">
                         <input type="hidden" name="REMARKS" id="REMARKS"   value="<?php echo isset($_GET['rem']) ?  $_GET['rem'] : "" ?>">
    				</p>
    			</div>
                <div id="showmeal">
    			<div class="scrolly">
    			<table id="table" class="table table-hover" style="font-size: 12px" >
    				<thead style="font-size: 15px;">
    					<tr> 
    					    <th>Meal</th>
							<th width="60">Price</th>
							<th style="text-align: center;" width="50">Qty</th>
							<th width="100">Sub-total</th>
							<th style="text-align: center;" width="30">Action</th>
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
						  		echo '<td style="font-size:15px;">'.$result->DESCRIPTION.'</td>';
						  		echo '<td style="font-size:15px; width:80px;">&#8369 <input type="hidden" id="'.$result->ORDERID.'orderprice" value="'.$result->PRICE.'" >'.number_format($result->PRICE,2).'</td>';
						  		echo '<td style="font-size:15px;"><input type="number" min="1" class="orderqty" data-id="'.$result->ORDERID.'" id="'.$result->ORDERID.'orderqty" value="'.$result->QUANTITY.'" style="width:50px"></td>';
						  		echo '<td style="font-size:15px;"> <output style="font-size:15px; text-align:center;" id="Osubtot'.$result->ORDERID.'">'.$result->SUBTOTAL.'</output></td>';
						  		// echo '<td></td>';
                                echo '<td><a title="Cancel Order" class="btn btn-sm btn-danger" style="text-decoration:none; text-align:center;" href="controller.php?action=delete&id='.$result->ORDERID.'&rem='.$result->REMARKS.'"><i style="font-size:15px;" class="fa fa-trash-o"></i></a></td>';
						  		echo '</tr>';

						  		$total += $result->SUBTOTAL; 

						  	 
						  		} 
    						}
					  		
				  		?>  
    				</tbody>
    			</table> 
    			</div> 
    		<!-- <hr/> -->
    		<!-- end order details -->
    		<!-- summary -->  
    			<table class="table table-bordered" >
    				<thead>
    					<tr>
    						<th>Total</th>
    						<th><input type="text" id="totamnt"  readonly="true" value="<?php echo number_format($total,2); ?>">
    						<input type="hidden" name="totalamount" id="totalamount"   value="<?php echo $total; ?>"></th>
    					</tr> 
    				</thead>
    			</table>
    		<!-- 	<div>
    				<button type="submit" name="save" class="btn btn-primary fa fa-save" id="save"> SAVE</button>
                    <a target="_blank" href="tempreceipt.php?orderno=<?php echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?>" class="btn btn-primary fa fa-print"> Print</a>
    			</div> -->
    		</div> 
    		<!-- end summary -->
     	</div> 
    </div>
    </form>

 