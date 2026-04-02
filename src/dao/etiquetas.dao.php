<?php

	namespace crud\etiqueta;
	
	require ('../../lib/ado.class.php');

	class etiqueta extends \db2_dao {
		
		public function etiqueta($params){	
			
			$dti = $params['dti'];
            $dtf = $params['dtf'];

		
         
		$sql = "
  
SELECT DISTINCT
etiqueta_gonpro.IDEMPRESA,
etiqueta_gonpro.IDPRODUTO,
etiqueta_gonpro.IDUSUARIO,
ea.IDLOTE,
PG.DESCRCOMPRODUTO,
PG.MODELO
FROM dba.etiqueta_gonpro etiqueta_gonpro
INNER join dba.PRODUTO PG
ON PG.IDPRODUTO = etiqueta_gonpro.IDPRODUTO
INNER join dba.estoque_analitico ea
ON ea.IDPRODUTO = etiqueta_gonpro.IDPRODUTO
and ea.IDsubPRODUTO = etiqueta_gonpro.IDsubPRODUTO
and ea.idplanilha = etiqueta_gonpro.idplanilha
WHERE ( RTRIM( etiqueta_gonpro.origemmovimento) LIKE 'NFE') AND
etiqueta_gonpro. idempresa in (1) and ( cast(etiqueta_gonpro.dtmovimento as date) >= '$dti'  AND
cast(etiqueta_gonpro.dtmovimento as date)  <= '$dtf') AND
(etiqueta_gonpro.tipoetiqueta = 'G') AND 
etiqueta_gonpro.IDCADEIAPRECO IS NULL and
EA.IDLOTE <> ''
order by etiqueta_gonpro.IDPRODUTO
  ";
//   print_r($sql);
//   die;
			$etiqueta = $this->execSelectArray($sql);
			
			if( $etiqueta === false){
				throw new \Exception($this->getErroMsg());
			}
			return $etiqueta;
		
		}


		

	}

?>