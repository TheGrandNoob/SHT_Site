$("#MainBtn").fadeOut(0);
$(".popUpMenuG").fadeOut(0);
$(".popUpMenuM").fadeOut(0);
var 
    Wwidth=$(window).width() // ширина  
    Wheight=$(window).height()// высота
    /////////////    Elemnts ////////////
var ModalWindow = document.getElementById("ModalWindow");
    ExitButton = document.getElementById("ExitBtn");
    MexitBtn = document.getElementById("MExtBtn");
    ExtBtn = document.getElementById("ExtBtn");
    openCMenu = document.getElementById("openCMenu");
    Title = document.getElementById("modalHead");
    /////////////  Varables //////////////
var
    a1 , a2 ,a3;


a1 = Wwidth*0.35;
a2 = Wheight*0.6;
a3 = a1*0.3;

ModalWindow.style.width =a1 + "px";
ModalWindow.style.height=a2 + "px";

ModalWindow.style.marginLeft = Wwidth*0.5 - (Wwidth*0.35)/2 + "px";
ModalWindow.style.marginTop = Wheight*0.5 - (Wheight*0.6)/2 + "px"; 

