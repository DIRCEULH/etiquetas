
<?php
defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/busca_produtos_fabrica.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\busca_produtos_fabrica as c;

$dao = new c\busca_produtos_fabrica(array());

$inputs = json_decode( file_get_contents('php://input'), true);

$produtos = $dao->busca_produtos_Promo(array($inputs['codproduto'], $inputs['codfabricante']));

$contem = sizeof($produtos);
		
if($contem == 0){

    $produtos = $dao->busca_produtos_fabrica(array($inputs['codproduto'], $inputs['codfabricante']));

}

print_r(json_encode(utf8_encode_array($produtos)));
?>