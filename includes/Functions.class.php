<?php
class Functions extends  DBConnect
{
	var $html = "";
	var $html_ch = "";
	function check_user(){
		if(!isset($_SESSION["session_userid"]) || $_SESSION["session_userid"] == "" )
			header("Location: ".FULL_PATH);
	}
	
	function check_admin(){
		if(!isset($_SESSION["session_wfp_admin_id"])  || $_SESSION["session_wfp_admin_id"] == "" )
			header("Location: ".FULL_PATH."admincp");
	}
	
	
	
function getFieldWhere($field,$table,$where="")
	{
		$obj = new DBConnect();
		$res = "";
		$sql = "select ".$field." from ".$table." ".$where;
		$row = $obj->RunQuerySingleObj($sql);
		if(!empty($row))
		{
	
			$res = $row->$field;
		}
	
		return $res;
	}

function getField($field,$table,$id="")
	{
		
		$res = "";
		$sql = "select ".$field." from ".$table." where id = '".$id."'";
	
		$row = $this->RunQuerySingleObj($sql);
		if(!empty($row))
		{
	
			$res = $row->$field;
		}
	
		return $res;
	}
function getFieldMulti($field,$table,$where="")
	{
		
		
		$sql = "select ".$field." from ".$table." ".$where;
	$res = "";
		$rows = $this->RunQueryObj($sql);
		if(!empty($rows))
		{
			foreach($rows as $row)
			 {
				if($row->$field != "-1")
					$res[] = $row->$field;
			 }
		}
	
		return $res;
	}	
function getField2($field1,$field2,$table,$id="")
{
	
	$res = "";
	$sql = "select ".$field1.",".$field2." from ".$table." where id = '".$id."'";
	$row = $this->RunQuerySingle($sql);

	if(!empty($row))
	{

		$res = $row[$field1]."?||?".$row[$field2];
	}

	return $res;
}	


function getField2Where($field1,$field2,$table,$where="")
{
	
	$res = "";
	$sql = "select ".$field1.",".$field2." from ".$table." ".$where;
	$row = $this->RunQuerySingle($sql);

	if(!empty($row))
	{

		$res = $row[$field1]."?||?".$row[$field2];
	}

	return $res;
}

function checkDot($name)
	{
		$dot = substr($name,-4,1);
		if($dot != '.')
		{
			$dot = substr($name,-5,1);
			if($dot == '.')
				$dot = substr($name,-5,5);
			else
				$dot = 0;
		}
		else
		{
			$dot = substr($name,-4,4);
		}
	
		return $dot;
	}
	
function chkExtFile($ext)
	 {
		 
		  $ext = strtolower($ext);
		 
		 $arr = array('.jpg','.jpeg','.png','.tif','.gif','.pdf');
		  if(in_array($ext, $arr))
		   {
			   return true;
		   }
		  else
		   {
			   return false;
		   }

	 }		

function chkExt($ext)
	 {
		 
		  $ext = strtolower($ext);
		 
		 $arr = array('.jpg','.jpeg','.png','.tif','.gif');
		  if(in_array($ext, $arr))
		   {
			   return true;
		   }
		  else
		   {
			   return false;
		   }

	 }	
	/****************************************************************************
	 My encryption
	*****************************************************************************/
	function e($string) {
		$result = '';
		$key = KEY;
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
	
		return base64_encode($result);
	}
	
	function d($string) {
		$key = KEY;
		$result = '';
		$string = base64_decode($string);
	
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
	
		return $result;
	}
	
	
function getCount($table,$where)
 {
  		
		$res = "";		
		   $sql = "select count(*) as num from ".$table." ".$where;
		
		$row = $this->RunQuerySingleObj($sql);
		if(!empty($row))
		{
		
			$res = $row->num;		
		}
		
		return $res;	
	}	
/****************************************************************************
	Generic message
*****************************************************************************/
	
	function getMessageTop($msg="")
	 {
		 $tf = "";
			if($msg == 1)
			 {
			  $mess = "Record has been added successfully.";
			  $tf = true;
			 }
			 elseif($msg == 2){
			  $mess = "Record has been updated successfully.";
			   $tf = true;
			  }
			 elseif($msg == 3){
			  $mess = "Record has been deleted successfully.";
			   $tf = true;
			  }
			 else if($msg == 4){
			   $mess = "Record has been activated successfully!";
			    $tf = true;
			   }
			  elseif($msg == 5){
			   $mess = "Record has been deactivated successfully!";
			    $tf = true;
			   }
			 elseif($msg == 6){
			   $mess = "User has been successfully Registered, please login.";
			    $tf = true;
			   } 
			 elseif($msg == 7){
			   $mess = "Record has been not deleted successfully.";
			   $tf = true;
			   } 
			  elseif($msg == 8){
			   $mess = "Application files has been uploaded.";
			   $tf = true;
			   }   
			  elseif($msg == 9){
			   $mess = "Your application's extension has been sent to the administrator.";
			   $tf = true;
			   }    
			   
			 else
			 {
			  $mess = $msg;
			  $tf = false;
			 }
			return $this->display_msg($mess,$tf);
			  
	 }
	 
	 
function display_msg($msg,$dis)
	{
		$m = "";
		if(!empty($msg))
		{
		
			if($dis == true)
				$out =  "<div class='success'>".$msg."</div>";
			else
				$out = "<div class='error1'>".$msg."</div>";
		
			
			$m = '<script type="text/javascript">
							jQuery(function(){
								jQuery("#msg").show().html("'.$out.'").fadeOut(6000);
								
						});
					</script>';

			
		}		
		return $m;
	}
function getMsgTxt($msg, $table="")
 {
	$msgtxt = "";
	if(empty($table))
	 $table = "record";
	if($msg == '1')
	 $msgtxt = ucfirst($table)." has been added succresfully";
	elseif($msg == '2')
	 $msgtxt = ucfirst($table)." has been updated succresfully";
	elseif($msg == '3')
	 $msgtxt = ucfirst($table)." has been deleted succresfully";
	elseif($msg == '5')
	 $msgtxt = ucfirst($table)." has been activated succresfully";
	elseif($msg == '4')
	 $msgtxt = ucfirst($table)." has been deactivated succresfully";
	elseif($msg == '6')
	 $msgtxt = "Record does not exist";
	elseif($msg == '7')
	 $msgtxt = "Error while adding ".ucfirst($table);
	elseif($msg == '8')
	 $msgtxt = "Member(s) has been assigned to the group";
	elseif($msg == '9')
	 $msgtxt = "Details not available";
	elseif($msg == '10')
	 $msgtxt = "Error while sending sms, Email has been sent to the administrator";
	else
		$msgtxt = $msg;
	 //$msgtxt = "Invalid parameter";
	return $msgtxt; 
 }
	
function getDD($name,$table,$event,$select_name,$where,$id="")
		 {
			
			$rs = "";
			$row = "";
			$sql = "";
			$rows = array();
			$sql = "select * from ".$table." ".$where;

			$rows = $this->RunQueryObj($sql);

			if(!empty($rows))
			 {
				$rs .= '<select name="'.$name.'" id="'.$name.'" '.$event.'>
                         <option value="">Select '.ucfirst($name).'</option>';
			 foreach($rows as $row)
			  {
				if($id == $row->id)
				 	$rs .= '<option value="'.$row->id.'" selected="selected">'.$row->$select_name.'</option>';
				else
				 	$rs .= '<option value="'.$row->id.'" >'.$row->$select_name.'</option>';
					  
			  }
			  	$rs .= '</select>';
			 }
		
			 
			return $rs;
	     }	

function getMDD($name,$table,$event,$select_name,$where,$id="")
		 {
			 

			$rs = "";
			$row = "";
			$sql = "";
			$rows = array();
			 $sql = "select * from ".$table." ".$where;
			
			$rows = $this->RunQueryObj($sql);
			
			if(!empty($rows))
			 {
				$rs .= '<select name="'.$name.'[]" id="'.$name.'" '.$event.' style="height:150px; width:350px;" multiple="multiple">
                         <option value="">Select '.ucfirst($name).'</option>';
			 foreach($rows as $row)
			  {
				
				if(!empty($id) && in_array($row->id, $id))
				 	$rs .= '<option value="'.$row->id.'" selected="selected">'.$row->$select_name.'</option>';
			    else
				 	$rs .= '<option value="'.$row->id.'" >'.$row->$select_name.'</option>';
					  
			  }
			  	$rs .= '</select>';
			 }
		
			 
			return $rs;
	     }	 

	
	
function getObjectRightDD($ids="")
		 {
			
		
			$rs = "";
			$row = "";
			$sql = "";
			$rows = array();
			$sql = "select * from fw_object_right where status = 1";
			
			$rows = $this->RunQueryObj($sql);
			
			if(!empty($rows))
			 {
				$rs .= '<select name="object_right[]" id="object_right" style="height:150px; width:350px;" multiple="multiple">
                         <optgroup label="Available Rights">';
			
			 foreach($rows as $row)
			  {				
				
				if(!empty($ids) && in_array($row->id, $ids))
				 {
				
					
					$rs .= '<option value="'.$row->id.'" selected="selected">'.$this->getField("name","fw_object",$row->object_id).' | | can '.$this->getField("name","fw_right",$row->right_id).'</option>';
				 }
			    else
				 {
				 	$rs .= '<option value="'.$row->id.'" >'.$this->getField("name","fw_object",$row->object_id).' | | can '.$this->getField("name","fw_right",$row->right_id).'</option>';
				 }
					  
			  }
			  	$rs .= '</optgroup></select>';
			 }
		
			 
			return $rs;
	     }	
		  


function getMenu($vt_id,$user_id)
 {
	$rs = "";
	$row = "";
	$sql = "";
	$rows = array();
	if($user_id)
	 {
		$sql = "select * from wfp_layers where status = 1 and layer_level_id = 1 and visualization_type_id =".$vt_id." and (group_id =1 or group_id in(select group_id from wfp_user_group where user_id = ".$user_id.")) order by id asc";
	 }
	else
	 {
		$sql = "select * from wfp_layers where status = 1 and layer_level_id = 1 and visualization_type_id =".$vt_id." and group_id = 1 order by id asc";	 
	 }

	
	$rows = $this->RunQueryObj($sql);
	$this->html_ch = "";
	
	if(!empty($rows))
	 {
		 foreach($rows as $row)
		  {
			  //echo "<br>".$row->title;
			  $this->html_ch .= '<li><a href="#">'.$row->title.'</a><hr>';
			  $this->html_ch .= $this->getChild($row->id,$row->layer_level_id,$user_id);
			  $this->html = ""; 
			  $this->html_ch .= '</li>';
		  }
	 }
	 return $this->html_ch;
 }

function getChild($id,$level,$user_id)
 {
	$rs = "";
	$row = "";
	$sql = "";
	$rows = array();
	
	if($user_id)
	 {
		$sql = "select * from wfp_layers where status = 1 and parent_id = ".$id." and (group_id = 1 or group_id in(select group_id from wfp_user_group where user_id = ".$user_id.")) order by id asc";
	 }
	else
	 {
		$sql = "select * from wfp_layers where status = 1 and parent_id = ".$id." and group_id = 1 order by id asc";
	 }
	
	
	$rows = $this->RunQueryObj($sql);
	
	if(!empty($rows))
	 {
		 $this->html .= '<ul>';
		 foreach($rows as $row)
		  {
			  //if($row->layer_level_id == 4)
			  if($row->cartodb_index != -1 && $row->cartodb_index !='')
			   {
				   
				   if($row->layer_type == 2)
				   	$this->html .= '<li ><a href="#" rel="'.$row->indicator.'"><input type="checkbox" id="li_'.$row->cartodb_index.'" />'.$row->title.'</a>';
				   else
				   	$this->html .= '<li ><a href="#" rel="'.$row->indicator.'"><input type="radio" name="li_" id="li_" value="li_'.$row->cartodb_index.'" />'.$row->title.'</a>';
			   }
			  else
			   {
				   
				   
				   $this->html .= '<li><a href="#">'.$row->title.'</a>';
			   }
			 
			  $this->html = $this->getChild($row->id,$row->layer_level_id,$user_id);
			  $this->html .= '</li>';
		  }
		  $this->html .= '</ul>';
	 }
	 return  $this->html;
 }
 



}// end funciton calss
?>
