function afficher_filtres (
    titre_contient="", titre_contient_pas="", resume_contient="", resume_contient_pas="",
    nb_pages_operateur="", nb_pages="<", domaine="Quelconque") {
        if (document.getElementById("filtres").innerHTML=="") {
            let options_nb_pages_operateurs = "";
            for (operateur of ["<", "<=", "=", ">=", ">"]) {
                selected = operateur==nb_pages_operateur?"selected":"";
                options_nb_pages_operateurs+='<option value ="'+operateur+'" '+selected+`>
                `+operateur.replace("<", "&lt;").replace(">", "&gt;")+'</option>';
            };
            let options_domaines = '<option value="Quelconque">Quelconque</option>';
            let domaines_livres = fetch("domaines_livres.php")
            .then(resultat => resultat.text())
            .then(function(domaines_livres) {
                for (let domaine_livre of domaines_livres.slice(0, -1).split(";")) {
                    selected = domaine_livre==domaine?"selected":"";
                    options_domaines+='<option value="'+domaine_livre+'" '+selected+'>'+domaine_livre+'</option>';
                };
                document.getElementById("filtres").innerHTML = `
                <table id='table_filtres'>
                    <tr>
                        <td>Titre contient </td>
                        <td><input type="text" name="titre_contient" value="`+titre_contient+`"></input></td>
                    </tr>
                    <tr>
                        <td>Titre ne contient pas </td>
                        <td><input type="text" name="titre_contient_pas" value="`+titre_contient_pas+`"></input></td>
                    </tr>
                    <tr>
                        <td>Résumé contient </td>
                        <td><input type="text" name="resume_contient" value="`+resume_contient+`"></input></td>
                    </tr>
                    <tr>
                        <td>Résumé ne contient pas </td>
                        <td><input type="text" name="resume_contient_pas" value="`+resume_contient_pas+`"></input></td>
                    </tr>
                    <tr>
                        <td>Nombre de pages <select name="nb_pages_operateur">
                                            `+options_nb_pages_operateurs+`
                                            </select></td>
                        <td><input type="number" min=1 name="nb_pages" value="`+nb_pages+`"></input></td>
                    </tr>
                    <tr>
                        <td>Domaine</td>
                        <td><select name="domaine">
                        `+options_domaines+`
                        </select></td>
                    </tr>
                    </table>`;
                document.getElementById("afficher_filtres").innerHTML = "&#9660; Filtres";
        });
        }
        else {
            document.getElementById("filtres").innerHTML = "";
            document.getElementById("afficher_filtres").innerHTML = "&#9654; Filtres";
        }
    }