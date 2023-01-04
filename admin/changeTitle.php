<?php 
require_once("../include/initialize.php");
?>
<div class="container">
	 <div class="row"> 
	 	<div class="col-lg-6">
	 		<div class="row">
	 			<div class="col-md-12"> 
	 			<?php
	                $sql = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                 $mydb->setQuery($sql);
                $viewTitle = $mydb->loadSingleResult(); 
            	?>
	 			<form  class="form-horizontal  span6" action="<?php echo web_root ?>admin/processTitle.php?action=add" enctype="multipart/form-data" method="POST">
	 				<fieldset>
				          <div class="form-group">
				            <div class="col-md-10">
				              <label style="font-size: 20px;" class="col-md-4 control-label" for="Title">Title:</label>

				              <div class="col-md-8">
				              	<input name="" type="hidden" value="">
				                 <input style="font-size: 20px; width: 100%;" class="form-control input-lg" id="Title" name="Title" placeholder="Change title" type="text" value="<?php  echo $viewTitle->Title; ?>" required>
				              </div>
				            </div>
				          </div>   
				         <div class="form-group">
				            <div class="col-md-10">
				              <label class="col-md-4 control-label" for="idno"></label>
				              <div class="col-md-8">
				                <button style="width: 100%;" class="btn btn-primary btn-lg" name="save" type="submit" >Save</button>
				              </div>
				            </div>
				          </div>
					</fieldset>
					</form>
	 			</div>
	 		</div>
	 	</div>
	 	
</div><!--End of container-->