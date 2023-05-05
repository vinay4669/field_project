var b1 = document.getElementById("profile-button");
var b2 = document.getElementById("donate-button");
var b3 = document.getElementById("request-button");
var b4 = document.getElementById("history-button");
var b5 = document.getElementById("edit-button");
var b6 = document.getElementById("logout-button");

var c1 = document.getElementById("profile");
var c2 = document.getElementById("donate");
var c3 = document.getElementById("request");
var c4 = document.getElementById("history");
var c5 = document.getElementById("edit");
var c6 = document.getElementById("logout");

b1.addEventListener("click", function(){
    c1.style.display = "flex";
    c2.style.display = "none";
    c3.style.display = "none";
    c4.style.display = "none";
    c5.style.display = "none";
    c6.style.display = "none";
    b1.style = "background-color: rgb(255, 155, 11);;";
    b2.style = "background-color: transparent;";
    b3.style = "background-color: transparent;";
    b4.style = "background-color: transparent;";
    b5.style = "background-color: transparent;";
    b6.style = "background-color: transparent;";
});

b2.addEventListener("click", function(){
    c1.style.display = "none";
    c2.style.display = "block";
    c3.style.display = "none";
    c4.style.display = "none";
    c5.style.display = "none";
    c6.style.display = "none";
    b1.style = "background-color: transparent;";
    b2.style = "background-color: rgb(255, 145, 11);;";
    b3.style = "background-color: transparent;";
    b4.style = "background-color: transparent;";
    b5.style = "background-color: transparent;";
    b6.style = "background-color: transparent;";
})

b3.addEventListener("click", function(){
    c1.style.display = "none";
    c2.style.display = "none";
    c3.style.display = "block";
    c4.style.display = "none";
    c5.style.display = "none";
    c6.style.display = "none";
    b1.style = "background-color: transparent;";
    b2.style = "background-color: transparent;";
    b3.style = "background-color: rgb(255, 145, 11);";
    b4.style = "background-color: transparent;";
    b5.style = "background-color: transparent;";
    b6.style = "background-color: transparent;";
})

b4.addEventListener("click", function(){
    c1.style.display = "none";
    c2.style.display = "none";
    c3.style.display = "none";
    c4.style.display = "block";
    c5.style.display = "none";
    c6.style.display = "none";
    b1.style = "background-color: transparent;";
    b2.style = "background-color: transparent;";
    b3.style = "background-color: transparent;";
    b4.style = "background-color: rgb(255, 145, 11);";
    b5.style = "background-color: transparent;";
    b6.style = "background-color: transparent;";
})

b5.addEventListener("click", function(){
    c1.style.display = "none";
    c2.style.display = "none";
    c3.style.display = "none";
    c4.style.display = "none";
    c5.style.display = "flex";
    c6.style.display = "none";
    b1.style = "background-color: transparent;";
    b2.style = "background-color: transparent;";
    b3.style = "background-color: transparent;";
    b4.style = "background-color: transparent";
    b5.style = "background-color: rgb(255, 145, 11);";
    b6.style = "background-color: transparent";
})

b6.addEventListener("click", function(){
    c1.style.display = "none";
    c2.style.display = "none";
    c3.style.display = "none";
    c4.style.display = "none";
    c5.style.display = "none";
    c6.style.display = "flex";
    b1.style = "background-color: transparent;";
    b2.style = "background-color: transparent;";
    b3.style = "background-color: transparent;";
    b4.style = "background-color: transparent";
    b5.style = "background-color: transparent;";
    b6.style = "background-color: rgb(255, 145, 11)";
})