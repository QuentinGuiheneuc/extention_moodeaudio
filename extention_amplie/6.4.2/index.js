var time = true
function ajouter() {
    document.getElementById("Ajout").className = "col-container-fluid"
    document.getElementById("Supp").className = "container-fluid hide"
    document.getElementById("Modi").className = "container-fluid hide"

}
function supp() {
    document.getElementById("Ajout").className = "container-fluid hide"
    document.getElementById("Supp").className = "container-fluid"
    document.getElementById("Modi").className = "container-fluid hide"

}
function modif() {
    document.getElementById("Ajout").className = "container-fluid hide"
    document.getElementById("Supp").className = "container-fluid  hide"
    document.getElementById("Modi").className = "container-fluid"

}
function setnc(params) {
    consol.log(params);
}




