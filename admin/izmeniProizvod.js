var myApp=angular.
    module("mojModul", [])
	.controller("mojKontroler", function($scope, $http){
	
		
	$scope.pripremi=function(proizvod){
		$scope.id=proizvod.id;
		$scope.naslov=proizvod.Naslov;
		$scope.idTelefona=proizvod.IdTelefona;
		$scope.procesor=proizvod.Procesor;
		$scope.baterija=proizvod.Baterija;
		$scope.kamera=proizvod.Kamera;
		$scope.memorija=proizvod.Memorija;
		$scope.operativniSistem=proizvod.OperativniSistem;
		$scope.cena=proizvod.Cena;
	};
	
		$scope.izmeniPodatke=function(){
		$http.post("servis1.php?id="+$scope.id,{naslov:$scope.naslov, idTelefona:$scope.idTelefona, procesor:$scope.procesor, baterija:$scope.baterija, kamera:$scope.kamera,
		memorija:$scope.memorija ,operativniSistem:$scope.operativniSistem, cena:$scope.cena})
		.then(function(response){
			 $scope.poruka=response.data;
			 $scope.popuniPodatke();
		});		
	};
    $scope.popuniPodatke=function(){
			$http.get("servis1.php")
	    .then(function(response){
         $scope.proizvodi=response.data;
	});
	};
		$scope.popuniPodatke();
		
});