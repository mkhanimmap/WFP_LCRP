<?php
define('MAIN',realpath('.'));
include MAIN.'/includes/config.php';
include MAIN.'/includes/class.db-pg.php';
include MAIN.'/includes/Functions.class.php';
include MAIN.'/includes/function.php';

$Fun = new Functions();


$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:"";

$cid = isset($_GET["cid"])?$_GET["cid"]:"";
$type = isset($_GET["type"])?$_GET["type"]:$Fun->e(2);
$url = "";
$index[] = '';
$error = "";
$visualization_type_id = $Fun->d($type);
/*if($type)
	$visualization_type_id = $Fun->d($type);
else
 	 $visualization_type_id = $Fun->getFieldWhere("id","wfp_visualization_type","where status =1 and default_select = 1 and country_id=".$Fun->d($cid));
*/

$map_center = $Fun->getField("map_center","wfp_country",$Fun->d($cid));
$zoom = $Fun->getField("zoom","wfp_country",$Fun->d($cid));

if(!$map_center)
 {
	 $map_center = "";
	
 }
 
/*if($visualization_type_id)
 {
	$url = $Fun->getField("visualization_url","wfp_visualization_type",$visualization_type_id);
	$index = $Fun->getFieldMulti("cartodb_index","wfp_layers","where layer_level_id in(4,3,2) and visualization_type_id=".$visualization_type_id);
	if(!$index)
	 {
		$error = 1;
		 
     }
 }
else
 {
	 $error = 1;
 }
if($error)
 {
	  echo "Sorry! visualization is not set yet, back to <a href='index.php'>Home</a>";
	 die();
 }
*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WFP OpsFeed <?php echo $Fun->getField("name","wfp_country",$Fun->d($cid))?></title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet prefetch' href='accordion/foundation.css'>
    <link href="accordion/mtree.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://libs.cartocdn.com/cartodb.js/v3/3.11/themes/css/cartodb.css" />
    <link href="mybox/mybox.css" rel="stylesheet" type="text/css" />
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     <script src="mybox/mybox.js" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
html, body {
	height: 100%;
	padding: 0;
	margin: 0;
}
.mtree-demo .mtree {
	background: #EEE;
	/*margin: 10px auto;max-width: 320px;*/
	max-width: 100%;
	border-radius: 3px;
}
.mtree-skin-selector {
	text-align: center;
	background: #EEE;
	padding: 10px 0 15px;
}
.mtree-skin-selector li {
	display: inline-block;
	float: none;
}
.mtree-skin-selector button {
	padding: 5px 10px;
	margin-bottom: 1px;
	background: #BBB;
}
.mtree-skin-selector button:hover {
	background: #999;
}
.mtree-skin-selector button.active {
	background: #999;
	font-weight: bold;
}
.mtree-skin-selector button.csl.active {
	background: #FFC000;
}
</style>
</head>
  <body>
  
  <div style="width:100%; height:94%;" >
   <div style="width:23%; float:left; padding-top:20px; padding-left:5px;">
        <div > <strong>LEBANON COUNTRY RESPONSE PLAN</strong><br /><br /></div>
        <div>
        <a href="country.php?cid=<?php echo $cid;?>"><img class="block" id="u478_img" src="images/logo.png" alt="" width="300" style="border: #1C93B3 solid 1px;" /></a> <br /><br />
        </div>
        <input type="hidden" name="path" id="path" value="<?php echo FULL_PATH?>" />
        <div style="float:right; padding-right:3px; padding-bottom:7px;"><strong>
        <?php
         if($user_id)
		  {
		?>
        <a href="logout.php?cid=<?php echo $cid?>">Logout</a>
        
        <?php
		  }
		  else
		   {?>
			   <a href="#login" rel="mybox">Login</a>
            <?php
		   }
		?>
        </strong></div>
        <div class="dropdown">
        <?php
         echo $Fun->getDD('type','wfp_visualization_type','onchange="getType(this.value,'.$Fun->d($cid).')" class="dropdown-select"','name',' where status=1 and country_id='.$Fun->d($cid),$Fun->d($type));
        ?>
        </div> 
        <div>
        <ul class="mtree jet">
            <?php
             echo $Fun->getMenu($visualization_type_id,$user_id);
            ?>
        </ul>
        </div>
   </div>	
   <div style="width:75%; float:left; height:100%;" id="div_map">
     <div  id="map" style="width: 77%; height: 93%; position: absolute;border-left: #c9c5c5 10px solid;
  box-shadow: 0 5px 0 #c9c5c5;"></div>
   	 
   </div>
   
  </div>
  <div style="z-index:12; position:absolute; float:right; width:100%;">
  	<div style="width:15%; float:right;"><div class="dropdown" style="width:100%;" id="divPartner">
        <?php
		  loadPartner("'".'DisSyr - # of vulnerable individuals receiving e-cards'."'");
        ?>
        </div></div>
    <div style="width:15%; float:right;"><div class="dropdown" style="width:100%;" id="divBeneficiaryGroup">
        <?php
		 loadBeneficiaryGroup("'".'DisSyr - # of vulnerable individuals receiving e-cards'."'");
        ?>
        </div></div>
        <div style="width:15%; float:right;"><div class="dropdown" style="width:100%;" id="divMonth">
        <?php
		 loadMonth("'".'DisSyr - # of vulnerable individuals receiving e-cards'."'");
        ?>
        </div></div>
        <div style="width:15%; float:right;"><div class="dropdown" style="width:100%;" id="divYear">
        <?php
		 loadYear("'".'DisSyr - # of vulnerable individuals receiving e-cards'."'");
        ?>
        </div></div>
  </div>	
          
  
    
   


   
    
</body>
<script src="accordion/jQuery.js"></script>
<script src='accordion/jquery.velocity.min.js'></script>
<script src="accordion/mtree.js"></script>
<script src="http://libs.cartocdn.com/cartodb.js/v3/3.11/cartodb.js"></script>
<script type="text/javascript" src="js/carto1.js"></script>
<script>
	 $(document).ready(function() {
		 
		  jQuery( "input[id*='li_']" ).each(function(index, element) {
				if (jQuery(this).val() == 'li_1')
				 {
					jQuery(this).attr('checked',true);
				 }    
			});
		  
		  
		  var mtree = $('ul.mtree');
  
		  // Skin selector for demo
		  mtree.wrap('<div class=mtree-demo></div>');
		  var skins = ['bubba','skinny','transit','jet','nix'];
		  mtree.addClass(skins[3]);
	
		  //window.onload = main('<?php echo $url;?>',<?php echo json_encode($index);?>,'<?php echo str_replace(",","??", $map_center);?>',<?php echo $zoom;?>);
		  window.onload = main('<?php echo $url;?>','<?php echo str_replace(",","??", $map_center);?>',<?php echo $zoom;?>);
	 });
    </script>
</html>

<div  id="login" style="width:400px;height:230px;display:none">
	<div>&nbsp;</div>
	<span class="hd2"><strong>Login</strong></span>
	<div>&nbsp;</div>
	<form name="form_signup" id="form_signup" action="" method="post" >
	<div class="main_txt"  align="left"  style="width:370px;height:50px;">
		<div>Username</div>
		<div style="width:365px;padding:3px;margin-top:10px;"><input type="text" name="username" id="username" value="" class="field1"  style="width:300px;"  /></div>
		<div>Password</div>
		<div style="width:365px;padding:3px;margin-top:10px;"><input type="password" name="pass" id="pass" value="" class="field1"  style="width:300px;"  /></div>
		<div align="left">
		<input type="button" name="for" id="for" value="Submit"     />
		</div>
		<div id="error_" style="padding-left:20px; padding-bottom:20px; color:#900; font-weight:bold;">&nbsp;</div>
	</div>
	</form>
</div>