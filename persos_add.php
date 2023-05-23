<?php 
require_once('functions.php');


if (!isset($_SESSION['user'])){
    header('Location: login.php');
}
// Récupérer la direction principale sélectionnée

if (isset($_POST["send"])){
    if ($_POST['name'] != ""){
        $bdd = connect();
        
        $directionMain = $_POST['direction_main'];


        $sql = "SELECT id_maindominante FROM maindominante WHERE direction_main = :directionMain";
        $sth = $bdd->prepare($sql);
        $sth->execute(['directionMain' => $directionMain]);
        $idMaindominante = $sth->fetchColumn();

        
        $sql = "INSERT INTO persos (`name`, `for`, `dex`, `int`, `char`, `vit`, `pdv`, `user_id`, `id_maindominante`) VALUES (:name, :for, :dex, :int, :char, :vit, :pdv, :user_id, :id_maindominante)";
        
       
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'name' => $_POST['name'],
            'for'  => 5,
            'dex'  => rand(0,20),
            'int'  => rand (0,20),
            'char'  => rand (0,20),
            'vit'  => rand (0,20),
            'pdv'  => 25,
            'user_id' => $_SESSION['user']['id'],
            'id_maindominante' => $idMaindominante
        ]);
        header('Location: persos.php');
    }
  
}
$bdd = connect();

$sql = "SELECT direction_main FROM maindominante;";
$sth = $bdd->prepare($sql);

$sth->execute();

$options = '';
while ($directionMain = $sth->fetchColumn()) {
    $options .= '<option value="' . $directionMain . '">' . $directionMain . '</option>';
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
    <div class="direction-container">
    <label for="direction_main" class="direction-label">Direction de la main :</label>
    <select name="direction_main" id="direction_main" class="direction-select">
        <?php echo $options; ?>
    </select>
</div>
     <br>
    <div>
        <input type="submit" name="send" value="Créer" />
    </div>
    </form>
   
<div>
    <br>
    <a href="persos.php" class="btn">Retour</a>
 </div>

      

    </form>
</body>
</html>