<html>
<head>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<title>Script ajax: Suggerimenti autocomlete con scriptaculous</title>
<style type="text/css">
    input{
	font-family:Verdana;
        font-size:10px;
	width:200px;
    }
    div.campo{
	font-family:Verdana;
        font-size:10px;
    }
    div.boxsuggerimenti {
      font-family:Verdana;
      font-size:10px;
      position:absolute;
      background-color:white;
      border:1px solid #888;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul {
      list-style-type:none;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul li.selected { background-color: #C2EBEF;}
    div.boxsuggerimenti ul li {
      list-style-type:none;
      display:block;
      margin:0;
      padding:1px;
      cursor:pointer;
      border-bottom:1px solid #888;
    }
</style>
</head>
<body>
   <script src="//code.jquery.com/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<div class="campo">Squadra di calcio serie A:</div>
<input type="text" id="squadra" name="nome"/>
<div id="suggerimenti_squadra" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("squadra", "suggerimenti_squadra", "cerca.php", {minChars: 1});</script>
 
 </body>
 </html>