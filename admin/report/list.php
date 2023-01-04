<?php 
	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>

<style type="text/css"> 

#wrap{
	width: 100%;
	text-align: center;
}
.wrap-content{ 
    width: 100%; 
    text-align: center;
}
.wrap-content input {  
    margin-bottom: 5px; 
    font-size: 15px; 
    width: 220px; 
}

.wrap-content button { 
    margin-bottom: 5px;   
    font-size: 15px; 
    width: 220px; 
}
.wrap-content label {   
    margin-bottom: 5px; 
    font-size: 15px; 
    width: 100px; 
}
</style>

<form method="POST" action="">
<!-- <div class="col-lg-12">
	<div id="wrap">
		<div class="wrap-content">
			<label class="item" >Date From:</label>
			<input id="datefrom" class="item date_pickerfrom validate_date" type="" name="date_pickerfrom" autocomplete="off" placeholder="mm/dd/yyyy">
		</div>
		<div class="wrap-content">
			<label class="item" >Date To:</label>
			<input id="dateto" class="item date_pickerto validate_date" type="" name="date_pickerto" autocomplete="off" placeholder="mm/dd/yyyy"> 
		</div>
		<div class="wrap-content"> 
			<label class="item" ></label>
			<button class="item btn btn-primary btn-sm submit" type="submit" name="submit">Retrieve</button>   
		</div>
	</div> -->
 <div class="col-lg-12"> 
	<div class="page-header"><h1 align="center"><?php
                $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                 $mydb->setQuery($sql);
                $viewTitle = $mydb->loadSingleResult(); 
                echo $viewTitle->Title;
            ?></title>
 </h1></div>
	<div id="wrap">
	<h3 align="center">Sales Report</h3>
    <p  style="font-size:15px;text-align: center;">
    Dates: <?php echo isset($_POST['date_pickerfrom']) ? "From : " .$_POST['date_pickerfrom'] : "Month-Day-Year" ?> | <?php echo isset($_POST['date_pickerfrom']) ? " To : " .$_POST['date_pickerto'] : "Month-Day-Year" ?></p></div>
		<div class="wrap-content">
			<label class="item" >Date From:</label>
			<input id="datefrom" class="item date_pickerfrom validate_date" type="" name="date_pickerfrom" autocomplete="off" placeholder="Month-Day-Year" required>
		</div>
		<div class="wrap-content">
			<label class="item" >Date To:</label>
			<input id="dateto" class="item date_pickerto validate_date" type="" name="date_pickerto" autocomplete="off" placeholder="Month-Day-Year" required> 
		</div>
		<div class="wrap-content"> 
			<label class="item" ></label>
			<button class="item btn btn-primary btn-sm submit" type="submit" name="submit">View Report</button>   
		</div> 
    <div id="validaterecord"></div>
   
    <center>
    	
		<table class="table table-bordered table-hover mytbl" style="font-size: 10px; width: 700px; box-shadow: 10px 10px 5px #888888;" >
		<thead>
			<tr style="font-weight: bold; font-size:12px;">
				<td colspan="5" >
					<a href="#" id="expandAllTasks"><i class="btn btn-primary btn-xs">Expand All</i></a>
				    | <a href="#" id="expandable"><i class="btn btn-primary btn-xs">Collapse All</i></a>
				</td>
			</tr>
			<tr bgcolor="skyblue" style="font-weight: bold; font-size: 15px;">  
				<!-- <td width="150">Order#</td> -->
				<!-- <td>Description</td>
				<td width="100" align="center">Price</td> 
				<td width="100" align="center">Quantity</td>
				<td width="100" align="center">Sub-total</td> -->
				<td>Order Number</td>
				<td style="width: 130px;">Total Bill</td>
				<td style="width: 140px;">Discount (20%)</td>
                <td>Senior ID</td>
				<td style="width: 130px;">Total Amount</td>
			</tr>

		</thead>
		<tbody>		 
			<?php
			$price = 0;
			$qty = 0;
			$total = 0;
			$dateto ="";
			$datefrom = "";
			if(isset($_POST['submit'])){ 
				$datefrom = date_format(date_create($_POST['date_pickerfrom']),'Y-m-d');
				$dateto = date_format(date_create($_POST['date_pickerto']),'Y-m-d');
			// $query="SELECT ORDERNO,DESCRIPTION,PRICE,SUM(QUANTITY) as QTY,SUM(SUBTOTAL) as TOT FROM `tblorders` 
			//         WHERE `STATUS`='Paid' AND  DATE(`DATEORDERED`) >= '".$datefrom ."' 
			//         AND DATE(`DATEORDERED`) <= '".$dateto."' GROUP BY DESCRIPTION";


				if ($dateto!='Y-m-d' or $datefrom!='Y-m-d') {
					# code...
					$query="SELECT * FROM `tblpayments`  WHERE   DATE(`TRANSDATE`) >= '".$datefrom ."' AND DATE(`TRANSDATE`) <= '".$dateto."'";

				$mydb->setQuery($query);
				$row = $mydb->executeQuery();

				$maxrow = $mydb->num_rows($row);

				  if ($maxrow > 0) {
				   $cur = $mydb->loadResultList();
				// 	# code...
				   foreach ($cur as $result) { 
				   	echo '<tr style="font-size:15px; background-color:#F0F8FF;"  data-tt-id="1'.$result->ORDERNO.'">';
				   	echo '<td>'.$result->ORDERNO.'</td>';
				   	echo '<td>&#8369; '.number_format($result->OVERALLTOTAL,2).'</td>';
				   	echo '<td>&#8369; '.number_format($result->DISCOUNTSENIOR,2).'</td>';
				   	echo '<td>'.$result->SENIORID.'</td>';
				   	echo '<td>&#8369; '.number_format($result->TOTALPAYMENT,2).'</td>';  
				  echo '</tr>';

				// 	# code...
				// 	echo '<tr style="font-size:12px;"> 
				// 			<td>'.$result->DESCRIPTION.'</td>
				// 			<td align="center">'.number_format($result->PRICE,2).'</td>
				// 			<td align="center">'.number_format($result->QTY) .'</td> 
				// 			<td align="center">'.number_format($result->TOT,2).'</td> 
				// 		 </tr>';

					 $price += $result->TOTALPAYMENT;
					 $qty   += $result->DISCOUNTSENIOR;
					 $total += $result->OVERALLTOTAL;


					 			echo '<tr style="font-size:14px; background-color:#DCDCDC;"  data-tt-id="2" data-tt-parent-id="1'.$result->ORDERNO.'">';
							   	echo '<td colspan="2">Description</td>';  
							   	echo '<td>Price</td>';
							   	echo '<td>QUANTITY</td>';
							   	echo '<td>Subtotal</td>';
							   	echo '</tr>';
					  // echo '<table class="table table-bordered table-hover">';
				   		$query="SELECT * FROM `tblorders` WHERE ORDERNO='".$result->ORDERNO."'"; 
						$mydb->setQuery($query);
						$row = $mydb->loadResultList();
						// DESCRIPTION	PRICE	QUANTITY	SUBTOTAL	
						  foreach ($row as $res) {
						  		echo '<tr style="font-size:13px;" data-tt-id="2" data-tt-parent-id="1'.$result->ORDERNO.'">';
							   	echo '<td style="font-size:11px;" colspan="2">'.$res->DESCRIPTION.'</td>';
							   	echo '<td style="font-size:13px;">&#8369; '.number_format($res->PRICE,2).'</td>';
							   	echo '<td style="text-align:center; font-size:13px;">'.$res->QUANTITY.'</td>';
							   	echo '<td style="font-size:13px;">&#8369; '.number_format($res->SUBTOTAL,2).'</td>';
							   	echo '</tr>';
						  }
					// echo '</table>';
				  }  
				}else{
					echo '<tr style="text-align:center;font-size:15px;">
							<td  colspan="4" >No Records Available</td> 
						</tr>';
				}
				}else{
					echo '<tr style="text-align:center;font-size:15px;">
							<td  colspan="4" >Please enter the correct date. </td> 
						</tr>';
				}
				

				



			  }
			  // else{
			// 	echo '<tr><td colspan="7" align="center"></td></tr>';

			// }
			 

			?>
		</tbody>
		<tfoot>
			<tr style="font-size: 15px;">
				<td align="center" style="font-weight: bold;">TOTAL</td>
				<td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bold;">&#8369; <?php echo number_format($total,2);?></td>
				<td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bold;">&#8369; <?php echo number_format($qty,2) ;?></td>
				<td width="100" style="background-color: #E74C3C; color:#fff; text-align: center; font-weight: bold;">&#8369; <?php echo number_format($price,2) ;?></td>
			</tr>
		</tfoot>
		</table>   
	
</div>
</center>
</form>
	<div class="row">
			<div class="col-md-12">
				<div class="col-md-2"> 	
				<form method="POST" action="proccess.php">
					<input type="hidden" name="datefrom" value="<?php echo isset($_POST['date_pickerfrom']) ? $_POST['date_pickerfrom'] : "mm/dd/yy" ?>">
					<input type="hidden" name="dateto" value="<?php echo isset($_POST['date_pickerto']) ? $_POST['date_pickerto'] : "mm/dd/yy" ?>">
			
				<button style="font-size: 15px;" title="Export to Excel File"  type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Report</button>
		     	</form>
	 			</div>
	 		</div>
		</div>
 

<!--  <table class="mytbl">
  <tr data-tt-id="1">
    <td>Parent</td>
  </tr>
  <tr data-tt-id="2" data-tt-parent-id="1">
    <td>Child</td>
  </tr>
</table> -->