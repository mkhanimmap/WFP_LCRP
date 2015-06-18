<?php
function loadMonth($indicator)
 {
	    $dbconn = pg_connect(CONNSTRCARTODB)
		or die('Could not connect: ' . pg_last_error());
		$query = "SELECT distinct(trim((string_to_array(date, '-'))[2])) as month from ai_reports_2015_04_14_07_22 where indicator_name in(".$indicator.") order by month";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		$rs_p = "";
		
		if(pg_num_rows($result) > 0)
		 {
			          
			$array = array(
				"1" => "JAN",
				"2" => "FEB",
				"3" => "MAR",
				"4" => "APR",
				"5" => "MAY",
				"6" => "JUN",
				"7" => "JUL",
				"8" => "AUG",
				"9" => "SEP",
				"10" => "OCT",
				"11" => "NOV",
				"12" => "DEC"
			); 
			$rs_p .= '<select name="month" id="month" onChange="getByMonth(this.value)">
                    <option value="">Select Month</option>';
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				
				 if($id == $line["month"])
				 	$rs_p .= '<option value="'.$line["month"].'" selected="selected">'.$array[$line["month"]].'</option>';
				else
				 	$rs_p .= '<option value="'.$line["month"].'" >'.$array[$line["month"]].'</option>';
			}
			$rs_p .= '</select>';
		 }
		echo $rs_p;
		pg_free_result($result);
		pg_close($dbconn);
 }
 function loadYear($indicator)
 {
	    $dbconn = pg_connect(CONNSTRCARTODB)
		or die('Could not connect: ' . pg_last_error());
		$query = "SELECT distinct(trim((string_to_array(date, '-'))[1])) as year from ai_reports_2015_04_14_07_22 where indicator_name in(".$indicator.") order by year";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		$rs_p = "";
		
		if(pg_num_rows($result) > 0)
		 {
			$rs_p .= '<select name="year" id="year" onChange="getByYear(this.value)">
                    <option value="">Select year</option>';
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				 if($id == $line["year"])
				 	$rs_p .= '<option value="'.$line["year"].'" selected="selected">'.$line["year"].'</option>';
				else
				 	$rs_p .= '<option value="'.$line["year"].'" >'.$line["year"].'</option>';
			}
			$rs_p .= '</select>';
		 }
		echo $rs_p;
		pg_free_result($result);
		pg_close($dbconn);
 }
function loadPartner($indicator)
 {
	 $dbconn = pg_connect(CONNSTRCARTODB)
		or die('Could not connect: ' . pg_last_error());
		$query = "select distinct(partner_id) as pid,partner_name from ai_reports_2015_04_14_07_22 where indicator_name in(".$indicator.") order by partner_name asc";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		
		$rs_p = "";
		
		if(pg_num_rows($result) > 0)
		 {
			$rs_p .= '<select name="partner" id="partner" onChange="getByPartner(this.value)">
                    <option value="">Select Partner</option>';
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				 if($id == $line["pid"])
				 	$rs_p .= '<option value="'.$line["pid"].'" selected="selected">'.$line["partner_name"].'</option>';
				else
				 	$rs_p .= '<option value="'.$line["pid"].'" >'.$line["partner_name"].'</option>';
			}
			$rs_p .= '</select>';
		 }
		echo $rs_p;
		pg_free_result($result);
		pg_close($dbconn);
 }

function loadBeneficiaryGroup($indicator)
{
 $dbconn = pg_connect(CONNSTRCARTODB);
$query = "select trim((string_to_array(indicator_name, ' '))[1]) as BeneficiaryGroup from 
ai_reports_2015_04_14_07_22 where trim((string_to_array(indicator_name, ' '))[1]) not in('#','AffLeb-','AffLeb-#','Amount','Female','Male') and  indicator_name in(".$indicator.")   group by BeneficiaryGroup order by BeneficiaryGroup";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$rs_b = "";
		$id = "";
		if(pg_num_rows($result) > 0)
		 {
			$rs_b .= '<select name="BeneficiaryGroup" id="BeneficiaryGroup" onChange="getBeneficiaryGroup(this.value)">
                    <option value="">Select BeneficiaryGroup</option>';
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				 if($id == $line["beneficiarygroup"])
				  {
				 	$rs_b .= '<option value="'.$line["beneficiarygroup"].'" selected="selected">'.$line["beneficiarygroup"].'</option>';
				  }
				else
				 {
				 	$rs_b .= '<option value="'.$line["beneficiarygroup"].'" >'.$line["beneficiarygroup"].'</option>';
				 }
			}
			$rs_b .= '</select>';
		 }
		echo $rs_b;
		pg_free_result($result);
		pg_close($dbconn);
}

function getMinMax($indicator)
{
 $dbconn = pg_connect(CONNSTRCARTODB);
 $query = "SELECT   MIN(cast(value as numeric)),MAX(cast(value as numeric)) FROM ai_reports_2015_04_14_07_22 ai  where indicator_name in (".$indicator.")";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$rs_b = "";
		$id = "";
		if(pg_num_rows($result) > 0)
		 {
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				 	$rs_b = $line["min"]."?||?".$line["max"];
			}
		 }
		echo $rs_b;
		pg_free_result($result);
		pg_close($dbconn);
}
?>