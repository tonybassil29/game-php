<?php 
    require_once('functions.php');
?>
 <!DOCTYPE html>
<html>
<head>
   
    <style>
 
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        position:relative;
    }

    body {
        background-image: url('img/mort.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }


  

    </style>
   
</head>
<body>
    <?php require_once('_header.php'); ?>
    <div class="over">GAME OVER</div>

        
    <div class="btn-container">
  
       <a href="persos.php" class="btn btn-return">Return</a>
        <a href="donjons_play.php" class="btn btn-return">Ressuciter Vous !</a>
</div>

    
</body>
</html>


