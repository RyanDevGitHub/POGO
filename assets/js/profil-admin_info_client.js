// Récupère la racine (protocole + host + dossier courant)
const baseUrl = window.location.origin + "/";
const button_modify = document.querySelector(".modify-button");
const form_modify = document.querySelector(".form_profil");
const div_container_profil_client = document.querySelector(
  ".container-info-client"
);
const delete_adresse = document.getElementById("adresse");
const delete_numero = document.getElementById("numero");
const delete_code_postal = document.getElementById("code_postal");
const delete_nom = document.getElementById("nom");
const delete_prenom = document.getElementById("prenom");
const delete_pseudo = document.getElementById("pseudo");
const input_search_bar = document.getElementsByName("search-bar");
const formulaire_recherche_information_clients =
  document.querySelector(".form-search");

formulaire_recherche_information_clients.addEventListener("keyup", () => {
  console.log("echo");
  let form = document.forms["form-search"]["search-bar"];
  param = "search=" + form.value;
  console.log(param);
  var text = "abc";
  console.log(form.value.length);
  if (form.value.length > 0) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", baseUrl + "controllers/AutoSugestController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status === 200) {
        response = JSON.parse(xhr.response);
        console.log(response);

        let resultR = document.querySelector("#result-search");
        resultR.innerHTML = "";
        // let resulte = "";
        for (i = 0; i < response.length; i++) {
          let mipseudo = response[i]["pseudo"];
          let miA = document.createElement("a");
          console.log(mipseudo);
          miA.setAttribute(
            "onclick",
            'add_search_in_input("' + mipseudo + '")'
          );
          miA.textContent = mipseudo;

          resultR.append(miA);
          resultR.append(document.createElement("br"));

          // resulte = resulte + "<a onclick='add_search_in_input('"+response[i]['pseudo'] +"')'>" +response[i]['pseudo'] + "</a></br>" ;
        }
        //document.querySelector("#result-search").innerHTML = resulte;
      } else if (this.readyState == 4) {
        alert("Une erreur est survenue. . .");
      }
    };
    xhr.send(param);
    return false;
  } else {
    let resulte = "";
    document.querySelector("#result-search").innerHTML = resulte;
    return false;
  }
});

function new_password() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", baseUrl + "controllers/ReinitPasswordController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status === 200) {
      console.log(this.response);
      if (this.response === "Email envoyé avec succès") {
        alert("Un email de récuperation de compte a bien été envoyer !");
      }
    } else if (this.readyState == 4) {
      alert("Une erreur est survenue. . .");
    }
  };
  xhr.send();
  return false;
}

function add_search_in_input(resulte_clicked) {
  console.log(resulte_clicked);
  document.forms["form-search"]["search-bar"].value = resulte_clicked;
  document.querySelector("#result-search").innerHTML = "";
}
