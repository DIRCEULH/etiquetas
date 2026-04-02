<?php

defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/update_gondolas.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\updateGondolas as c;

$dao = new c\updateGondolas(array());

$inputs = json_decode( file_get_contents('php://input'), true);
		
$return_Update_gondolas = $dao->updateGondolas(array($inputs['PrecoVenda'], $inputs['DataInicio'], $inputs['DataValidade'],$inputs['Quantidade'],  $inputs['Produto'], $inputs['Fabricante']));

$return_Update_gondolas = $dao->updateProdutosPosicao(array($inputs['Posicao'],  $inputs['Produto'], $inputs['Fabricante']));

if (strstr( $inputs['Codbarra'] , '*')) {

    $return_Update_gondolas = $dao->updateProdutosCodBarras(array(substr($inputs['Codbarra'], 0, -1),$inputs['Produto'], $inputs['Fabricante']));

} else {
$return_Update_gondolas = $dao->updateProdutosfabrica(array($inputs['Codbarra'],$inputs['Produto'], $inputs['Fabricante']));
}
print_r(json_encode(utf8_encode_array($return_Update_gondolas)));
?>