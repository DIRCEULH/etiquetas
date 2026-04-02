<?php

namespace crud\busca_produtos_fabrica;

require(ROOT_DIR . '/lib/ado.class.php');

class busca_produtos_fabrica extends \sqlserver_dao
{




	public function busca_produtos_Promo($params)
	{
		$sql = "

		select p.CodProduto_ID
		, p.CodFabricante_ID
		, l.marca
		, l.descricao
		, p.precovenda
		, '0' Markup1
		, '' PrecoVenda2
		, '0' Markup2
		, '' PrecoVenda3
		, '0' Markup3 
		,    convert(varchar(10),p.datainicio,103) datainicio
		,    convert(varchar(10),p.datavalidade,103) datavalidade
		,   p.quantidade
		,   'GONDOLAS' Linha
		, est.posicao
		, case when l.codbarra = '' then b.codbarras + '*' else l.codbarra end codbarra
		, case when l.codbarra = '' then b.codbarras  else l.codbarra  end CodBarraInt
		from lprecopromo p
		inner join hack_vwproduto l
		on p.CodProduto_ID = l.CodProduto_ID
		and p.CodFabricante_ID = l.CodFabricante_ID
		left join EstoqueProduto est
        on p.CodProduto_ID = est.CodProduto_ID
		and p.CodFabricante_ID = est.CodFabricante_ID
		left join ProdutoCodBarras b
		on l.CodProduto_ID = b.CodProduto_ID
		and l.CodFabricante_ID = b.CodFabricante_ID
		where p.CodProduto_ID =   ?
		and p.CodFabricante_ID = ?
		and p.tipo_id = 'GONDOLAS'
		and est.posicao like '%G.%'
		and p.filial = '01'

        ";

		$produtos = $this->execSelect($sql, $params);

		if ($produtos === false) {
			throw new \Exception($this->getErroMsg());
		}
		return $produtos;


	}

	public function busca_produtos_fabrica($params)
	{
		$sql = "

		select p.CodProduto_ID
		, p.CodFabricante_ID
		, p.marca
		, p.descricao
		, l.precovenda
		, l.Markup1
		, l.PrecoVenda2
		, l.Markup2
		, l.PrecoVenda3
		, l.Markup3 
		,  '' datainicio
		,  '' datavalidade
		,  '' quantidade
		,  'FABRICA' Linha
		,  '' posicao
		, p.codbarra
		from hack_vwproduto p
		inner join lpreco l
		on p.CodProduto_ID = l.CodProduto_ID
		and p.CodFabricante_ID = l.CodFabricante_ID
		where p.CodProduto_ID =   ?
		and p.CodFabricante_ID = ?
		and l.filial = '01'

        ";

		$produtos = $this->execSelect($sql, $params);

		if ($produtos === false) {
			throw new \Exception($this->getErroMsg());
		}
		return $produtos;


	}



	
}
