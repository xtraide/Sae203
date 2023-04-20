<?php

include "function.php";


/* Si le formulaire est envoyé alors on fait les traitements */
if (1) {
    /* Récupération des valeurs des champs du formulaire */

        $name   = corect("test");
        $mail = corect('xxtraide@gmailcom');
        $sujet    = corect("c moi whesh");
        $message    = corect("c oussie moi");
    

    /* Expression régulière permettant de vérifier si le
    * format d'une adresse e-mail est correct */
    $regex_mail = '/^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$/i';

    /* Expression régulière permettant de vérifier qu'aucun
    * en-tête n'est inséré dans nos champs */
    $regex_head = '/[\n\r]/';

    /* Si le formulaire n'est pas posté de notre site on renvoie
    * vers la page d'accueil */
   /* if ($_SERVER['HTTP_REFERER'] != 'http://www.monsite.com/send_email.php') {
        header('Location: http://www.monsite.com/');
    }*/
    /* On vérifie que tous les champs sont remplis  elseif*/ if (
        empty($name)
        || empty($mail)
        || empty($sujet)
        || empty($message)
    ) {
        $alert = 'Tous les champs doivent être renseignés';
    }
    /* On vérifie que le format de l'e-mail est correct  elseif (!preg_match($regex_mail, $expediteur)) {
        $alert = 'L\'adresse ' . $mail . ' n\'est pas valide';
    }
    /* On vérifie qu'il n'y a aucun header dans les champs */ /*elseif (
        preg_match($regex_head, $mail)
        || preg_match($regex_head, $name)
        || preg_match($regex_head, $sujet)
    ) {
        $alert = 'En-têtes interdites dans les champs du formulaire';
    }*/
    /* Si aucun problème et aucun cookie créé, on construit le message et on envoie l'e-mail */ if (!isset($_COOKIE['sent'])) {
        /* Destinataire (votre adresse e-mail) */
        $to = 'thieblemontnicolas@gmail.com';

        /* Construction du message */
        $msg  = 'Bonjour,' . "\r\n\r\n";
        $msg .= 'Ce mail a été envoyé depuis monsite.com par ' . $name . "\r\n\r\n";
        $msg .= 'Voici le message qui vous est adressé :' . "\r\n";
        $msg .= '***************************' . "\r\n";
        $msg .= $message . "\r\n";
        $msg .= '***************************' . "\r\n";

        /* En-têtes de l'e-mail */
        $headers = 'From: ' . $name . ' <' . $mail . '>' . "\r\n\r\n";

        /* Envoi de l'e-mail */
        if (mail($to, 'Mon Sujet',"ayaya")) {
            $alert = 'E-mail envoyé avec succès';

            /* On créé un cookie de courte durée (ici 120 secondes) pour éviter de
            * renvoyer un mail en rafraichissant la page */
            setcookie("sent", "1", time() + 120);

            /* On détruit la variable $_POST */
            unset($_POST);
        } else {
            
            $alert = 'Erreur d\'envoi de l\'e-mail 74';
        }
    }
    /* Cas où le cookie est créé et que la page est rafraichie, on détruit la variable $_POST */ else {
        unset($_POST);
    }
   
}
echo $alert;
