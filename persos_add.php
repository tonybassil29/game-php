<?php 
require_once('functions.php');


if (!isset($_SESSION['user'])){
    header('Location: login.php');
}

if (isset($_POST["send"])){
    if ($_POST['name'] != ""){
        $bdd = connect();
        
        $sql = "INSERT INTO persos (`name`, `for`, `dex`,`int`, `char`,`vit`, `pdv`,`user_id`) VALUES (:name, :for, :dex, :int, :char, :vit, :pdv, :user_id);";
       
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'name' => $_POST['name'],
            'for'  => rand(0,20),
            'dex'  => rand(0,20),
            'int'  => rand (0,20),
            'char'  => rand (0,20),
            'vit'  => rand (0,20),
            'pdv'  => 20 + rand(2, 4),
            'user_id' => $_SESSION['user']['id']
        ]);
        header('Location: persos.php');
    }
  
}

?>
 <?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/modifier.css">
    <title>Document</title>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <h1>Créer un personnage</h1>
    <form action="" method="POST">
    <div>
        <label for="name">NOM :</label>
        <input type="name" placeholder="Entrez le nom de votre personnage" name="name" id="name" />
    </div>
    <div>
        <input type="submit" name="send" value="modifier" />
    </div>
    </form>
   
<div>
    <br>
    <a href="persos.php" class="btn">Retour</a>
 </div>

      

    </form>
</body>
</html>