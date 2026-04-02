<?php

	namespace crud\deleteGondolas;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class deleteGondolas extends \sqlserver_dao{
		
		public function deleteGondolas($params){		
			$sql = "
			DELETE FROM lprecopromo
			WHERE codproduto_id = ?
			and codfabricante_id = ?
			and tipo_id = 'GONDOLAS'
			and sequencia = ?
            ";	
			$result_delete = $this->execQuery($sql, $params);
			
			if( $result_delete === false)
				throw new \Exception($this->getErroMsg());

			return $result_delete;
		}


		public function deletePosicao($params){		
			$sql = "
			DELETE FROM estoqueproduto
			WHERE codproduto_id = ?
			and codfabricante_id = ?
			and local = 'ESTO'
			and filial = '01'
			and empresa = '01'
			and SUBSTRING(posicao, 0, 2)  in ( 'G')
            ";	
			$result_delete = $this->execQuery($sql, $params);
			
			if( $result_delete === false)
				throw new \Exception($this->getErroMsg());

			return $result_delete;
		}
	}

?>