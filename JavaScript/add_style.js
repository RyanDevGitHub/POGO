//variables for my shopping list 
var inputSelectStyle = document.getElementById("optionSelectStyle");
var buttonAddStyle = document.getElementById("addStyle");
var inputStyle = document.getElementById("ipStyle");
var divParentStyle = document.getElementById("listStyle");

console.log(inputStyle.value)
arrayStyle = inputStyle.value.length > 0 ? inputStyle.value.split(" ") : [];
inputStyle.value = "";
for (let i = 0; i < arrayStyle.length; i++){
    addliStyle(arrayStyle[i])
}

//toggle between classlist
function strikeoutStyle() {
  this.classList.toggle("done");
}

//check the length of the string entered
function inputlengthStyle() {
  return inputSelectStyle.value.length;
}

//collect data that is inserted 
function addliStyle(ipValue) {
    console.log(ipValue)
    var li = document.createElement("li");
    var btn = document.createElement("button");
    btn.className = "delete";
    btn.innerHTML = "-";
    btn.style.width = "30px";
    btn.style.height = "30px";
    btn.style.backgroundColor= "white";
    btn.style.cursor = "pointer";
    btn.type = "button";
    btn.addEventListener("click", function(e) {
      e.target.parentNode.remove();
      var value = e.target.parentNode.innerHTML;
      for (let i = 0; i < arrayStyle.length ; i++){
        if (value.includes(arrayStyle[i])){
            arrayStyle.splice(i, 1); 
            inputStyle.value = arrayStyle.join(" ");
            return;
        }
      }
    });
    li.addEventListener("click", strikeoutStyle);
    li.innerHTML = ipValue + "  ";
    li.style.fontWeight ="bold";
    li.appendChild(btn);
    divParentStyle.appendChild(li);
    inputStyle.value = arrayStyle.join(" ");
}

//this will add a new list item after click 
function addListAfterClickStyle() {
  if (inputlengthStyle() > 0 && arrayStyle.indexOf(inputSelectStyle.value) === -1) { 
    arrayStyle.push(inputSelectStyle.value);
    addliStyle(inputSelectStyle.value);
    inputSelectStyle.value = "";
  }
}

//this will check for a click event and create new list item
buttonAddStyle.addEventListener("click", addListAfterClickStyle);