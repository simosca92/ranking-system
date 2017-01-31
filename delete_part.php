<?php
	require_once __DIR__ . '/db_connect.php';
	$db = new DB_CONNECT();
	session_start();
  /*echo $_POST["cognome"];
  echo $_POST["nome"];*/
	mysql_query("DELETE FROM Partecipante_temp where username='$_SESSION[cod]' and Nome=\"$_POST[nome]\" and Cognome=\"$_POST[cognome]\"") or die(mysql_error());
	if(isset($_POST['submit0'])) {
      header("Location: formSTD.php");
    }
    else if(isset($_POST['submit1'])){
      header("Location: formRDL.php");
    }
    else if(isset($_POST['submit2'])){
      header("Location: form4_7.php");
    }
?>