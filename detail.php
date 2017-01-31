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
      </head>
      <style>
            [class^="col-md"] {
            background-color: rgba(86, 61, 124, 0.15);
            border: 1px solid rgba(86, 61, 124, 0.2);
            padding-bottom: 14px;
            padding-top: 18px;
            margin-bottom: 45px;
          
            }
            [class^="col-sm"] {
              margin-bottom: 45px;
             }
            h1,h3,a,pre,label,td,th {
              font-family: 'Lato', sans-serif;
            }
            li{
              background-color: #FFFFFF;
              font-family: 'Lato', sans-serif;
            }
            body{
              margin-top:30px;
            }
            h1{
              margin-bottom: 30px;
            }
           .container{
            margin-top: 50px;
            margin-bottom: 50px;
            }
            table{
            background-color:#FFFFFF;
            margin-top: 10px;
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
            #foto{
              height: 200px;
              width: 180px;
              background-color: #FFFFFF;
              border: 1px solid #000000;
            }
            #foto1{
              height: 100%;
              width: 100%;
            }
            #aliginText{
              text-align: center;
            }
            .btn{
              background-color: #5D8AA8;
              }
              .btn:hover{
              background-color: #5D8AA8;
              }
      </style> 
      <body>
         <?php
               //se cerco di accedere direttametne a indexZonale senza passare per index
               if(!$_GET)
                  header("Location: index.php");
            ?>
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
           <nav class="navbar navbar-default" role="navigation">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Espandi barra di navigazione</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="pull-left" href="index.html">
                    <img src="laser.png" class="laser">
                  </a>
              </div>
               <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                      <li id="first"><a href="index.php" class="change">Torna alla Home</a></li>
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
                      <div class="col-md-12" id="ex3">
                          <?php
                            echo "<h1>$_GET[classe]</h1>";
                            echo "<h3>Categoria: $_GET[cat]</h3>";
                           ?>
                            <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Standard&cat=Assoluta'">Assoluta</button>
                            <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Standard&cat=Under21'">Under 21</button>
                            <button class="btn btn-primary" onclick="window.location.href='detail.php?classe=Standard&cat=Under19'">Under19</button>
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
                           //  SELECT * FROM `Ranking` join Atleta on Atleta.Nome = CONCAT(Ranking.Nome,' ',Ranking.Cognome) where (2015-YEAR(Atleta.nascita)) < 34
                                 require_once __DIR__ . '/db_connect.php';
                                 $db = new DB_CONNECT();
                                 if(strcmp($_GET["cat"],"Under21")==0){
                                 $current=date(Y);
                                 $selezione=mysql_query("SELECT Ranking.Nome,Ranking.Cognome,Ranking.Punteggio FROM `Ranking` join Atleta on Atleta.NomeCognome = CONCAT(Ranking.Cognome,' ',Ranking.Nome) 
                                  where ($current - YEAR(Atleta.nascita)) < 21 ORDER BY Ranking.Punteggio DESC") or die(mysql_error());;
                                 }
                                 else if(strcmp($_GET["cat"],"Under19")==0){
                                 $current=date(Y);
                                 $selezione=mysql_query("SELECT Ranking.Nome,Ranking.Cognome,Ranking.Punteggio FROM `Ranking` join Atleta on Atleta.NomeCognome = CONCAT(Ranking.Cognome,' ',Ranking.Nome) 
                                  where ($current - YEAR(Atleta.nascita)) < 19 ORDER BY Ranking.Punteggio DESC") or die(mysql_error());;
                                 }
                                 else
                                 $selezione=mysql_query("SELECT Nome,Cognome,Punteggio 
                                  from Ranking
                                  where Classe = '$_GET[classe]'  
                                  order by Punteggio DESC") or die(mysql_error());
                                 if(mysql_num_rows($selezione)>0){
                                  $a=1; 
                                   while($array=mysql_fetch_assoc($selezione)) 
                                    { 
                                      $nome=$array["Nome"]; 
                                      $cognome=$array["Cognome"];
                                      $punteggio =$array["Punteggio"];
                                      echo  "<tr  id=\"$nome|$cognome\">
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