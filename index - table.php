<?php
define('MAIN',realpath('.'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';

$Fun = new Functions();

$sql = "select * from wfp_country where status =1";

$rows = $Fun->RunQueryObj($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WFP OpsFEED</title>
	
</head>
 
<body>
  <ul>
   <?php
    if(!empty($rows))
	 {
		 foreach($rows as $row)
		  {
			  echo "<a href='country.php?cid=".$Fun->e($row->id)."'><li>".$row->name."</li></a>";
		  }
	 }
   ?>
  </ul>
</body>
</html>