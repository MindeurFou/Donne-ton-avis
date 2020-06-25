<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <title>Bienvenue sur DTA</title>
        <link href="semantic.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
        
        <script src="semantic.min.js" type="text/javascript"></script>
         
    </head> 
    <body>
        <div class="ui top attached tabular menu">
  <a class="active item" data-tab="first">First</a>
  <a class="item" data-tab="second">Second</a>
  <a class=" item" data-tab="third">Third</a>
  
</div>
<div class="ui bottom attached active tab segment" data-tab="first">
        la lol
</div>
<div class="ui bottom attached tab segment" data-tab="second">
        la lil
</div>
<div class="ui bottom attached tab segment" data-tab="third">
        la lul
</div>
        
    </body>
    <script>$('.tabular.menu .item').tab({history:false});</script>
</html>
