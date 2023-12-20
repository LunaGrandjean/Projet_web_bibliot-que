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

    // Début de la transaction
    $dbh->beginTransaction();

    try {
        // Requête de suppression dans la table "Ecrit"
        $sql_delete_ecrit = "DELETE FROM Ecrit WHERE Livre_ISSN = :ISSN";
        $stmt_delete_ecrit = $dbh->prepare($sql_delete_ecrit);
        $stmt_delete_ecrit->bindParam(':ISSN', $ISSN);
        $stmt_delete_ecrit->execute();

        // Requête de suppression dans la table "livre"
        $sql_delete_livre = "DELETE FROM livre WHERE ISSN = :ISSN";
        $stmt_delete_livre = $dbh->prepare($sql_delete_livre);
        $stmt_delete_livre->bindParam(':ISSN', $ISSN);
        $stmt_delete_livre->execute();

        // Commit de la transaction si tout s'est bien déroulé
        $dbh->commit();

        echo "Livre supprimé avec succès.";
    } catch (PDOException $e) {
        // Rollback en cas d'erreur
        $dbh->rollBack();
        echo "Erreur lors de la suppression du livre : " . $e->getMessage();
    }
}

// Rediriger vers la page des livres après la suppression
header("Location: page_livres.php");
$dbh = null;
?>
