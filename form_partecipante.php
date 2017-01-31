<?php
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
     /*$posizioni=mysql_query("SELECT NomeCognome,nascita FROM `Atleta`  where  YEAR(Atleta.nascita) > 2015") or die(mysql_error());
          while($array=mysql_fetch_assoc($posizioni)) {
                  list($anno,$mese,$giorno)=split("-", $array["nascita"],3);
                  $anno=$anno-100;
                  $newdate=$anno."-".$mese."-".$giorno;
                  echo $newdate."<br>";
                  mysql_query("UPDATE Atleta SET nascita='$newdate' WHERE NomeCognome='$array[NomeCognome]'") or die(mysql_error());

          }
          */
          $posizioni=mysql_query("SELECT Cognome,Nome,tessera FROM `TABLE 10`") or die(mysql_error());
           while($array=mysql_fetch_assoc($posizioni)) {
              echo $array[Nome]." ".$array[Cognome]." ".$array[tessera];
                  mysql_query("UPDATE Atleta SET Nome='$array[Nome]',Cognome='$array[Cognome]' WHERE tessera_fiv=$array[tessera]") or die(mysql_error());

          }

?>