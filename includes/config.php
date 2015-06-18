<?php
session_start();
ob_start();
if($_SERVER['HTTP_HOST']=="localhost:8888")
{


$connstr = "host=localhost port=5432 dbname= user= password=";
define("CONNSTR",$connstr);
define('FULL_PATH',"http://localhost:8888/MyLab/bootstrap/wfp/");
}

else
{
	
$connstr = "host=localhost port=5432 dbname= user= password=";

$connstrCartoDB = "host=localhost port=5432 dbname= user= password=";
define("CONNSTR",$connstr);
define("CONNSTRCARTODB",$connstrCartoDB);
define('FULL_PATH',"http://localhost:8888/MyLab/bootstrap/wfp/");
}
define("LIMIT",15);
define("KEY",'wfpKey');


//USA Eastern Time Zone
putenv("TZ=US/Eastern");

error_reporting(E_ALL);


?>