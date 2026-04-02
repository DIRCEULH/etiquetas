<?php

	namespace crud\updateGondolas;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class updateGondolas extends \sqlserver_dao{
		
		public function updateGondolas($params){		
			$sql = "
            UPDATE lprecopromo
			SET precovenda = ? ,
			DataInicio = ?,
			DataValidade = ? ,
			Quantidade = ?
			Where CodProduto_id = ?
			and CodFabricante_id = ?
			and tipo_id = 'GONDOLAS'
             ";
			
			$return_Update_gondolas = $this->execQuery($sql, $params);
			
			if( $return_Update_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $return_Update_gondolas;
		}


		public function updateProdutosfabrica($params){		
			$sql = "
			UPDATE ProdutoFabrica SET CodBarra = ?
			WHERE CodProduto_ID = ?
			AND CodFabricante_ID = ?
             ";
			
			$return_Update_gondolas = $this->execQuery($sql, $params);
			
			if( $return_Update_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $return_Update_gondolas;
		}

		public function updateProdutosCodBarras($params){		
			$sql = "
			UPDATE ProdutoCodBarras SET CodBarras = ?
			WHERE CodProduto_ID = ?
			AND CodFabricante_ID = ?
             ";
			
			$return_Update_gondolas = $this->execQuery($sql, $params);
			
			if( $return_Update_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $return_Update_gondolas;
		}


		public function updateProdutosPosicao($params){		
			$sql = "
			UPDATE estoqueproduto SET Posicao = ?
			WHERE CodProduto_ID = ?
			AND CodFabricante_ID = ?
			and local = 'ESTO'
			and filial = '01'
			and empresa = '01'
			and SUBSTRING(posicao, 0, 2)  in ( 'G')
             ";
			
			$return_Update_gondolas = $this->execQuery($sql, $params);
			
			if( $return_Update_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $return_Update_gondolas;
		}
	
	}

?>