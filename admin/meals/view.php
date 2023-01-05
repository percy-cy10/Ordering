<?php  
      if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }
if(!$_SESSION['ADMIN_ROLE']=='Administrator'){
  redirect(web_root."admin/index.php");
}
    $MEALID = $_GET['id'];
    $meal = New Meal();
    $singlemeal = $meal->single_meal($MEALID);

   
     $category = New Category();
    $singlecategory = $category->single_category($singlemeal->CATEGORYID);
  ?>
<div class="container">
<div class="panel-body inf-content">
    <div class="row">
        <div class="col-md-4">
         <a class="MEALID" data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image" data-id="<?php echo $singlemeal->MEALID; ?>">
            <img alt="" style="width:500px; height:400px;>"
             title="Upload Image" class="img-circle img-thumbnail isTooltip" src="<?php echo $singlemeal->MEALPHOTO; ?>" data-original-title="Usuario"> 
         </a>  
        </div>
        <div class="col-md-6">
            <h1><strong>Detalles de Comida</strong></h1><br>
            <div class="table-responsive">
            <table class="table table-condensed table-responsive table-user-information">
                <tbody>
               
                    <tr>    
                        <td>
                            <strong style="font-size: 20px;">Comida</strong>
                        </td>
                        <td style="font-size: 20px;" class="text-primary">
                            <?php echo ': '.$singlemeal->MEALS; ?>     
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong style="font-size: 20px;">Categoria</strong>
                        </td>
                        <td style="font-size: 20px;" class="text-primary">
                            <?php echo ': '.$singlecategory->CATEGORY; ?>  
                        </td>
                    </tr>

                    <tr>        
                        <td>
                            <strong style="font-size: 20px;">Precio</strong>
                        </td>
                        <td style="font-size: 20px;" class="text-primary">
                            <?php echo ': S/. '.number_format($singlemeal->PRICE,2); ?> 
                        </td>
                    </tr>


                    
                                 
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
            

     <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type="button">×</button>

                  <h4 class="modal-title" id="myModalLabel">Cambiar imagen</h4>
                </div>

                <form action="controller.php?action=photos" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="rows">
                        <div class="col-md-12">
                          <div class="rows">
                            <div class="col-md-8">
                            <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                              <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> <input id="photo" name="photo" type="file">
                            </div>
                            <div class="col-md-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cerrar</button> <button class="btn btn-primary"
                    name="savephoto" type="submit">Subir foto</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

 