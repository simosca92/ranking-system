<!DOCTYPE html>
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
padding-bottom: 20px;
padding-top: 50px;
overflow: auto;
margin-top: 20px;
margin-bottom: 20px;
}
[class^="col-sm"] {
padding-bottom: 10px;
padding-top: 10px;
background-color: #EFEFEF;
}
h1,a,pre,label {
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
</style>
<body>
<!-- CONTENUTO DELLA PAGINA ... -->

  <?php
        require_once __DIR__ . '/db_connect.php';
        $db10 = new DB_CONNECT();
        session_start();
              //se non c'è la sessione registrata
        if (!session_is_registered('autorizzato')) {
        header("Location: login.html");
        die;
        }
        else{
              //Altrimenti Prelevo il codice identificatico dell'utente loggato
                $cod = $_SESSION['cod']; //id cod recuperato nel file di verifica
                $check=mysql_query("SELECT Zona FROM Regata_temp where username = '$cod' ") or die(mysql_error());
                if(mysql_num_rows($check) > 0){
                   $array=mysql_fetch_assoc($check);
                   $_SESSION['zona']=$array["Zona"];
                   echo"<script>
                   alert('Ciao $cod hai un aggiungimento di regata in sospeso!');
                   window.location.href='formSTD.php';
                   </script>";
               }
             }

     ?>
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
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right" >
          <!-- MENU A DISCESA --> 
          <li class="dropdown">
            <a href="#" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
              APRI MENU <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <?php
                  require_once __DIR__ . '/db_connect.php';
                  $db1234 = new DB_CONNECT();
                  session_start();
                  $select=mysql_query("SELECT Permessi FROM login where username = '$_SESSION[cod]' ") or die(mysql_error());
                  $array=mysql_fetch_assoc($select);
                  if(strcmp($array["Permessi"],"ALL") == 0 )
                    echo "<li><a href=formROOT.php>Regate nazionali/internazionali</a></li>";
                 ?>
               <li><a href="index.php">Torna alla Home Page</a></li>
               <li><a href="logOut.php">Logout</a></li>
             </ul>
           </li>
           <!--MENU A DISCESA -->
         </ul>
       </div>
     </nav>
     <div class="container">

      <div class="row">
        <div class="col-md-12"><h1>Aggiungi una regata</h1>
          <form  class="form-horizontal" action="add_regata.php" method="post" role="form">
            <div class="form-group">
              <label  class="control-label col-sm-2" for="text">Circolo organizzatore:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="circolo" id="text" pattern=".{2,}"   required title="2 characters minimum">
              </div>  
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="text">Nome Regata:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="nome_regata" id="text" pattern=".{2,}"   required title="2 characters minimum">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="date">Data:</label>
              <div class="col-sm-2">
                <input type="date" class="form-control" name="data" id="date"min="1950-01-01">
              </div>
                                     <!--</div>
                                     <div class="form-group">-->
                                       <label class="control-label col-sm-1"> Zona:</label>
                                       <div class="col-sm-2">
                                         <select class="form-control" id="sel1" name="zona">
                                         <?php
                                              require_once __DIR__ . '/db_connect.php';
                                              $db123 = new DB_CONNECT();
                                              session_start();
                                              $select=mysql_query("SELECT Permessi FROM login where username = '$_SESSION[cod]' ") or die(mysql_error());
                                              $array=mysql_fetch_assoc($select);
                                              if(strcmp($array["Permessi"],"ALL") == 0 ){
                                                  echo "<option>I zona</option>
                                                        <option>II zona</option>
                                                        <option>III zona</option>
                                                        <option>IV zona</option>
                                                        <option>V zona</option>
                                                        <option>VI zona</option>
                                                        <option>VII zona</option>
                                                        <option>VIII zona</option>
                                                        <option>IX zona</option>
                                                        <option>X zona</option>
                                                        <option>XI zona</option>
                                                        <option>XII zona</option>
                                                        <option>XIII zona</option>
                                                        <option>XIV zona</option>
                                                        <option>XV zona</option>";
                                              }
                                              else{
                                                  echo "<option>$array[Permessi]</option>";
                                              }
                                         ?>
                                        </select>
                                      </div>
                                    </div>
                 <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Numero STD:</label>
                    <div class="col-sm-1">
                      <input type="number" class="form-control" name="" id="number" min="0">
                     </div> 
                      <label class="control-label col-sm-2" for="date">Numero RDL:</label>
                    <div class="col-sm-1">
                      <input type="number" class="form-control" name="" id="number" min="0">
                    </div>
                      <label class="control-label col-sm-2" for="date">Numero 4.7:</label>
                    <div class="col-sm-1">
                      <input type="number" class="form-control" name="" id="number" min="0">
                        </div>    
                  </div>               
                                    <button type="submit" class="btn btn-warning">Avanti</button>
                                  </form>
                                </div>
                              </div>
                            </div>

        </body>
 </html>