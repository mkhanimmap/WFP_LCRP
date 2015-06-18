<?php
define('MAIN',realpath('.'));
include MAIN.'/includes/config.php';
$cid = isset($_REQUEST["cid"])?$_REQUEST["cid"]:"";
if( isset( $_SESSION['user_id'] ) )
	{
		$_SESSION['user_id'] = "";
		unset($_SESSION['user_id']);
	}
	 header("Location: country.php?cid=".$cid);
?>

<?php    
	exit();
?>