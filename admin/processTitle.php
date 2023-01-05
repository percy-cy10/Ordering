<?php
require_once ("../include/initialize.php");
	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
 
switch ($action) {
	case 'add' :
	
	doInsert();
	break;

 
	}

   
function doInsert(){
	if (isset($_POST['save'])) {
		# code...
		$title = $_POST['Title'];
		$query = "UPDATE `tbltitle` SET  `Title` ='{$title}' WHERE `TItleID`=1";
		$res = mysql_query($query) or die(mysql_error());
		if (isset($res)) {
			# code...
			message ("Title has been updated.","success");
			redirect('index.php');
		}
	}
 	
}

?>