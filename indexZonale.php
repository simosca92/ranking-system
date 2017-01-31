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

}
.laser{
 margin-left: 10px;
 padding-right: 20px;
}
.btn {
  -webkit-border-radius: 60;
  -moz-border-radius: 60;
  border-radius: 60px;
  font-family: 'Lato', sans-serif;
  color: #ffffff;
  font-size: 11px;
  background: #9aaab5;
  padding: 9px 20px 10px 20px;
  text-decoration: none;
}

.btn:hover {
  background: #0788d9;
  text-decoration: none;
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
}
#ex3::-webkit-scrollbar-thumb:active{
  background-color:#5D8AA8;
  border:1px solid #333333;
} 
</style>
<body onload="CambiaImmagine()">
  <body>

    <!-- CONTENUTO DELLA PAGINA ... -->
     <?php
       //se cerco di accedere direttametne a indexZonale senza passare per index
       if(!$_GET)
          header("Location: index.php");
     ?>
    <!-- JS -->
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {      
       $('#resultTable tr').click(function (event) {
                   //alert($(this).attr('id')); //trying to alert id of the clicked row
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
        <a class="pull-left" href="index.html">
          <img src="logo_fiv.png" class="laser">
        </a>
      </div>

      <!—Elementi della barra -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li id="first"><a href="RegolamentoRankingFIV.pdf" class="change">Regolamento Ranking</a></li>
          <li id="second"><a href="index.php" class="change">Ranking nazionale</a></li>
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
         <div class="row" >
          
          <?php
            echo "<h1 align=center> $_GET[zona]</h1>"
          ?>
          
         </div>
        <div class="row">
          <div class="col-md-6" id="ex3"><h1>Standard</h1>
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
             $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking_zonale` where Classe='Standard' and Zona=$_GET[zona] order by Punteggio DESC,Nome") or die(mysql_error());
             if(mysql_num_rows($selezione)>0){ 
              $a=1;
              $space="  ";
              while($array=mysql_fetch_assoc($selezione)) 
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
                $a=$a+1;
              }
            }
            mysql_close();
            ?> 
          </tbody> 
        </table>
      </div>
      <div class="col-md-6" id="ex3"><h1>Radial Femminile</h1>
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
         $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking_zonale` where Classe='Radial Femminile' and Zona=$_GET[zona] order by Punteggio DESC,Nome") or die(mysql_error());
         if(mysql_num_rows($selezione)>0){ 
          $a=1;
          $space="  ";
          while($array=mysql_fetch_assoc($selezione)) 
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
  <div class="col-md-6" id="ex3"><h1>Radial</h1>
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
     $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking_zonale` where Classe='Radial' and Zona=$_GET[zona] order by Punteggio DESC,Nome") or die(mysql_error());
     if(mysql_num_rows($selezione)>0){ 
      $a=1;
      $space="  ";
      while($array=mysql_fetch_assoc($selezione)) 
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
        $a=$a+1;
      }
    }
    mysql_close();
    ?> 
  </tbody> 
</table>
</div>
<div class="col-md-6" id="ex3"><h1>4.7</h1>
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
   $selezione=mysql_query("SELECT Nome,Cognome,Punteggio FROM `Ranking_zonale` where Classe='4.7' and Zona=$_GET[zona] order by Punteggio DESC,Nome") or die(mysql_error());
   if(mysql_num_rows($selezione)>0){ 
    $a=1;
    $space="  ";
    while($array=mysql_fetch_assoc($selezione)) 
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