<?php
class DBConnect
{	
	var $DB_Server;
	var $DB_Username;
	var $DB_Password;
	var $DB_DBName;
	var $success;
	var $pin;
	var $error = "Error :: " ;
	var $sqlQry;
	var $con;
	
	
	//Database Connection Method
	function DBConnect()
	{
	
		$this->DB_Driver = DRIVER;
		$this->DB_Username = USER;
		$this->DB_Password = PASSWORD;
		
		try {
		$this->con = new PDO(DRIVER, USER, PASSWORD);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		/*$this->success = mysql_pconnect($this->DB_Server, $this->DB_Username, $this->DB_Password);
		mysql_select_db($this->DB_DBName);
		if(!$this->success)
			echo mysql_errno() . ": " . mysql_error() . "<BR>";
			//else
			//echo yes;*/
	}
	
	function DB_close()
	 {
		 $this->con = NULL;
	 }
		 
	
	//Data Insertion Method
	function Insert($strTable, $arrValue)
	{
		$strQuery = "	insert into $strTable (";
		
		reset($arrValue);
		while(list ($strKey, $strVal) = each($arrValue))
		{
			$strQuery .= $strKey . ",";
		}

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);
		$strQuery .= ") values (";

		reset($arrValue);
		while(list ($strKey, $strVal) = each($arrValue))
		{
			$strQuery .= "'" . $this->FixString($strVal) . "',";
		}

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);
		 $strQuery .= ");";
	
		//exit($strQuery);
		if($this->MySQLQuery($strQuery))
			return $this->con->lastInsertId();
		else
		 echo "ERROR while inserting record";
	}
		
	//Method To FIX Quotes
	function FixString($strString)
	{
		// Stripslashes
		if (get_magic_quotes_gpc())
		  {
		   $strString = stripslashes($strString);
		  }
		// Quote if not a number
		if (!is_numeric($strString))
		  {
		   $strString = "" . mysql_real_escape_string($strString) . "";
		  }
		return $strString;
	}
	
	
	
	//RUNS MySql Query
	function MySQLQuery($strQuery)
	{
		//$this->success = mysql_db_query($this->DB_DBName, $strQuery);
		$this->success = $this->con->query($strQuery);
		if(!$this->success)
		{
			//Nothing
			echo mysql_error();
		}
		return $this->success;
	}	
	
	//Data Updatation Method
	function UpdateRec($strTable, $strWhere, $arrValue)
	{
		$strQuery = "	update $strTable set ";

		reset($arrValue);

		while (list ($strKey, $strVal) = each ($arrValue))
		{
			$strQuery .= $strKey . "='" . $this->FixString($strVal) . "',";
		}

		$strQuery = substr($strQuery, 0, strlen($strQuery) - 1);
		$strQuery .= " where $strWhere;";
		
		$this->sqlQry = $strQuery;
	
		//exit($strQuery);
		return $this->MySQLQuery($strQuery);
	}
	
	
	
	//run all query
	function RunQuery($strQry)
	{
		$arr = "";
		$rsQry = mysql_query($strQry);
		if(!empty($rsQry))
		{
			if(mysql_num_rows($rsQry) > 0)
			{
				while($rowsQry = mysql_fetch_array($rsQry))
				{
					$arr[] = $rowsQry;
				}
			}
			else
				$this->error .= " Table empty.";
		}
		else
			echo $this->error .= mysql_error();
	return $arr;
	}
	
	
	//run all query
	function RunQueryObj($strQry)
	{
		$arr = "";
		$rsQry = $this->con->query($strQry);
		if(!empty($rsQry))
		{
			if($rsQry->rowCount() > 0)
			{
				while($rowsQry = $rsQry->fetchObject())
				{
					$arr[] = $rowsQry;
				}
			}
			else
				$this->error .= " Table empty.";
		}
		else
			echo $this->error .= mysql_error();
	return $arr;
	}
	
	//run single query
	function RunQuerySingle($strQry)
	{
		$arr = "";
		$rsQry = mysql_query($strQry);
		if(!empty($rsQry))
		{
			if(mysql_num_rows($rsQry) > 0)
			{
				$rowsQry = mysql_fetch_array($rsQry);
					$arr = $rowsQry;
			}
			else
				$this->error .= " Table empty.";
		}
		else
			echo $this->error .= mysql_error();
	return $arr;
	}
	
	//run single query
	function RunQuerySingleObj($strQry)
	{
		$arr = "";
		$stmt = $this->con->prepare($strQry);
		if($stmt->execute())
		{
			if($stmt->rowCount() > 0)
			{
					$rowsQry = $stmt->fetchObject();			
					$arr = $rowsQry;
			}
			else
				$this->error .= " Table empty.";
		}
		else
			echo $this->error .= mysql_error();
	return $arr;
	}
	
	//run query fetch rows
	function RunQueryRow($strQry)
	{
		$arr = 0;
		$rsQry = mysql_query($strQry);
		if(!empty($rsQry))
			$arr =mysql_num_rows($rsQry);
		else
			$this->error .= mysql_error();
	return $arr;
	}
	
}
?>
