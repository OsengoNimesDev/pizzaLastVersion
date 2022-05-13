<?php
session_start();

require '../model/db.class.php';
require '../model/pizza.class.php';
require '../model/commande.class.php';
require '../model/client.class.php';
require '../view/index.class.php'; 
require '../view/cartes.class.php'; 
require '../view/photo.class.php';
require '../view/historique.class.php';
require '../view/formulaire.class.php';
require '../view/inscription.class.php';
require '../view/panier.class.php';

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

    case "validationPanier.html":
        $command = new CommandeDB($_SESSION['ref_cli']);
        $somme=0;
        $prix=0;
        foreach ($_SESSION['panier'] as $cle => $valeur) {
            $tabcom=explode("_", $cle);
            $pizza = Pizza::getById($tabcom[1]);
            switch($tabcom[2]){
                case "p":
                    $taille = 0;
                    $prixUnitaire = $pizza->getPrixPart();
                    break;

                 case "m":
                    $taille = 1;
                    $prixUnitaire = $pizza->getPrixPetite();
                    break;

                 case "g":
                    $taille = 2;
                    $prixUnitaire = $pizza-> getPrixGrande();
                    break;
            }
            $prix=$prixUnitaire*$valeur;
            $somme += $prix;
            $command->ajouterLigne ($tabcom[1], $taille, $valeur);
        }
        $command->majPrix($somme);
        header('Location: /index.html');
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
                if (isset($_SESSION['panier'])){
                    header('Location: /panier.html');
                } else {
                    header('Location: /index.html');}
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
        $histList = CommandeDB::list();
        $page = new Historique($histList);
        $titre = "Pizzeria de la plage - Historique de commande";
        }
        else {header('Location: /index.html'); }
    break;

    case "panier.html":
        $page= new Panier();
        break;

    default : 
        header('HTTP/1.1 404 Not Found');
        die();
    break;
}