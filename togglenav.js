function togglenav(e){

  var menu = document.getElementById("menu");
  
  if (window.matchMedia("(max-width: 1080px)").matches)
  {
    if (e.target.id == "burgerbutton"){
      if (menu.style.display == "block"){
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    } else {
  
    menu.style.display = "none";
    }
  } else {
    menu.style.display = "block";
  }
}

function togglenavresize(e) {

  var menu = document.getElementById("menu");
  if (window.matchMedia("(max-width: 1080px)").matches) { 
    menu.style.display = "none"; 
  } else {
  
    menu.style.display = "block";
  }
}

