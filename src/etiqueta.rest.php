<?php

$descricao = $_REQUEST['descricao'];
$precovenda = $_REQUEST['precovenda'];
$codproduto_id = $_REQUEST['CodProduto_ID'];
$codfabricante_id = $_REQUEST['CodFabricante_ID'];
$marca = $_REQUEST['marca'];
$codbarra = $_REQUEST['codbarra'];
$CodBarraInt = $_REQUEST['CodBarraInt'];
$posicao = $_REQUEST['posicao'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/font-awesome.min.css" rel="stylesheet" />
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootbox.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  
    <script type="text/javascript" src="../app/js/BrowserPrint-2.0.0.75.min.js"></script>
    <script type="text/javascript">
        var selected_device;
        var devices = [];

        function setup() {
            //Get the default device from the application as a first step. Discovery takes longer to complete.
            BrowserPrint.getDefaultDevice("printer", function(device) {

                //Add device to list of devices and to html select element
                selected_device = device;
                devices.push(device);
                var html_select = document.getElementById("selected_device");
                var option = document.createElement("option");
                option.text = device.name;
                html_select.add(option);

                //Discover any other devices available to the application
                BrowserPrint.getLocalDevices(function(device_list) {
                    for (var i = 0; i < device_list.length; i++) {
                        //Add device to list of devices and to html select element
                        var device = device_list[i];
                        if (!selected_device || device.uid != selected_device.uid) {
                            devices.push(device);
                            var option = document.createElement("option");
                            option.text = device.name;
                            option.value = device.uid;
                            html_select.add(option);
                        }
                    }

                }, function() {
                    alert("Error getting local devices")
                }, "printer");

            }, function(error) {
                alert(error);
            })
        }

        function getConfig() {
            BrowserPrint.getApplicationConfiguration(function(config) {
                alert(JSON.stringify(config))
            }, function(error) {
                alert(JSON.stringify(new BrowserPrint.ApplicationConfiguration()));
            })
        }

        function writeToSelectedPrinter(dataToWrite) {
            selected_device.send(dataToWrite, undefined, errorCallback);
            bootbox.dialog({ message: '<font color= "orange"><i class="fa fa-print" aria-hidden="true"></i> Imprimindo...... <font>', title: "Enviado para Impressora!!", buttons: { OK: { className: 'btn-default' } } });
		    window.setTimeout(function(){		
			bootbox.hideAll();
		}, 3000);
        }
        var readCallback = function(readData) {
            if (readData === undefined || readData === null || readData === "") {
                alert("No Response from Device");
            } else {
                alert(readData);
            }

        }
        var errorCallback = function(errorMessage) {
            alert("Error: " + errorMessage);
        }

        function readFromSelectedPrinter() {

            selected_device.read(readCallback, errorCallback);

        }

        function getDeviceCallback(deviceList) {
            alert("Devices: \n" + JSON.stringify(deviceList, null, 4))
        }

        function sendImage(imageUrl) {
            url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
            url = url + "/" + imageUrl;
            selected_device.sendUrl(url, undefined, errorCallback)
        }

        function sendImageHttp(imageUrl) {
            url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
            url = url + "/" + imageUrl;
            url = url.replace("https", "http");
            selected_device.sendUrl(url, undefined, errorCallback)
        }

        function onDeviceSelected(selected) {
            for (var i = 0; i < devices.length; ++i) {
                if (selected.value == devices[i].uid) {
                    selected_device = devices[i];
                    return;
                }
            }
        }
        window.onload = setup;
    </script>
</head>

<body style="font-family: verdana;">
<div class="container-fluid	">
    <div  class="panel panel-default">
        <div class="panel-heading"><b>Etiqueta de preço</b></div><br></br>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-left">
                            <div>
                                <font color="black" size="0"><?php echo ' Cód.Prod: ' . $codproduto_id . ' Cód.Fabr: ' . $codfabricante_id . ' Fabr: ' . $marca ?></font>
                            </div>
                            <div>
                                <font color="black" size="0"><?php echo $descricao ?></font>
                            </div>
                            <div><?php echo '<font color="red" size="5">' . ' R$ ' . number_format($precovenda,  2, ',', '.') . '</font>' ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../app/image/logo_correa.png" alt="Smiley face" height="45" width="75"></div>
                            <div>
                                <font color="black" size="0"> <?php echo $codbarra . ' - ' . $posicao ?></font>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br></br><br></br><br></br><br></br>
        <!-- codigo de Preços-->
        <!-- <button style="margin-left: 80px;"  class="btn btn-default "  onclick="writeToSelectedPrinter(' ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR4,4~SD15^JUS^LRN^CI0^XZ^XA^MMT^PW599^LL0320^LS0^FO416,128^GFA,00768,00768,00012,:Z64:eJxjYBgFeMACGIOZgdEBxuZqYGiAsWUOMCgwrGJYwbWCa4HWAg0G9v/8//j/2f+pf1DDwNXUxcXFpaGhwLCCgYdBhlVGTkLi/sE7DFwMGkxcK7QWrGrqYpBjsOCX/1P/4Yn7PwagWpBqhQVMqxhk/9j+sbAoKPx7hoeBCWi2hsYChVUdXHicGvC2xdn/1tkDYA7HCiWOLogrU321gvOazjrg1jmSAQDOqy+i:F3E7^FT119,175^A0N,39,64^FH\^FD<?php echo ' R$ ' . number_format($precovenda,  2, ',', '.'); ?>^FS^FT118,80^A0N,38,16^FH\^FD<?php echo ' Cód.Prod: ' . $codproduto_id . ' Cód.Fabr: ' . $codfabricante_id . ' Fabr: ' . $marca ?>^FS^FT119,126^A0N,38,21^FH\^FD<?php echo $descricao ?>^FS^FT120,210^A0N,26,45^FH\^FD<?php echo $codbarra . ' - ' . $posicao ?>^FS^PQ1,0,1,Y^XZ')"><i class="fa fa-print" aria-hidden="true"></i> Imprimir  <i class="fa fa-money" aria-hidden="true"></i></button> -->
        <button style="margin-left: 80px;"  class="btn btn-default "  onclick="writeToSelectedPrinter(' ^XA~TA000~JSN^LT0^MNW^MTT^PON^PMN^LH0,0^JMA^PR4,4~SD15^JUS^LRN^CI0^XZ^XA^MMT^PW599^LL0320^LS0^FO416,128^GFA,00768,00768,00012,:Z64:eJxjYBgFeMACGIOZgdEBxuZqYGiAsWUOMCgwrGJYwbWCa4HWAg0G9v/8//j/2f+pf1DDwNXUxcXFpaGhwLCCgYdBhlVGTkLi/sE7DFwMGkxcK7QWrGrqYpBjsOCX/1P/4Yn7PwagWpBqhQVMqxhk/9j+sbAoKPx7hoeBCWi2hsYChVUdXHicGvC2xdn/1tkDYA7HCiWOLogrU321gvOazjrg1jmSAQDOqy+i:F3E7^FT130,175^A0N,39,64^FH\^FD<?php echo ' R$ ' . number_format($precovenda,  2, ',', '.'); ?>^FS^FT150,80^A0N,38,16^FH\^FD<?php echo ' Prod: ' . $codproduto_id . ' Fabr: ' . $codfabricante_id . ' Marca: ' . $marca ?>^FS^FT150,126^A0N,38,21^FH\^FD<?php echo $descricao ?>^FS^FT152,210^A0N,26,45^FH\^FD<?php echo $codbarra . ' - ' . $posicao ?>^FS^PQ1,0,1,Y^XZ')"><i class="fa fa-print" aria-hidden="true"></i> Imprimir  <i class="fa fa-money" aria-hidden="true"></i></button>
       <!-- codigo de barras-->
        <button style="margin-left: px;"  class="btn btn-default "  onclick="writeToSelectedPrinter('^XA~TA000~JSN^LT0^MNW^MTD^PON^PMN^LH0,0^JMA^PR4,4~SD15^JUS^LRN^CI0^XZ^XA^MMT^PW831^LL0446^LS0^FT438,85^A0N,35,14^FH\^FD<?php echo $descricao ?>^FS^BY2,2,60^FT477,155^BEN,,Y,N^FD<?php echo $CodBarraInt ?>^FS^FT87,84^A0N,32,14^FH\^FD<?php echo $descricao ?>^FS^BY2,2,57^FT127,149^BEN,,Y,N^FD<?php echo $CodBarraInt ?>^FS^FT671,154^A0N,21,19^FH\^FD<?php echo  $posicao ?>^FS^FT319,149^A0N,21,21^FH\^FD<?php echo $posicao  ?>^FS^PQ1,0,1,Y^XZ')"><i class="fa fa-print" aria-hidden="true"></i> Imprimir <i class="fa fa-barcode" aria-hidden="true"></i></button>
        <br></br></div>
    </div>   
</body>

</html>