<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();
$Fun->check_admin();
$msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:"";
$msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:"";
$mss = "";
$stid = isset($_REQUEST["stid"])?$_REQUEST["stid"]:"";

if(isset($_REQUEST["btn_passadd"]))
	 {
		
	 	$password = isset($_POST["password"])?$_POST["password"]:"";
		$cpassword = isset($_POST["cpassword"])?$_POST["cpassword"]:"";
		
	 	
	 	
		$arrValue = array (	
					"password" => $password					
					);

			 $ins_id = $Fun->UpdateRec('wfp_user',"id=".$Fun->d($stid), $arrValue);
			 
			if($ins_id)
			{
				header("location:manage-user.php?msg=".$Fun->e('2'));
				exit();
			}
			else
			{
				$mss  .="Record has been not updated successfully.<br/>";
			}
		
	 
	 	
     }
if(isset($_REQUEST["btn_add"]))
	 {
	 	$name = isset($_POST["name"])?$_POST["name"]:"";
		$email = isset($_POST["email"])?$_POST["email"]:"";
		$org = isset($_POST["org"])?$_POST["org"]:"";
		$allowDownload = isset($_POST["allowDownload"])?1:0;
		
	 	if(!empty($name))
	 	{
	 	
	 	
		$arrValue = array (	
					"name" => $name,
					"email" => $email,
					"allow_download" => $allowDownload,
					"org_id" => $org
					);

			 $ins_id = $Fun->UpdateRec('wfp_user',"id=".$Fun->d($stid), $arrValue);
			 
			if($ins_id)
			{
				header("location:manage-user.php?msg=".$Fun->e('2'));
				exit();
			}
			else
			{
				$mss  .="Record has been not updated successfully.<br/>";
			}
		
	 	}
	 	else 
	 	{
	 		if(empty($name))
	 		{
	 			$mss  .="user can not be blank.<br/>";
	 		}
	 	}
     }
     
     
     $sql  = "SELECT * from wfp_user WHERE  id =".$Fun->d($stid);
     $row = $Fun->RunQuerySingleObj($sql);
     
     $id = !empty($row->id)? $row->id:"";
     $name = !empty($row->name)? $row->name:"";
	 $org_id = !empty($row->org_id)? $row->org_id:"";
     $username = !empty($row->username)? $row->username:""; 
	 $email = !empty($row->email)? $row->email:""; 
	 $allow_download = !empty($row->allow_download)? "checked":""; 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script language="javascript"  src="../js/default.js"></script>
<script language="javascript"  src="../js/user.js"></script>
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
			    	<td width="180px" valign="top" id="leftnav">
						<?php include("side-menu.php");?>
                    </td>
			        <td valign="top" align="center">
                    	&nbsp;
                      <!--Main Contant Begin-->  
                       <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tbllisting">
                       <tr>

                          	<td colspan="5" align="right"   >
							   <a href="#"  class="button" id="luser" onclick="userChange()" style="display:none;">Edit User</a>  <a href="#" id="lpass"  class="button" onclick="passChange()">Edit Password</a>  <a href="javascript:history.back()"  class="button">Back</a>

                            </td>
                          </tr> 
                        <tr class="mainhead">
                          <td colspan="5" align="left"><h1>Edit User</h1></td>
                        </tr>
                       <?php 
						if($msg || $mss)
						 {
							if(!empty($msg))
								$msg = $Fun->d($msg);
							else
							 	$msg = $mss;
							  ?>
						  
						  <tr>

                          	<td colspan="5" align="left" valign="middle"  id="msg1" class="error1" >
							<?php echo  $msg;?></td>
                          </tr> 
                          <?php
						 }
						 ?>
                       <tr>

                          	<td colspan="5" align="left"   >
							   <div id="success" class="success" style="display:none;"></div>
                               <div id="err" class="error1" style="display:none;"></div>

                            </td>
                          </tr> 
					  	 
                        <tr>
                          <td colspan="5">&nbsp;
                           <form action="" method="post" name="frmadd" id="frmadd" enctype="multipart/form-data">
                           <input type="hidden" name="path" id="path" value="<?php echo FULL_PATH?>" />
                           <table width="100%" id="main">
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Username</span></td>
                              <td width="51%">&nbsp;<?php echo $username;?></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Full Name</span></td>
                              <td width="51%">&nbsp;<input type="text" name="name" id="name" class="txtin" value="<?php echo $name?>" /></td>
                              <td width="28%">&nbsp;</td>
                            </tr> 
                            
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Email</span></td>
                              <td width="51%">&nbsp;<input type="text" name="email" id="email" class="txtin" value="<?php echo $email?>" /></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Organization</span></td>
                              <td width="51%">&nbsp;<?php
                                echo $Fun->getDD('org','wfp_org','','name',' where status=1',$org_id);
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Allow download data</span></td>
                              <?php
                               
							  ?>
                              <td width="51%">&nbsp;<input type="checkbox" name="allowDownload" id="allowDownload" <?php echo $allow_download;?> /></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td><input type="submit" name="btn_add" id="btn_add" value="Update" />&nbsp;&nbsp;
                             <input type="button" name="btn_back" id="btn_back" value="Back" onClick="window.location.href='javascript:history.back()'" /></td>
                             <td>&nbsp;</td>
                            </tr>
                           </table>
                           
                           
                           </form>
                          <form action="" method="post" name="frmpass" id="frmpass" enctype="multipart/form-data">
                          <table width="100%" id="pass" style="display:none;">
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Password</span></td>
                              <td width="30%">&nbsp;<input type="password" name="password" id="password" class="txtin" value="" /></td>
                              <td width="49%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Confirm password</span></td>
                              <td width="30%">&nbsp;<input type="password" name="cpassword" id="cpassword" class="txtin" value=""  /></td>
                              <td width="49%">&nbsp;</td>
                            </tr>
                           
                            
                            <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td><input type="submit" name="btn_passadd" id="btn_passadd" value="Save" onclick="return chkPass()" />&nbsp;&nbsp;
                             <input type="button" name="btn_back" id="btn_back" value="Back" onClick="window.location.href='javascript:history.back()'" /></td>
                             <td>&nbsp;</td>
                            </tr>
                           </table>
                          </form>
                          </td>
                          
                      
                        </tr>
                        
                        <tr>
                          <td colspan="5">&nbsp;</td>
                          
                        
                        </tr>
                      
                      </table>
                      <!--Main Contant End-->  
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
<?php
$Fun->DB_close();
?>