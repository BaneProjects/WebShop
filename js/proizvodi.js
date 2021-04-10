$(document).ready(function(){

});
function UbaciUKorpu(idProizvoda)
{
	   $.post("ajax/ajax_proizvodi.php", {idProizvoda:idProizvoda}, function(response){
		   alert(response);
		   $("#broj").html(parseInt($("#broj").html())+1);
		   
	   })	
}