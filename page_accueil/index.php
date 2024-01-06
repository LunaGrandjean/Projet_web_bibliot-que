<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles.css" media="screen" type="text/css"/>
    <script type="text/javascript" src="index.js"></script>
</head>
<body>
    <div id="lien_connexion" style="background:blue; padding:10px 25px">
        <a href="http://localhost/Projet_web_bibliotheque/administrateur/connexion_admin.php" class="text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <span style="color:white;">
                Connexion administrateur
            </span>
        </a>
    </div>
    <div id="recherche_livre">
        <form action="index.php" method="post">
            <?php
                if (array_key_exists("search", $_POST)) {
                    echo '<div class="recherche"><input type="text" name="search" placeholder="Chercher un livre..." value="' . $_POST["search"] . '"/><button type="submit">Chercher</button></div>';
                    $chercher_par_titre = $chercher_par_resume = $chercher_par_domaine = $chercher_par_auteur = false;
                }
                else {
                    echo '<div class="recherche"><input type="text" name="search" placeholder="Chercher un livre..."/><button type="submit">Chercher</button></div>';
                    //Si l'on n'a pas encore effectué de recherche, alors les "radiobuttons"
                    //correspondant à toutes les caractéristiques (titre, résumé, domaine, auteur)
                    //selon lesquelles on peut chercher un livre doivent tous être cochés
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
            include("../db.php");
            if (array_key_exists("search", $_POST)) {
                $search = $_POST["search"];
                $sql_select = "SELECT ISSN, Titre, Resume, Nbpages, Domaine, GROUP_CONCAT(CONCAT(Nom, ' ', Prenom) SEPARATOR ', ') AS Auteurs
                FROM livre
                LEFT JOIN ecrit ON livre.ISSN = ecrit.Livre_ISSN
                LEFT JOIN auteur ON ecrit.Auteur_Num = auteur.Num
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
                    //La fonction non_vide servira à filtrer les termes de la recherche,
                    //pour exclure ceux qui sont vides
                    function non_vide($chaine) {
                        return $chaine!="";
                    };
                    //Il devrait y avoir une virgule à la fin de $chercher_par, donc on la retire
                    $chercher_par = substr($chercher_par, 0, -1);
                    $condition_selection = '';
                    foreach (array_filter(explode(" ", $search), "non_vide") as $terme) {
                        $condition_selection = $condition_selection . ' CONCAT('. $chercher_par .')
                        LIKE "%' . substr($terme, 0, 5) . '%" OR ';
                    };
                    $condition_selection = "(" . substr($condition_selection, 0, -4) . ")";
                    //Si l'on n'a aucun terme de recherche, alors on met "TRUE" comme condition
                    //pour des questions de syntaxe.
                    if ($condition_selection=="()") {
                        $condition_selection = "TRUE";
                    };
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
                
                $stmt_select = $pdo->prepare($sql_select);

                echo "<table class='table'>
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
                </table>";
                $pdo = null;
            }
        }
        ?>
        </div>
    </form>
    </div>

</body>
</html>