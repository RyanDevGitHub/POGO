//JS CODE FOR AUTO COMPLETE HEADER SECTION
document.addEventListener("DOMContentLoaded", function() {
    //get input document
    var matchingKeywords = [];
    var inputSearchBar = document.querySelector(".text-search");
    var suggestions = document.getElementById("suggestions");
    console.log(suggestions);
    //create event listener in input for any push and check matching keyword
    inputSearchBar.addEventListener("input",function(event){
        var inputValue = this.value.toLowerCase();
         matchingKeywords = keywords.filter(function(keyword) {
            return keyword.toLowerCase().startsWith(inputValue); 
        });
        console.log(matchingKeywords);

        suggestions.innerHTML = "";

        matchingKeywords.forEach(function(matchingKeyword) {
            console.log("test");
          var suggestionItem = document.createElement("div");
          suggestionItem.textContent = matchingKeyword;
          suggestions.appendChild(suggestionItem);
        });
    });
    //add children html div with matching key word
    

    
});



