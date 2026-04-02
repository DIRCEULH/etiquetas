<?php

	interface abstract_dao{};

	class sqlserver_dao implements abstract_dao{
		
		public $conn;
		private $error_msg;
				
		public function __construct($params ){
			
			$this->conn = false;
			$this->error_msg = '';
			
			$this->connect_database($params);
			
		}
		
		public function connect_database($params){
			
			if( empty($params)){		
				$serverName   = "servidor4"; 
				$uid          = "deak";   
				$pwd 		  = "";  
				$databaseName = 'TI';
				
			} else extract($params);
			
			$connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);   
	 
			$this->conn = sqlsrv_connect( $serverName, $connectionInfo); 		
			
			if( $this->conn == false)
				$this->setErrorMsg();	
		}
		
		public function execQuery($sql, $params){
			
			$result = false;
			
			if( $this->conn != false)
				
				$result  = sqlsrv_query($this->conn, $sql, $params);
			
			else $this->setErrorMsg("Banco de dados não conectado!");

			if ( $result == false)
				$this->setErrorMsg();			
			
			return $result;
			
		}
		
		public function execSelect($sql, $params){
			
			$stmt = $this->execQuery($sql,$params);			
			
			$rows = array();
			if( $stmt != false ){
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
					$rows[] = $row;		
				}
			}
			else $rows = false;
			
			return $rows;
		}	
		
		public function closeQuery(){
			
			if( $this->conn != false)
				sqlsrv_close($this->conn);
			
		}
		
		public function  getErroMsg(){
			return $this->error_msg;
		}
		
		private function setErrorMsg($msg = ''){
			
			$this->error_msg .= $msg;
			
			if( ($errors = sqlsrv_errors() ) != null)
				foreach( $errors as $error )					
					$this->error_msg .= $error[ 'message'] ." \n";		
			
		}		
	}
?>