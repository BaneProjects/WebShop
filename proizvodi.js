var myApp=angular.
    module("mojModul", [])
	.controller("mojKontroler", function($scope, $http){
		
	$scope.povecaj=function(idKomentara)
	{
		//alert(idKomentara);
		$http.get("komentari.php?akcija=volime&idKomentara="+idKomentara)
		 location.reload();
	};
	$scope.smanji=function(idKomentara)
	{    
		$http.post("komentari.php?akcija=nevolime&idKomentara="+idKomentara)
		location.reload();
	};
});