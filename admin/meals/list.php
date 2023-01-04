<?php
   if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

		check_message(); 
		?> 
		 
		<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">Lista de Comidas  <a href="index.php?view=add" class="btn btn-primary btn-s  ">  <i class="fa fa-plus-circle fw-fa"></i> Agregar Comida</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
			    <form action="controller.php?action=delete" Method="POST">  	
			    <div class="table-responsive">				
				<table id="dash-table"  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0" >
					
				  <thead style="font-size: 18px;">
				  	<tr>  
				  		<th style="text-align: center;">Foto</th>  
				  		<th>Descripción de la Comida</th>
				  		<th>Categorias</th>  
				  		<th>Precio</th> 
				  		<th style="text-align: center;">Accion</th> 
				  	</tr>	
				  </thead> 	

			  <tbody>
				  	<?php 
				  		$query = "SELECT * FROM `tblmeals` m , `tblcategory` c
           					 WHERE  m.`CATEGORYID` = c.`CATEGORYID` ORDER BY CATEGORIES ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>';
				  		// echo '<td width="3%" align="center"></td>';
				    	echo '<td width="100px">
							<a class="MEALID" href="#" data-target="#menuModal"  data-toggle="modal"  data-id="'.$result->MEALID.'"> 
							<img  title="Change Photo" width="100px" height="40px" src="'.web_root.'admin/meals/'.$result->MEALPHOTO . '">
							</a></td>'; 	 
				  		echo '<td style="font-size:15px;">'.$result->MEALS.'</a></td>';
				  		
				  		echo '<td style="font-size:15px; width:100px">'. $result->CATEGORY.'</td>'; 
				  		echo '<td style="font-size:15px;" width="100px"> s/ '.  number_format($result->PRICE,2).'</td>';  

				  	 	echo '<td align="center" width="230px"> <a title="View Info" href="index.php?view=view&id='.$result->MEALID.'" class="btn btn-info btn-s  ">  <span class="fa  fa-info fw-fa "> Ver</a>
				  	 	     <a title="Edit" href="index.php?view=edit&id='.$result->MEALID.'" class="btn btn-primary btn-s  ">  <span class="fa fa-pencil fw-fa"> Editar</a>
				  		     <a title="Remove" href="controller.php?action=delete&id='.$result->MEALID.'" class="btn btn-danger btn-s  ">  <span class="fa  fa-trash-o fw-fa "> Remover</a></td>';
				  	} 
				  	?>
				  </tbody>
				</table>

				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><i class="fa fa-trash fw-fa"></i> Delete Selected</button>
				</div> -->
				</div>
				</form>
 
					 <div class="modal fade" id="menuModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">x</button>

                                    <h4 class="modal-title" id="myModalLabel">Imagen.</h4>
                                </div>

                                <form action="<?php echo web_root; ?>admin/meals/controller.php?action=photos" enctype="multipart/form-data" method=
                                "post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8"> 
                                                            <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                                                              <input name="MAX_FILE_SIZE" type="hidden" 
                                                              value="1000000"> 
                                                              <input id="photo" name="photo" type="file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Cerrar</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Subir foto</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->  

                