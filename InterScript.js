var TitleName;
$(document).ready(function($) {
    $(".Po_Gorodu").hover(function()
    {
        $(".popUpMenuG").fadeIn(0);
    },function()
    {
        $(".popUpMenuG").fadeOut(0);
    });
    $(".popUpMenuG").hover(function()
    {
        $(".popUpMenuG").fadeIn(0);
    },function()
    {
        $(".popUpMenuG").fadeOut(0);
    });
    $(".PoMecinatu").hover(function()
    {
        $(".popUpMenuM").fadeIn(0);
    },function()
    {
        $(".popUpMenuM").fadeOut(0);
    });
    $(".popUpMenuM").hover(function()
    {
        $(".popUpMenuM").fadeIn(0);
    },function()
    {
        $(".popUpMenuM").fadeOut(0);
    });
    $(".searchElem").hover(function()
    {
        var $SearchElem = $(this);
        var $Elementbuffer = $SearchElem.attr("fregion") ; 
        var Rg = document.getElementById($Elementbuffer);
        Rg.style.fill = "#4169E1";  
    },
    function()
    {
        var $SearchElem = $(this);
        var $Elementbuffer = $SearchElem.attr("fregion") ; 
        var Rg = document.getElementById($Elementbuffer);
        Rg.style.fill = "#05316D"
    });
    $(".tiles").hover(function(e){
        $('#Hint').text(e.clientX + ' ' + e.clientY);
        $('#Hint').css(
        {
            'left': e.clientX + 10, 
            'top': e.clientY + 10,
            "z-index":1000,
        });
        $('#Hint').show().text("hint");
    });
    $(".searchElem").click(function()
    {
        $(".popup-fade").fadeIn();
        $("#ModalWindow").fadeIn();
        $SearchElem = $(this);
        var $RG =$SearchElem.attr("fregion");
        var $Title = $("#"+$RG);
        var Title = $Title.attr("RGName");
        alert(Title);
    });

    $("#ExitBtn").click(function()
    {
        $(".popup-fade").fadeOut();
        $("#ModalWindow").fadeOut();
        
    });
   
    $(".tiles").click(function()
    {
        $(".popup-fade").fadeIn();
        $("#ModalWindow").fadeIn();
        var $tiles = $(this);
        var $textHead = $tiles.attr("id");
        var textHead = $($textHead).attr("RGName");
        $("modalMeader").html($(this).attr(("descriptiondata")));
        $(".ModalHead").text(textHead);
    });

    $(".searchElemM").click(function()
    {
        $Miz = $(this);
        window.location.replace($Miz.attr("site"));
    });
});