<?php

    require_once('functions.php');
    if (isset($_POST["send"])) {
        $bdd = connect();
        $sql = "SELECT * FROM users WHERE `email` = :email;";
        
        $sth = $bdd->prepare($sql);
        
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password']) ) {
            // dd($user);
            $_SESSION['user'] = $user;
            header('Location: persos.php');
        } else {
            $msg = "Email ou mot de passe incorrect !";
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
    <link rel="stylesheet" href="styles/register_login.css">
    <title>Document</title>
</head>
<body>
    <?php require_once('_nav.php'); ?>
    <form action="" method="post">

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div class="container">
        <h2>Connexion sur votre compte</h2>
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
            <button type="submit" name="send" value="Créer">Se connecter</button>

        </div>
        </form>
    </div>
</body>
</html>
