<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';

$main = new Functions();
$rs = "";

$username = isset($_REQUEST["username"])?$_REQUEST["username"]:"";
$pass = isset($_REQUEST["pass"])?$_REQUEST["pass"]:"";

if($username && $pass)
 {
	$sql = "Select * from wfp_user where username = '".pg_escape_string($username)."' and password = '".pg_escape_string($pass)."'";
		
	$val = $main->RunQuerySingle($sql);	
	
	if( !empty($val))
	{
		 $_SESSION['user_id'] = $val['id'];		
		 $rs = $_SESSION['user_id'];
	}
   
 }

 echo $rs;


?>