const formulaire = document.querySelector('form');

///VERIFIVATION JS FORMULAIRE INSCIPTION

formulaire.addEventListener("keyup",function(e) {
    //e.preventDefault();
    input_focus = document.querySelector("input:focus");
    input_focus = input_focus.name;
    form = document.forms["form-register"];

        //PSEUDO

        if( input_focus === 'pseudo'){
            if(event.keyCode === 8){
                console.log('delete was press');
                CheckPseudoContaineAllGoodCaractere();
                if(PseudoContaineAllGoodCaractere === true){
                    document.querySelector('[name="pseudo"]').classList.remove("error");
                }
            }
            l = form["pseudo"].value.length -1;
            console.log("variable i pour pseudo",l);
            console.log(form["pseudo"].value[l]);
            CheckPseudoContaineGoodCaractere(form["pseudo"].value[l]);
            CheckPseudoContaineAllGoodCaractere();
            if(form["pseudo"].value.length >=2 && PseudoContaineAllGoodCaractere === true ){
                document.querySelector('[name="pseudo"]').classList.remove("error");
            }else if(form["pseudo"].value.length <2){
                document.querySelector('[name="pseudo"]').classList.add("error");
            }

        //EMAIL

        }else if(input_focus === 'email'){
            const input_email_recuperation = document.querySelector("input[type='email']");
            let value = input_email_recuperation.value;
            let params =  input_email_recuperation.name+"="+value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST","./back/check_email.php",true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                console.log(this.status)
                if(this.readyState == 4 && this.status === 200){
                    response = (xhr.responseText);
                    if(response === 'email incorrecte'){
                        input_email_recuperation.classList.add("error");
                        console.log('ajout de la class error');
                       input_email_recuperation.setCustomValidity('Votre email est invalide');
                    }else if(response === 'email correcte'){
                        input_email_recuperation.classList.remove("error");
                        console.log("enlever la class error");
                       input_email_recuperation.setCustomValidity('')
                    }
                }else if(this.readyState == 4){
                    alert("Une erreur est survenue. . .");
                }
            };
            xhr.send(params);

            return false;

        //MOT DE PASSE
            
        }else if(input_focus === "mdp" || input_focus === "verefmdp"){
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
                        input.setCustomValidity('Votre mot de passe est invalide');
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

//FONCTION verife email modale

const input_email_recuperation = document.querySelector("#email_recuperation");
input_email_recuperation.addEventListener("keyup",function (){

    let value = input_email_recuperation.value;
    let params =  "email="+value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","./back/check_email.php",true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status === 200){
            response = this.response;
            if(response === 'email incorrecte'){
                input_email_recuperation.classList.add("error");
                console.log('ajout de la class error');
                input_email_recuperation.setCustomValidity('Votre email est invalide');
            }else if(response === 'email correcte'){
                input_email_recuperation.classList.remove("error");
                console.log("enlever la class error");
                input_email_recuperation.setCustomValidity('')
                return 
            }
        }else if(this.readyState == 4){
            alert("Une erreur est survenue. . .");
        }
    };
    xhr.send(params);

    return false;
});

//FONCTION PSEUDO

function CheckPseudoContaineGoodCaractere (char){
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
        console.log('error char');
        document.querySelector('[name="pseudo"]').classList.add("error");
        form["pseudo"].setCustomValidity('Les symbole ne sont pas accepter');
        return PseudoContaineGoodCarctere = false;
    }
}
function CheckPseudoContaineAllGoodCaractere(){
    PseudoContaineAllGoodCaractere = true;
    for(a=0;a<form["pseudo"].value.length;a++){
        CheckPseudoContaineGoodCaractere(form["pseudo"].value[a]);
        if(PseudoContaineGoodCarctere === false){
            PseudoContaineAllGoodCaractere = false;   
        }
    }if(PseudoContaineAllGoodCaractere === false){
        console.log('error word');
        return PseudoContaineAllGoodCaractere;
    }else{
        form["pseudo"].setCustomValidity('');
        return PseudoContaineAllGoodCaractere;
    }
}

//FONCTION MOT DE PASS OUBLIER 
function open_modal_mot_de_passe_oublier(instruction){
    const modal_mot_de_passe_oublier = document.querySelector(".modal_mot_de_passe_oublier");
    const modal = document.querySelector(".modal");
    console.log(modal,instruction);
    if(instruction === "open"){
        modal_mot_de_passe_oublier.classList.add("active");
        modal.classList.add("active");
    }else if(instruction === "close"){
        modal_mot_de_passe_oublier.classList.remove("active");
        modal.classList.remove("active");

    }

}
function send_email_de_recuperation(){
    if(input_email_recuperation.className !== "error"){
        email = input_email_recuperation.value;
        params = "email="+email;
        var xhr = new XMLHttpRequest();
        xhr.open("POST","./back/mot_de_passe_oublier.php",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status === 200 ){
                console.log(this.response);
                if(this.response === "Email envoyé avec succès"){
                    alert("Un email de récuperation de compte a bien été envoyer !");
                }else if (this.response == "Échec de l'envoi de l'email"){
                    alert("Aucun compte existant avec cette email !");
                }
            }else if(this.readyState == 4){
                alert("Une erreur est survenue. . .");
            }
        };
        xhr.send(params);
        return false;
    }else{
        alert('email invalid');
    }
}

