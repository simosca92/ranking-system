<?php
    require_once __DIR__ . '/db_connect.php';
    $db = new DB_CONNECT();
    session_start(); 
    if(isset($_POST['submit1'])) {
      header("Location: formRDL.php");
    }
    else if(isset($_POST['submit2'])){
      header("Location: form4_7.php");
    }
    else if(isset($_POST['submit3'])){
      header("Location: last.php");
    }
    else if(isset($_POST['submit5'])){
      //echo "DELETE FROM Partecipante_temp where username='$_SESSION[cod]'";
      mysql_query("DELETE FROM Partecipante_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Regata_temp where username='$_SESSION[cod]'") or die(mysql_error());
      mysql_query("DELETE FROM Ranking_temp where username='$_SESSION[cod]'") or die(mysql_error());
      header("Location: form.php");
    }
    else if(isset($_POST['submit7'])){
      header("Location: form.php");
    }
    else if(isset($_POST['submit8'])){
      header("Location: formSTD.php");
    }
      else if(isset($_POST['submit9'])){
      header("Location: formRDL.php");
    }
    else{
      $arr=mysql_query("SELECT Nome,Cognome FROM `Atleta`  where NomeCognome= '$_POST[atleta]'") or die(mysql_error());
        while($array=mysql_fetch_assoc($arr)) {
           $nome=$array[Nome];
           $cognome=$array[Cognome];
         }
      $check0=mysql_query("SELECT * FROM `Atleta`  where NomeCognome= '$_POST[atleta]'") or die(mysql_error());
      //atleta non esistente
      $check1=mysql_query("SELECT * FROM `Partecipante_temp`  where Nome= '$nome' AND Cognome= '$cognome' AND username= '$_SESSION[cod]'") or die(mysql_error());
      //Posizione già assegnata
      $check2=mysql_query("SELECT * FROM `Partecipante_temp` where  Posizione='$_POST[posizione]' AND Classe='$_SESSION[classe]' AND username= '$_SESSION[cod]'") or die(mysql_error());
      if((mysql_num_rows($check1) == 0) and (mysql_num_rows($check2) == 0) and  (mysql_num_rows($check0) > 0)){ 
          mysql_query("INSERT INTO Partecipante_temp  (Nome, Cognome, Classe,Posizione,username) 
            VALUES ('".$nome."','".$cognome."','". $_SESSION[classe]."','". $_POST['posizione']."','".$_SESSION[cod]."')") or die(mysql_error());
          //prendo le posizioni del partecipante "X" in quella classe e in quella zona! (geniale!!)
          $posizioni=mysql_query("SELECT Posizione FROM `Partecipante` JOIN `Regata` ON Id_regata=Id_regata_p  where  Nome= '$nome' AND Cognome= '$cognome' AND Classe='$_SESSION[classe]' AND Zona='$_SESSION[zona]'") or die(mysql_error());
          //$posizioni=mysql_query("SELECT Posizione FROM `Partecipante`  where  Nome= '$nome' AND Cognome= '$cognome' AND Classe='$_SESSION[classe]'") or die(mysql_error());
          //AGGIORNAMENTO RANKING PER IL PARTECIPANTE
          $pos=array();
          $ris=array();
          $i=1;
          $pos[0]=(101 - $_POST["posizione"]) * 1.30;
          while($array=mysql_fetch_assoc($posizioni)) {
            $pos[$i] = (101 - $array["Posizione"]) * 1.30;
           // $a=$a+$parz;
            $i=$i+1;
          }
          // se il numero di posizioni è maggiore di 5 prendo i 5 punteggi più alti
           //var_dump($pos);
          /*if(count($pos) > 5){
              $i2=0;
              while($i2 < 5){
                  $index = maxPr($pos);
                  $ris[$i2] = $pos[$index];
                  $pos[$index] = -1;
                  $i2 = $i2 + 1;
              }
            }
            else{
              $ris=$pos;
            }*/
            // FINE AGGIORNAMENTO RANKING PER IL PARTECIPANTE
            
            //CALCOLO NUOVO PUNTEGGIO
            $a=array_sum($pos);
          
         
          mysql_query("INSERT INTO Ranking_temp  (Nome, Cognome, Punteggio, Classe, username) 
                  VALUES ('".$nome."','".$cognome."','".$a."','".$_SESSION[classe]."','".$_SESSION[cod]."')") or die(mysql_error());
          if (strcmp($_SESSION[classe], "Standard")==0){
           echo "<script>
                alert('Partecipante aggiunto!');
                window.location.href='formSTD.php';
                </script>";
              }
           else if(strcmp($_SESSION[classe], "Radial")==0)
           echo "<script>
                alert('Partecipante aggiunto!');
                window.location.href='formRDL.php';
                </script>";
           else
           echo "<script>
                alert('Partecipante aggiunto!');
                window.location.href='form4_7.php';
                </script>";
           
                }
                else{
                      if (strcmp($_SESSION[classe], "Standard")==0){
                            if(mysql_num_rows($check0) == 0)
                              echo "<script>
                                  alert('Atleta non esistente!'+ $_POST[atleta]);
                                  window.location.href='formSTD.php';
                                  </script>";
                            else
                                echo "<script>
                                  alert('Partecipante già presente o posizione già assegnata per questa regata!');
                                  window.location.href='formSTD.php';
                                  </script>";
                          }
                       else if(strcmp($_SESSION[classe], "Radial")==0){
                              if(mysql_num_rows($check0) == 0)
                                      echo "<script>
                                          alert('Atleta non esistente!');
                                          window.location.href='formRDL.php';
                                          </script>";
                                    else
                                        echo "<script>
                                          alert('Partecipante già presente o posizione già assegnata per questa regata!');
                                          window.location.href='formRDL.php';
                                          </script>";
                          }
                       else{
                               if(mysql_num_rows($check0) == 0)
                                      echo "<script>
                                          alert('Atleta non esistente!');
                                          window.location.href='form4_7.php';
                                          </script>";
                                    else
                                        echo "<script>
                                          alert('Partecipante già presente o posizione già assegnata per questa regata!');
                                          window.location.href='form4_7.php';
                                          </script>";
                          }
                }
         
      mysql_close();
    }


    function maxPr($array)
    {
      $i7=1;
      $max=$array[0];
      $ind=0;
      while($i7 < count($array)){
        if($array[$i7] > $max){
            $max=$array[$i7];
            $ind=$i7;
          }
        $i7=$i7+1;
      }
      return $ind;
    }
 ?>