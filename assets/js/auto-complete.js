// //JS CODE FOR AUTO COMPLETE HEADER SECTION
// document.addEventListener("DOMContentLoaded", function() {
//     //get input document
//     var matchingKeywords = [];
//     var searchForm = document.getElementsByClassName("search form");
//     var inputSearchBar = document.querySelector(".text-search");
//     var suggestions = document.getElementById("suggestions");

//     const search_text = document.querySelector(".text-search");
//     const suggestion_container = document.getElementById("suggestions");
//     const button_search = document.querySelector(".search-button");

//     button_search.addEventListener("click", () => {
//         search_text.classList.toggle("active");
//         suggestion_container.classList.toggle("active");
//     });
//     //create event listener in input for any push and check matching keyword
//     inputSearchBar.addEventListener("input",function(event){
//         var inputValue = this.value.toLowerCase();
//         matchingKeywords = keywords.filter(function(keyword) {
//             return keyword.toLowerCase().startsWith(inputValue);
//         });
//         //for each matchin keyword create div whith name of keyword and
//         suggestions.innerHTML = "";
//         matchingKeywords.forEach(function(matchingKeyword) {
//           var suggestionItem = document.createElement("div");
//           suggestionItem.classList.add("suggestion");
//           suggestionItem.textContent = matchingKeyword;
//           suggestions.appendChild(suggestionItem);
//           const suggestion_div = suggestion_container.querySelectorAll('div');
//           console.log(suggestion_div);
//           suggestion_div.forEach((div) => {
//             div.classList.add('active');
//         });
//         });
//     });

//     document.addEventListener("click", function(event) {
//         const inputSearchBar = document.getElementById("inputSearchBar"); // Remplacez par votre propre ID ou sélectionnez l'élément input d'une autre manière
//         console.log(event.target.classList[0]);
//         // Vérifiez si la cible du clic n'est pas l'élément input
//         if (event.target !== inputSearchBar && event.target.classList[0] !== "fa-solid" && event.target.classList[0] !== "text-search") {
//             // Le clic s'est produit en dehors de l'input, déclenchez votre propre événement
//             search_text.classList.remove("active");
//             suggestion_container.classList.remove("active");
//             console.log("Clic en dehors de l'input !" );
//         }
//     });

//     // Ajoutez un gestionnaire d'événements de clic à la div des suggestions
//     suggestion_container.addEventListener("click", function(event) {
//         if (event.target.tagName === "DIV" && event.target.classList.contains("suggestion")) {
//             // L'utilisateur a cliqué sur une suggestion
//             // Récupérez le texte de la suggestion
//             const suggestionText = event.target.textContent;

//             // Remplissez l'input avec le texte de la suggestion
//             inputSearchBar.value = suggestionText;

//             // Soumettez le formulaire
//             document.forms[0].submit();
//         }
//     });
// });

const input = document.querySelector(".custom-search-input");
const suggestionsBox = document.getElementById("custom-suggestions");
const form = document.querySelector(".custom-search-form");

// Quand l'utilisateur tape
input.addEventListener("input", function () {
  const value = this.value.toLowerCase();
  suggestionsBox.innerHTML = "";

  if (!value) {
    suggestionsBox.classList.remove("active");
    return;
  }

  const matches = keywords.filter((keyword) =>
    keyword.toLowerCase().startsWith(value)
  );

  if (matches.length > 0) {
    matches.forEach((match) => {
      const div = document.createElement("div");
      div.textContent = match;
      div.classList.add("custom-suggestion");
      suggestionsBox.appendChild(div);
    });
    suggestionsBox.classList.add("active");
  } else {
    suggestionsBox.classList.remove("active");
  }
});

// Quand on clique sur une suggestion
suggestionsBox.addEventListener("click", function (e) {
  if (e.target.classList.contains("custom-suggestion")) {
    input.value = e.target.textContent;
    form.submit();
  }
});

// Clic en dehors pour fermer la suggestion
document.addEventListener("click", function (e) {
  if (!form.contains(e.target)) {
    suggestionsBox.classList.remove("active");
  }
});

// Fonction clear
function clearCustomInput() {
  input.value = "";
  suggestionsBox.innerHTML = "";
  suggestionsBox.classList.remove("active");
}
