<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/pager-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();
$Fun->check_admin();
	
$pages = new Pager();

$pages->pageEnd = 20;	
$pages->pageSet = 15;

	$mss = "";
	$msg = isset($_REQUEST['msg'])?$_REQUEST['msg']:"";
	$pag = isset($_REQUEST["pagenum"]) && !empty($_REQUEST["pagenum"])?"&pagenum=".$_REQUEST["pagenum"]:"";
	$act = isset($_REQUEST['act'])?$_REQUEST['act']:"";
	$search = isset($_REQUEST['search'])?trim($_REQUEST['search']):"";
	$clear = isset($_REQUEST['btnclear'])?$_REQUEST['btnclear']:"";
	$uid = isset($_REQUEST["uid"])?$_REQUEST["uid"]:"";
   
	

    $search = "";
 	$qry  = "select * from wfp_user_country where user_id = ".$Fun->d($uid)." order by id desc";
 

 $pages->baseQry = $qry;
 $sql = $pages->getPagingQry();
 $rows = $Fun->RunQueryObj($sql);




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/admin.css"/>
<script language="javascript" src="../js/lib/jquery.js"></script>
<script language="javascript" src="../js/default.js"></script>
<script language="javascript" src="../js/user_country.js"></script>
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
			    	<td width="180px" valign="top" id="leftnav" align="left"><?php include("side-menu.php");?></td>
			        <td valign="top" align="center">
                    <form name="frmsearch" method="post">
                    <input type="hidden" name="path" id="path" value="<?php echo FULL_PATH?>" />
                    <input type="hidden" name="uid" id="uid" value="<?php echo $uid;?>" />
               		<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tbllisting">
                    	<tr class="mainhead">
                    		<td colspan="3">
                            	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td width="71%" align="left"><h1>Manage Privileges</h1></td>
                                    <td width="29%">&nbsp;</td>
                                 	<td width="29%">&nbsp;</td>
                                  </tr>
                                 </table>
                            </td>
                        </tr>
                      
                       <tr>

                          	<td colspan="3" align="right" valign="middle"  >
							<a href="javascript:history.back()">Back</a></td>
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

                          	<td colspan="3" align="left" valign="middle"  id="msg1" class="error1" >
						<?php echo  $Fun->getMsgTxt($msg); ?></td>
                          </tr> 
                          <?php
						 }
						 ?>
                         <tr>
                          <td colspan="3">
                           <div style="width:98%; display:none;" id="msgError" class="error1"></div>
                          </td>
                         </tr>
                        <tr >
                    		<td colspan="3">
                            	<table width="100%" cellpadding="0" cellspacing="0" height="50">
                                 <tr class="head" style=" background-color:#90d6dd;">
                                  <td width="104" style="padding-left:135px;">Country</td>
                                  <td width="169"><?php  echo $Fun->getDD('country','wfp_country','class="txtin"','name',' where status=1','');?></td>
                                <td width="527">  <input type="button" name="add" id="add" value="Add" onclick="addPrivilege()" /></td>
                                 </tr>
                                </table> 
                        </td>
                        </tr>
                        
					
					
                       
                      
                    	<tr class="head" id="last_row">
							<td width="5%"  align="center" valign="top" style="border-bottom:#d1d1d1 solid 1px;">#</td>
                            <td width="19%" align="left" valign="top" style="border-bottom:#d1d1d1 solid 1px;"><strong>Country Access</strong></td> 
                    	  	<td width="18%" align="center" valign="top" style="border-bottom:#d1d1d1 solid 1px;"><strong>&nbsp;Action</strong></td>
                        </tr>
                        <?php
						if(!empty($rows)){
                      
                     $j = 0;
                      	foreach($rows as $row){
							
							?>
                       	<tr <?php if($j%2==0){ echo 'bgcolor="#F2F2F2"'; }else{ echo 'bgcolor="#F2F2F2"'; }?> id="row_<?php echo $row->id;?>">
					    	<td valign="top" align="center" style="border-right:#d1d1d1 solid 1px;border-bottom:#d1d1d1 solid 1px;" >&nbsp;
							<?php echo $j+1;?></td>
                     		<td valign="top" align="left" style="border-right:#d1d1d1 solid 1px;border-bottom:#d1d1d1 solid 1px;" >&nbsp;
							<?php 
									echo $Fun->getField("name","wfp_country",$row->country_id);
								?>&nbsp;</td> 
								
                       
                       
                       
                      <td valign="top" align="center" style="border-bottom:#d1d1d1 solid 1px;">&nbsp; <span onclick="delUCountry('<?php echo $row->id;?>')" style="cursor:pointer; color:#000; font-weight:bold;">Delete</span>
                        
                                    
                       </td>
                    </tr>
                    <?php 
					$j++;
					} ?> 
                     <tr> 
                    		<td height="33" colspan="3" align="center" style="color:#000000;"><?php $pages->getPaging();?></td>
                   		</tr>
					<?php }else{ ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center">No record found!</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php } ?>
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
<?php
$Fun->DB_close();
?>