<?php
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
     $posizioni=mysql_query("SELECT Nome,nascita FROM `Atleta`  where  YEAR(Atleta.nascita) > 2015") or die(mysql_error());
          while($array=mysql_fetch_assoc($posizioni)) {
                  list($anno,$mese,$giorno)=split("-", $array["nascita"],3);
                  $anno=$anno-100;
                  $newdate=$anno."-".$mese."-".$giorno;
                  mysql_query("UPDATE Atleta SET nascita=$newdate WHERE Nome='$array[Nome]'") or die(mysql_error());

          }
?>