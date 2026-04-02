<?php

defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/insert_gondolas.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\insertGondolas as c;

$dao = new c\gondolas(array());

$inputs = json_decode( file_get_contents('php://input'), true);
	
$result_gondolas = $dao->gond(array($inputs['empresa'],$inputs['filial'],$inputs['tipo_id'],$inputs['codproduto_id'],  $inputs['codfabricante_id'], $inputs['datainicio'],$inputs['datavalidade'], $inputs['precovenda'], $inputs['quantidade']));

$result_gondolas = $dao->posicao_gond(array($inputs['empresa'],$inputs['filial'],$inputs['codproduto_id'],  $inputs['codfabricante_id'], $inputs['posicao']));


print_r ( json_encode($result_gondolas) );
?>