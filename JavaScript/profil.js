
// verification champ correcter 
/*const formulaire = document.querySelector('.form_profil');
formulaire.addEventListener("submit",function(e) {
    e.preventDefault();
    console.log(formulaire);
    
});
*/
const formulaire = document.querySelector('.form_profil');
formulaire.addEventListener("keyup",function(e) {
    //e.preventDefault();
    input_focus = document.querySelector("input:focus");
    input_focus = input_focus.name;
    form = document.forms["form_profil"];
    if( input_focus === 'pseudo'){
        if(event.keyCode === 8){
            console.log('delete was press');
            CheckPseudoContaineAllGoodCaractere("pseudo");
            if(PseudoContaineAllGoodCaractere === true){
                document.querySelector('[name="pseudo"]').classList.remove("error");
            }
        }
        l = form["pseudo"].value.length -1;
        console.log("variable i pour pseudo",l);
        console.log(form["pseudo"].value[l]);
        CheckPseudoContaineGoodCaractere(form["pseudo"].value[l],"pseudo");
        CheckPseudoContaineAllGoodCaractere("pseudo");
        if(form["pseudo"].value.length >=2 && PseudoContaineAllGoodCaractere === true ){
            document.querySelector('[name="pseudo"]').classList.remove("error");
        }else if(form["pseudo"].value.length <2){
            document.querySelector('[name="pseudo"]').classList.add("error");
        }
    }else if( input_focus === 'name'){
        if(event.keyCode === 8){
            console.log('delete was press');
            CheckPseudoContaineAllGoodCaractere("name");
            if(PseudoContaineAllGoodCaractere === true){
                document.querySelector('[name="name"]').classList.remove("error");
            }
        }
        l = form["name"].value.length -1;
        console.log("variable i pour name",l);
        console.log(form["name"].value[l]);
        CheckPseudoContaineGoodCaractere(form["name"].value[l],"name");
        CheckPseudoContaineAllGoodCaractere("name");
        if(form["name"].value.length >=2 && PseudoContaineAllGoodCaractere === true ){
            document.querySelector('[name="name"]').classList.remove("error");
        }else if(form["name"].value.length <2){
            document.querySelector('[name="name"]').classList.add("error");
        }
    }else if( input_focus === 'firstname'){
        if(event.keyCode === 8){
            console.log('delete was press');
            CheckPseudoContaineAllGoodCaractere("firstname");
            if(PseudoContaineAllGoodCaractere === true){
                document.querySelector('[name="firstname"]').classList.remove("error");
            }
        }
        l = form["firstname"].value.length -1;
        console.log("variable i pour firstname",l);
        console.log(form["firstname"].value[l]);
        CheckPseudoContaineGoodCaractere(form["firstname"].value[l],"firstname");
        CheckPseudoContaineAllGoodCaractere("firstname");
        if(form["firstname"].value.length >=2 && PseudoContaineAllGoodCaractere === true ){
            document.querySelector('[name="firstname"]').classList.remove("error");
        }else if(form["firstname"].value.length <2){
            document.querySelector('[name="firstname"]').classList.add("error");
        }
    }else if(input_focus === 'email'){
        const mailInput = document.querySelector("input[type='email']");
        let value = mailInput.value;
        let params =  mailInput.name+"="+value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST","./back/check_email.php",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status === 200){
                response = (xhr.responseText);
                console.log(response);
                if(response === 'email incorrecte'){
                    mailInput.classList.add("error");
                    console.log('ajout de la class error');
                    form["email"].setCustomValidity('Adresse email: ex: xxxxx@gmail.xxx');
                }else if(response === 'email correcte'){
                    mailInput.classList.remove("error");
                    console.log("enlever la class error");
                    form["email"].setCustomValidity('')
                }
            }else if(this.readyState == 4){
                alert("Une erreur est survenue. . .");
            }
        };
        xhr.send(params);

        return false;
    }else if(input_focus === 'code_postal'){
        const input = document.querySelector("input[name='"+input_focus+"']");
        numbers = /^[0-9]+$/ ;
        value = input.value;
        if(value.length === 5 && value.match(numbers) || value.length === 0){
            input.classList.remove("error");
            input.setCustomValidity('');
            param ="code-postale="+value;
            xhr = new XMLHttpRequest();
            xhr.open('POST','./back/search-city.php',true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 &&  this.status === 200 ){
                    let select_ville = document.querySelector("#ville");
                    let select_default = document.createElement("option");
                    select_ville.innerHTML ="";
                    select_default.setAttribute("value","none");
                    select_default.setAttribute("selected",true);
                    select_default.setAttribute("disabled",true);
                    select_default.setAttribute("hidden",true);
                    select_ville.append(select_default);
                    select_default.innerHTML = "Selectioner votre ville";
                    json_ville = JSON.parse(this.response);
                    //console.log(json_ville.length);
                    for(i = 0; i<json_ville.length;i++){
                        console.log(name_ville = json_ville[i][0]);
                        console.log(id_ville = json_ville[i][1]);
                        select_response = document.createElement("option");
                        select_response.setAttribute('value', name_ville);
                        select_response.setAttribute('id', id_ville);
                        select_ville.append(select_response);
                        select_response.innerHTML = name_ville;


                    }

                }else if(this.readyState == 4){
                    alert("Une erreur est survenue. . .");
                }
            };
            xhr.send(param);
            return false;
        }else{
            input.classList.add("error");
            input.setCustomValidity('Votre code postale doit contenir 5 chiffre');
            let select_ville = document.querySelector("#ville");
            let select_default = document.createElement("option");
            select_ville.innerHTML ="";
            select_default.setAttribute("value","none");
            select_default.setAttribute("selected",true);
            select_default.setAttribute("disabled",true);
            select_default.setAttribute("hidden",true);
            select_ville.append(select_default);
            select_default.innerHTML = "Selectioner votre ville";

        } 
    }else if(input_focus === 'numero'){
        const input = document.querySelector("input[name='"+input_focus+"']");
        numbers = /^[0-9]+$/ ;
        value = input.value;

        if(value.length === 10 && value.match(numbers) || value.length === 0){
            input.classList.remove("error");
            input.setCustomValidity('');
        }else{
            input.classList.add("error");git
            input.setCustomValidity('Votre code postale doit contenir 5 chiffre');

        }
    }else if(input_focus === "password" || input_focus === "seconde_password"){
        const input = document.querySelector("input[name='"+input_focus+"']");
        value = input.value;
        let params =  input_focus+"="+value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST","./back/check_mdp.php",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status === 200){
                response = (xhr.responseText);
                console.log(response);
                if(response === 'fail_mdp'){
                    input.classList.add("error");
                    input.setCustomValidity('Votre mot de passe est invalide il doit contenir 1MAJ 1NOMBRE 1SYMBOLE');
                    if(value.length === 0){
                        input.classList.remove("error");
                        input.setCustomValidity('');
                    }
                }else if(response === 'good_mdp'){
                    input.classList.remove("error");
                    input.setCustomValidity('');
                }
            }else if(this.readyState == 4){
                alert("Une erreur est survenue. . .");
            }
        };
        xhr.send(params);
        return false;    
    }
});


function CheckPseudoContaineGoodCaractere (char,input){
    PseudoContaineGoodCarctere = true;
    char = char.charCodeAt(0)
    console.log(char);
    if (
        char >= 65 && char <= 90 ||
        char >= 97 && char <= 122 ||
        char >= 192 && char <= 221 ||
        char >= 224 && char <= 246 ||
        char >= 249 && char <= 255 ||
        char == 45 ||
        char == 39 || char == 24 
        ) {
        return  PseudoContaineGoodCarctere = true;

    }else{
        console.log(input);
        console.log('error char'+ input);
        document.querySelector('[name="'+input+'"]').classList.add("error");
        form[input].setCustomValidity('Les symbole ne sont pas accepter');
        return PseudoContaineGoodCarctere = false;
    }
}
function CheckPseudoContaineAllGoodCaractere(input){
    PseudoContaineAllGoodCaractere = true;
    for(a=0;a<form[input].value.length;a++){
        CheckPseudoContaineGoodCaractere(form[input].value[a],input);
        if(PseudoContaineGoodCarctere === false){
            PseudoContaineAllGoodCaractere = false;   
        }
    }if(PseudoContaineAllGoodCaractere === false){
        console.log('error word');
        return PseudoContaineAllGoodCaractere;
    }else{
        form[input].setCustomValidity('');
        return PseudoContaineAllGoodCaractere;
    }
}

//fonction add class active

function addClassMonCompte(){
    // remove all class active

    const historique_de_commande = document.querySelector('.historique_de_commande');
    historique_de_commande.classList.remove('active');
    
    const marques_favorites = document.querySelector('.marques_favorites');
    marques_favorites.classList.remove('active');

    const mon_compte = document.querySelector('.mon_compte');
    mon_compte.classList.add("active");

    //remove all class active 

    const ButtunHistoriqueCommande = document.querySelector(".buttun_historique_de_commande")
    ButtunHistoriqueCommande.classList.remove("active");

    const ButtunMarquesFavorites = document.querySelector(".buttun_marques_favorites")
    ButtunMarquesFavorites.classList.remove("active");

    const ButtunMonCompte = document.querySelector(".buttun_mon_compte")
    ButtunMonCompte.classList.add("active");
}

function addClassHistoriqueDeCommandes(){

    const mon_compte = document.querySelector('.mon_compte');
    mon_compte.classList.remove("active");

    const marques_favorites = document.querySelector('.marques_favorites');
    marques_favorites.classList.remove('active');

    const historique_de_commande = document.querySelector('.historique_de_commande');
    historique_de_commande.classList.add('active');

    const ButtunMonCompte = document.querySelector(".buttun_mon_compte")
    ButtunMonCompte.classList.remove("active");

    const ButtunMarquesFavorites = document.querySelector(".buttun_marques_favorites")
    ButtunMarquesFavorites.classList.remove("active");

    const ButtunHistoriqueCommande = document.querySelector(".buttun_historique_de_commande")
    ButtunHistoriqueCommande.classList.add("active");
}

function addClassMarquesFavorites(){

    const mon_compte = document.querySelector('.mon_compte');
    mon_compte.classList.remove("active");

    const historique_de_commande = document.querySelector('.historique_de_commande');
    historique_de_commande.classList.remove('active');

    const marques_favorites = document.querySelector('.marques_favorites');
    marques_favorites.classList.add('active');

    const ButtunMonCompte = document.querySelector(".buttun_mon_compte")
    ButtunMonCompte.classList.remove("active");

    const ButtunHistoriqueCommande = document.querySelector(".buttun_historique_de_commande")
    ButtunHistoriqueCommande.classList.remove("active");

    const ButtunMarquesFavorites = document.querySelector(".buttun_marques_favorites")
    ButtunMarquesFavorites.classList.add("active");
}
function updateDiv()
{ 
    $( ".info_client" ).load(window.location.href + " .info_client" );
};




