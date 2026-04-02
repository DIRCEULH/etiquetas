<?php

// defined('ROOT_DIR') ?: define('ROOT_DIR', __DIR__);	
require('dao/etiquetas.dao.php');
require('../../lib/commons.inc.php');
date_default_timezone_set('America/Bahia');

use crud\etiqueta as c;

$dao = new c\etiqueta(array());

$inputs = json_decode( file_get_contents('php://input'), true);

//print_r($inputs['dti']);
//die;

$results = $dao->etiqueta(array('dti'=> $inputs['dti'],'dtf'=>$inputs['dtf'] ));
// print_r($results);
// die;

if($results ){
foreach($results as $result){

    $rows[] = array(
   'IDPRODUTO'=>$result[1],
   'IDLOTE'=>$result[3],
   'DESCRCOMPRODUTO'=>$result[4],
   'MODELO'=>$result[5]


    );
}

print_r (json_encode(utf8_encode_array($rows)));
}else{
    $rows[] = array(
        'IDPRODUTO'=>'Nada encontrado neste periodo!',
        'IDLOTE'=>'',
        'DESCRCOMPRODUTO'=>'',
        'MODELO'=>''

    );

    print_r (json_encode(utf8_encode_array($rows)));   
}

?>