<?php
defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require(ROOT_DIR .'/dao/usuario.dao.php');
require(ROOT_DIR .'/lib/commons.inc.php');

use crud\usuarios as c;

$dao = new c\usuario(array());
		
$users = $dao->users(array());

print_r(json_encode(utf8_encode_array($users)));
?>