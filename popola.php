<?php
	// Nelle versioni di PHP precedenti alla 4.1.0 si deve utilizzare  $HTTP_POST_FILES anzichè
	// $_FILES.
	// require_once __DIR__ . '/old';
	$file = "/membri/simonescala/old/".$_FILES['CSV']['name'];
	$fp = fopen($file,"w");
	if (move_uploaded_file($_FILES['CSV']['tmp_name'], $file)) {
	    echo "File is valid, and was successfully uploaded.\n";
	} else {
	    echo "Possibile attacco tramite file upload!\n";
	}
	fclose($fp);
	$delimiter = ";";
	 //variabile da stampare
	//apro il file
	require_once __DIR__ . '/db_connect.php';
	$db = new DB_CONNECT();
	session_start();
	$_SESSION["regata"] = $_POST['nome_regata'];
	$_SESSION["zona"] = "Nazionale";
	$_SESSION["data"] = $_POST["data"];
	$_SESSION["circolo"] = $_POST["circolo"];
	$_SESSION["part"] = $_POST["part"];
	$_SESSION["grade"] = $_POST["grade"];
	list($grade,$event)=split("-", $_POST["grade"]);
	mysql_query("INSERT INTO Regata_temp (username,Nome_regata,Circolo_org, Data, Zona ,Npart,Grade) VALUES ('".$_SESSION['cod']."'
		,'".$_POST['nome_regata']."','".$_POST['circolo']."','".$_POST['data']."','Nazionale' ,'".$_POST['part']."','".$grade."')") or die(mysql_error());
	$primo=0;

	if (($fp = fopen($file, "r")) !== false)
	{
		
	//per ogni riga del file...
	while (($data = fgetcsv($fp, 1000, $delimiter)) !== false) {
	//...inserisco una riga nella tabella

	 $index=0;
	 $array=array();
	 $pos=array();
			foreach( $data as $el ) {
			   $array[$index]=$el;
			  
			   if(count($array)==3){
			   	
			   	$arr= explode(" ", $array[1]);
			   	if(count($arr)==2){
			   		$cognome=$arr[1];
			   		$nome=$arr[0];
			   	}
			   	else if(count($arr)==3){
			   		$cognome=$arr[1]." ".$arr[2];
			   		$nome=$arr[0];
			   	}
			   	if(count($arr)==4){
			   		$cognome=$arr[2]." ".$arr[3];
			   		$nome=$arr[0]." ".$arr[1];
			   	}

			   		mysql_query("INSERT INTO Partecipante_temp  (Nome, Cognome, Classe,Posizione,username) 
	            VALUES ('".$nome."','".$cognome."','Standard','". $array[0]."','".$_SESSION[cod]."')") or die(mysql_error());
			   		$posizioni=mysql_query("SELECT Posizione,Npart,Grade FROM `Partecipante` JOIN `Regata` ON Id_regata=Id_regata_p  where  Nome= '$nome' AND Cognome= '$cognome' AND Classe='Standard' AND Zona='Nazionale'") or die(mysql_error());
			   	$i=1;
			   	$pos[0]=round((($grade*($_POST["part"] - $array[0] + 1)) / $_POST["part"]),2);
			   	//a detta di panada tutte le regate nazionali vanno in rankin nazionale
			   	while($array2=mysql_fetch_assoc($posizioni)) {
			            $pos[$i] = round((($array2["Grade"]*($array2["Npart"] - $array2['Posizione'] + 1)) / $array2["Npart"]),2);
			           // $a=$a+$parz;
			            $i=$i+1;
	            	}
				//INSERIRE QUI CALCOLO ZONALE (prime cinque zonali vanno in ranking nazionale)
	           $posizioniZonale=mysql_query("SELECT Posizione FROM `Partecipante` JOIN `Regata` ON Id_regata=Id_regata_p  where  Nome= '$nome' AND Cognome= '$cognome' AND Classe='Standard' AND Zona !='Nazionale' ORDER BY Regata.Data") or die(mysql_error());
	           $five=0;
	           	while(($array3=mysql_fetch_assoc($posizioniZonale)) && (five<5)) {
			            $pos[$i] = round(((10*(53 - $array3['Posizione'] + 1)) / 53),2);
			           // $a=$a+$parz;
			            $five=$five+1;
			            $i=$i+1;
	            	}
				$a=array_sum($pos);
	          	mysql_query("INSERT INTO Ranking_temp  (Nome, Cognome, Punteggio, Classe, username) 
	                  VALUES ('".$nome."','".$cognome."','".$a."','Standard','".$_SESSION[cod]."')") or die(mysql_error());
			   }
			 $index=$index+1;      
		    }
	    }
	    fclose($fp);
	    header("Location:last_naz.php");
	  }
?>