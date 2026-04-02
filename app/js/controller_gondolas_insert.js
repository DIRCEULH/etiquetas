var app = angular.module('myApp', ['rw.moneymask']);


app.controller('customersCtrl', function ($scope, $http) {
	
	$scope.gondolas = [];


	$scope.logado = window.sessionStorage.getItem('user');
	 
	 $http.post(
		'http://servidor4:8080/Gondolas/src/busca_fabricantes_fabrica.rest.php',

	).then(
		function (response) {
			$scope.fabricantes = response.data;
			//console.log($scope.fabricantes);

		}
	);


	 $scope.buscaDadosProdutos = function () {

		var codproduto = $scope.codproduto_id;
		var codfabricante = $scope.codfabricante_id;
		var data = {codproduto,codfabricante};
		//console.log(data);

if(codproduto != null && codfabricante !=  null ){

	 $http.post(
		'http://servidor4:8080/Gondolas/src/busca_produtos_fabrica.rest.php',data

	).then(
		function (response) {
			$scope.produtos = response.data;
			//console.log($scope.produtos);

			})
			.catch(function (err) {
				
					bootbox.alert('<font color= "red"> Nada Encontrado com este Fornecedor!!</font> ');
					window.setTimeout(function(){
							
						bootbox.hideAll();
					}, 2000);
			
			})
			.finally(function () {
				// Hide loading spinner whether our call succeeded or failed.
			

			});



} else {
	bootbox.alert('<font color= "red"> Favor preencher os campos !!</font> ');
	window.setTimeout(function(){
			
		bootbox.hideAll();
	}, 2000);
}

}
    


	$scope.insereDados = function () {

		var empresa = $scope.empresa;
		var filial = $scope.filial;
		var tipo_id = $scope.tipo_id;
		var codproduto_id = $scope.codproduto_id;
		var codfabricante_id = $scope.codfabricante_id;
		var datainicio = $scope.datainicio;
		var datavalidade = $scope.datavalidade;
		var precovenda = $scope.precovenda;
		var quantidade = $scope.quantidade;
		var posicao = $scope.posicao;
		var data = { empresa, filial, tipo_id, codproduto_id,codfabricante_id,datainicio,datavalidade,precovenda,quantidade,posicao };

		//console.log(data);

		if ($scope.empresa == null || $scope.filial == null || $scope.tipo_id == null ||
			$scope.codproduto_id == null || $scope.codfabricante_id == null || 
			$scope.datainicio == null || $scope.datavalidade == null || $scope.precovenda == null || 
			$scope.quantidade == null || $scope.posicao == null) {
			bootbox.alert('<font color= "red"> Campos obrigatórios!!! <font>');
			window.setTimeout(function () {

				bootbox.hideAll();
			}, 2000);
		}
		if ($scope.empresa != null && $scope.filial != null && $scope.tipo_id != null && $scope.codproduto_id != null && 
			$scope.codfabricante_id != null && $scope.datainicio != null && $scope.datavalidade != null &&
			$scope.precovenda != null && $scope.quantidade != null && $scope.posicao != null) {
			console.log(data);
			$http.post(
				"http://servidor4:8080/Gondolas/src/insert_gondolas.rest.php"
				, data
			).then(
				function (response) {
					$scope.gondolas = response.data.records;
	
				}
			);
				
			bootbox.alert('<font color= "blue"> Enviado com Sucesso!! <font>');
			window.setTimeout(function () {

				bootbox.hideAll();
			}, 2000);
		
		}


	}


});




