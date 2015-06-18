<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$admin = new Functions();
$msg = "";

//print_r( $_SESSION );
$val = "";
$msg = "";
$username = isset($_POST["username"])?$_POST["username"]:"";
if(isset($_POST['btnLogin']))
{
	$password = isset($_POST["password"])?$_POST["password"]:"";
	 $sql = "Select * from wfp_admin where username = '".pg_escape_string($username)."' and password = '".pg_escape_string($password)."'";
		
	$val = $admin->RunQuerySingle($sql);	
	
	if( !empty($val))
	{
		 $_SESSION['session_wfp_admin_id'] = $val['id'];		
		 header("Location: main.php");	
	}
   else
    $msg = "Username/Password Is Incorrect";

	
}

$admin->DB_close();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js" type="text/javascript"></script>
<script src="../js/default.js" type="text/javascript" ></script>
<script src="../js/login.js" type="text/javascript"></script>
</head>
<body>

	<table cellspacing="0" cellpadding="0" class="maintbl" align="center">
		<tr>
			<td class="logo">
				Administration Panel</td>
		</tr>
		<tr>
			<td class="topnav" align="left">&nbsp;</td>
		</tr>
		<tr>
			<td class="middlearea" valign="top">
			<table cellspacing="0" cellpadding="10" width="100%" height="100%">
				<tr>
            		<td class="middlearea">
                    <form name="frm" method="post" action="">
                   	<table cellspacing="0" cellpadding="4" class="tbl" align="center">
                		<tr>
                    		<td colspan="3" class="mainhead">
                        	Login Area</td>
                   		</tr>
                        
                        <?php if($msg){?>
                    	<tr>
                          <td colspan="3"><div id="diverr" class="error1" ><?php echo $msg;?></div></td>
                   	    </tr>
                        <?php }?>
                       
                        <tr>
                    		<td>
                    	  		<div id="err" class="error1" style="display:none;"></div>                  	    
                            </td>
                   	    </tr>
                          
                        <tr>
                    	  <td width="112" align="right"><strong>User Name</strong></td>
                    	  <td width="208"><input type="text" name="username" id="username" class="txtin" value="<?php echo $username;?>"></td>
                    	  <td width="54">&nbsp;</td>
             			</tr>
                        
                         <tr>
                    	  <td width="112" align="right"><strong>Password</strong></td>
                    	  <td><input type="password" name="password" id="password" class="txtin"></td>
                    	  <td>&nbsp;</td>
             			</tr>
                        
                        <tr>
                      		<td></td>
                      		<td><input type="submit" name="btnLogin" id="btnLogin" value="Login" class="button"></td>
                      		<td>&nbsp;</td>
                   		</tr>
                    </table>
                   </form>
                   </td>
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