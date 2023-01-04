<?php

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=".date('M-d-Y')."_Sales_Report.xls");  
header("Pragma: no-cache"); 
header("Expires: 0"); 
?>
  <?php
  require_once("../../include/initialize.php");
   //admin_confirm_logged_in();
  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/login.php");
     } 
  ?>  
  <!-- <style type="text/css"> @page { size: auto;  margin: 2mm; }</style> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php
                $query = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                $res = mysql_query($query) or die(mysql_error());
                $viewTitle = mysql_fetch_assoc($res);
                echo $viewTitle['Title'];
            ?></title>
   </title> <!-- 
 <link rel="stylesheet" type="text/css" href="<?php echo web_root;?>css/bootstrap.min.css"> -->
 
<style type="text/css">
* {

}
    #wrap{
        width: 100%;
        margin-top: 0px;
    }

    @media print {
     .mytblprint {page-break-after: always;}
    }
    .tbl {
        width: 100%;
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
    }
    .tbl tr td  {
  /*      border: 1px solid #eee;
        padding: 0px;
        margin: 0px;*/
        border-bottom: 1px solid #eee;
    }
</style>

</head>

 
<body onload="window.print();"> 
 <h2 align="center"><?php
                $query = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                $res = mysql_query($query) or die(mysql_error());
                $viewTitle = mysql_fetch_assoc($res);
                echo $viewTitle['Title'];
            ?></h2>
    <h2 align="center">Sales Report</h2>
    <p  style="font-size:25px;text-align: center;">
    Inclusive Dates <?php echo ($_POST['datefrom']!="mm/dd/yy") ? "From : " .date_format(date_create($_POST['datefrom']),"m/d/Y"): "mm/dd/yy" ?> | <?php echo ($_POST['dateto']!="mm/dd/yy") ? "To : " .date_format(date_create($_POST['dateto']),"m/d/Y") : "mm/dd/yy" ?></p></div> 
    
        <table class="tbl mytblprint" border="1" style="width: 900px;padding: 0px;margin: 0px; text-align: center; "  >
        <thead>
            <tr style="font-weight: bold; padding: 5px;border: 1px #eee solid;">  
                <td style="font-size: 20px; width: 525px;">Order Number</td>
                <td style="font-size: 20px; width: 150px;">Total bill</td>
                <td style="font-size: 20px; width: 150px; ">Discount (20%)</td>
                <td>Senior ID</td>
                <td style="font-size: 20px; width: 150px;">Total Amount</td>
            </tr>

        </thead>
        <tbody>     
            <?php
            $price = 0;
            $qty = 0;
            $total = 0;
            $dateto ="";
            $datefrom = "";

            if($_POST['datefrom']!="mm/dd/yy" AND $_POST['dateto']!="mm/dd/yy"){ 


                $datefrom = date_format(date_create($_POST['datefrom']),'Y-m-d');
                $dateto = date_format(date_create($_POST['dateto']),'Y-m-d');

          

                $query="SELECT * FROM `tblpayments`  WHERE   DATE(`TRANSDATE`) >= '".$datefrom ."' AND DATE(`TRANSDATE`) <= '".$dateto."'";

                $mydb->setQuery($query);
                $row = $mydb->executeQuery();

                $maxrow = $mydb->num_rows($row);

                  if ($maxrow > 0) {
                   $cur = $mydb->loadResultList();
                //  # code...
                   foreach ($cur as $result) { 
                    echo '<tr  data-tt-id="1'.$result->ORDERNO.'" style="background-color:#00FF7F;">';
                    echo '<td style="font-weight:bold;">'.$result->ORDERNO.'</td>';
                    echo '<td style="font-weight:bold;">'.number_format($result->OVERALLTOTAL,2).'</td>';
                    echo '<td style="font-weight:bold;">'.number_format($result->DISCOUNTSENIOR,2).'</td>';
                    echo '<td>'.$result->SENIORID.'</td>';
                    echo '<td style="font-weight:bold;">'.number_format($result->TOTALPAYMENT,2).'</td>';  
                  echo '</tr>';
 
                     $price += $result->TOTALPAYMENT;
                     $qty   += $result->DISCOUNTSENIOR;
                     $total += $result->OVERALLTOTAL;


                                echo '<tr  data-tt-id="2" data-tt-parent-id="1'.$result->ORDERNO.'" style="background-color:#eee;">';
                                echo '<td colspan="2">Description</td>';  
                                echo '<td>Price</td>';
                                echo '<td>QUANTITY</td>';
                                echo '<td>Subtotal</td>';
                                echo '</tr>';
                      // echo '<table class="table table-bordered table-hover">';
                        $query="SELECT * FROM `tblorders` WHERE ORDERNO='".$result->ORDERNO."'"; 
                        $mydb->setQuery($query);
                        $row = $mydb->loadResultList();
                        // DESCRIPTION  PRICE   QUANTITY    SUBTOTAL    
                          foreach ($row as $res) {
                                echo '<tr data-tt-id="2" data-tt-parent-id="1'.$result->ORDERNO.'">';
                                echo '<td colspan="2">'.$res->DESCRIPTION.'</td>';
                                echo '<td>'.$res->PRICE.'</td>';
                                echo '<td>'.$res->QUANTITY.'</td>';
                                echo '<td>'.$res->SUBTOTAL.'</td>';
                                echo '</tr>';
                          }
                    // echo '</table>';
                  }  
                }else{
                    echo '<tr style="text-align:center;font-size:15px;">
                            <td  colspan="4" >No Records Available</td> 
                        </tr>';
                }

                }
             

            ?>
        </tbody>
 
        <tfoot>
            <tr style="font-size: 20px;">
                <td align="center" style="background-color: #E74C3C;color:#fff; font-weight: bolder;">TOTAL</td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($total,2);?></td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($qty,2)?></td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($price,2);?></td>
            </tr>
        </tfoot>
        </table>      

<!-- jQuery --> 
<script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

<script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script> 

<script type="text/javascript" src="<?php echo web_root; ?>admin/js/janobe.js" charset="UTF-8"></script>
<script src="<?php echo web_root; ?>js/jquery.treetable.js" type="text/javascript"></script>
 <script type="text/javascript"> 
$(".mytblprint").treetable();
</script>
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
 </center>
</body>
<footer>
    
</footer>
</html>