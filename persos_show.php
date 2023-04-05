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
  <h1>Détails du Personnage</h1> <br>
  <b>Nom: </b> <?php echo $perso['name']; ?> <br>
  <b>Dextérité: </b> <?php echo $perso['dex']; ?> <br>
  <b>Force: </b> <?php echo $perso['for']; ?> <br>
  <b>Intelligence: </b> <?php echo $perso['int']; ?> <br>
  <b>Point de Vie: </b> <?php echo $perso['pdv']; ?> <br>
  <b>Charisme: </b> <?php echo $perso['char']; ?> <br>
  <b>Vitalité: </b> <?php echo $perso['vit']; ?> <br> <br> <br>

  <a href="persos.php" class="btn">Retour</a>
      
  </body>
  </html>