<?php 
  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
  }

  $autonum = New Autonumber();
    $res = $autonum->set_autonumber('userid');
?>
<style type="text/css">
  label{
    font-size: 20px;
  }
</style>
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Agregar nuevo usuario</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 
                   
                    <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "user_id">User Id:</label>

                      <div class="col-md-8"> --> 
                         <input id="user_id" name="user_id"  type="hidden" value="<?php echo $res->AUTO; ?>">
                    <!--   </div>
                    </div>
                  </div> -->           
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for="U_NAME">Nombres:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
<<<<<<< HEAD
                         <input class="form-control input-lg" id="U_NAME" name="U_NAME" placeholder="Nombres" type="text" value="">
=======
                         <input class="form-control input-lg" id="U_NAME" name="U_NAME" placeholder=
                            "User Fullname" type="text" value="">
>>>>>>> parent of b4d6a74 (Merge branch 'main' of https://github.com/percycondori/Ordering)
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
<<<<<<< HEAD
                      <label class="col-md-4 control-label" for="U_USERNAME">Nombre de Usuario:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-lg" id="U_USERNAME" name="U_USERNAME" placeholder="Nombre de Usuario" type="text" value="">
=======
                      <label class="col-md-4 control-label" for=
                      "U_USERNAME">Nombre de usuario:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-lg" id="U_USERNAME" name="U_USERNAME" placeholder=
                            "Account Username" type="text" value="">
>>>>>>> parent of b4d6a74 (Merge branch 'main' of https://github.com/percycondori/Ordering)
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "U_PASS">Password:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" minlength="2" value="">
                         <input class="form-control input-lg" id="U_PASS" min="3" name="U_PASS" placeholder="Digitar Contraseña" type="Password" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "U_ROLE">Role:</label>

                      <div class="col-md-8">
                       <select class="form-control input-lg" name="U_ROLE" id="U_ROLE">
                          <option value="Administrator"  >Administrador</option>
                          <option value="Cashier"  >Cajero</option> 
                          <option value="Waiter">Cliente</option> 
                        </select> 
                      </div>
                    </div>
                  </div>


            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                       <button style="width: 100%;" class="btn btn-primary btn-lg" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Guardar</button> 
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
                       </div>
                    </div>
                  </div>

               
        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>
       