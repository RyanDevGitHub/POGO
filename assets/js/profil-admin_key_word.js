//TO SHOW TEXTE SEARCH BAR
// Récupère la racine (protocole + host + dossier courant)
const baseUrl = window.location.origin + "/";

const select_input_key_word = document.getElementById("keyword");
const edit_key_word = document.querySelector(".edit-key-word");
const button_delete_key_word = document.querySelector("#delete_key_word");
const button_move_key_word = document.getElementById("move_key_word");
const response_delete_key_word = document.querySelector(
  ".response_delete_key_word"
);
const new_name_key_word = document.querySelector("[name = new_name_key_word]");

//Key word select

select_input_key_word.addEventListener("change", () => {
  edit_key_word.classList.add("active");
});

button_move_key_word.addEventListener("click", function () {
  param =
    "id=" +
    select_input_key_word.options[select_input_key_word.selectedIndex].id +
    "& value=" +
    new_name_key_word.value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", baseUrl + "controllers/MoveKeyWordController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status === 200) {
      if (
        this.response === "Votre Mot Clé doit contenir uniquement des lettre"
      ) {
        alert(
          "👎 Votre Mot Clé doit contenir uniquement des lettre et faire minimum 2 char et maximum 25 char  😡"
        );
      } else {
        alert("👌nom du mot clé changé avec succès✔️");
        window.location.reload();
      }
    } else if (this.readyState == 4) {
      alert("Une erreur est survenue. . .");
    }
  };
  xhr.send(param);
  return false;
});

button_delete_key_word.addEventListener("click", function () {
  param =
    "id=" +
    select_input_key_word.options[select_input_key_word.selectedIndex].id;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", baseUrl + "controllers/DeleteKeyWordController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status === 200) {
      alert("👌Suprimation du mot clé avec succès✔️");
      window.location.reload();
    } else if (this.readyState == 4) {
      alert("Une erreur est survenue. . .");
    }
  };
  xhr.send(param);
  return false;
});

//Fin key word select
