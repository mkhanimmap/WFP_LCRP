<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';

$main = new Functions();


$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";

$act = isset($_REQUEST["act"])?$_REQUEST["act"]:"";
$level = isset($_REQUEST["level"])?$_REQUEST["level"]:"";
$country = isset($_REQUEST["country"])?$_REQUEST["country"]:"";
$visualization_type = isset($_REQUEST["visualization_type"])?$_REQUEST["visualization_type"]:"";


$html = "";
 
 if($act == "getParent")
 {
	$num = "";
	$sql = "";
	
	if($id == 2)
	 {
		 $html = $main->getDD('parent','wfp_layers','','title',' where status=1 and layer_level_id = 1 and country_id='.$country.' and visualization_type_id='.$visualization_type,'');
	 }
	
	if($id == 3)
	 {
		 $html = $main->getDD('parent','wfp_layers','onchange="getChildFirst(this.value)"','title',' where status=1 and layer_level_id = 1 and country_id='.$country.' and visualization_type_id='.$visualization_type,'');
	 }
	
	if($id == 4)
	 {
		 $html = $main->getDD('parent','wfp_layers','onchange="getChildFirst(this.value)"','title',' where status=1 and layer_level_id = 1  and country_id='.$country.' and visualization_type_id='.$visualization_type,'');
	 }
	
	echo $html;
 }
 
 if($act == "getVT")
 {
	$num = "";
	$sql = "";
	
	if($id)
	 {
		 $html =  $main->getDD('visualization_type','wfp_visualization_type','class="txtin"','name',' where status=1 and country_id='.$id,'');
	 }
	
	
	
	echo $html;
 }
 
 
if($act == "getChildFirst")
 {
	$num = "";
	$sql = "";
	
	if($level == 3)
	 {
		$html = $main->getDD('first_child','wfp_layers','','title',' where status=1 and layer_level_id = 2 and parent_id ='.$id,'');
	 }
	 
	if($level == 4)
	 {
		$html = $main->getDD('first_child','wfp_layers','onchange="getSecondChild(this.value)"','title',' where status=1 and layer_level_id = 2 and parent_id ='.$id,'');
	 } 
	
	echo $html;
 }
 
 if($act == "getSecondChild")
 {
	$num = "";
	$sql = "";
	
	
		$html = $main->getDD('second_child','wfp_layers','','title',' where status=1 and layer_level_id = 3 and parent_id ='.$id,'');
	
	
	echo $html;
 }

?>