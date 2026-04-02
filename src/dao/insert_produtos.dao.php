<?php

	namespace crud\insertProduto;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class produtos extends \sqlserver_dao{
		
		public function insereProdutos($params){		
			$sql = "
			insert into produtos
			(prod_nome, prod_data_compra, prod_obs, prod_usu)
			values(?,convert(varchar(10), ?,102),?,? )
            ";	
			$produtos = $this->execQuery($sql, $params);
			
			if( $produtos === false)
				throw new \Exception($this->getErroMsg());

			return $produtos;
		}
	}

?>