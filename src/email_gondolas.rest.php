
<?php

set_time_limit(3000);
ini_set('memory_limit', '1024M');
require('lib\sendmail.php'); 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$serverName = "servidor2";
$uid = "deak";
$pwd = "";
$databaseName = 'TI';
$connectionInfo = array("UID" => $uid, "PWD" => $pwd, "database" => $databaseName);
$conn = sqlsrv_connect($serverName, $connectionInfo);

//var_dump ($conn);

$sql = "select 
  convert(varchar(10) , man_data_prox, 103) man_data_prox
, man_prod_nome
, convert(varchar(10) , man_data, 103) man_data
, man_obs
from manutencao ";

$result = sqlsrv_query($conn, $sql);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
//    echo  $row['man_data_prox'];
//    echo date('d/m/Y');

    if($row['man_data_prox'] == date('d/m/Y')){

    $titulo = "Manutencao : ".$row['man_prod_nome'];
    $body = "<pre><b>Manutencao agendada para:</b><br><br>" .$row['man_data_prox']."  do ".$row['man_prod_nome']."<br><br>".
    "Ultima manutencao realizada na data de : ".$row['man_data']."<br><br>".$row['man_obs']."</pre>"; 
    $email = 'suporte@correamte.com.br;gerente04@correamte.com.br;ademilci@acmse.com.br';
    				
    send_mail($email, $titulo, $body,'');

    echo $body;

    } else {

        echo $row['man_prod_nome'].'Não possui manutenção hoje!!<br>';
    }
}