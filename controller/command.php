<?php
session_start();
print_r ($_SESSION);
// $_SESSION['prenom'] = 'Pierre';

require '../model/db.class.php';
require '../model/pizza.class.php';
require '../view/index.class.php';
require '../view/cartes.class.php';
require '../model/client.class.php';
require '../view/formulaire.class.php';


$url = filter_input(INPUT_GET, "url"); // on récupère ce qu'il y a dans l'url saisie par l'utilisateur

switch ($url) {
    case "carte.html":
        $pizzaList = Pizza::list();
        $page = new Carte($pizzaList);
        $titre = "Pizzeria de la plage - Carte";
        break;

    case "connexion.html":

       
        $page = new Formulaire();

        // $form = new Formulaire();
        // $form->htmlConnexion();
        $client = new Client();
        $isConnect = $client->connexion();
        $page = new Formulaire($isConnect);


        break;

    case "formulaire.html":
        $page = new Formulaire(false);



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

    case "index.html":
        $page = new Accueil();
        $titre = "Pizzeria de la plage - Accueil";
        break;

    case "":
        $page = new Accueil();
        $titre = "Pizzeria de la plage - Bienvenue";
        break;

    default:
        header('HTTP/1.1 404 Not Found');
        die();
        break;
}