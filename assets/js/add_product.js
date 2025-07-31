//variables for my shopping list
var inputOptionSelect = document.getElementById("optionSelect");
var buttonAdd = document.getElementById("addKeyWord");
var inputKeyword = document.getElementById("ipKeyWord");
var divParent = document.getElementById("listKey");

console.log(inputKeyword.value);
arrayKey = inputKeyword.value.length > 0 ? inputKeyword.value.split(" ") : [];
inputKeyword.value = "";
for (let i = 0; i < arrayKey.length; i++) {
  addli(arrayKey[i]);
}

//toggle between classlist
function strikeout() {
  this.classList.toggle("done");
}

//check the length of the string entered
function inputlength() {
  return inputOptionSelect.value.length;
}

//collect data that is inserted
function addli(ipValue) {
  var li = document.createElement("li");
  var btn = document.createElement("button");
  btn.className = "delete";
  btn.innerHTML = "-";
  btn.style.width = "30px";
  btn.style.height = "30px";
  btn.style.backgroundColor = "white";
  btn.style.cursor = "pointer";
  btn.type = "button";
  btn.addEventListener("click", function (e) {
    e.target.parentNode.remove();
    var value = e.target.parentNode.innerHTML;
    for (let i = 0; i < arrayKey.length; i++) {
      if (value.includes(arrayKey[i])) {
        arrayKey.splice(i, 1);
        inputKeyword.value = arrayKey.join(" ");
        return;
      }
    }
  });
  li.addEventListener("click", strikeout);
  li.innerHTML = ipValue + "  ";
  li.style.fontWeight = "bold";
  li.appendChild(btn);
  divParent.appendChild(li);
  inputKeyword.value = arrayKey.join(" ");
}

//this will add a new list item after click
function addListAfterClick() {
  if (inputlength() > 0 && arrayKey.indexOf(inputOptionSelect.value) === -1) {
    arrayKey.push(inputOptionSelect.value);
    addli(inputOptionSelect.value);
    inputOptionSelect.value = "";
  }
}

//this will check for a click event and create new list item
buttonAdd.addEventListener("click", addListAfterClick);
