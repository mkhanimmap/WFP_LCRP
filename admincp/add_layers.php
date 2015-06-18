<?php
//ngodb status
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();
$Fun->check_admin();
$msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:"";
$mss = "";
$level = isset($_POST["level"])?$_POST["level"]:"";
$cartodb_index = isset($_POST["cartodb_index"])?$_POST["cartodb_index"]:"";
$title = isset($_POST["title"])?$_POST["title"]:"";
$visualization_type_id = isset($_POST["visualization_type"])?$_POST["visualization_type"]:"";
$group_id = isset($_POST["group"])?$_POST["group"]:"";
$indicator = isset($_POST["indicator"])?$_POST["indicator"]:"";
$country = isset($_POST["country"])?$_POST["country"]:"";
$layer_type = isset($_POST["layer_type"])?$_POST["layer_type"]:"-1";

$parent = 0;


if(isset($_REQUEST["btn_add"]))
	 {
	 	if(!empty($title))
	 	{
	 	
		 	if($level == 2)
			 {
				 $parent = isset($_POST["parent"])?$_POST["parent"]:"";
			 }
			elseif($level == 3)
			 {
				 $parent = isset($_POST["first_child"])?$_POST["first_child"]:"";
			 }
			elseif($level == 4)
			 {
				 $parent = isset($_POST["second_child"])?$_POST["second_child"]:"";
			 }
	 	
		$arrValue = array (	
					"title" => $title,
					"layer_level_id" => $level,
					"parent_id" => $parent,
					"country_id" => $country,
					"visualization_type_id" => $visualization_type_id,
					"group_id" => $group_id,
					"layer_type" => $layer_type,					
					"cartodb_index" => $cartodb_index - 1,
					"indicator" => $indicator,
					"status" => 1
					);

			$ins_id = $Fun->Insert('wfp_layers', $arrValue);
			if($ins_id)
			{
				header("location:manage-layers.php?msg=".$Fun->e('1'));
				exit();
			}
			else
			{
				$mss  .="Record has been not added successfully.<br/>";
			}
		
	 	}
	 	else 
	 	{
	 		if(empty($title))
	 		{
	 			$mss  .="Title can not be blank.<br/>";
	 		}
	 	}
     }
	 
	 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.bpopup.min.js"></script>
<script language="javascript"  src="../js/default.js"></script>
<script language="javascript"  src="../js/layers.js"></script>
<style>
#element_to_pop_up { 
    background-color:#fff;
    border-radius:15px;
    color:#000;
    display:none; 
    padding:20px;
    min-width:400px;
    min-height: 180px;
}
.b-close{
    cursor:pointer;
    position:absolute;
    right:10px;
    top:5px;
}

</style>
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
                          <td colspan="5" align="left"><h1>Add layer</h1></td>
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
                           <table width="100%" >
                           <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Group</span></td>
                              <td width="51%"><?php
                                echo $Fun->getDD('group','wfp_group','class="txtin"','name',' where status=1','');
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            </tr> 
                            
                             <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Country</span></td>
                              <td width="51%"><?php
                                echo $Fun->getDD('country','wfp_country','onchange="getVT(this.value)" class="txtin"','name',' where status=1','');
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                             <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Visualization Type</span></td>
                              <td width="51%" id="td_VT"><?php
                                echo $Fun->getDD('visualization_type','wfp_visualization_type','class="txtin"','name',' where status=1','');
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Level</span></td>
                              <td width="51%"><?php
                                echo $Fun->getDD('level','wfp_layers_level','onchange="getParent(this.value);" class="txtin"','name',' where status=1','');
							   ?></td>
                              <td width="28%">&nbsp;</td>
                            <tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Layer Type</span></td>
                              <td width="51%">
                              	<select id="layer_type" name="layer_type">
                                 <option value="-1">Select layer type</option>
                                 <option value="1" <?php if($layer_type == 1)echo "selected";?>>Single selection</option>
                                 <option value="2" <?php if($layer_type ==2) echo "selected";?>>Multiple selection</option>
                                </select>
                              </td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr id="tr_parent">
                              <td>&nbsp;</td>
                              <td>Parent</td>
                              <td id="td_parent">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr id="tr_firstChild">
                              <td>&nbsp;</td>
                              <td>First child</td>
                              <td id="td_firstChild">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr id="tr_SecondChild">
                              <td>&nbsp;</td>
                              <td>Second child</td>
                              <td id="td_SecondChild">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr id="tr_title">
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Title</span></td>
                              <td width="51%">
                                <input type="text" name="title" id="title" class="txtin" value="<?php echo $title;?>" />
                              </td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">CartoDB Index</span></td>
                              <td width="51%">
                               <input type="text" name="cartodb_index" id="cartodb_index" class="txtin" value="<?php echo $cartodb_index;?>"  />
                              </td>
                              <td width="28%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="11%">&nbsp;</td>
                              <td width="10%"><span class="box_txt">Select Indicator</span></td>
                              <td width="51%">
                               <input type="hidden" name="indicator" id="indicator" class="txtin" value="<?php echo $indicator;?>" />
                               <input type="hidden" name="layer_id" id="layer_id" class="txtin" value="" />
                                 <button id="my-button" name="my-button" >Select Indicator</button>
                              </td>
                              <td width="28%">&nbsp;</td>
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
    <div id="element_to_pop_up">Content of popup</div>
</body>
</html>
<?php
$Fun->DB_close();
?>