<?php

defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/delete_gondolas.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\deleteGondolas as c;

$dao = new c\deleteGondolas(array());

$inputs = json_decode( file_get_contents('php://input'), true);
		
$return_Delete_Gondolas = $dao->deleteGondolas(array($inputs['Produto'], $inputs['Fabricante'], $inputs['sequencia']));
$return_Delete_Gondolas = $dao->deletePosicao(array($inputs['Produto'], $inputs['Fabricante']));

print_r(json_encode(utf8_encode_array($return_Delete_Gondolas)));
?>