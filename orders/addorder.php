<?php
require_once("../../include/initialize.php");
 if (!isset($_SESSION['WAITER_USERID'])){
      redirect(web_root."login.php");
 }


?>   
<?php 
    $cart_value =0;
    if (isset($_SESSION['admin_gcCart'])) { 
        if (!empty($_SESSION['admin_gcCart'])){  

            $count_cart = count($_SESSION['admin_gcCart']);

            for ($i=0; $i < $count_cart  ; $i++) {  
                   $cart_value  +=  $_SESSION['admin_gcCart'][$i]['qty'];
            } 
        }
       } 

?>
    
<!-- Nav tabs --> 
<ul class="nav nav-pills">
    <li class="active"><a href="#home" data-toggle="tab">List of Meals</a>
    </li>
    <li>
      <a href="#profile" data-toggle="tab">
       <span class="fa fa-shopping-cart fw-fa"> 
          <div id="cartvalue" class="label label-danger"><?php echo $cart_value; ?></div>
       </span>
       <b id="addnotif"></b>
       </a>
    </li> 
</ul>

<!-- Tab panes  login panel-->
<div class="tab-content">
  <div class="tab-pane fade in active" id="home"> 
<!--     <form action="#">
      <fieldset>
        <input type="text" name="search" value="" id="id_search" placeholder="Search for Meals" autofocus />
      </fieldset>
    </form>
      <BR/> -->
      <div  id="resulttable">        
      <table id="dash-table2"  class="table table-striped table-bordered table-hover "  style="font-size:11px" cellspacing="0" >
           <thead>
            <tr>   
              <th>Meals</th>  
              <th width="100">Categories</th>  
              <th width="80">Price</th> 
              <th width="20"></th> 
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
              echo '<td> &#8369 '.  number_format($result->PRICE,2).'</td>';   
              echo '<td align="center">
                   <a  title="Add to Cart" class="btn btn-primary btn-xs addcartadmin" data-id="'.$result->MEALID.'">  <span class="fa fa-shopping-cart fw-fa"></a> </a></td>'; 
              echo '</tr>';
            } 
            ?>
          </tbody>
          
          
        </table> 
        </div>  
  </div>
  <!-- end login panel --> 
  <!-- sign in panel -->
  <div class="tab-pane fade" id="profile">
<style type="text/css"> 
  #table{
    font-size: 14px;
    padding: 0px;
  }

  #placeorder{
    width: 600px;
    font-size: 18px;
  }
  #placeorder label {
    margin-top: 5px;
  }
  #tableno { 
  height: 30px;
  width:100px;
  font-size: 12px;
  }
    #REMARKS { 
  height: 30px;
  width:100px;
  font-size: 12px;
  }
  .stot{
    text-align: right;
    font-size: 18px;
    font-weight: bold;
  } 
 </style>
 <br/>
<form id="contact-us" method="post" action="controller.php?action=addorder">  
<div id="cart">
<table id="table" class="table table-responsive">
<thead>
  <tr>
  <th>Meal</th>
  <th width="80">Price</th>
  <th width="80">Qty</th>
  <th width="80">Sub-total</th>
  <th width="20">Action</th>
  </tr>
</thead>
<tbody>
   <?php
          $cart = 0;
          $subtotal = 0; 
          if (!empty($_SESSION['admin_gcCart'])){   
            $count_cart = count($_SESSION['admin_gcCart']); 
              for ($i=0; $i < $count_cart  ; $i++) { 

                    echo  '<tr>'; 
                    echo  '<td>'.$_SESSION['admin_gcCart'][$i]['meals'].'</td>';
                    echo  '<td><input style="height:20px" type="hidden" name="price" id="'.$_SESSION['admin_gcCart'][$i]['mealid'].'price"  value="'.$_SESSION['admin_gcCart'][$i]['price'].'"/> '.$_SESSION['admin_gcCart'][$i]['price'].'</td>';
                    echo  '<td><input style="height:25px;width:50px" type="number" name="qty" id="'.$_SESSION['admin_gcCart'][$i]['mealid'].'qty" required class=" admincartqty" data-id="'.$_SESSION['admin_gcCart'][$i]['mealid'].'"   value="'.$_SESSION['admin_gcCart'][$i]['qty'].'" autocomplete="false"/> </td>';
                    // echo '<td>'.$_SESSION['admin_gcCart'][$i]['qty'].'</td>';
                    echo  '<td align="center"> <output id="Osubtot'.$_SESSION['admin_gcCart'][$i]['mealid'].'">'.$_SESSION['admin_gcCart'][$i]['subtotal'].'</output></td>';
                    echo '<td><a class="btn btn-xs btn-danger removecartadmin" style="text-decoration:none;" data-id='.$_SESSION['admin_gcCart'][$i]['mealid'].' ><i class="fa fa-shopping-cart"></i></a></td>';
                    echo  '</tr>';   

                        $cart += $_SESSION['admin_gcCart'][$i]['qty'];
                        $subtotal += $_SESSION['admin_gcCart'][$i]['subtotal'];
             } 


          }  
                // echo  '<tr>
                //             <td colspan="3" ><p class="stot">Total</p></td>
                //             <td> &#8369 <span id="sum" class="stot">'. $subtotal.'</span></td>
                //             <td>
                //           </tr>';


                          ?>  
   
  </tbody>
</table>
            <?php 
              if ($subtotal > 0) { 
             ?>

             <div id="placeorder">
              <div class="row" >
                <label class="col-xs-2"  style="height: 30px;text-align:  center; font-size: 13px">Table No.</label>
                <div class="col-xs-2"> 
                  <select style="font-size:15px;" name="tableno" id="tableno">  

                                  <?php 
                            //Statement

                        // $mydb->setQuery("SELECT * FROM `tbltable` where STATUS = 'Occupied' AND `RESERVEDDATE`='".date_create('Y-m-d')."' order by asc");
                        // $cur = $mydb->loadResultList();
                        //  foreach ($cur as $result) {
                 //                        echo  '<option value='.$result->TABLENO.' >'.$result->TABLENO.'</option>';
                        // }                            
                                      ?>
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

                   <div style="font-size:15px;" class="col-xs-2"> 
                  <select style="font-size:15px;" name="REMARKS" id="REMARKS">  
                    <option value="DineIn">Dine In</option>
                    <option value="TakeOut">Take Out</option>
                  </select>
                </div> 
                <div class="col-xs-2">
                   <button  style="height: 30px;text-align:  center; font-size: 12px"  type="submit" id="submit" name="submit" class="text-center btn btn-primary  btn-xs">Place Order</button> 
                </div>
              </div>
             </div> 
          <div class="clear"></div>
          <?php } ?>
           
</div> 
          </form>  


  </div> 
<!-- end panel sign up -->
</div>    
   <script type="text/javascript">  
    $(document).ready(function() {
    $('#dash-table2').DataTable({
                responsive: true ,
                  "sort": false,
                  "lengthChange" : false
        });
 
    });
   </script>  