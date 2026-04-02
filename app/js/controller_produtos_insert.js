var app = angular.module('myApp', []);


app.controller('customersCtrl', function ($scope, $http) {
	$scope.produtos = [];

	
	// var user = window.sessionStorage.getItem('user');
    
	// if(user == 'ADMIN') {
    //    $scope.mostra = 1;
	// }

	$scope.insereDados = function () {

		var nome = $scope.nome;
		var data = $scope.data;
		var observacao = $scope.observacao;
		var usuario = window.sessionStorage.getItem('user');
		var data = { nome, data, observacao, usuario };

		//console.log(data);

		$http.post(
			"http://servidor4:8080/Ti_control/src/insert_produtos.rest.php"
			, data
		).then(
			function (response) {
				$scope.produtos = response.data.records;
				//console.log($scope.produtos);
			}
		);
		if ($scope.nome == null || $scope.data == null || $scope.observacao == null) {
			bootbox.alert('<font color= "red"> Campos obrigatórios!!! <font>');
			window.setTimeout(function () {

				bootbox.hideAll();
			}, 2000);
		}
		if ($scope.nome != null && $scope.data != null && $scope.observacao != null) {
			bootbox.alert('<font color= "blue"> Enviado com Sucesso!! <font>');
			window.setTimeout(function () {

				bootbox.hideAll();
			}, 2000);
			//window.location = "../app/upload_links.html"
		}


	}


});




