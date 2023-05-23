<?php require_once('functions.php');

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

    // dd($persos);

?>

<?php require_once('_header.php'); ?>

<div class="container_custom">
<h1 class="titre_custom">Vos personnages</h1>

    <a class="btn btn-purple" href="persos_add.php">Créer un personnage</a>

    <?php if (isset($_GET['msg'])) {
        echo "<div>" . $_GET['msg'] . "</div>";
    } ?>

    <table class="table">
        <thead>
            <tr>
                <th width="2%">ID</th>
                <th>Nom</th>
                <th style="padding-right: 95px"; width="30%">Action</th>
            </tr>
        </thead>
        <style>
    body {
        background-image: url('img/gant.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

</style>
        <tbody>
            <?php foreach ($persos as $perso) { ?>
                <tr>
                <td style="color: orange; font-weight: 900;"><?php echo $perso['id']; ?></td>
                <td style="color: orange; padding-left: 500px; font-weight: 900;font-size: 20px;"><?php echo $perso['name']; ?></td>


                    <td>
                       <a 
                            class="btn btn-blue"
                            href="persos_choice.php?id=<?php echo $perso['id']; ?>" 
                        >Choisir</a>
                        <a 
                            class="btn btn-green"
                            href="persos_show.php?id=<?php echo $perso['id']; ?>" 
                        >Détails</a>

                        <a 
                            class="btn btn-red"
                            href="persos_del.php?id=<?php echo $perso['id']; ?>" 
                            onClick="return confirm('Etes-vous sûr ?');"
                        >Supprimer</a>

                        <a 
                            class="btn btn-yellow"
                            href="persos_edit.php?id=<?php echo $perso['id']; ?>" 
                        >Modifier</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
