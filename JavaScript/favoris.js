function delete_favoris(id_product){
    const button_delete_favoris = document.querySelector("#button_delete_favori");
    event.preventDefault();
    console.log(id_product);
    param = "id_product="+id_product;
    var xhr = new XMLHttpRequest();
    xhr.open("POST","./back/delete_favoris.php",true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status === 200 ){
            console.log(this.response);
            if(this.response === "sucess"){
                alert("👎Votre favorie vient d'être suprimé 😡");
                button_delete_favoris.remove();
            }else{
                alert("👌une erreur c'est produite contacter un administrateur pour plus d'aide✔️");
               
            }
        }else if(this.readyState == 4){
            alert("Une erreur est survenue. . .");
        }
    };
    xhr.send(param);
    return false;
}