<?php
 	session_start(); 
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
    if(isset($_POST['submit4'])) {
        mysql_query("INSERT INTO Regata (Nome_regata, Circolo_org, Data, Zona,Npart,Grade) 
        VALUES ('".$_SESSION['regata']."','".$_SESSION['circolo']."','".$_SESSION['data']."','".$_SESSION['zona']."','".$_SESSION['part']."','".$_SESSION['grade']."')") or die(mysql_error());
        $selezione=mysql_query("SELECT Id_regata FROM `Regata` where Nome_regata= '$_SESSION[regata]' and Data='$_SESSION[data]' and Zona='$_SESSION[zona]'") or die(mysql_error());
        $array=mysql_fetch_assoc($selezione);
        $id=$array["Id_regata"];
        $partTable=mysql_query("SELECT Nome,Cognome,Classe, Posizione FROM `Partecipante_temp` where username='$_SESSION[cod]'") or die(mysql_error());
         while($array=mysql_fetch_assoc($partTable)) {
            mysql_query("INSERT INTO Partecipante (Id_regata_p,Nome, Cognome, Posizione, Classe) 
                              VALUES ('".$id."','".$array["Nome"]."','".$array["Cognome"]."','".$array["Posizione"]."','".$array["Classe"]."')") or die(mysql_error());
          }
         $partTableRanking=mysql_query("SELECT Nome,Cognome,Punteggio,Classe FROM `Ranking_temp` where username='$_SESSION[cod]'") or die(mysql_error());
         while($array=mysql_fetch_assoc($partTableRanking)) {
                        $check3 = mysql_query("SELECT * FROM `Ranking`  where  Nome= '$array[Nome]' AND Cognome= '$array[Cognome]' AND Classe='$array[Classe]'") or die(mysql_error());
                         if(mysql_num_rows($check3) > 0){
                             mysql_query("UPDATE `Ranking` SET `Punteggio`= '$array[Punteggio]' WHERE  Nome= '$array[Nome]' AND Cognome= '$array[Cognome]' AND Classe='$array[Classe]'") or die(mysql_error());
                         }
                         else{
                                mysql_query("INSERT INTO Ranking (Nome, Cognome, Punteggio, Classe) 
                                VALUES ('".$array["Nome"]."','".$array["Cognome"]."','".$array["Punteggio"]."','".$array["Classe"]."')") or die(mysql_error());
                         }
                    }
        }
      mysql_query("DELETE FROM Partecipante_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Regata_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Ranking_temp where username='$_SESSION[cod]'") or die(mysql_error());
        if(isset($_POST['submit4'])) {
        	 echo "<script>
                    alert('Regata aggiunta correttamente!');
                    window.location.href='formROOT.php';
                    </script>";
        }
        else{
        	header("Location: formROOT.php");
		}
?>