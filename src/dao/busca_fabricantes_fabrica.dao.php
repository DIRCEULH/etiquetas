<?php

namespace crud\busca_fabricantes_fabrica;

require(ROOT_DIR . '/lib/ado.class.php');

class busca_fabricantes_fabrica extends \sqlserver_dao
{


	public function busca_fabricante_Promo()
	{
		$sql = "
		select 
		CodFabricante_ID 
		, descricao 
		from fabricante

        ";

		$fabricantes = $this->execSelect($sql,array());

		if ($fabricantes === false) {
			throw new \Exception($this->getErroMsg());
		}
		return $fabricantes;


	}

	
}
