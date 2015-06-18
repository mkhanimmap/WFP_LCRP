<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';

if( isset( $_SESSION['session_wfp_admin_id'] ) )
	{
		$_SESSION['session_wfp_admin_id'] = "";
		unset($_SESSION['session_wfp_admin_id']);
	}

    header("Location: index.php");
	exit();
?>