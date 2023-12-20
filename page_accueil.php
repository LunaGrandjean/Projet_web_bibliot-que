<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Test</title>
    <link rel="stylesheet" href="styles.css" media="screen" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>
<body>
    <div id="recherche_livre">
        <form action="page_acceuil.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher un livre..." name="search" aria-label="Rechercher un livre" aria-describedby="button-addon2" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Rechercher</button>
                </div>
            
            <br>
            <br>
            Chercher par :
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="switch">
                <input type="checkbox" name="chercher_par_titre" <?php echo isset($_POST["chercher_par_titre"]) ? 'checked="checked"' : ''; ?>>
                <span class="slider"></span>
            </label>
            <label for="chercher_par_titre">Titre</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="switch">
                <input type="checkbox" name="chercher_par_resume" <?php echo isset($_POST["chercher_par_resume"]) ? 'checked="checked"' : ''; ?>>
                <span class="slider"></span>
            </label>
            <label for="chercher_par_resume">Résumé</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="switch">
                <input type="checkbox" name="chercher_par_domaine" <?php echo isset($_POST["chercher_par_domaine"]) ? 'checked="checked"' : ''; ?>>
                <span class="slider"></span>
            </label>
            <label for="chercher_par_domaine">Domaine</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label class="switch">
                <input type="checkbox" name="chercher_par_auteur" <?php echo isset($_POST["chercher_par_auteur"]) ? 'checked="checked"' : ''; ?>>
                <span class="slider"></span>
            </label>
            <label for="chercher_par_auteur">Auteur</label>
        </form>

        <div id="resultats_livres">
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

            // Requête SQL de base
            $sql_select = "SELECT livre.ISSN, Titre, Resume, Nbpages, Domaine, GROUP_CONCAT(CONCAT(Nom, ' ', Prenom) SEPARATOR ', ') AS Auteurs
            FROM livre
            LEFT JOIN Ecrit ON livre.ISSN = Ecrit.Livre_ISSN
            LEFT JOIN Auteur ON Ecrit.Auteur_Num = Auteur.Num
            WHERE Titre LIKE :search
                OR Nbpages LIKE :search
                OR Domaine LIKE :search
                OR CONCAT(Nom, ' ', Prenom) LIKE :search
            GROUP BY livre.ISSN";

            // Si une recherche est effectuée
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                // Modifiez la requête pour inclure des conditions de recherche
                $sql_select = "SELECT livre.ISSN, Titre, Resume, Nbpages, Domaine, GROUP_CONCAT(CONCAT(Nom, ' ', Prenom) SEPARATOR ', ') AS Auteurs
                    FROM livre
                    LEFT JOIN Ecrit ON livre.ISSN = Ecrit.Livre_ISSN
                    LEFT JOIN Auteur ON Ecrit.Auteur_Num = Auteur.Num
                    WHERE Titre LIKE :search
                        OR Nbpages LIKE :search
                        OR Domaine LIKE :search
                        OR CONCAT(Nom, ' ', Prenom) LIKE :search
                    GROUP BY livre.ISSN";
            }

            $stmt_select = $dbh->prepare($sql_select);

            echo "<form action='supprimer_livres.php' method='post'>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>ISSN</th>";
            echo "<th scope='col'>Titre</th>";
            echo "<th scope='col'>Resume</th>";
            echo "<th scope='col'>Nbpages</th>";
            echo "<th scope='col'>Domaine</th>";
            echo "<th scope='col'>Auteur</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Bind the parameter only once
            $search = '%' . $_POST['search'] . '%';
            $stmt_select->bindParam(':search', $search, PDO::PARAM_STR);
            $stmt_select->execute();

            while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<th scope='row'>{$row['ISSN']}</th>";
                echo "<td>{$row['Titre']}</td>";
                echo "<td>{$row['Resume']}</td>";
                echo "<td>{$row['Nbpages']} pages</td>";
                echo "<td>{$row['Domaine']}</td>";
                echo "<td>{$row['Auteurs']}</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</form>";

            $dbh = null;
        ?>
        </div>
    </div>
</body>
</html>
