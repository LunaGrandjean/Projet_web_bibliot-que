<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" media="screen" type="text/css"/>
    <script type="text/javascript" src="page_accueil.js"></script>
</head>
<body>
    <span id="domaines_livres" class="invisible"><?php
        $host = 'localhost';
        $db_name = 'projetweb';
        $username = 'root';
        $password = '';

        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        }
        $stmt_select = $dbh->prepare("SELECT DISTINCT Domaine FROM livre");
        $stmt_select->execute();
        while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
            echo "{$row['Domaine']};";
            }
        ?></span>
    <div id="recherche_livre">
        <form action="page_accueil.php" method="post">
            <?php
                if (array_key_exists("search", $_POST)) {
                    echo '<div class="recherche"><input type="text" name="search" placeholder="Chercher un livre..." value="' . $_POST["search"] . '"/><button type="submit">Chercher</button></div>';
                    $chercher_par_titre = $chercher_par_resume = $chercher_par_domaine = $chercher_par_auteur = false;
                }
                else {
                    echo '<div class="recherche"><input type="text" name="search" placeholder="Chercher un livre..."/><button type="submit">Chercher</button></div>';
                    $chercher_par_titre = $chercher_par_resume = $chercher_par_domaine = $chercher_par_auteur = true;
                }
                $titre_checked = $resume_checked = $domaine_checked = $auteur_checked = "";
                if (array_key_exists("chercher_par_titre", $_POST)) {
                    $chercher_par_titre = true;
                }
                if (array_key_exists("chercher_par_resume", $_POST)) {
                    $chercher_par_resume = true;
                }
                if (array_key_exists("chercher_par_domaine", $_POST)) {
                    $chercher_par_domaine = true;
                }
                if (array_key_exists("chercher_par_auteur", $_POST)) {
                    $chercher_par_auteur = true;
                }
                if ($chercher_par_titre) {
                    $titre_checked = 'checked="checked"';
                }
                if ($chercher_par_resume) {
                    $resume_checked = 'checked="checked"';
                }
                if ($chercher_par_domaine) {
                    $domaine_checked = 'checked="checked"';
                }
                if ($chercher_par_auteur) {
                    $auteur_checked = 'checked="checked"';
                }
                echo '<br><br>
                Chercher par :
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_titre"' . $titre_checked .'>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_titre">Titre</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_resume"' . $resume_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_resume">Résumé</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox"  name="chercher_par_domaine"' . $domaine_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_domaine">Domaine</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="switch">
                <input type="checkbox" name="chercher_par_auteur"' . $auteur_checked . '>
                <span class="slider"></span>
                </label>
                <label for="chercher_par_auteur">Auteur</label>
                <div id="conteneur_filtres">
                <span id="afficher_filtres" onclick="afficher_filtres();">&#9654; Filtres</span>
                <div id="filtres"></div>
                </div>';
            ?>
        <br>
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
                die('Echec de la connexion à la base de données : ' . $e->getMessage());
            }

            // Requête SQL de base

            if (array_key_exists("search", $_POST)) {
                $search = $_POST["search"];
                $sql_select = "SELECT ISSN, Titre, Resume, Nbpages, Domaine, GROUP_CONCAT(CONCAT(Nom, ' ', Prenom) SEPARATOR ', ') AS Auteurs
                FROM livre
                LEFT JOIN Ecrit ON livre.ISSN = Ecrit.Livre_ISSN
                LEFT JOIN Auteur ON Ecrit.Auteur_Num = Auteur.Num
                WHERE ";
                $chercher_par = '';
                if ($chercher_par_titre) {
                    $chercher_par = $chercher_par . 'Titre, " ",';
                }
                if ($chercher_par_resume) {
                    $chercher_par = $chercher_par . 'Resume, " ",';
                }
                if ($chercher_par_domaine) {
                    $chercher_par = $chercher_par . 'Domaine, " ",';
                }
                if ($chercher_par_auteur) {
                    $chercher_par = $chercher_par . 'auteur.Nom, " ", auteur.Prenom,';
                }
                if ($chercher_par=="") {
                    echo '<div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display=' . "'none'" . ';">&times;</span>
                    Il faut chercher au moins par titre, résumé, domaine ou auteur.
                    </div>';
                }
                else {
                    //Il devrait y avoir une virgule à la fin de $chercher_par, donc on la retire
                    $chercher_par = substr($chercher_par, 0, -1);
                    $condition_selection = '';
                    foreach (explode(" ", $search) as $terme) {
                        $condition_selection = $condition_selection . ' CONCAT('. $chercher_par .')
                        LIKE "%' . substr($terme, 0, 5) . '%" OR ';
                    };
                    $condition_selection = "(" . substr($condition_selection, 0, -4) . ")";
                    if (array_key_exists("titre_contient", $_POST)) {
                        $condition_selection = $condition_selection . ' AND (Titre LIKE "%' . $_POST["titre_contient"] . '%")';
                        if ($_POST["titre_contient_pas"]!="") {
                            $condition_selection = $condition_selection . ' AND (NOT Titre LIKE "%' . $_POST["titre_contient_pas"] . '%")';
                        }
                        $condition_selection = $condition_selection . ' AND (Resume LIKE "%' . $_POST["resume_contient"] . '%")';
                        if ($_POST["resume_contient_pas"]!="") {
                            $condition_selection = $condition_selection . ' AND (NOT Resume LIKE "%' . $_POST["resume_contient_pas"] . '%")';
                        }
                        if (is_numeric($_POST["nb_pages"])) {
                            $condition_selection = $condition_selection . ' AND (Nbpages ' . $_POST["nb_pages_operateur"] . $_POST["nb_pages"] . ")";
                        }
                        if ($_POST["domaine"]!="Quelconque") {
                            $condition_selection = $condition_selection . ' AND (Domaine = "' . $_POST["domaine"] . '")';
                        }
                        echo "<script type='text/javascript'>afficher_filtres('" . $_POST["titre_contient"] . "', '" . $_POST["titre_contient_pas"] . "', '" . $_POST["resume_contient"] . "', '" . $_POST["resume_contient_pas"] . "', '" . $_POST["nb_pages_operateur"] . "', '" . $_POST["nb_pages"] . "', '" . $_POST["domaine"] . "');</script>";
                    }
                    $sql_select = $sql_select . $condition_selection . " GROUP BY ISSN";
                }
                
            $stmt_select = $dbh->prepare($sql_select);

            echo "<form action='supprimer_livres.php' method='post'>
            <table class='table'>
            <thead>
            <tr>
            <th scope='col'>ISSN</th>
            <th scope='col'>Titre</th>
            <th scope='col'>Résumé</th>
            <th scope='col'>Nombre de pages</th>
            <th scope='col'>Domaine</th>
            <th scope='col'>Auteur(s)</th>
            </tr>
            </thead>
            <tbody>";

            $stmt_select->execute();

            while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                <th scope='row'>{$row['ISSN']}</th>
                <td>{$row['Titre']}</td>
                <td>{$row['Resume']}</td>
                <td>{$row['Nbpages']}</td>
                <td>{$row['Domaine']}</td>
                <td>{$row['Auteurs']}</td>
                </tr>";
            }

            echo "</tbody>
            </table>
            </form>";
        }
        ?>
        </div>
        </form>
    </div>
</body>
</html>
