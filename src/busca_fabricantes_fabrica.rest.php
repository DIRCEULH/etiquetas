<?php
defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/busca_fabricantes_fabrica.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\busca_fabricantes_fabrica as c;

$dao = new c\busca_fabricantes_fabrica(array());

$inputs = json_decode( file_get_contents('php://input'), true);


$fabricantes = $dao->busca_fabricante_Promo(array());


print_r(json_encode(utf8_encode_array($fabricantes)));

?>