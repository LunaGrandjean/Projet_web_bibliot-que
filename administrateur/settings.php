<?php
$host = 'localhost';
$db_name = 'projetweb';
$username = 'root';
$password = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Échec de la connexion à la base de données : ' . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification dans la base de données
    $sql = "SELECT * FROM administrateur WHERE Nom = :username AND Password = :password";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Nom d'utilisateur et mot de passe valides
            // Récupération du nouveau mot de passe (s'il a été soumis)
            if (isset($_POST['new_password'])) {
                $newPassword = $_POST['new_password'];
                $userId = $stmt->fetch(PDO::FETCH_ASSOC)['Id'];

                // Mise à jour du mot de passe dans la base de données
                $updateSql = "UPDATE administrateur SET Password = :newPassword WHERE Id = :userId";
                $updateStmt = $dbh->prepare($updateSql);
                $updateStmt->bindParam(':newPassword', $newPassword);
                $updateStmt->bindParam(':userId', $userId);

                try {
                    $updateStmt->execute();
                    echo "Mot de passe changé avec succès.";

                    // Redirection vers la page 'connexion_admin.php' après le changement de mot de passe
                    header("Location: connexion_admin.php");
                    exit();
                } catch (PDOException $e) {
                    echo "Erreur lors de la mise à jour du mot de passe : " . $e->getMessage();
                }
            }
        } else {
            // Nom d'utilisateur ou mot de passe incorrect
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la vérification du nom d'utilisateur et du mot de passe : " . $e->getMessage();
    }
}

// Fermeture de la connexion à la base de données
$dbh = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Changer le mot de passe</title>
</head>
<body>

<form method="post" action="">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="username" required><br>

    <label>Mot de passe actuel:</label>
    <input type="password" name="password" required><br>

    <label>Nouveau mot de passe:</label>
    <input type="password" name="new_password"><br>

    <input type="submit" value="Changer le mot de passe">
</form>

</body>
</html>
