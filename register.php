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
    <link rel="stylesheet" href="styles/test.css"> 
</head>
<body>
    <div class="container">
        <h2>Création de votre compte</h2>
        <br>
        <form method="post" action="">
            <div class="forme">
                <label for="email">Email :</label>
                <input placeholder="Entrer votre email" type="email" id="email" name="email" required>
            </div>

            <div class="forme">
                <label for="password">Mot de passe :</label>
                <input placeholder="Entrer votre mot de passe"type="password" id="password" name="password" required>
            </div>

        <div class="forme">
            <button type="submit" name="send" value="Créer">S'enregistrer</button>

        </div>
        </form>
    </div>
</body>
</html>