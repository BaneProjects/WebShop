<?php
class Log {
  public static function upisi($datoteka, $tekst) 
  {
	 $stariTekst="";
	 if(file_exists($datoteka))$stariTekst=file_get_contents($datoteka);
     $f=fopen($datoteka, "w");
	 $tekstZaUpis=date("d.m.Y  H:i")."-".$tekst."\r\n".$stariTekst."\r\n";
	 fwrite($f, $tekstZaUpis);
	 fclose($f);
  }
}
?>