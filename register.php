<?php

    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();

        $sql = "INSERT INTO users (`email`, `password`) VALUES (:email, :password);";
        $sth = $bdd->prepare($sql);
        $sth->execute([
            'email'     => $_POST['email'],
            'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: login.php');
    }
?>
<?php require_once('_header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Page de Création</title>
    <link rel="stylesheet" href="styles/register_login.css"> 
</head>
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
<body>
    <div class="container_reco">
        <h2>Création de votre compte</h2>
        <br>
        <form method="post" action="">
            <div class="forme_reco">
                <label for="email">Email :</label>
                <input placeholder="Entrer votre email" type="email" id="email" name="email" required>
            </div>

            <div class="forme_reco">
                <label for="password">Mot de passe :</label>
                <input placeholder="Entrer votre mot de passe"type="password" id="password" name="password" required>
            </div>

        <div class="forme_reco">
            <button type="submit" name="send" value="Créer">S'enregistrer</button>

        </div>
        </form>
    </div>
</body>
</html>