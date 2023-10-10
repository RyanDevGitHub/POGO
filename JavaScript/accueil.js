const items = document.querySelectorAll("img.slider");
const nbSlide = items.length;
const slider_section = document.querySelector(".slider");

 //FOR SLIDER ONLY ACCUEIL

let count = 0;

function enleverActiveImage(){
    for(let i =0;i<nbSlide;i++){
        items[i].classList.remove('active');
    }
}
slider_section.style.backgroundImage ="url('./res/slider5.jpeg')";
function slider(){
    count++;
    if(count >= nbSlide){
        count = 0;
    }
    if(count === 0){
        slider_section.style.backgroundImage ="url('./res/slider5.jpeg')";
    }else{
        slider_section.style.backgroundImage ="url('./res/slider"+count+".jpeg')";
    }
    
    enleverActiveImage();
    items[count].classList.add('active');
}

slider();

setInterval(slider , 6000);

function update() {
    $.get("accueil.js", function(data) {
      $("#section-article column").html(data);
    });
  }

 
  



