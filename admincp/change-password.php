<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();
$Fun->check_admin();
$message = ""; 
$error = "";

	$mss = "";
	$msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:"";
	
	if(isset($_POST["btn_update"]))
	 {
		 
		 $oldpassword = isset($_POST["oldpassword"])?$_POST["oldpassword"]:"";
		 $newpassword = isset($_POST["newpassword"])?$_POST["newpassword"]:"";
		 $confirmpassword = isset($_POST["confirmpassword"])?$_POST["confirmpassword"]:"";		 
		 
	
				 
			if($oldpassword != "" || $newpassword != "" || $confirmpassword !="")
			 {
				
				 $sql = "select id from wfp_admin where password ='".$oldpassword."' and id=".$_SESSION['session_wfp_admin_id'];
				 
				 $row = $Fun->RunQuerySingleObj($sql);
				 
				
				 if(!empty($row))
				  {
					  if($newpassword == $confirmpassword)
					  {
						  
						  $arrAppPDUp = array (	
						"password" => $newpassword
						);
				 
				 	   $up_AppPD_id = $Fun->UpdateRec('wfp_admin',"id=".$_SESSION['session_wfp_admin_id'], $arrAppPDUp);
						  
						  
						  if($up_AppPD_id)
							$mss = "Password has been changed successfully. ";   
						   else
						   $mss = "Error while updating admin password."; 
					  }
					 else
					  {
						  
						  $mss = "Password mismatch.";
					  }
				  }
				 else
				 {
					 $mss = "Incorrect old Password";
				 }
		     }
		 
		 
	
		 
	 }
	
?>
<html>
<head>
<title>Administration Panel</title>
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script src="../js/default.js" type="text/javascript"></script>
<script src="../js/password.js" type="text/javascript"></script>
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
			    	<td width="180px" valign="top" id="leftnav"><?php include("side-menu.php");?></td>
			        <td valign="top" align="center">
                    <form name="frm" method="post">
                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tbllisting">
                    	<tr class="mainhead">
                    	  <td width="18%">&nbsp;</td>
                    	  <td colspan="2" align="center"><h1>Change Password</h1></td>
                    	  <td width="32%">&nbsp;</td>
                  	  	</tr>
                        <tr >
                    	  <td width="18%">&nbsp;</td>
                    	  <td colspan="2" align="center">&nbsp;</td>
                    	  <td width="32%" align="right" ><a onClick="window.location.href='main.php'" style="cursor:pointer;">Back</a>&nbsp;&nbsp;</td>
                  	  	</tr>
                    	 <?php 
						if($msg || $mss)
						 {
							if(!empty($msg))
								$msg = $Fun->decrypt($msg);
							else
							 	$msg = $mss;
							  ?>
						  
						  <tr>

                          	<td colspan="4" align="left" valign="middle"  id="msg" >
							<?php echo  $Fun->getMsgTxt($msg);?></td>
                          </tr> 
                          <?php
						 }
						 ?>
						
                        
                         <tr>
                    	  <td colspan="4">
                    	    <div id="success" class="success" style="display:none;"></div>
                    	    <div id="err" class="error1" style="display:none;"></div>                  	    </td>
                   	    </tr>
                              
                    	<tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="22%" valign="top"><strong>Old Password:*</strong></td>
                    	  <td height="30" width="28%" valign="top"><input type="password" name="oldpassword" id="oldpassword" class="txtin"></td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
                        <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="22%" valign="top"><strong>New Password:*</strong></td>
                    	  <td height="30" width="28%" valign="top"><input type="password" name="newpassword" id="newpassword" class="txtin"></td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
                        <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="22%" valign="top"><strong>Confirm Password:*</strong></td>
                    	  <td height="30" width="28%" valign="top"><input type="password" name="confirmpassword" id="confirmpassword" class="txtin"></td>
             			  <td>&nbsp;</td>
                  	 	</tr>
					  
                    	<tr>
                    	  <td>&nbsp;</td>
                    	  <td>&nbsp;</td>
                    	  <td valign="top"><input type="submit" name="btn_update" value="Update" class="button" id="btn_update"></td>
                    	  <td>&nbsp;</td>
                  	    </tr>
                        
                    	<tr>
                    		<td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
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
<?php $Fun->DB_close();?>