<?php 
	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>

<style type="text/css"> 
#wrap{
	width: 100%;
	margin-top: 15px;
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

<form method="POST" action=""  >
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
	<div class="page-header"><h1 align="center">Plazacafe</h1>
	<div id="wrap">
	<h3 align="center">Sales Report with Senior</h3>
    <p  style="font-size:15px;text-align: center;">
    Inclusive Dates <?php echo isset($_POST['date_pickerfrom']) ? "From : " .$_POST['date_pickerfrom'] : "mm/dd/yy" ?> <?php echo isset($_POST['date_pickerfrom']) ? "To : " .$_POST['date_pickerto'] : "mm/dd/yy" ?></p></div>
		<div class="wrap-content">
			<label class="item" >Date From:</label>
			<input id="datefrom" class="item date_pickerfrom validate_date" type="" name="date_pickerfrom" autocomplete="off" placeholder="mm/dd/yyyy" required>
		</div>
		<div class="wrap-content">
			<label class="item" >Date To:</label>
			<input id="dateto" class="item date_pickerto validate_date" type="" name="date_pickerto" autocomplete="off" placeholder="mm/dd/yyyy" required> 
		</div>
		<div class="wrap-content"> 
			<label class="item" ></label>
			<button class="item btn btn-primary btn-sm submit" type="submit" name="submit">View Report</button>   
		</div> 
    <div id="validaterecord"></div>
    <center>
		<table class="table table-bordered table-hover" style="font-size: 10px; width: 700px; box-shadow: 10px 10px 5px #888888;" >
		<thead>
			<tr bgcolor="skyblue" style="font-weight: bold; font-size: 15px;">  
				<!-- <td width="150">Order#</td> -->
				<td>Description</td>
				<td width="100" align="center">Price</td> 
				<td width="100" align="center">Quantity</td>
				<td width="100" align="center">Sub-total</td>
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
			$query="SELECT o.ORDERNO,DESCRIPTION,PRICE,SUM(QUANTITY) as QTY,SUM(SUBTOTAL) as TOT FROM `tblorders` o, `tblpayments` p
			        WHERE o.`ORDERNO`=p.`ORDERNO` AND `STATUS`='Paid'  AND `DISCOUNTSENIOR`!=0 AND  DATE(`DATEORDERED`) >= '".$datefrom ."' 
			        AND DATE(`DATEORDERED`) <= '".$dateto."' GROUP BY DESCRIPTION";

				$mydb->setQuery($query);
				$row = $mydb->executeQuery();

				$maxrow = $mydb->num_rows($row);

				if ($maxrow > 0) {
				$cur = $mydb->loadResultList();
					# code...
					foreach ($cur as $result) {
					# code...
					echo '<tr style="font-size:12px;"> 
							<td>'.$result->DESCRIPTION.'</td>
							<td align="center">'.number_format($result->PRICE,2).'</td>
							<td align="center">'.number_format($result->QTY) .'</td> 
							<td align="center">'.number_format($result->TOT,2).'</td> 
						 </tr>';

					 $price += $result->PRICE;
					 $qty   += $result->QTY;
					 $total += $result->TOT;
					 }  
				}else{
					echo '<tr style="text-align:center;font-size:15px;">
							<td  colspan="4" >No Records Available</td> 
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
				<td width="100" style="background-color: #E74C3C; color:#fff; text-align: center; font-weight: bold;"><?php echo number_format($price,2) ;?></td>
				<td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bold;"><?php echo number_format($qty) ;?></td>
				<td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bold;"><?php echo number_format($total,2);?></td>
			</tr>
		</tfoot>
		</table>   
	
</div>
</center>
</form>
	<div class="row">
			<div class="col-md-12">
				<div class="col-md-2"> 	
				<form method="POST" action="printsales.php">
					<input type="hidden" name="datefrom" value="<?php echo isset($_POST['date_pickerfrom']) ? $_POST['date_pickerfrom'] : "mm/dd/yy" ?>">
					<input type="hidden" name="dateto" value="<?php echo isset($_POST['date_pickerto']) ? $_POST['date_pickerto'] : "mm/dd/yy" ?>">
			
				<button  type="submit"  class="btn btn-primary"><i class="fa fa-print"></i> Print Report</button>
		     	</form>
	 			</div>
	 		</div>
		</div>