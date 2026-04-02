<?php

	namespace crud\insertGondolas;
	
	require (ROOT_DIR .'/lib/ado.class.php');

	class gondolas extends \sqlserver_dao{
		
		public function gond($params){		
			$sql = "
			insert into lprecopromo
			(empresa, filial, tipo_id, codproduto_id, codfabricante_id, datainicio, datavalidade, precovenda,quantidade)
			values(?,?,?,?,?,convert(varchar(10),?,102),convert(varchar(10),?,102),?,?)
            ";	
			$result_gondolas = $this->execQuery($sql, $params);
			
			if( $result_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $result_gondolas;
		}


		public function posicao_gond($params){		
			$sql = "
			insert into estoqueproduto
			(empresa, filial, codproduto_id, codfabricante_id, local,posicao)
			values(?,?,?,?,'ESTO',?)
            ";	
			$result_gondolas = $this->execQuery($sql, $params);
			
			if( $result_gondolas === false)
				throw new \Exception($this->getErroMsg());

			return $result_gondolas;
		}
	}

?>