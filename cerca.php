<?php
	require_once __DIR__ . '/db_connect.php';
	$db = new DB_CONNECT();
	if(isset($_POST['atleta'])){
		$nome=$_POST['atleta'];
  	}
  	else{
		$nome="";
	}
	$query=" select NomeCognome from Atleta where NomeCognome like '%$nome%' order by NomeCognome";
	$result = mysql_query ($query) or die(mysql_error());
	echo "<ul>";
	 while($array=mysql_fetch_assoc($result)) 
    { 
    	echo "<li>".$array["NomeCognome"]."</li>";
	}
	echo "</ul>";
?>