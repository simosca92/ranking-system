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
    <style type="text/css">
          input{
              font-family: 'Lato', sans-serif;
              font-size:15px;
              width:200px;
          }
          div.campo{
              font-family: 'Lato', sans-serif;
              font-size:15px;
          }
          div.boxsuggerimenti {
            font-family: 'Lato', sans-serif;
            font-size:15px;
            background-color:white;
            border:1px solid #888;
            margin:0px;
            padding:0px;
            top: auto;
            max-height: 200px;
          }
          div.boxsuggerimenti ul {
            list-style-type:none;
            margin:0px;
            padding:0px;
            top: auto;
            overflow: auto;
            max-height: 200px;
          }
          div.boxsuggerimenti ul li.selected { 
            background-color: #C2EBEF; 
            top: auto;
            overflow: auto;
            max-height: 200px; 
           
          }
          div.boxsuggerimenti ul li {
            list-style-type:none;
            display:block;
            margin:0;
            padding:1px;
            cursor:pointer;
            border-bottom:1px solid #888;
            top: auto;
            
          }

  </style>
  </head>
  <style>
  [class^="col-md"] {
    background-color: rgba(86, 61, 124, 0.15);
    border: 1px solid rgba(86, 61, 124, 0.2);
    padding-bottom: 50px;
    padding-top: 50px;
    margin-top: 20px;


  }
  [class^="col-sm"] {
    padding-bottom: 10px;
    padding-top: 10px;
    background-color: #EFEFEF;
  }
  h1,h3,a,pre,label {
    font-family: 'Lato', sans-serif;
  }
  li{
    background-color: #FFFFFF;
    font-family: 'Lato', sans-serif;
  }
  body{
    margin-top:30px;
  }

  form{
    margin-top: 30px;
  }
  .laser{
   margin-left: 10px;
   padding-right: 20px;
 }
 .container{
  margin-top: 50px;
  margin-bottom: 50px;
}
#Annulla{
  float: left !important;
}
.wrapper {
  text-align: center;
}
#Next{
  float: right !important;
}
#button2{
  margin-bottom: 20px;
}
#backg{
  background-color: transparent;
  text-align: center;
}
table{
  background-color:#FFFFFF;
}
 
  #suggerimenti_squadra{
    z-index: 1;
  }
  #sovra{
    z-index: 2;
  }
   #first{
        margin-top: 25px;
          }
   #second{
        margin-top: 25px;
          }
   #third{
        margin-top: 25px;
    }

</style>

<body>
  <?php
  require_once __DIR__ . '/db_connect.php';
  $db9 = new DB_CONNECT();
  session_start();
            //se non c'è la sessione registrata
  if (!session_is_registered('autorizzato')) {
   header("Location: login.html");
   die;
 }
 else{
            //Altrimenti Prelevo il codice identificatico dell'utente loggato
               $cod = $_SESSION['cod']; //id cod recuperato nel file di verifica
               //controllo l'accesso diretto a FORMclasse.php
               $check3=mysql_query("SELECT * FROM `Regata_temp") or die(mysql_error());
               if(mysql_num_rows($check3) == 0)
                header("Location: form.php");
            }
            
            ?>
            <!-- CONTENUTO DELLA PAGINA ... -->
            <!-- JS -->
            <script src="//code.jquery.com/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="ajax/prototype.js" type="text/javascript"></script>
            <script src="ajax/effects.js" type="text/javascript"></script>
            <script src="ajax/controls.js" type="text/javascript"></script>
            <!-- JS -->
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

          </nav>
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <?php 
                session_start();
                 echo  "<h2>$_SESSION[zona]</h2>";
                echo  "<h2>Regata: $_SESSION[regata]</h2>"; 
                $_SESSION['classe'] = "Radial";
                echo  "<h3>Circolo organizzatore: $_SESSION[circolo]</h3>";

                ?>

                <table id="resultTable" class="table table-hover">
                 <thread>
                  <tr>
                    <th>Pos</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                  </tr>
                </thread>
                <tbody>
                 <?php
                 require_once __DIR__ . '/db_connect.php';
                 $db = new DB_CONNECT();
                 $selezione=mysql_query("SELECT Nome,Cognome,Posizione FROM `Partecipante_temp` where Classe='Radial'order by Posizione,Nome") or die(mysql_error());
                 if(mysql_num_rows($selezione)>0){ 
                  $a=1;
                  $space="  ";
                  while($array=mysql_fetch_assoc($selezione)) 
                  { 
                    $nome=$array["Nome"]; 
                    $cognome=$array["Cognome"];
                    $pos=$array["Posizione"]; 
                    echo  "
                    <form action=\"delete_part.php\" method=\"post\">
                        <tr id=\"$nome $cognome\">
                        <td> <input value=$pos type=hidden name=pos> $pos </input></td>
                        <td> <input value='$nome' type=hidden name=nome> $nome </input></td>
                        <td><input value='$cognome' type=hidden name=cognome> $cognome </input></td>
                        <td> <button name=submit1 type=\"submit\" class=\"btn btn-warning btn-sm\"  onClick=\"return(confirm('Cancellare?'))\">-</button></td>
                        </tr>
                    </form>
                    ";
                    $a=$a+1;
                  }
                }
                mysql_close();
                ?> 
              </tbody> 
            </table>
          </div>
          <div class="col-md-5 col-md-offset-1"><h1>Aggiungi partecipante</h1>
           <h3>Classe: Radial</h3> 
           
      <form class="form-horizonatal" role="form" action="add_partecipante.php" method="post">
             <div class="form-group">
              <label  class="control-label col-sm-2">Atleta:</label>
              <div class="col-sm-9">
                  <input type="text" id="squadra" name="atleta"  class="form-control"/>
                  <div id="suggerimenti_squadra" class="boxsuggerimenti"></div>
                  <script type="text/javascript">new Ajax.Autocompleter("squadra", "suggerimenti_squadra", "cerca.php", {minChars: 1});</script>
                
            
              </div>
            </div>

            <div  id="sovra" class="form-group">

              <label class="control-label col-sm-2">Pos:</label>
              <div  class="col-sm-6">
                <?php
                require_once __DIR__ . '/db_connect.php';
                $db22 = new DB_CONNECT();
                $selezione=mysql_query("SELECT MAX(Posizione) AS PosizioneMAX FROM `Partecipante_temp` where Classe='Radial' and  username='$_SESSION[cod]'") or die(mysql_error());
                $array=mysql_fetch_assoc($selezione);
                $val=$array["PosizioneMAX"] + 1;
                echo " <input type=number class=form-control id=number min=1 name=posizione value=$val />"
                ?>
              </div>
              <div  class="col-sm-3" id="backg">

                <button name="submit" id="button2" type="submit" class="btn btn-danger btn-lg">+</button>
              </div>
            </div>
            <div class="form-group">
              <button id="first" name="submit5"  type="submit" class="btn btn-danger">Annulla</button>
              <button id="second" name="submit8"  type="submit" class="btn btn-primary">Indietro</button>
              <button id="third" name="submit2"   type="submit" class="btn btn-primary">Vai ai 4.7</button>
            </div>                          
          </form>
        </div>
      </div>
    </div>
  </body>
  </html>