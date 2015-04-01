
$(document).ready(function() {
        "use strict";
       

        $(".btn-inscription").click (function ()   {
            
            $("#step-3").css("display", "inline-block");
            $("#step-1").css("display", "none");
            $("#step-2").css("display", "none");
        });



    $(".btn-envoyer").click(function (event)   {
        event.preventDefault();
        var usemetier = $("#metier").val();
        var useGender =  $('input:radio[name=gender3]:checked').val();
        var useName = $("#name3").val();
        var useMail = $("#email3").val();
        var useTelephone = $("#telephone3").val();
        var useMessage = $("#mail-message").val();
        event.preventDefault();

        $.ajax("contact_inscription.php", {
            type: "POST",
            data: {
                user_metier: usemetier,
                use_gender: useGender,
                user_name: useName,
                user_mail: useMail,
                user_telephone: useTelephone,
                user_message: useMessage 
            },
            dataType : "json",
            success: function (notification) {

                updateNotifInscription(notification);
            }
        })
    });

})

    function updateNotifInscription(notification) {
        console.log(notification);
        var notifMessage = $("#bloc_notif3 .notif_message");
        notifMessage.text(notification.message);
        notifMessage.css("color", notification.color);
    }

 
