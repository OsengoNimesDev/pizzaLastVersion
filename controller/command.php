<?php
session_start();

require '../model/db.class.php';
require '../model/pizza.class.php';
require '../model/histcommande.class.php';
require '../model/client.class.php';
require '../view/index.class.php'; 
require '../view/cartes.class.php'; 
require '../view/photo.class.php';
require '../view/historique.class.php';
require '../view/formulaire.class.php';


$url = filter_input(INPUT_GET, "url"); // on récupère ce qu'il y a dans l'url saisie par l'utilisateur

switch($url) {
    case "index.html" :
    case "" :
        $page = new Accueil;
        $titre = "Pizzeria de la plage - Accueil";
    break;

    case "carte.html" :
        $pizzaList = Pizza::list();
        $page = new Carte($pizzaList);
        $titre = "Pizzeria de la plage - Carte";
    break;

    case "connexion.html": 
        $page = new Formulaire();
        break;
        
    case "validationConnexion.html":
        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password=filter_input(INPUT_POST, 'password');
        $client = Client::connexion($email,$password);
        // var_dump($client);
        if( $client){
                $ref_cli= $client->getID();
                $_SESSION["ref_cli"]=$ref_cli;
                header('Location: /index.html');
            //echo "on a trouvé";
        }else{
            unset($_SESSION);
            header('Location: /connexion.html');
            // echo "ça n'existe pas ";
        }

        die();
        break;

    case "photo.html" :
        $page = new Photo;
        $titre = "Pizzeria de la plage - Photo";
    break;

    case "histcommand.html" :
        $histList = Historique::list();
        $page = new Historique($histList);
        $titre = "Pizzeria de la plage - Historique de commande";
    break;

    default : 
        header('HTTP/1.1 404 Not Found');
        die();
    break;
}
