"use strict";

$(document).ready(function () {
    $("#contactForm-step-2").on("submit", function (event) {

  
    $("#step-1").css("display", "none");
    $("#step-3").css("display", "none");
    $("#step-2").css("display", "inline-block");
        var useGender =  $('input:radio[name=gender]:checked').val();
        var useName = $("#name").val();
        var useMail = $("#email").val();
        var useTelephone = $("#telephone").val();
        var nbAchat = $("#nb-factures-achat").text();
        var nbVente = $("#nb-factures-vente").text();
        var nbSalaries = $("#nb-salaries").text();
        var valmin = $("#val-min").text();
        var valmax = $("#val-max").text();
        
        
        event.preventDefault();

        $.ajax("contact.php", {
            type: "POST",
            data: {
                use_Gender: useGender,
                name: useName,
                email: useMail,
                use_Telephone: useTelephone,
                nb_Achat : nbAchat,
                nb_Vente : nbVente,
                nb_Salaries : nbSalaries,
                valeur_min: valmin,
                valeur_max: valmax
            },
            dataType : "json",
            success: function (notification) {

                updateNotif(notification);
            }

        });
    });
});


function updateNotif(notifications) {
    var notifMessageVisiteur = $("#bloc_notif .notif_message");
    var notifMessageComptable = $("#bloc_notif2 .notif_message");
    notifMessageVisiteur.css("display", "none");
    notifMessageComptable.css("display", "none");

    notifMessageVisiteur.text( notifications[0].message + "à votre courriel.");
    notifMessageComptable.text(notifications[1].message + "au comptable. ");

    notifMessageVisiteur.css("color", notifications[0].color);
    notifMessageComptable.css("color", notifications[1].color);

    notifMessageVisiteur.fadeIn("slow");
    notifMessageComptable.fadeIn("slow");

}