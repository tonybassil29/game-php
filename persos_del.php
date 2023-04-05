<?php require_once('functions.php');
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }
    if (!isset($_GET['ID'])) {
        header('Location: persos.php?msg=id non passé !');
    }
    $bdd= connect();

    $sql = "DELETE FROM persos WHERE id = :id AND user_id=:user_id;";

    $sth->execute([
        'id'         =>$_GET['ID'],
        'user_id'    =>$_SESSION['user']['ID']
    ]);

    //header('Location: persos.php?msg=perso bien supprimé !');