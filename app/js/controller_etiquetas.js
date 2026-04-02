var app = angular.module('myApp', ['angularUtils.directives.dirPagination','rw.moneymask']);

app.controller('customersCtrl',function ($scope,$http,$filter) {

	$scope.logado = window.sessionStorage.getItem('user');

	$scope.enabled = [];
	$scope.gondolas = [];
	
	$scope.carregar = function (){

		if ($scope.dti == null) {
			var adate = new Date();
			var dia =  adate.getDate();
			if(dia < 10){
				dia = '0' + dia;
			  }
			var mes = adate.getMonth() + 1;
			if(mes < 10){
				mes = '0' + mes;
			  }
			var ano = adate.getFullYear();
			var dti = [ano, mes, dia].join('-');
			
		} else {
		// data inicial
		var adate = new Date($scope.dti);
		
		var dia  = adate.getDate().toString().padStart(2, '0');
		var mes  = (adate.getMonth()+1).toString().padStart(2, '0');
		var ano  = adate.getFullYear();
		var dti = [ano, mes, dia].join('-');
		}

		if ($scope.dtf == null) {
			var adate = new Date();
			var dia =  adate.getDate();
			if(dia < 10){
				dia = '0' + dia;
			  }
			var mes = adate.getMonth() + 1;
			if(mes < 10){
				mes = '0' + mes;
			  }
			var ano = adate.getFullYear();
			var dtf = [ano, mes, dia].join('-');
			//console.log(adate);

		} else {
			
		// data final
		
		var datef = new Date($scope.dtf);
		
		var dia  = datef.getDate().toString().padStart(2, '0');
		var mes  = (datef.getMonth()+1).toString().padStart(2, '0');
		var ano  = datef.getFullYear();
		var dtf = [ano, mes, dia].join('-');

			
			}

		var dados = {dti, dtf}
		console.log(dados);
		$http.post(
			'../src/etiquetas.rest.php',dados
	
		).then(
			function (response) {
				$scope.etiqueta = response.data;
				//console.log($scope.etiqueta);
			

				var grupo = $scope.etiqueta;
				for (var g in grupo) {
					var produtos  = grupo[g];
					var produto = produtos.IDPRODUTO;
					//console.log(produto);
				
				if(produto != 'Nada encontrado neste periodo!'){
					//console.log(parseFloat(produtos.idproduto));
					$scope.impressao = true;

				}else{
					$scope.impressao = false;
					
				}
				}
			}).catch(function (err) {
			bootbox.alert('<font color= "red"><i class="fa fa-bug" aria-hidden="true"></i> Error!! ');
			window.setTimeout(function () {
				bootbox.hideAll();
			}, 2000);
		})
		.finally(function () {


		});
	}

		
		

	
// 	// function update
// 	$scope.alterar = function (x,Produto,Fabricante,PrecoVenda,DataInicio,DataValidade,Quantidade,Codbarra,Posicao) {
		
		
// 		var data = {x,Produto,Fabricante,PrecoVenda,DataInicio,DataValidade,Quantidade,Codbarra,Posicao};
// 		console.log(data);
// 	    var campo1 = '';
// 		var campo2 = '';
// 		var campo3 = '';
// 		var campo4 = '';
// 		if(PrecoVenda == '' ){ var campo1 = 'Preço de Venda'}
// 		if(DataInicio == '' ){var campo2 = 'Data de Inicio'}
// 		if(DataValidade == '' ){var campo3 = 'Data de validade'}
// 		if(Quantidade == '' ){var campo4 = 'Quantidade'}
// 		if(Codbarra == '' ){var campo5 = 'Código de barras'}
// 		if(Posicao == '' ){var campo6 = 'Posicao'}

// 		if(PrecoVenda != '' && DataInicio != '' && DataValidade != '' && Quantidade !=''  && Codbarra !='' && Posicao !=''){

// 		$http.post(
// 			"http://servidor4:8080/Gondolas/src/update_gondolas.rest.php", data

// 		).then(
// 			function (response) {
// 				$scope.rtrnUsers = response.data;
//                 //console.log($scope.rtrnUsers );
// 				bootbox.alert('<font color= "blue"> Salvo com sucesso!!</font>');
// 				window.setTimeout(function(){
					
// 					bootbox.hideAll();
// 					//window.location = "../app/update_gondolas.html";
// 				}, 1000);
				
// 			}
// 		);
			
	
// 		} else {
// 			bootbox.alert('<font color= "red"> Favor preencher o campo : <font>'+ campo1 + ' ' + campo2 + ' ' + campo3 + ' ' + campo4 + ' ' + campo5 + ' ' + campo6 );
// 			window.setTimeout(function(){
					
// 				bootbox.hideAll();
// 			}, 2000);
// 		}
// 	}


// 	// deletar dados

// 	$scope.remover = function (Produto, Fabricante, sequencia) {

// 		console.log(sequencia);
// 		bootbox.confirm({
// 			message: "<font color='red'>Deseja realmente excluir o Item da Gondola?</font>",
// 			buttons: {
// 				confirm: {
// 					label: 'Sim',
// 					className: 'btn-primary'
// 				},
// 				cancel: {
// 					label: 'Não',
// 					className: 'btn-danger'
// 				}
// 			},
// 			callback: function (result) {
// 				console.log('Deseja realmente excluir o Item da Gondola?' + result);
// 				if (result == true) {

// 		        var data = { Produto ,Fabricante, sequencia};
// 		        console.log(data);


// 		$http.post(
// 			"http://servidor4:8080/Gondolas/src/delete_gondolas.rest.php", data

// 		).then(
// 			function (response) {
// 				$scope.rtrnUsers = response.data;}
// 		);

// 		window.location = "../app/update_gondolas.html";

// 	}
// }
// });
			
// }

// 	// liberar input para editar
// 	$scope.editar = function(x) {
// 		console.log("index: " + x);
// 		$scope.enabled[x] = true;
// 	}

//      // imprimi etyiqueta com preços
// 	$scope.writeToSelectedPrinter = function(um,PrecoVenda,dois,Produto,Fabricante,Marca,tres,Descricao,quatro,Codbarra,Posicao,cinco) {
// 		dataToWrite = um+PrecoVenda+dois+'Prod: '+Produto+' Fabr: '+Fabricante+' Marca: '+Marca+tres+Descricao+quatro+Codbarra+' - '+Posicao+cinco;
// 		selected_device.send(dataToWrite, undefined, errorCallback);
// 		//console.log(dataToWrite);
	
// 		bootbox.dialog({ message: '<font color= "orange"><i class="fa fa-print" aria-hidden="true"></i> Imprimindo...... <font>', title: "Enviado para Impressora!!", buttons: { OK: { className: 'btn-default' } } });
// 		window.setTimeout(function(){		
// 			bootbox.hideAll();
// 		}, 3000);
// }
  
});




