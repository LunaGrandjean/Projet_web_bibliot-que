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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['Num'])) {
    // Récupérer le numéro de l'auteur à supprimer
    $numAuteur = $_GET['Num'];

    // Début de la transaction
    $dbh->beginTransaction();

    try {
        // Requête de suppression dans la table "Ecrit"
        $sql_delete_ecrit = "DELETE FROM Ecrit WHERE Auteur_Num = :Num";
        $stmt_delete_ecrit = $dbh->prepare($sql_delete_ecrit);
        $stmt_delete_ecrit->bindParam(':Num', $numAuteur);
        $stmt_delete_ecrit->execute();

        // Requête de suppression dans la table "auteur"
        $sql_delete_auteur = "DELETE FROM auteur WHERE Num = :Num";
        $stmt_delete_auteur = $dbh->prepare($sql_delete_auteur);
        $stmt_delete_auteur->bindParam(':Num', $numAuteur);
        $stmt_delete_auteur->execute();

        // Commit de la transaction si tout s'est bien déroulé
        $dbh->commit();

        echo "Auteur supprimé avec succès.";
    } catch (PDOException $e) {
        // Rollback en cas d'erreur
        $dbh->rollBack();
        echo "Erreur lors de la suppression de l'auteur : " . $e->getMessage();
    }
}

// Rediriger vers la page des auteurs après la suppression
header("Location: page_auteur.php");
$dbh = null;
?>
