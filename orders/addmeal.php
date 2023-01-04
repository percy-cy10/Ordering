 <div>
<?php
require_once("../include/initialize.php");
//checkAdmin();
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }


$orderno = "";
$tableno = "";
	if (isset($_GET['orderno'])) {
		# code...
		$orderno = $_GET['orderno'];
	}
	if (isset($_GET['tableno'])) {
		# code...
		$tableno = $_GET['tableno'];
	}
   if (isset($_GET['rem'])) {
		# code...
		$remarks = $_GET['rem'];
	}


?> 
	<input type="hidden" name="orderno" id="orderno" value="<?php echo $orderno; ?>">
	<input type="hidden" name="tableno" id="tableno" value="<?php echo $tableno; ?>">
	<input type="hidden" name="rem" id="rem" value="<?php echo $remarks; ?>">  	
		 <table id="dash-table"  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0" >
					
				  <thead>
				  	<tr>  
						<th>Meals</th>  
						<th width="100">Categories</th>  
						<th width="70">Price</th> 
						<th width="20">Action</th> 
				  	</tr>	
				  </thead> 	

			  <tbody>
				  	<?php 
				  		$query = "SELECT * FROM `tblmeals` m , `tblcategory` c
           					 WHERE  m.`CATEGORYID` = c.`CATEGORYID` ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>';  
				  		echo '<td>'.$result->MEALS.'</a></td>';
				  		
				  		echo '<td>'. $result->CATEGORY.'</td>'; 
				  		echo '<td > &#8369 '.number_format($result->PRICE,2).'</td>';  

				  	 	echo '<td align="center" > 
				  	 	     <a title="Add Meal"  data-id="'.$result->MEALID.'" class="btn btn-primary btn-xs addmeal">  <span class="fa fa-plus fw-fa"></a></td>';
				  	 	 echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				 	
				</table>

	</div>
</div> 
 <script type="text/javascript">
  $(document).ready(function() {
    $('#dash-table').DataTable({
                responsive: true ,
                  "sort": false,
                  "lengthChange" : false
        });
 
	});

  $(document).ready(function(){
  	$(".addmeal").click(function(){ 
  		var id = $(this).data("id");
  		var orderno = $("#orderno").val();
  		var tableno = $("#tableno").val();
  		var remarks = $("#rem").val();
  		// alert(id);
  		$.ajax({
  			type : "POST",
  			url : "showmeals.php?orderno="+orderno+"&tableno="+tableno+"&rem="+remarks,
  			dataType : "text",
  			data :{mealid:id},
  			success : function(data){
  				// alert(data);
  				$("#showmeal").html(data);
  			}

  		});
  	});
  });
 </script> 