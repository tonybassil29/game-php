<?php require_once('functions.php');

 ?>
<?php 
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }

    $bdd = connect();

    $sql = "SELECT * FROM persos WHERE user_id = :user_id";

    $sth = $bdd->prepare($sql);
        
    $sth->execute([
        'user_id'     => $_SESSION['user']['id']
    ]);

    $persos = $sth->fetchAll();

    //dd($persos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <h1> Votre profil</h1>
    <a href="persos_add.php">Créer un personnage</a>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    }?>


    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($persos as $perso) { ?>
                <tr>
                    <td><?php echo $perso['id']; ?></td>
                    <td><?php echo $perso['name']; ?></td>
                    <td>
                        <a 
                        class="btn=grey"
                        href="persos_show.php?id=<?php echo $perso['id']; ?>">Détail</a>
                    </td>
                    <td>
                        <a
                        class="btn"
                        href="persos_del.php?id=<?php echo $perso['id']; ?>" onClick="return confirm('Voulez vous vraiment supprimer ce personnage ?');">Supprimer</a>
                    </td>
                    <td>
                        <a href="persos_edit.php?id=<?php echo $perso['id']; ?>">Modifier</a>
                    </td>
                   
                </tr>
            <?php } ?>
        </tbody>
    </table>

    

</body>
</html>