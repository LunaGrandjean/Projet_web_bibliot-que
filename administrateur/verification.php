<?php
session_start();
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM administrateur WHERE Nom = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['username'] = $user['username'];
        header('Location: page_admin.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Identifiants incorrects';
        header('Location: connexion_admin.php');
        exit();
    }
}
?>
