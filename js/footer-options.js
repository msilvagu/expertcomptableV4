$(document).ready(function() {
        "use strict";
       

        $(".bloc-texte").click (function ()   {
            
            $("#bloc-texte").css("display", "inline-block");
            $("#bloc-texte1").css("display", "none");
            $("#bloc-texte2").css("display", "none");
            $("#bloc-texte3").css("display", "none");
        });

        $(".bloc-texte1").click (function ()   {
            
            $("#bloc-texte1").css("display", "inline-block");
            $("#bloc-texte").css("display", "none");
            $("#bloc-texte2").css("display", "none");
            $("#bloc-texte3").css("display", "none");
        });

        $(".bloc-texte2").click (function ()   {
            
            $("#bloc-texte2").css("display", "inline-block");
            $("#bloc-texte").css("display", "none");
            $("#bloc-texte1").css("display", "none");
            $("#bloc-texte3").css("display", "none");
        });

        $(".bloc-texte3").click (function ()   {
            
            $("#bloc-texte3").css("display", "inline-block");
            $("#bloc-texte").css("display", "none");
            $("#bloc-texte1").css("display", "none");
            $("#bloc-texte2").css("display", "none");
        });
})

