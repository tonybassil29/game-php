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
<h1>Modifications : </h1>
<form action="" method="POST">
    <div>
        <label for="name">name :</label>
        <input type="name" placeholder="Entrez le nom de votre personnage" name="name" id="name" />
    </div>
    <div>
        <input type="submit" name="send" value="modifier" />
    </div>
    </form>
    <?php 
    if (!empty($_POST['name'])){
        echo "Nom Modifié avec succés !";
    }
    ?>
<div>
    <a href="persos.php" class="btn">Retour</a>
 </div>

