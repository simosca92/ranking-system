<?php
 	session_start(); 
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
    if(isset($_POST['submit4'])) {
        mysql_query("INSERT INTO Regata (Nome_regata, Circolo_org, Data, Zona) 
        VALUES ('".$_SESSION['regata']."','".$_SESSION['circolo']."','".$_SESSION['data']."','".$_SESSION['zona']."')") or die(mysql_error());
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
                        $check3 = mysql_query("SELECT * FROM `Ranking_zonale`  where  Nome= '$array[Nome]' AND Cognome= '$array[Cognome]' AND Zona='$_SESSION[zona]' AND Classe='$array[Classe]'") or die(mysql_error());
                         if(mysql_num_rows($check3) > 0){
                             mysql_query("UPDATE `Ranking_zonale` SET `Punteggio`= '$array[Punteggio]' WHERE  Nome= '$array[Nome]' AND Cognome= '$array[Cognome]'  AND Zona='$_SESSION[zona]' AND Classe='$array[Classe]'") or die(mysql_error());
                         }
                         else{
                                mysql_query("INSERT INTO Ranking_zonale (Nome, Cognome, Punteggio, Classe, Zona) 
                                VALUES ('".$array["Nome"]."','".$array["Cognome"]."','".$array["Punteggio"]."','".$array["Classe"]."','".$_SESSION["zona"]."')") or die(mysql_error());
                         }
                    }
        }
      mysql_query("DELETE FROM Partecipante_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Regata_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Ranking_temp where username='$_SESSION[cod]'") or die(mysql_error());
        if(isset($_POST['submit4'])) {
        	 echo "<script>
                    alert('Regata aggiunta correttamente!');
                    window.location.href='form.php';
                    </script>";
        }
        else{
        	header("Location: form.php");
		}
?>