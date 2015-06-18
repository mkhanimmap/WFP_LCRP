<?php class country extends DBConnect{
	
		public $id;
		public $nsme;
		public $snsme;
		public $status;
		
		public function loadQuery(){
				$qry = "Select * from immap_country order by id desc";
				return $qry;
				
			}
		
		public function load(){
				$qry = "Select * from immap_country order by id desc";
				return $this->RunQueryObj($qry);
				$this->DB_close();
			} 
	}
?>