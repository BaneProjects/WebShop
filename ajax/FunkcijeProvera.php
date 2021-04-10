<?php
function validanString($str)
{
	if(strpos($str, " ")!==false) return false;
	if(strpos($str, "=")!==false) return false;
	if(strpos($str, "+")!==false) return false;
	if(strpos($str, "-")!==false) return false;
	if(strpos($str, "*")!==false) return false;
	if(strpos($str, "/")!==false) return false;
	if(strpos($str, "?")!==false) return false;
	if(strpos($str, "&")!==false) return false;
	if(strpos($str, "''")!==false) return false;
	if(strpos($str, "(")!==false) return false;
	if(strpos($str, ")")!==false) return false;
	return true;
}
?>
