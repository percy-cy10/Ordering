<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
                $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                 $mydb->setQuery($sql);
                $viewTitle = $mydb->loadSingleResult();
                echo $viewTitle->Title;
            ?>
        </title>
        <link rel="stylesheet" href="<?php echo web_root; ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo web_root; ?>css/main.css" media="screen" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo web_root; ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo web_root; ?>css/style-portfolio.css">
        <link rel="stylesheet" href="<?php echo web_root; ?>css/picto-foundry-food.css" />
        <link rel="stylesheet" href="<?php echo web_root; ?>css/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo web_root; ?>css/font-awesome.min.css" rel="stylesheet">
        <!--<link rel="icon" href="favicon-1.ico" type="image/x-icon">-->
          <link href="<?php echo web_root; ?>admin/css/ekko-lightbox.css" rel="stylesheet">
    </head>

    <body>

<?php 
    if (isset($_SESSION['gcCart'])) {
        # code... 

        if (!empty($_SESSION['gcCart'])){  

            $count_cart = count($_SESSION['gcCart']);

            for ($i=0; $i < $count_cart  ; $i++) {  
                   @$cart_value  +=  $_SESSION['gcCart'][$i]['qty'];
            } 
        }
       } 

?>

</style>
    <nav class="navbar navbar-default navbar-fixed-top"  role="navigation">
            <div class="container">
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo web_root;?>index.php" class="navbar-brand">   <?php
                        $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                 $mydb->setQuery($sql);
                $viewTitle = $mydb->loadSingleResult();
                echo $viewTitle->Title;
                    ?> </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">   
                             <li><a class="color_animation <?php echo (publiccurrentpage() == 'index.php') ? "navactive" : "";?>" href="<?php echo web_root ;?>index.php">Inicio</a></li>
                            <li><a class="color_animation  <?php echo (publiccurrentpage() == 'orders') ? "navactive" : "";?>" href="<?php echo web_root ;?>orders/">
                             Lista de Pedidos</a>
                            </li> 
                            <li><a class="color_animation">
                            <i class="fa fa-user"></i> Bienvenido <?php echo $_SESSION['WAITER_FULLNAME']; ?></a>
                            </li> 
                            <li><a class="color_animation " href="<?php echo web_root; ?>logout.php">| Salir <i class="fa fa-sign-out"></i></a></li> 
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['WAITER_FULLNAME']; ?> <b class="caret"></b></a>
                                <style type="text/css">
                                    .dropdown-menu > li { 
                                        width: 100px; 


                                        }   
                                        .dropdown-menu > li > a  { 
 
                                            font-size :15px;
                                        }                                                           }
                                </style>
                                <ul class="dropdown-menu" style="width: 100%;">
                                <li>
                                <a href="<?php echo web_root; ?>logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>

                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
        </nav>
 
         
        <?php 
         require_once $content; 
         ?> 
 


        <!-- ============ Footer Section  ============= -->

     <!--    <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center">&copy; Plaza Cafe 2017, Theme by <a href="https://themewagon.com/">ThemeWagon</a></p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Back to <a href="#top">TOP</a></p>
                </div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Built With Care By <a href="#" target="_blank">Us</a></p></div>
            </div>
        </footer>
 -->

        <script type="text/javascript" src="<?php echo web_root; ?>jquery/jquery.min.js"> </script>
        <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap.min.js" ></script>

        <script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="<?php echo web_root; ?>js/jquery-1.10.2.js"></script>      -->
        <script type="text/javascript" src="<?php echo web_root; ?>js/jquery.mixitup.min.js" ></script>
        <script type="text/javascript" src="<?php echo web_root; ?>js/main.js" ></script> 
        <script type="text/javascript" src="<?php echo web_root; ?>js/janobe.js" ></script> 
        <script src="<?php echo web_root; ?>admin/js/ekko-lightbox.js"></script>
        <script src="<?php echo web_root; ?>admin/js/lightboxfunction.js"></script> 
 

    </body>
</html>

<script type="text/javascript">
    
 
// for the event handler for the text quantity in the orderlist for the cashie side 
        $(document).on("keyup",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

             // alert(price)


            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 

                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });

        $(document).on("change",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

           // alert(price)
 
            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 
                  
                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });


$(document).on("click", ".orderqty", function () { 
  $(this).select();
 
}); 
</script>