<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();
$Fun->check_admin();
$Fun->DB_close();
?>
<html>
<head>
<title>Administration Panel</title>
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
</head>
<body>
	<table cellspacing="0" cellpadding="0" class="maintbl" align="center">
		<tr>
			<td class="logo">Administration Panel</td>
		</tr>
        
		<tr>
			<td class="topnav" align="left">&nbsp;</td>
		</tr>
        
		<tr>
			<td class="middlearea" valign="top">
			<table cellspacing="0" cellpadding="10" width="100%" height="100%">
				<tr>
			    	<td width="180px" valign="top" id="leftnav"><?php include("side-menu.php");?></td>
			        <td valign="top" align="center"><h1>Welcome to administration panel</h1></td>
			    </tr>
			</table>
            </td>
		</tr>
		<tr>
			<td class="footer">&nbsp;</td>
		</tr>
	</table>
</body>
</html>