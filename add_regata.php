 <?php
 	//CONTROLLO SE VIENE INSERITA UNA DATA
 	if (strlen($_POST['data']) == 0) {
      echo"<script>
                 alert('Il campo data è obbligatorio!');
                 window.location.href='form.php';
                 </script>";
    }
    else{
          session_start(); 
          require_once __DIR__ . '/db_connect.php';
          $db = new DB_CONNECT();
          $NOME_REG=strtoupper($_POST["nome_regata"]);
          $CIRCOLO=strtoupper($_POST["circolo"]);
          $check=mysql_query("SELECT * FROM Regata where Nome_regata='$NOME_REG' and  Circolo_org='$CIRCOLO' and Data='$_POST[data]' and Zona='$_POST[zona]'") or die(mysql_error());
          if(mysql_num_rows($check) == 0){
              mysql_query("INSERT INTO Regata_temp (username,Nome_regata,Circolo_org, Data, Zona) VALUES ('".$_SESSION['cod']."','".$_POST['nome_regata']."','".$_POST['circolo']."','".$_POST['data']."','".$_POST['zona']."')") or die(mysql_error());
            /*  echo "<script>
                     alert('Regata aggiunta correttamente!');
                     window.location.href='formSTD.php';
                     </script>";*/
                 $regata=$_POST['nome_regata'];
                 $date1=$_POST['data'];
                 $circolo=$_POST['circolo'];
                 $_SESSION['regata'] = $regata;
                 $_SESSION['data'] = $date1;
                 $_SESSION['circolo'] = $circolo;
                 $_SESSION['zona'] = $_POST['zona'];
                 header ("Location: formSTD.php"); 
                 mysql_close();
              }
          else{
             echo"<script>
                   alert('Regata già esistente!');
                   window.location.href='form.php';
                   </script>";
          }
    }
?>