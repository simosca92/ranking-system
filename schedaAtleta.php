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
                             //alert($(this).attr('id')); //trying to alert id of the clicked row
                             var str = $(this).attr('id');
                             var res = str.split("|");
                             //alert(res[0]);
                             window.location.href='classificaReg.php?Data='+ res[0] +'&'+'Nome='+ res[1]+'&'+'Classe='+ res[2]+'&'+'Zona='+ res[3];
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
                    <div class="row" id="container">
                      <div class="col-md-6 col-md-offset-2" id="aliginText">
                        <?php
                            echo "<h1>$_GET[Cognome]"." "."$_GET[Nome]</h1>";
                             require_once __DIR__ . '/db_connect.php';
                                 $db1 = new DB_CONNECT();
                                 $stringa="$_GET[Cognome]"." "."$_GET[Nome]";
                                 $selezione=mysql_query("SELECT nascita,Circolo FROM Atleta WHERE Nome='$_GET[Nome]' and Cognome='$_GET[Cognome]'") or die(mysql_error());
                                 if(mysql_num_rows($selezione)>0){
                                        $array=mysql_fetch_assoc($selezione); 
                                        echo "<h3>Nato il: $array[nascita]</h3>";
                                        echo "<h3> Da: $array[Circolo] </h3>";
                                         $current=date(Y);
                                         $date = DateTime::createFromFormat("Y-m-d",$array[nascita]);
                                         $nas=$date->format("Y");
                                        if(($current - $nas) < 19 )
                                           echo"<h3>Categoria: UNDER 19</h3>";
                                        else if (($current - $nas) < 21 )
                                          echo"<h3>Categoria: UNDER 21</h3>";
                                        else 
                                          echo"<h3>Categoria: ASSOLUTO</h3>";
                                    }
                          ?>
                       </div>
                       <div class="col-sm-1">
                            <div id="foto"> <img id="foto1" src="icona.png"  ></div>
                       
                     </div>
                     </div>
                <div class="row">
                      <div class="col-md-12" id="ex3">
                          
                        <table id="resultTable" class="table table-hover">
                         <thread>
                          <tr>
                            <th>Data</th>
                            <th>Nome regata</th>
                            <th>Pos</th>
                            <th>Classe</th>
                            <th>Zona</th>
                          </tr>
                         </thread>
                         <tbody>
                             <?php
                                 require_once __DIR__ . '/db_connect.php';
                                 $db = new DB_CONNECT();
                                 $selezione=mysql_query("SELECT Data,Nome_regata,Posizione,Classe,Zona FROM Regata JOIN Partecipante ON Id_regata=Id_regata_p WHERE Nome='$_GET[Nome]' AND Cognome='$_GET[Cognome]' ORDER BY Data DESC") or die(mysql_error());
                                 if(mysql_num_rows($selezione)>0){ 
                                   while($array=mysql_fetch_assoc($selezione)) 
                                    { 
                                      $data=$array["Data"]; 
                                      $nome=$array["Nome_regata"]; 
                                      $pos=$array["Posizione"];
                                      $classe=$array["Classe"];
                                      $zona=$array["Zona"];  
                                      echo  "<tr id=\"$data|$nome|$classe|$zona\">
                                      <td>$data</td>
                                      <td>$nome</td>
                                      <td>$pos</td>
                                      <td>$classe</td>
                                      <td>$zona</td>
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