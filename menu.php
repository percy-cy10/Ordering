<style type="text/css">
#menu {
    /*margin-top: -75px;*/
}

#portfolios {
    display: block;
    width: 100%;
    padding: 0 12px;
    margin-bottom: 0;
    text-align: center;
}
.forms {
    display: inline-block;
}
#portfolios .forms .item {
    /*display: none;*/
    display: inline-block;
    /*opacity: 0;*/
    width: 30%;
    vertical-align: top;
    margin-bottom: 25px;
    margin-right: 20px;
    color: black;
    font-size: 30px;
    text-align: center;
    width: 207px;
    background-color: #f1f1f1;
    border:.5px solid black;
    border-radius: 5px;
    padding:5px;
    text-align: center;
}

#portfolios  .forms .item h2 {
    font-size: 32px;
    padding: 10px;
}
#portfolios .forms  .item1 {
    display: none;
    opacity: 0;
    vertical-align: top;
    margin-bottom: 25px;
    margin-right: 20px;
    color: #fff;
    font-size: 30px;
    text-align: center;
    -moz-box-sizing: border-box;
}

#portfolios .forms .item a {
  display: inline-block;
  max-width: 100%;
  text-decoration: none;
}
#portfolios .forms .item img {
  max-width: 100%;
}

@media (min-width: 991px) {
    #portfolios .forms  .item:nth-child(5),
    #portfolios .forms .item:nth-child(6),
    #portfolios .forms .item:nth-child(7),
    #portfolios .forms .item:nth-child(8) {
    margin-bottom: 0;
    }
}
       #description {
        width: 100%;
        padding: 2px;
        color:black; 
       }

       .p p {
        font-size: 13px;
        font-weight: bold; 
        height: 30px;
        color:black;
        margin-top: 5px;
        }
       #description input {
        width: 60px;
        color: black;
        font-size: 18px;
       }
       #description button {
        /*color: darkred;*/ 
        /*font-size: 20px;*/
        margin-top: 3px;
        font-weight: bold;
       }
      
       .item img {
        width: 210px;
        height: 80px;
       }
       #description > .price {
            font-size: 20px;
            font-weight: bold;
       } 

       #wrap{
        margin-top: 60px;
        } 
         </style>
 <div class="row" id="wrap">
<div class="col-lg-8">
<?php 
    $remarks = isset($_GET['rem']) ? $_GET['rem'] : ''; 
?> 
                             <h2 align="center" class="page-header">Lista de Menus</h2> 

                                <?php echo check_message(); ?>  
                            <ul id="filter-list" class="clearfix">
                                <li><a style="text-decoration: none;" class="filter <?php echo (!isset($_GET['category']) || $_GET['category']=='ALL') ? 'navactive' : '' ?>"  href="<?php echo web_root ?>index.php?view=menu&category=ALL&rem=<?php echo $remarks ?>">Todo</a></li>

                            <?php 

                                $categ = isset($_GET['category']) ? $_GET['category'] : '';
                                $sql = "SELECT * FROM tblcategory";
                                $mydb->SetQuery($sql);
                                $cur = $mydb->loadResultList();

                                foreach ($cur as $result) {

                            ?>
                              <li ><a style="text-decoration: none;"  href="<?php echo web_root; ?>index.php?view=menu&category=<?php echo $result->CATEGORY ?>&rem=<?php echo $remarks ?>" class="filter <?php echo  ($result->CATEGORY==$categ) ?   "navactive" : ""  ?> " ><?php echo $result->CATEGORY; ?></a></li>  
                                 
                            <?php  } ?>
                                </ul><!-- @end #filter-list -->    
                            <ul id="portfolios">

                             <?php  

                                $category = isset($_GET['category']) ? $_GET['category'] : "ALL";

                                if($category=='ALL'){
                                    $sql = "SELECT * FROM tblmeals";
                                }else{
                                    $sql = "SELECT * FROM tblmeals WHERE CATEGORIES LIKE '%".$category."%'";
                                } 

                                $mydb->SetQuery($sql);
                                $cur = $mydb->loadResultList();

                                foreach ($cur as $result) {
                        echo '<form class="forms" action="addcart.php?action=add&category='.$category.'" method="POST"  id="contact-us">';
                            
                              echo '<input type="hidden" name="REMARKS" value="'.$remarks.'">';
                              echo '<li id="'.$result->CATEGORIES.'" class="item '.$result->CATEGORIES.'"><img style="height:150px;border:.5px dashed black;padding:3px; border-radius:5px;" src="'.web_root.'admin/meals/'.$result->MEALPHOTO.'" alt="Food" >
                                    <div class="p">
                                    <p class="white">'.$result->MEALS.'</p>
                                    </div>
                                    <div id="description">
                                    <div style="color:black; background-color:#fff;border:1px dashed black;margin-top:10px; padding:5px;" class="price white">&#8369 '.$result->PRICE.'</div>
                                    <input type="hidden" name="mealid" value="'.$result->MEALID.'"/>
                                    <input type="hidden" name="meals" value="'.$result->MEALS.'"/>
                                    <input type="hidden" name="price" value="'.number_format($result->PRICE,2).'"/>
                                    <input type="hidden" name="subtotal" value="'.$result->PRICE.'"/>
                                    <span style="font-size:15px; margin-top:5px;color:black;font-weight:bold">QTY:</span>
                                    <input type="number" min="1" name="qty" style="font-size:20px; margin-top:15px; width:55px; text-align:center; font-weight:bold;height:30px;" placeholder="1" value="1"/>
                                    </div>
                                    <button style="border:.5px solid black; width:100%; font-size:18px; margin-top:5px;" title="Place Order" class="btn btn-success" type="submit" name="submit" >Order</button>
                                </li>';
                            echo '</form> ';
                           } ?>
                  
                            </ul><!-- @end #portfolios --> 
  
</div>

<div class="col-lg-4" style="border-left: solid 1px #ddd;">
    <?php include("cartsummary.php"); ?>
</div>
</div>
