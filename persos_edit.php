<?php require_once('functions.php');

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    if (!isset($_GET['id'])) {
        header('Location: persos.php?msg=id non passé !');
    }
    if (empty($_POST['name'])) {
        
    } else {
        $bdd = connect();
    
        $sql="UPDATE persos SET name = :name WHERE id = :id AND user_id = :user_id;";
    
        $sth = $bdd->prepare($sql);
    
        $sth->execute([
            'id'        => $_GET['id'],
            'user_id'   => $_SESSION['user']['id'],
            'name'      => $_POST['name']
        ]);
        
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
<h1>Modifications : </h1>
<form action="" method="POST">
    <div>
        <label for="name">NOM :</label>
        <input type="name" placeholder="Entrez le nom de votre personnage" name="name" id="name" />
    </div>
    <div>
        <input type="submit" name="send" value="Modifier" />
    </div>
    </form>
    <?php 
    if (!empty($_POST['name'])){
        echo "Nom Modifié avec succés !";
    }
    ?>
<div>
    <br>
    <a href="persos.php" class="btn">Retour</a>
 </div>


</body>
</html>
