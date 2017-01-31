<?php
   
    // Nelle versioni di PHP precedenti alla 4.1.0 si deve utilizzare  $HTTP_POST_FILES anzichè
// $_FILES.
// require_once __DIR__ . '/old';
$file = "/membri/simonescala/old/".$_FILES['CSV']['name'];
$fp = fopen($file,"w");
echo '<pre>';
if (move_uploaded_file($_FILES['CSV']['tmp_name'], $file)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possibile attacco tramite file upload!\n";
}

echo 'Alcune informazioni di debug:';
print_r($_FILES);

print "</pre>";
fclose($fp);
   $delimiter = ";";
   $echo = "<table>";  //variabile da stampare
   //apro il file
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
    $primo=0;
    
   if (($fp = fopen($file, "r")) !== false)
   {
    //per ogni riga del file...
    $b=0;
    while (($data = fgetcsv($fp, 1000, $delimiter)) !== false) {
    //...inserisco una riga nella tabella
    $a=0;
    $echo .= "<tr>";
    $index=0;
     $array=array();
        foreach( $data as $el ) 
            {
        // if(($a==0) or ($a==5) or ($a==$b)){ // con questo if posso prendere le righe che mi interessano
          // if((strcmp($el,"class")!=0) and (strcmp($el,"Name")!=0) and (strcmp($el,"DUMMY")!=0)){
      //  echo "ind=".$index."el:".$el;
           if($primo >=1)
            $array[$index]=$el;
            //echo count($array)."---";
            if((count($array)==7) && ($primo >= 1)){
              list($giorno,$mese,$anno)=split("/", $array[3],3);
              $newformat=$anno."/".$mese."/".$giorno;
              mysql_query("INSERT INTO `Atleta`(`N_tessera`, NomeCognome, `nascita`, Circolo, Zona, Sesso, `tessera_fiv`) VALUES ('$array[0]','$array[2]','$newformat','$array[6]','$array[5]','$array[4]','$array[1]')") or die(mysql_error());
              
            }
            $index=$index+1;
            $echo .= "<td>".$el."</td>";
            
           //}
        //}
         /*if(strcmp($el,"overall")==0)
           $b=$a;
         $a=$a+1;*/
       
      }
    $echo .= "</tr>";
    $primo=$primo+1;
    }
    fclose($fp);
   }
    
   //restituisco la tabella
   $echo .= "</table>";
   echo $echo;
?>