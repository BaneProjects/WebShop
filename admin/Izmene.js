var myApp=angular.
    module("mojModul", [])
	.controller("mojKontroler", function($scope, $http){
		$http.get("brisanje.php")
	    .then(function(response){
         $scope.proizvodi=response.data;
	    });
		$scope.obrisi=function(id){
			$http.get("brisanje.php?id="+id)
		.then(function(response){
			 $scope.poruka=response.data;
			 $scope.popuniPodatke();
			
		});
		};

		
		$scope.popuniPodatke=function(){
			$http.get("brisanje.php")
	    .then(function(response){
         $scope.proizvodi=response.data;
	    });
		}
		 $scope.popuniPodatke();
});