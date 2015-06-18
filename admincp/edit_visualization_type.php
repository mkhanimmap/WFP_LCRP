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


if(isset($_REQUEST["btn_add"]))
	 {
	 	$name = isset($_POST["name"])?$_POST["name"]:"";
		$country = isset($_POST["country"])?$_POST["country"]:"";
		$visualization_url = isset($_POST["visualization_url"])?$_POST["visualization_url"]:"";
		$default_select = isset($_POST["default_select"])?1:0; 
		
	 	if(!empty($name))
	 	{
	 		if($default_select == 1)
			 {
				 $arrd = array (	
					"default_select" => 0
					);

			  	$ins_id_d = $Fun->UpdateRec('wfp_visualization_type',"country_id=".$country, $arrd);
			 }
	 	
		$arrValue = array (	
					"name" => $name,
					"country_id" => $country,
					"visualization_url" => $visualization_url,
					"default_select" => $default_select,
					"status" => 1
					);

			 $ins_id = $Fun->UpdateRec('wfp_visualization_type',"id=".$Fun->d($stid), $arrValue);
			 
			if($ins_id)
			{
				header("location:manage-visualization-type.php?msg=".$Fun->e('2'));
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
	 			$mss  .="Visualization type can not be blank.<br/>";
	 		}
	 	}
     }
     
     
     $sql  = "SELECT * from wfp_visualization_type WHERE  id =".$Fun->d($stid);
     $row = $Fun->RunQuerySingleObj($sql);
     
     $id = !empty($row->id)? $row->id:"";
     $name = !empty($row->name)? $row->name:"";
	 $country = !empty($row->country_id)? $row->country_id:"";
	 $visualization_url = !empty($row->visualization_url)? $row->visualization_url:""; 
	 $default_select = !empty($row->default_select)? "checked":"";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script language="javascript"  src="../js/default.js"></script>
<script language="javascript"  src="../js/candidate.js"></script>
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
							   <a href="javascript:history.back()"  class="button">Back</a>

                            </td>
                          </tr> 
                        <tr class="mainhead">
                          <td colspan="5" align="left"><h1>Edit visualization type</h1></td>
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
                           <table width="100%">
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Visualization Type</span></td>
                              <td width="51%">&nbsp;<input type="text" name="name" id="name" class="txtin" value="<?php echo $name?>" /></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Country</span></td>
                              <td width="51%">&nbsp;<?php
                                echo $Fun->getDD('country','wfp_country','','name',' where status=1',$country);
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Visualization url</span></td>
                              <td width="51%">&nbsp;<input type="text" name="visualization_url" id="visualization_url" class="txtin" value="<?php echo $visualization_url?>" /></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Default</span></td>
                              <td width="30%">&nbsp;
                               <input type="checkbox" name="default_select" id="default_select" <?php echo $default_select;?> />
                              </td>
                              <td width="49%">&nbsp;</td>
                             </tr>
                            <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td><input type="submit" name="btn_add" id="btn_add" value="Save" />&nbsp;&nbsp;
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