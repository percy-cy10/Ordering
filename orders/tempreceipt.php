  <?php
  require_once("../../include/initialize.php");
   //admin_confirm_logged_in();
  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/login.php");
     } 
  ?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Print</title>
 

 <!-- Bootstrap Core CSS -->
    <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">



    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">


    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!--<link rel="icon" href="<?php echo web_root; ?>favicon-1.ico" type="image/x-icon"> -->

</head>


<?php
  @$orderno = isset($_GET['orderno']) ? $_GET['orderno'] : '';
@$query = "SELECT * FROM `tblorders` o , `tblusers` u
 WHERE  o.`USERID` = u.`USERID` AND `STATUS`='Pending' AND `ORDERNO` ='".$orderno."'";
@$mydb->setQuery($query);
@$cur = $mydb->loadSingleResult();
@$remarks = $cur->REMARKS;
?>
      
<body onload="window.print();">
 
 
<div id="wrapper">
<center>
    <div class="container">
        <div style="text-align: center;"><?php echo date('M-d/D-Y'); ?></div>
        <div style="text-align: center;font-size: 20px;">Customer's Order</div>
        <div><?php echo $remarks; ?> </div>
                 <tfoot>
                    <?php 
                        $total = 0;
                        $tableno = 0;

                            if (isset($_GET['orderno'])) {
                                # code...
                                $orderno = $_GET['orderno'];
                                $query = "SELECT * FROM `tblorders` o , `tblusers` u
                                 WHERE  o.`USERID` = u.`USERID` AND `STATUS`='Pending' AND `ORDERNO` ='".$orderno."'";

                                 $mydb->setQuery($query);
                                $cur = $mydb->loadResultList();

                                foreach ($cur as $result) {
                                $tableno = $result->TABLENO;
                             }
                         }
                             ?>
                      <tr style="text-align: center;">
                            <td colspan="2">Table No. <?php echo $tableno; ?> | </td>
                            <td>Order No. <?php echo $orderno; ?></td>
                        </tr>
                 </tfoot>                
       <table id="table" class="table" style="font-size: 12px;padding: 0; width: 570px;" >
                    <thead>
                        <tr> 
                            <th>Meal</th>
                            <th width="60" style="text-align: center;">Qty</th>
                            <th width="50" style="text-align: center;">Price</th>
                            <th width="100" style="text-align: center;">Sub-total</th> 
                        </tr> 
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        $tableno = 0;

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
                                echo '<td style="text-align: center;">'.$result->QUANTITY.'</td>';
                                echo '<td style="text-align: center;">'.$result->PRICE.'</td>';
                                echo '<td style="text-align: center;">'.$result->SUBTOTAL.'</td>'; 
                                echo '</tr>';

                                $total += $result->SUBTOTAL; 
                                $tableno = $result->TABLENO;
                             
                                } 
                            }
                            
                        ?>  
 
                <!-- summary -->  
               
                        <tr> 
                            <th colspan="3" style="text-align:right;">Total</th>
                            <th  width="100" style="text-align: center;"><?php echo number_format($total,2); ?></th>
                        </tr>
                 </tbody>
                </table>
            <!-- end summary -->
        
    </div>
            </center>
</div>
    <!-- /#wrapper -->


<!-- jQuery --> 
<script src="<?php echo web_root; ?>admin/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

<script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script type="text/javascript" src="<?php echo web_root; ?>admin/js/janobe.js" charset="UTF-8"></script>

    <script type="text/javascript">
    (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
        // console.log('Functionality to run after printing');
        // window.print();
        // window.close();
        window.location = "index.php";
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());
</script>
 
</body>
</html>