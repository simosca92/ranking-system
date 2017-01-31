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
              padding-bottom: 30px;
              padding-top: 30px;
              margin-top:30px;
              margin-bottom: 30px;
            }
            h1,a,pre,tr,td,li {
              font-family: 'Lato', sans-serif;
            }
            #bianco{
            background-color: #FFFFFF;
            font-family: 'Lato', sans-serif;
            }
            table{
              background-color:#FFFFFF;
            }
            .laser{
             margin-left: 10px;
             padding-right: 20px;
           }
          body{
              margin-top:30px;
              margin-bottom:30px;
          }
          #bluDiv{
            background-color:#5D8AA8;
          }
          #n1{
          	margin-right:40px;
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
            <img src="logo_fiv.png" class="laser">
          </a>
        </div>
		</nav>
       <div class="container">
        <div class="row">
          <div class="col-md-12" id="ex3"><h1>Standard</h1>
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
                        $selezione=mysql_query("SELECT Nome,Cognome,Posizione FROM `Partecipante_temp` where Classe='Standard'order by Posizione,Nome") or die(mysql_error());
                          if(mysql_num_rows($selezione)>0){ 
                                $a=1;
                                $space="  ";
                                while($array=mysql_fetch_assoc($selezione)) 
                                { 
                                    $nome=$array["Nome"]; 
                                    $cognome=$array["Cognome"]; 
                                    echo  "<tr id=\"$nome $cognome\">
                                        <td>$a</td>
                                        <td>$nome</td>
                                        <td>$cognome</td>
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
        <div class="col-md-12" id="bluDiv">
            <form class="form-horizontal" role="form" action="confrim_naz.php" method="post" align="center">
                  <button name="submit" id="n1" type="submit" class="btn btn-danger btn-lg">Cancella</button>
                  <button name="submit4" id="n2" type="submit" class="btn btn-warning btn-lg">Conferma</button>
            </form>
        </div>
       </div> 
     </body>
</html>