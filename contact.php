<?php
const OK_NOTIF = "Le devis a été envoyé ";
const KO_NOTIF = "Le message n'a pas été envoyé ";

$adresse_mail_de_reception = 'msilvagu@gmail.com'.','.'maria_silvagutierrez@yahoo.com'; /*rudy@web-group.fr*/

$from = $_POST["name"];
$mail = $_POST['email'];
$donnees= array(
    'gender' =>$_POST['use_Gender'],
    'telephone' =>$_POST['use_Telephone'],
    'val-min' =>$_POST['valeur_min'],
    'val-max' =>$_POST['valeur_max'],
    'nb-factures-achat' =>$_POST['nb_Achat'],
    'nb-factures-vente' =>$_POST['nb_Vente'],
    'nb-salaries' =>$_POST['nb_Salaries'] ,
    'mail' => $mail

    ); 
//fonction Envoyer mail
sendMail($adresse_mail_de_reception, "Votre devis expert comptable Paris", $mail, $from, $donnees);

function sendMail($adresse_mail_de_reception, $sujet, $mail_status, $envoyeur, $data)
{
    ini_set("smtp_port", 25);
    ini_set("sendmail_from", "devis_expertcomptable@webgroup.com");
    ini_set("auth_username", "devis_expertcomptable@webgroup.com");
    ini_set("auth_password", "mdp");
    ini_set("SMTP", "smtp.orange.fr");
    $profils = array(
        'visiteur' => $data['mail'],
        'comptable' => $adresse_mail_de_reception
    );
    $mail_statuses = array();
    foreach ($profils  as $profil => $adresse) {
        ob_start();
        $message_final = generateMessage($profil, $data);
        $mail_ok = mail($adresse, $sujet, $message_final);
        $mail_status = array(
            "statut" => "",
            "message" => "",
            "color" => ""
        );

        $mail_status = build_notification($mail_ok);
        $mail_statuses[] = $mail_status;
        ob_end_clean();
            
    }
        echo json_encode($mail_statuses); 
    exit();
}


/**
 * @param $mail_ok
 * @param $mail_status
 * @return mixed
 */
function build_notification($mail_ok)
{
    if ($mail_ok && $mail_ok == TRUE){
        $mail_status["message"] = OK_NOTIF;
        $mail_status["color"] = "green";
        
    } else {
        $mail_status["message"] = KO_NOTIF;
        $mail_status["color"] = "red";
        
    }

    return $mail_status;
}



function generateMessage($profil, $data)
{
    //Récupération de variables
    $civilite = $data['gender'];
    $telf = $data['telephone'];
    $factures_achat = $data['nb-factures-achat'];
    $factures_vente = $data['nb-factures-vente'];
    $val_min = $data['val-min'];
    $val_max = $data['val-max'];
    $nb_salaries = $data['nb-salaries'];
    

    //Génération du message

    $message = file_get_contents("mail/templates/".$profil . ".html");
    $message = str_replace("{civilite}", $civilite, $message);
    $message = str_replace("{name}", $_POST["name"], $message);
    $message = str_replace("{email}", $_POST["email"], $message);
    $message = str_replace("{telephone}", $telf, $message);
    $message = str_replace("{valeur-min}", $val_min, $message);
    $message = str_replace("{valeur-max}", $val_max, $message);
    $message = str_replace("{nb-factures-achat}",  $factures_achat , $message);
    $message = str_replace("{nb-factures-vente}",  $factures_vente , $message);
    $message = str_replace("{nb-salaries}",   $nb_salaries , $message);
 

    return $message;
}


