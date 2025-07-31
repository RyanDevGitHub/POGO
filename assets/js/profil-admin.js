function add_search_in_input(resulte_clicked){
    console.log(resulte_clicked);
    document.forms["form-search"]["search-bar"].value = resulte_clicked;
    document.querySelector("#result-search").innerHTML = "";
}


button_search.addEventListener("click",() =>{
    search_text.classList.toggle("active");
});
button_modify.addEventListener("click",()=>{
    div_container_profil_client.classList.remove("active");
    form_modify.classList.add("active");
});
delete_adresse.addEventListener("click",()=>{
    
})