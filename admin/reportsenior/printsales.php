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
<title>Sales Report</title>
 

 <!-- Bootstrap Core CSS -->
    <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="<?php echo web_root; ?>admin/css/sb-admin.css" rel="stylesheet"> -->


    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <!-- <link href="<?php echo web_root; ?>admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"> -->

    <!-- Morris Charts CSS -->
    <!-- <link href="<?php echo web_root; ?>admin/css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <link rel="icon" href="<?php echo web_root; ?>favicon-1.ico" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> 
<style type="text/css">
    #wrap{
        width: 100%;
        margin-top: 0px;
    }
</style>

</head>

 
<body onload="window.print();"> 
<div id="wrap">
<div id="container">
    <div class="page-header"><h1 align="center">Plazacafe</h1>
    <h4 align="center">Sales Report with Senior</h4>
    <p  style="font-size:15px;text-align: center;">
    Inclusive Dates <?php echo ($_POST['datefrom']!="mm/dd/yy") ? "From : " .date_format(date_create($_POST['datefrom']),"m/d/Y"): "mm/dd/yy" ?> <?php echo ($_POST['dateto']!="mm/dd/yy") ? "To : " .date_format(date_create($_POST['dateto']),"m/d/Y") : "mm/dd/yy" ?></p></div> 
    <center>
        <table class="table table-bordered table-hover" style="font-size: 10px; width: 700px;" >
        <thead>
            <tr bgcolor="skyblue" style="font-weight: bold; font-size: 15px;">  
                <!-- <td width="150">Order#</td> -->
                <td >Description</td>
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

            if($_POST['datefrom']!="mm/dd/yy" AND $_POST['dateto']!="mm/dd/yy"){ 


                $datefrom = date_format(date_create($_POST['datefrom']),'Y-m-d');
                $dateto = date_format(date_create($_POST['dateto']),'Y-m-d');

            // $query="SELECT ORDERNO,DESCRIPTION,PRICE,SUM(QUANTITY) as QTY,SUM(SUBTOTAL) as TOT FROM `tblorders` 
            //         WHERE `STATUS`='Paid' AND  DATE(`DATEORDERED`) >= '".$datefrom."' 
            //         AND DATE(`DATEORDERED`) <= '". $dateto."' GROUP BY DESCRIPTION";
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
                    echo '<tr> 
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

            }else{
                echo '<tr><td colspan="7" align="center"><h3>Please Enter The Dates</h3></td></tr>';

            }
             

            ?>
        </tbody>
        <tfoot>
            <tr style="font-size: 15px;">
                <td align="center">TOTAL</td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($price,2) ;?></td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($qty) ;?></td>
                <td width="100" style="background-color: #E74C3C;color:#fff; text-align: center; font-weight: bolder;"><?php echo number_format($total,2);?></td>
            </tr>
        </tfoot>
        </table>    
</div>
</div>

<!-- jQuery --> 
<script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

<script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script> 

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
 </center>
</body>
</html>