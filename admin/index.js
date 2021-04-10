var myApp=angular.
    module("mojModul", [])
	.controller("mojKontroler", function($scope, $http){
	
	$scope.posaljiPodatke=function(){
		$http.post("servisi.php",{ime:$scope.ime, prezime:$scope.prezime, email:$scope.email, lozinka:$scope.lozinka, adresa:$scope.adresa,
		status:$scope.status})
		.then(function(response){
			 $scope.poruka=response.data;
			 $scope.popuniPodatke();
		});		
	};
	$scope.Obrisi=function(id)
	{
	   $http.get("servisi.php?id="+id)
		.then(function(response){
			 $scope.poruka=response.data;
			 $scope.popuniPodatke();
			
		});
	};
	$scope.pripremi=function(korisnik){
		$scope.id=korisnik.id;
		$scope.ime=korisnik.Ime;
		$scope.prezime=korisnik.Prezime;
		$scope.email=korisnik.Email;
		$scope.lozinka=korisnik.Lozinka;
		$scope.adresa=korisnik.Adresa;
		$scope.status=korisnik.Status;
	};
	$scope.izmeniPodatke=function(){
		$http.post("servisi.php?id="+$scope.id,{ime:$scope.ime, prezime:$scope.prezime, email:$scope.email, lozinka:$scope.lozinka, adresa:$scope.adresa,
		status:$scope.status})
		.then(function(response){
			 $scope.poruka=response.data;
			 $scope.popuniPodatke();
		});		
		
	};
	$scope.popuniPodatke=function(){
		$http.get("servisi.php")
	    .then(function(response){
         $scope.korisnici=response.data;
	})
		
	}
	$scope.popuniPodatke();
	});