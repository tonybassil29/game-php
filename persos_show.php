<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: persos.php?msg=id non passé !');
    }

    $bdd = connect();

    $sql="SELECT * FROM persos WHERE id = :id AND user_id=:user_id;";

    $sth = $bdd->prepare($sql);

    $sth->execute([
        'id'        => $_GET['id'],
        'user_id'   => $_SESSION['user']['id']

    ]);

    $perso = $sth->fetch();

   $directionMainId = $perso['id_maindominante'];


   $sql = "SELECT direction_main FROM maindominante WHERE id_maindominante = :directionMainId";
   $sth = $bdd->prepare($sql);
   $sth->execute(['directionMainId' => $directionMainId]);
   $directionMain = $sth->fetchColumn();
?>


  <?php require_once('_header.php'); ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/details.css">
    <title>Document</title>
  </head>
  <body>
  <h1><span>Détails du Personnage</span></h1> <br>
  <b>Nom: </b> <span class="php-output"><?php echo $perso['name']; ?></span> <br> <br>
  <b>Level: </b> <span class="php-output"><?php echo $perso['level']; ?></span> <br> <br>
  <b>Dextérité: </b> <span class="php-output"><?php echo $perso['dex']; ?></span> <br> <br>
  <b>Force: </b> <span class="php-output"> <?php echo $perso['for']; ?> </span><br> <br>
  <b>Intelligence: </b><span class="php-output"> <?php echo $perso['int']; ?></span> <br> <br>
  <b>Point de Vie: </b><span class="php-output"> <?php echo $perso['pdv']; ?></span> <br> <br>
  <b>Charisme: </b> <span class="php-output"><?php echo $perso['char']; ?> </span><br> <br>
  <b>Vitalité: </b> <span class="php-output"><?php echo $perso['vit']; ?></span> <br> <br> 
  <b>Direction Principale: </b><span class="php-output"> <?php echo $directionMain; ?></span> <br> <br>
  <a href="persos.php" class="btn">Retour</a>
      
  </body>
  </html>
