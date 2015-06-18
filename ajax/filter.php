<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/function.php';
$act = isset($_REQUEST["act"])?$_REQUEST["act"]:"";
$indicator = isset($_REQUEST["indicator"])?$_REQUEST["indicator"]:"";
$html = "";
if($act == "month")
{
	$html = loadMonth($indicator);
}

if($act == "year")
{
	$html = loadYear($indicator);
}

if($act == "BeneficiaryGroup")
{
	$html = loadBeneficiaryGroup($indicator);
}

if($act == "Partner")
{
	$html = loadPartner($indicator);
}

if($act == "getminmax")
{
	$html = getMinMax($indicator);
}

echo $html;


?>