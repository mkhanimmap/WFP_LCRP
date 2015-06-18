<?php
define('MAIN',realpath('../'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/include_files.php';

$main = new Functions();


$id = isset($_REQUEST["id"])?$_REQUEST["id"]:"";

$id = isset($_REQUEST["id"])?$main->e($_REQUEST["id"]):"";
$cid = isset($_REQUEST["cid"])?$main->e($_REQUEST["cid"]):"";

echo $id."?||?".$cid;


 


?>