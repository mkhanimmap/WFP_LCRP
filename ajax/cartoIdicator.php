<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';
$main = new Functions();
$act = isset($_POST["act"])?$_POST["act"]:"";
$lid = isset($_POST["lid"])?$_POST["lid"]:"";

$arrInd = array ();
 
if($lid)
 {
	$sql = "select indicator from wfp_layers where id = ".$lid;
	$row = $main->RunQuerySingle($sql);
	if($row)
		$arrInd = split(",",$row["indicator"]);

 }
$html = "";
if($act == "getIndicator")
{
// Connecting, selecting database
$dbconn = pg_connect(CONNSTRCARTODB)
    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
$query = 'select distinct(indicator_id) as iid,indicator_name from ai_reports_2015_04_14_07_22 order by indicator_name';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
if(pg_num_rows($result) > 0)
 {
	$html .= "<table border='1'><tr><td>&nbsp;</td><td>Indicator Name</td></tr>";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		  if(in_array("'".$line['indicator_name']."'",$arrInd))
		   {
		  $html .= "<tr><td><input type='checkbox' id='ind_".$line['iid']."' name='ind_".$line['iid']."' value='".$line['iid']."' title='".$line['indicator_name']."' checked='checked'></td>";
		   }
		  else
		   {
			   $html .= "<tr><td><input type='checkbox' id='ind_".$line['iid']."' name='ind_".$line['iid']."' value='".$line['iid']."' title='".$line['indicator_name']."'></td>";
		   }
		  $html .= "<td>".$line['indicator_name']."</td></tr>";
	}
	$html .= "<tr><td>&nbsp;</td><td><input type='button' id='selectIndica' name='selectIndica' value='Select' onclick='selectIndicator()'></td></tr>";
	$html .= "</table>";
 }

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
}

$main->DB_close();
echo $html; 
?>