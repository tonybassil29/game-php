<?php
require_once('functions.php');

function changer_pseudo($newname) {
   
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
    }
    
    $user_id = $_SESSION['user']['id'];
    $pdo = connect();
    
    $sql = "UPDATE users SET name = :newname WHERE id = :user_id";
    $stmt= $pdo->prepare($sql);
    
    $stmt->execute([
        'newname' => $newname,
        'user_id' => $user_id
    ]);
    
    // Update session variable with new name
    $_SESSION['user']['name'] = $newname;
    
    header('Location: profile.php');
}
?>
