<!DOCTYPE html>
<html>

<head>
  <title>RankingList</title>
  <!-- META -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- META -->
  <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

  <!-- CSS -->
  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  <!-- CSS -->  
  
  <script language="Javascript" type="text/javascript">
  var secondi=1;
  var num=0;
  function CambiaImmagine() {
    var immagini=new Array();
    //immagini[0]="Laser.jpg";
    immagini[0]="race6.jpg";
    document.getElementById("sfondo").src=immagini[num];
    num=(num+1>=immagini.length)?0:num+1;
    setTimeout("CambiaImmagine()",secondi*5000);
  } 
  </script>
</head>
<style>
[class^="col-"] {
  background-color: rgba(86, 61, 124, 0.15);
  border: 1px solid rgba(86, 61, 124, 0.2);
  padding-bottom: 20px;
  padding-top: 40px;
  height: 500px;
  overflow-y:scroll;
  margin-bottom: 80px;
  
}
h1,a,pre,tr,td,li {
  font-family: 'Lato', sans-serif;
}
#bianco{
  background-color: #FFFFFF;
  font-family: 'Lato', sans-serif;
}
#first{
 background-color:#FFA500;
}
#second{
 background-color:#CC0000;
}
#third{
 background-color:#8F8F8F;
}
#sfondo{
  width: 100%;
  height: 25vh;
}
table{
  background-color:#FFFFFF;
  margin-top: 10px;
}
.laser{
 margin-left: 10px;
 padding-right: 20px;
}


#ex3::-webkit-scrollbar{
  width:8px;
  background-color:#cccccc;
} 
#ex3::-webkit-scrollbar-thumb{
  background-color:rgba(86, 61, 124, 0.15);
  border-radius:10px;
}
#ex3::-webkit-scrollbar-thumb:hover{
  background-color:#5D8AA8;
  border:1px solid #333333;
}
#ex3::-webkit-scrollbar-thumb:active{
  background-color:#5D8AA8;
  border:1px solid #333333;
} 
</style>
<body onload="CambiaImmagine()">
  <body>

    <!-- CONTENUTO DELLA PAGINA ... -->


    <!-- JS -->
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {      
       $('#resultTable tr').click(function (event) {
                  var str = $(this).attr('id');
                  var res = str.split("|");
                  window.location.href='schedaAtleta.php?Nome='+ res[0] +'&'+'Cognome='+ res[1];
                          
                
                         });
        });
    </script>
    <!-- JS -->
    <img id="sfondo" src="sfondo.jpg"> </img>
    <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Espandi barra di navigazione</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="pull-left" href="logo_fiv.png">
          <img src="logo_fiv.png" class="laser">
        </a>
      </div>

      <!—Elementi della barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li id="first"><a href="form_partecipante.php" class="change">Regolamento Ranking</a></li>
          <li id="second" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Ranking-List zonale  <b class="caret"></b></a>
              <ul id"resultUL" class="dropdown-menu">
                <li id="bianco"><a href="indexZonale.php?zona='I zona'">I Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='II zona'">II Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='III zona'">III Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='IV zona'">IV Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='V zona'">V Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='VI zona'">VI Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='VII zona'">VII Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='VIII zona'">VIII Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='IX zona'">IX Zona</a></li>
                <li id="bianco"><a href="indexZonale.php?zona='X zona'">X Zona</a></li>
              </ul>
            </li>
            <?php
            session_start();
            if (session_is_registered('autorizzato'))
              echo"<li id=third><a href=form.php class=change>Area riservata</a></li>";
            else
              echo"<li id=third><a href=login.html class=change>Area riservata</a></li>";
            ?>
          </ul>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="col-md-6" id="ex3"><h1>Standard top 10</h1>
            
               <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Standard&cat=Assoluta'">Vedi in dettaglio</button>
                         
            <table id="resultTable" class="table table-hover">
             <thread>
              <tr>
                <th>Pos</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Punteggio</th>
              </tr>
            </thread>
            <tbody>
             <?php
             require_once __DIR__ . '/db_connect.php';
             $db = new DB_CONNECT();
             $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking` where Classe='Standard'order by Punteggio DESC,Nome") or die(mysql_error());
             if(mysql_num_rows($selezione)>0){ 
              $a=1;
              $space="  ";
              $ok=1;
              while(($array=mysql_fetch_assoc($selezione)) && ($ok==1)) 
              { 
                $nome=$array["Nome"]; 
                $cognome=$array["Cognome"]; 
                $punteggio=$array["Punteggio"]; 
                echo  "<tr id=\"$nome|$cognome\">
                <td>$a</td>
                <td>$nome</td>
                <td>$cognome</td>
                <td>$punteggio</td>
                </tr>";
                if($a==10)
                  $ok=0;
                $a=$a+1;
              }
            }
            mysql_close();
            ?> 
          </tbody> 
        </table>
      </div>
      <div class="col-md-6" id="ex3"><h1>Radial Femminile top 10</h1>
       
              <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Radial Femminile&cat=Assoluta'">Vedi in dettaglio</button>
            
        <table id="resultTable" class="table table-hover">
         <thread>
          <tr>
            <th>Pos</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Punteggio</th>
          </tr>
        </thread>
        <tbody>
         <?php
         require_once __DIR__ . '/db_connect.php';
         $db3 = new DB_CONNECT();
         $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking` where Classe='Radial femminile'order by Punteggio DESC,Nome") or die(mysql_error());
         if(mysql_num_rows($selezione)>0){ 
          $a=1;
          $space="  ";
          $ok=1;
          while(($array=mysql_fetch_assoc($selezione)) && ($ok==1))
          { 
            $nome=$array["Nome"]; 
            $cognome=$array["Cognome"]; 
            $punteggio=$array["Punteggio"]; 
            echo  "<tr id=\"$nome|$cognome\">
            <td>$a</td>
            <td>$nome</td>
            <td>$cognome</td>
            <td>$punteggio</td>
            </tr>";
            if($a==10)
              $ok=0;
            $a=$a+1;
          }
        }
        mysql_close();
        ?> 
      </tbody> 
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-6" id="ex3"><h1>Radial top 10</h1>
    
              <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Radial&cat=Assoluta'">Vedi in dettaglio</button>
            
    <table id="resultTable" class="table table-hover">
     <thread>
      <tr>
        <th>Pos</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Punteggio</th>
      </tr>
    </thread>
    <tbody>
     <?php
     require_once __DIR__ . '/db_connect.php';
     $db2 = new DB_CONNECT();
     $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking` where Classe='Radial'order by Punteggio DESC,Nome") or die(mysql_error());
     if(mysql_num_rows($selezione)>0){ 
      $a=1;
      $space="  ";
      $ok=1;
      while(($array=mysql_fetch_assoc($selezione)) && ($ok==1)) 
      { 
        $nome=$array["Nome"]; 
        $cognome=$array["Cognome"]; 
        $punteggio=$array["Punteggio"]; 
        echo  "<tr id=\"$nome|$cognome\">
        <td>$a</td>
        <td>$nome</td>
        <td>$cognome</td>
        <td>$punteggio</td>
        </tr>";
         if($a==10)
              $ok=0;
        $a=$a+1;
      }
    }
    mysql_close();
    ?> 
  </tbody> 
</table>
</div>
<div class="col-md-6" id="ex3"><h1>4.7 top 10</h1>
  
              <button  class="btn btn-primary" onclick="window.location.href='detail.php?classe=4.7&cat=Assoluta'">Vedi in dettaglio</button>
          
  <table id="resultTable" class="table table-hover">
   <thread>
    <tr>
      <th>Pos</th>
      <th>Nome</th>
      <th>Cognome</th>
      <th>Punteggio</th>
    </tr>
  </thread>
  <tbody>
   <?php
   require_once __DIR__ . '/db_connect.php';
   $db1 = new DB_CONNECT();
   $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking` where Classe='4.7'order by Punteggio DESC,Nome") or die(mysql_error());
   if(mysql_num_rows($selezione)>0){ 
    $a=1;
    $space="  ";
    $ok=1;
    while(($array=mysql_fetch_assoc($selezione)) && ($ok==1)) 
    { 
      $nome=$array["Nome"]; 
      $cognome=$array["Cognome"]; 
      $punteggio=$array["Punteggio"]; 
      echo  "<tr id=\"$nome|$cognome\">
      <td>$a</td>
      <td>$nome</td>
      <td>$cognome</td>
      <td>$punteggio</td>
      </tr>";
       if($a==10)
              $ok=0;
      $a=$a+1;
    }
  }
  mysql_close();
  ?> 
</tbody> 
</table>
</div>
</div>
</div> 
</body>
</html>