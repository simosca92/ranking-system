<?php
		session_start();
		$_SESSION = array();
		session_destroy(); //distruggo tutte le sessioni
		$msg = urlencode($msg); // invio il messaggio via get
		header("location: index.php");
		exit();
?>