<?php
const OK_NOTIF = "Nous avons envoyé votre demande.";
const KO_NOTIF = "Erreur: Votre mail n'a pas été envoyé.";
$adresse_mail_de_reception = 'msilvagu@gmail.com'.','.'maria_nit_s@hotmail.com';
$metier = $_POST['user_metier'];
$gender = $_POST['use_gender'];
$from = $_POST['user_name'];
$mail_client=$_POST['user_mail'];
$telephone = $_POST['user_telephone'];
$message = $_POST['user_message'];

sendContact($gender,$adresse_mail_de_reception, "Nouveau contact", $metier, $from, $mail_client, $telephone, $message);

function sendContact($gender, $adresse_mail_de_reception, $sujet, $metier, $sender, $adresse_client, $telf, $message)
{
    ini_set("smtp_port", 25);
    ini_set("sendmail_from", "devis_expertcomptable@webgroup.com");
    ini_set("auth_username", "devis_expertcomptable@webgroup.com");
    ini_set("auth_password", "mdp");
    ini_set("SMTP", "smtp.orange.fr");
    $profils = array(
        'administrateur' => "msilvagu@gmail.com",
        'expert-comptable' => "maria_nit_s@hotmail.com"
    );
    foreach ($profils as $profil => $adresse) {
        ob_start();
        $message_final = generateMessage($gender, $metier, $sender, $adresse_client, $telf,$message, $profil);
        $mail_ok = mail($adresse, $sujet, $message_final);
        $mail_status = array(
            "statut" => "",
            "message" => "",
            "color" => ""
        );
        $mail_status = build_notification($mail_ok);
        ob_end_clean();
    }       
        #$mail_status = build_notification($mail_ok);
        $mail_statuses[] = $mail_status; 
    
    echo json_encode($mail_status); exit();
}

/**
 * @param $mail_ok
 * @param $mail_status
 * @return mixed
 */
function build_notification($mail_ok)
{
    if ($mail_ok && $mail_ok == TRUE) {
        $mail_status["message"] = OK_NOTIF;
        $mail_status["color"] = "green";
    } else {
        $mail_status["message"] = KO_NOTIF;
        $mail_status["color"] = "red";
    }

    return $mail_status;
}

function generateMessage($gender, $metier, $sender, $adresse_client, $telf, $message_user, $profil)
{   
    
    /*$str = "Message envoyé par : " . $sender . "\n" . $raw_message;
    return $str;*/
    $message = file_get_contents("contact/templates/" . $profil .".html");
    $message = str_replace("{metier}", $metier, $message);
    $message = str_replace("{civilite}", $gender, $message);
    $message = str_replace("{name}", $sender, $message);
    $message = str_replace("{email}", $adresse_client, $message);
    $message = str_replace("{telephone}", $telf, $message);
    $message = str_replace("{message}", $message_user, $message);
    
 

    return $message;
}
