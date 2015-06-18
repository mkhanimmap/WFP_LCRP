<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';

$main = new Functions();

$country = isset($_REQUEST["country"])?$_REQUEST["country"]:"";
$uid = isset($_REQUEST["uid"])?$_REQUEST["uid"]:"";

$act = isset($_REQUEST["act"])?$_REQUEST["act"]:"";

$html = "";
 
 if($act == "addUCountry")
 {
	$num = "";
	$sql = "";
	
	$sql = "select * from wfp_user_country where country_id =".$country." and user_id=".$main->d($uid);
	$num = $main->RunQuerySingle($sql);
	
	if(empty($num))
	 {
	
	
	
		$arrValue = array (	
						"country_id" => $country,
						"user_id" => $main->d($uid)
						);
	
				$ins_id = $main->Insert('wfp_user_country', $arrValue);
				if($ins_id)
				{$num = "";
					//echo $ins_id;
					echo $html = '<tr <bgcolor="#F2F2F2" id="row_'.$ins_id.'"><td valign="top" align="center" style="border-right:#d1d1d1 solid 1px;border-bottom:#d1d1d1 solid 1px;" >&nbsp;'.$num.'</td><td valign="top" align="left" style="border-right:#d1d1d1 solid 1px;border-bottom:#d1d1d1 solid 1px;" >&nbsp;'.$main->getField("name","wfp_country",$country).'&nbsp;</td><td valign="top" align="center" style="border-bottom:#d1d1d1 solid 1px;">&nbsp; <span onclick="delUCountry(\''.$ins_id.'\')" style="cursor:pointer; color:#000; font-weight:bold;">Delete</span></td></tr>';
				}
				else
				{
					echo 0;
				}
    }
   else
    {
		echo 2;
    }
 }

if($act == "del")
 {
			$sql = "DELETE FROM wfp_user_country WHERE id =".pg_escape_string($uid);
			
			$ins_id = $main->MySQLQuery($sql);
			if($ins_id)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
  
 }
?>