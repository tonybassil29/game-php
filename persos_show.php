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
  <b>Nom: </b> <?php echo $perso['name']; ?> <br> <br>
  <b>Dextérité: </b> <?php echo $perso['dex']; ?> <br> <br>
  <b>Force: </b> <?php echo $perso['for']; ?> <br> <br>
  <b>Intelligence: </b> <?php echo $perso['int']; ?> <br> <br>
  <b>Point de Vie: </b> <?php echo $perso['pdv']; ?> <br> <br>
  <b>Charisme: </b> <?php echo $perso['char']; ?> <br> <br>
  <b>Vitalité: </b> <?php echo $perso['vit']; ?> <br> <br> <br>

  <a href="persos.php" class="btn">Retour</a>
      
  </body>
  </html>
