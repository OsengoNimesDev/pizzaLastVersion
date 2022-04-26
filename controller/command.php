<?php

require '../model/db.class.php';
require '../model/pizza.class.php';
require '../model/histcommande.class.php';
require '../view/index.class.php'; 
require '../view/cartes.class.php'; 
require '../view/photo.class.php';
require '../view/historique.class.php';


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

    case "photo.html" :
        $page = new Photo;
        $titre = "Pizzeria de la plage - Photo";
    break;

    case "histcommand.html" :
        $histList = HistCommande::list();
        $page = new Historique($histList);
        $titre = "Pizzeria de la plage - Historique de commande";
    break;

    default : 
        header('HTTP/1.1 404 Not Found');
        die();
    break;
}

if (isset($_FILES['photo']['tmp_name'])) {  
    $taille = getimagesize($_FILES['photo']['tmp_name']); // met la largeur et la longueur dans un array lol
    $largeur = $taille[0];
    $hauteur = $taille[1];
    $extension = exif_imagetype($_FILES['photo']['tmp_name']);
    $largeur_miniature = 300;
    $hauteur_miniature = $hauteur / $largeur * $largeur_miniature; // Une petite règle de trois pour retailler la largeur de l'image à 300 pixels avec une hauteur proportionnelle
    $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']); // Stocke toute la photo dans la variable $im
    $im_miniature = imagecreatetruecolor($largeur_miniature, $hauteur_miniature); // Prépare une image tampon noire en 24 bits d'une largeur de 300 pixels avec une hauteur proportionnelle à la photo d'origine.
    imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);
    imagejpeg($im_miniature, './img/upload/miniatures/'.$_FILES['photo']['name'], 90);
    echo $extension;
}
?>
