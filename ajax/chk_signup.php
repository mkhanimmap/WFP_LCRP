<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';

$main = new Functions();

$username = isset($_REQUEST["name"])?$_REQUEST["name"]:"";

$act = isset($_REQUEST["act"])?$_REQUEST["act"]:"";


 
 if($act == "username")
 {
	$sql = "SELECT * FROM wfp_user WHERE username = '".$username."'";
	//aaaaa
	$num = $main->RunQuerySingle($sql);
	
	if(empty($num))
	 {
	  echo  1;
	 }
	else
	 {
	  echo 0;
	 }
  
 }
 
 $main->DB_close();
?>