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
require '../view/inscription.class.php';


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
        $titre = "Pizzeria de la plage - Formulaire de connexion";
        break;

    case "validationConnexion.html":
        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password=filter_input(INPUT_POST, 'password');
        $client = Client::connexion($email,$password);
        // var_dump($client);
        if($client){
                $ref_cli=$client->getID();
                $nom=$client->getNom();
                $prenom=$client->getPrenom();
                $_SESSION["ref_cli"]=$ref_cli;
                $_SESSION["nom"]=$nom;
                $_SESSION["prenom"]=$prenom;
                header('Location: /index.html');
            //echo "on a trouvé";
        }else{
            unset($_SESSION["ref_cli"]);
            header('Location: /connexion.html');
            // echo "ça n'existe pas ";
        }
        break;

    case "inscription.html": 
        $page = new Inscription();
        $titre = "Pizzeria de la plage - Formulaire d'inscription'";
        break;
    
    case "validationCreation.html":
        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $nom=filter_input(INPUT_POST, 'nom');
        $prenom=filter_input(INPUT_POST, 'prenom');
        $adresse=filter_input(INPUT_POST, 'adresse');
        $telephone=filter_input(INPUT_POST, 'telephone');
        $password=filter_input(INPUT_POST, 'password');
        $repassword=filter_input(INPUT_POST, 'repassword');
        if ($password != $repassword) {
            $_SESSION["error"] = "les deux mots de passe ne sont pas identiques";
            header('Location: /inscription.html');
        }
        else {
            $id = Client::inscription($email, $password, $nom, $prenom, $adresse, $telephone);
            // var_dump($client);
            if($id){
                unset($_SESSION["error"]);
                $_SESSION["ref_cli"]=$id;
                header('Location: /index.html');
                //echo "on a trouvé";
            }else{
                unset($_SESSION["ref_cli"]);
                $_SESSION["error"] = "l'adresse email saisie est déjà utilisée";
                header('Location: /inscription.html');
                // echo "ça n'existe pas ";
            }
        }
        break;

    case "histcommand.html" :
        if ($_SESSION) {
        $histList = Historique::list();
        $page = new Historique($histList);
        $titre = "Pizzeria de la plage - Historique de commande";
        }
        else {header('Location: /index.html'); }
    break;

    // case "photo.html" :
    //     $page = new Photo;
    //     $titre = "Pizzeria de la plage - Photo";
    // break;
case "commande.class.php":
    print_r($_POST);
    break;

    default : 
        header('HTTP/1.1 404 Not Found');
        die();
    break;
}