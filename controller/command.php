<?php

require '../model/db.class.php';
require '../model/pizza.class.php';
require '../view/index.class.php'; 
require '../view/cartes.class.php'; 


$url = filter_input(INPUT_GET, "url"); // on récupère ce qu'il y a dans l'url saisie par l'utilisateur

switch($url) {
    case "carte.html" :
        $pizzaList = Pizza::list();
        $page = new Carte($pizzaList);
        $titre = "Pizzeria de la plage - Carte";
        break;

    case "index.html" :
        $page = new Accueil();
        $titre = "Pizzeria de la plage - Accueil";
    break;
    
    case "":
        $page= new Accueil();
        $titre="Pizzeria de la plage - Accueil";
    break;

    default : 
        header('HTTP/1.1 404 Not Found');
        die();
    break;
}