function afficher_filtres () {
    let code_afficher_filtres = document.getElementById("afficher_filtres").innerHTML;
    if (document.getElementById("filtres").innerHTML=="") {
        document.getElementById("filtres").innerHTML = `
        Nombre de pages <select>
                            <option value="<">&lt;</option>
                            <option value="<=">&lt;=</option>
                            <option value="=">=</option>
                            <option value=">=">&gt;=</option>
                            <option value=">">&gt;</option>
                        </select>
        `;
        document.getElementById("afficher_filtres").innerHTML = "&#9660; Filtres";
    }
    else {
        document.getElementById("filtres").innerHTML = "";
        document.getElementById("afficher_filtres").innerHTML = "&#9654; Filtres";
    }
}