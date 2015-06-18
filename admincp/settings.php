<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.admin.php';

$Fun = new Functions();
$Fun->check_admin();


	
	if(isset($_POST['btn_edit']))
	{
		
			
			
			$title = isset($_POST["title"])?$_POST["title"]:"";
			$signup_subject = isset($_POST["signup_subject"])?$_POST["signup_subject"]:"";
			$signup_email = isset($_POST["signup_email"])?$_POST["signup_email"]:"";
			$forget_subject = isset($_POST["forget_subject"])?$_POST["forget_subject"]:"";
			$forget_email = isset($_POST["forget_email"])?$_POST["forget_email"]:"";	
		
		
		
			
			$objlogin->setsignup_subject($signup_subject);
			$objlogin->setsignup_email($signup_email);
			$objlogin->setforget_subject($forget_subject);
			$objlogin->setforget_email($forget_email);
			
			
			
				$sql_chg = $objlogin->Update('');
				
				if($objDB->query($sql_chg))
				{
					$msg=1;
					
				}
				else
				{
					$msg =2;
				}
		
	}
	

	 $pages->baseQry  = "select * from fpts_admin order by id desc";
	 $sql = $pages->getPagingQry();
	 $rows = $Fun->RunQuery($sql);
?>
<html>
<head>
<title>Administration Panel</title>
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script src="../js/default.js" language="javascript"></script>
<script src="../js/settings.js" language="javascript"></script>
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
                    <form name="frmsettings" id="frmsettings" method="post">
                      <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tbllisting">
                    	<tr class="mainhead">
                    	  <td width="9%">&nbsp;</td>
                    	  <td colspan="2" align="center"><h1>Site Settings</h1></td>
                    	  <td width="6%">&nbsp;</td>
                  	  	</tr>
                        <tr>
                    	  <td>&nbsp;</td>
                    	  <td valign="top">&nbsp;</td>
                    	  <td colspan="2" align="right" ><a href="change-password.php"><strong>Change Password</strong></a>&nbsp;&nbsp;</td>
                   	    </tr>
                    	<?php if($msg){?>
                    	
                    	<tr>
                    	  <td>&nbsp;</td>
                    	  <td valign="top">&nbsp;</td>
                          
                    	  <td id="txt_msg">
						  	
							
                            <?php 
							if(!empty($msg_txt))
								echo $fun->getMessage($msg_txt);
							else
							 echo "&nbsp;";
							
							?>
							
							
                          </td>
                    	  <td>&nbsp;</td>
                  	 	</tr>
                        <?php }?>
                        
                        <?php if($message){?>
                    	<tr>
                    	  <td>&nbsp;</td>
                    	  <td valign="top">&nbsp;</td>
                    	  <td class="success"><?php echo $message;?><div id="diverr" style="display:none;"></div></td>
                    	  <td>&nbsp;</td>
                  	 	</tr>
                        <?php }?>
                       
                        <tr>
                    	  <td colspan="4">
                    	    <div id="success" class="success" style="display:none;"></div>
                    	    <div id="err" class="error1" style="display:none;"></div>                  	    </td>
                   	    </tr>
                        
                              
                    	
                        
                        <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="20%" valign="top"><strong>Forget Subject:</strong></td>
                    	  <td height="30" width="65%" valign="top"><input type="text" name="forget_subject" id="forget_subject" class="txtin" value="<?php echo $row["forget_subject"] ?>"></td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
                         <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="20%" valign="top"><strong>Email text when user has requested password:</strong></td>
                    	  <td height="30" width="65%" valign="top">
                          <textarea name="forget_email" id="forget_email" class="txtin1" rows="5" cols="50"><?php echo  $row["forget_email"] ?></textarea>
                          </td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
                        <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="20%" valign="top"><strong>Signup Subject:</strong></td>
                    	  <td height="30" width="65%" valign="top"><input type="text" name="signup_subject" id="signup_subject" class="txtin" value="<?php echo $row["signup_subject"] ?>"></td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
                         <tr>
                    	  <td height="30">&nbsp;</td>
                    	  <td height="30" width="20%" valign="top"><strong>Email text when user has Signup:</strong></td>
                    	  <td height="30" width="65%" valign="top">
                          <textarea name="signup_email" id="signup_email" class="txtin1" rows="5" cols="50"><?php echo $row["signup_email"]?></textarea>
                          </td>
             			  <td>&nbsp;</td>
                  	 	</tr>
                        
					  
                    	<tr>
                    	  <td>&nbsp; </td>
                    	  <td>&nbsp;</td>
                    	  <td align="left" valign="top">
                           <input type="submit" name="btn_edit" value="Update" id="btn_edit" class="button">&nbsp;&nbsp;
                           </td>
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
			</table></td>
		</tr>
		<tr>
			<td class="footer">&nbsp;</td>
		</tr>
	</table>
</body>
</html>
<?php
$Fun->DB_close();
?>