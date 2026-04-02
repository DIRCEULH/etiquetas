<?php

	namespace crud\usuarios;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class usuario extends \sqlserver_dao{
		
		public function users(){		
		$sql = "
		  select 
		  usu_nome
		  from usuarios
        ";
			
			$users = $this->execSelect($sql, array());
			
			if( $users === false){
				throw new \Exception($this->getErroMsg());
			}
			return $users;
		}
	}

?>