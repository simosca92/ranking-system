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
            [class^="col-"] {
            background-color: rgba(86, 61, 124, 0.15);
            border: 1px solid rgba(86, 61, 124, 0.2);
            padding-bottom: 20px;
            padding-top: 40px;
            margin-bottom: 80px;
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
            h3{
              margin-bottom: 30px;
            }
           .container{
            margin-top: 50px;
            margin-bottom: 50px;
            }
            table{
            background-color:#FFFFFF;
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
      </style>
      <body>
            <?php
               //se cerco di accedere direttametne a indexZonale senza passare per index
               if(!$_GET)
                  header("Location: index.php");
            ?>
            <script src="//code.jquery.com/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
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
                      <li id="first"><a href="index.php" class="change">Torna alla Ranking</a></li>
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
                            echo "<h1>$_GET[Nome]</h1>";
                            echo "<h3>Zona: $_GET[Zona]</h3>";
                            echo "<h3>Classe: $_GET[Classe]</h3>";
                           ?>
                        <table id="resultTable" class="table table-hover">
                         <thread>
                          <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Pos</th>
                          </tr>
                         </thread>
                         <tbody>
                             <?php
                                 require_once __DIR__ . '/db_connect.php';
                                 $db = new DB_CONNECT();
                                 $selezione=mysql_query("SELECT Nome,Cognome,Posizione 
                                  from Partecipante JOIN Regata ON Id_regata = Id_regata_p  
                                  where Nome_regata='$_GET[Nome]' AND Classe='$_GET[Classe]' AND Data='$_GET[Data]' AND Zona='$_GET[Zona]' 
                                  order by Posizione") or die(mysql_error());
                                 if(mysql_num_rows($selezione)>0){ 
                                   while($array=mysql_fetch_assoc($selezione)) 
                                    { 
                                      $nome=$array["Nome"]; 
                                      $cognome=$array["Cognome"]; 
                                      $pos=$array["Posizione"];
                                      echo  "<tr id=\"$data-$nome-$classe-$zona\">
                                      <td>$nome</td>
                                      <td>$cognome</td>
                                      <td>$pos</td>
                                      </tr>";
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