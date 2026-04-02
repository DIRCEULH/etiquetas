<?php

	namespace crud\produtos;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class produto extends \sqlserver_dao{
		
		public function prod(){		
		$sql = "
		  select 
		  prod_nome
		  from produtos
        ";
			
			$produto = $this->execSelect($sql, array());
			
			if( $produto === false){
				throw new \Exception($this->getErroMsg());
			}
			return $produto;
		}
	}

?>