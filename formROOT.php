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
#file {
    font-family: 'Lato', sans-serif;
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
          $select=mysql_query("SELECT Permessi FROM login where username = '$_SESSION[cod]' ") or die(mysql_error());
          $array=mysql_fetch_assoc($select);
          //echo $array["Permessi"];
          if(strcmp($array["Permessi"],"ALL") != 0 )
            header("Location: form.php");

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
        <div class="col-md-12"><h1>Aggiungi una regata Nazionale/Internazionale</h1>
          <form  class="form-horizontal" action="popola.php"  enctype="multipart/form-data" method="post">
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
                <label class="control-label col-sm-2" for="date">Event Grade:</label>
              <div class="col-sm-1">
                <select class="form-control" id="sel1" name="grade">
                  <option>20-Italia Cup</option>
                  <option>30-Europa Cup</option>
                </select>    
              </div>
               <label class="control-label col-sm-2" for="date">N part:</label>
               <div class="col-sm-1">
                <input type="number" id="number" name="part" min="3" value="0"/>
              </div>
              </div>
                       <!--</div>
                                     <div class="form-group">-->
                                      <div class="form-group">
                                       <label class="control-label col-sm-2"> Upload CSV:</label>
                                       <div class="col-sm-3">
                                           <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                                           <input id="file" type="file" name="CSV" accept=".csv">
                                      </div>
                                      </div>
             
              <button type="submit" class="btn btn-warning">Avanti</button>
            </form>
           </div>
          </div>
        </div>
     </body>
 </html>