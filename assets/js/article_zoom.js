// Récupère la racine (protocole + host + dossier courant)
const baseUrl = window.location.origin + "/";

function add_favoris(id_producte, id_user) {
  param = "id_producte=" + id_producte + "&id_user=" + id_user;
  console.log(param);
  var xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    baseUrl + "controllers/AddProductInFavorieController.php",
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status === 200) {
      console.log(this.response);
      switch (this.response) {
        case "favoris_add":
          alert("✔️​😀​Votre article a bien été ajouter a vos favoris✔️​😀​");
          window.location.reload();
          break;
        case "favoris_exist":
          alert("❌​🛒​Votre article fait deja partie de vos favoris❌​🛒​");
          window.location.reload();
          break;
      }
    } else if (this.readyState == 4) {
      alert("Une erreur est survenue. . .");
    }
  };
  xhr.send(param);
  return false;
}
function open_avis() {
  const button_voir_plus = document.querySelector("#button_open_avis");
  const container_avis = document.querySelector(".container_avis");
  container_avis.classList.toggle("active");
  button_voir_plus.toggleAttribute("hidden");
}
function modify_avis(id_avis) {
  const avis_box = document.querySelector("#avis_box_" + id_avis);
  const title_id_avis = document.querySelector("#title_" + id_avis);
  const desc_id_avis = document.querySelector("#desc_" + id_avis);
  const value_title = document.querySelector("#title_" + id_avis).innerHTML;
  const value_desc = document.querySelector("#desc_" + id_avis).innerHTML;
  const img_id_avis = document.querySelector("#img_" + id_avis);
  const icon_box = document.querySelector("#icon_" + id_avis);

  title_id_avis.remove();
  desc_id_avis.remove();
  img_id_avis.remove();
  icon_box.remove();

  const my_form = document.createElement("FORM");
  my_form.setAttribute("name", "form_avis");
  my_form.setAttribute("method", "GET");
  my_form.setAttribute("class", "form_avis_modify");
  my_form.setAttribute("action", "/back/move_avis.php");
  const p_title = document.createElement("h4");
  p_title.setAttribute("class", "p_title");
  p_title.innerHTML = "Titre";

  const my_input_hidden_id_avis = document.createElement("INPUT");
  my_input_hidden_id_avis.setAttribute("hidden", true);
  my_input_hidden_id_avis.setAttribute("value", id_avis);
  my_input_hidden_id_avis.setAttribute("name", "id_avis");

  const my_input_hidden_id_article = document.createElement("INPUT");
  my_input_hidden_id_article.setAttribute("hidden", true);
  my_input_hidden_id_article.setAttribute("value", id_avis);
  my_input_hidden_id_article.setAttribute("name", "id_article");

  const my_input_title = document.createElement("INPUT");
  my_input_title.setAttribute("type", "text");
  my_input_title.setAttribute("name", "title_avis");
  my_input_title.setAttribute("class", "title_avis");
  my_input_title.setAttribute("value", value_title);
  my_input_title.setAttribute("required", true);
  const p_desc = document.createElement("p");
  p_desc.setAttribute("class", "p_desc");
  p_desc.innerHTML = "Desc";

  let div_title = document.createElement("div");
  div_title.appendChild(p_title);
  div_title.appendChild(my_input_hidden_id_avis);
  div_title.appendChild(my_input_title);
  my_form.appendChild(div_title);

  let div_desc = document.createElement("div");
  div_desc.appendChild(p_desc);

  const my_input_desc = document.createElement("TEXTAREA");
  my_input_desc.setAttribute("name", "desc_avis");
  my_input_desc.setAttribute("class", "desc_avis");
  my_input_desc.innerHTML = value_desc;
  my_input_desc.setAttribute("required", true);
  div_desc.appendChild(my_input_desc);
  my_form.appendChild(div_desc);

  let div_stars = document.createElement("div");
  div_stars.setAttribute("class", "stars_modify");

  for (i = 5; i > 0; i--) {
    let value = i.toString();
    let input = document.createElement("INPUT");
    input.setAttribute("class", "star_modify star_modify-" + value);
    input.setAttribute("id", "star_modify-" + i + "-2");
    input.setAttribute("type", "radio");
    input.setAttribute("name", "star_modify");
    input.setAttribute("value", i);
    let label = document.createElement("label");
    label.setAttribute("class", "star_modify star-" + i);
    label.setAttribute("for", "star_modify-" + i + "-2");
    div_stars.appendChild(input);
    div_stars.appendChild(label);
  }

  my_form.appendChild(div_stars);

  const my_input_submit = document.createElement("INPUT");
  my_input_submit.setAttribute("type", "submit");
  my_input_submit.setAttribute("value", "MODIFIER");
  my_form.appendChild(my_input_submit);

  avis_box.appendChild(my_form);
}
