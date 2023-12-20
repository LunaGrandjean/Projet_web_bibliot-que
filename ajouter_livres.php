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
            $ISSN = $_POST['ISSN'];
            $titre = $_POST['Titre'];
            $resume = $_POST['Resume'];
            $nb_pages = $_POST['Nbpages'];
            $domaine = $_POST['Domaine'];

            // Requête d'insertion dans la table "livre" avec PDO
            $sql = "INSERT INTO livre (ISSN, Titre, Resume, Nbpages, Domaine) VALUES (:ISSN, :Titre, :Resume, :Nbpages, :Domaine)";
            $stmt = $dbh->prepare($sql);

            $stmt->bindParam(':ISSN', $ISSN);
            $stmt->bindParam(':Titre', $titre);
            $stmt->bindParam(':Resume', $resume);
            $stmt->bindParam(':Nbpages', $nb_pages);
            $stmt->bindParam(':Domaine', $domaine);

            try {
                $stmt->execute();
                echo "Livre ajouté avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de l'ajout du livre : " . $e->getMessage();
            }
        }

        // Fermeture de la connexion à la base de données
        header("Location: page_livres.php");
        $dbh = null;
        ?>
