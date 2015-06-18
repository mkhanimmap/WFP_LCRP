<?php class admin extends DBConnect{
	
		public $username;
		public $password;
		
		public function login(){
			
				$qry = "Select id from immap_admin where username = '".mysql_real_escape_string($this->username)."' and password = '".mysql_real_escape_string($this->password)."'";
				
				return $this->RunQuerySingleObj($qry);
				$this->DB_close();
			}
		
		 
	}
?>