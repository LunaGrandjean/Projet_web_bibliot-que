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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ISSN'])) {
    // Récupérer l'ISSN du livre à supprimer
    $ISSN = $_POST['ISSN'];

    // Requête de suppression dans la table "livre"
    $sql_delete = "DELETE FROM livre WHERE ISSN = :ISSN";
    $stmt_delete = $dbh->prepare($sql_delete);

    $stmt_delete->bindParam(':ISSN', $ISSN);

    try {
        $stmt_delete->execute();
        echo "Livre supprimé avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du livre : " . $e->getMessage();
    }
}

// Rediriger vers la page des livres après la suppression
header("Location: page_livres.php");
$dbh = null;
?>
