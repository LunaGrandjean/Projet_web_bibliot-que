<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles.css" media="screen" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="modifier_livres.js"></script>

    <!-- Include other necessary styles and scripts -->
</head>
<body>
    <!-- Your navigation bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="page_auteur.php">Auteur</a>
                    <li class="nav-item">
                    <a class="nav-link" href="page_livres.php">Livre</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        
        <div id="recherche-livre">
            <form action="page_livres.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher un livre..." name="search" aria-label="Rechercher un livre" aria-describedby="button-addon2" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Rechercher</button>
                </div>
            </form>
            <br>
            <br>
            <h2>Liste des livres</h2> 
            <div class='livres-container'> 
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
                    echo "<th scope='col'>Action</th>";
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
                        echo "<td>
                                <input type='hidden' name='ISSN' value='{$row['ISSN']}'>
                                <button type='submit'>Supprimer</button>
                            </td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</form>";

                    $dbh = null;
                ?>
            </div>


            <h2>Ajouter un livre</h2>
            <form action="ajouter_livres.php" method="post">
                <div class="mb-3">
                    <label for="ISSN" class="form-label">ISSN :</label>
                    <input type="text" class="form-control" id="ISSN" name="ISSN" required>
                </div>
                <div class="mb-3">
                    <label for="Titre" class="form-label">Titre :</label>
                    <input type="text" class="form-control" id="Titre" name="Titre" required>
                </div>
                <div class="mb-3">
                    <label for="Resume" class="form-label">Résumé :</label>
                    <textarea class="form-control" id="Resume" name="Resume" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="Nbpages" class="form-label">Nombre de pages :</label>
                    <input type="number" class="form-control" id="Nbpages" name="Nbpages" required>
                </div>
                <div class="mb-3">
                    <label for="Domaine" class="form-label">Domaine :</label>
                    <input type="text" class="form-control" id="Domaine" name="Domaine" required>
                </div>
                <div class="mb-3">
                    <label for="Auteur" class="form-label" name="Auteur">Auteur :</label>
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
                    
                            // Récupération des auteurs depuis la base de données
                            $sqlAuteurs = "SELECT * FROM auteur";
                            $stmtAuteurs = $dbh->query($sqlAuteurs);
                            
                            // Affichage des cases à cocher pour chaque auteur
                            while ($auteur = $stmtAuteurs->fetch(PDO::FETCH_ASSOC)) {
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='checkbox' name='Auteurs[]' value='{$auteur['Num']}' id='auteur{$auteur['Num']}'>{$auteur['Nom']} {$auteur['Prenom']}<br>";
                                echo "</div>";
                            }
                
                            // Affichage des auteurs sélectionnés (si disponible)
                            if (isset($_POST['Auteurs'])) {
                                $selectedAuteurs = $_POST['Auteurs'];
                                echo "<div>Auteurs sélectionnés :</div>";
                                echo "<ul>";
                                foreach ($selectedAuteurs as $selectedAuteur) {
                                    echo "<li>{$selectedAuteur}</li>";
                                }
                                echo "</ul>";
                            }
                        ?>
                    <br>
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter le livre</button>
            </form>
        </div>
    </div>
</body>
</html>
