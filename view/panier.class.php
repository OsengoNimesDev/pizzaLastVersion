<?php
class Panier{
    public function __construct() {
       
    }
    public function html(){
        // print_r($_SESSION);
        $panier=[];
        if (isset($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $cle => $valeur) {
                    $tabcom=explode("_", $cle);
                    // print_r($tabcom);
                    $pizza =Pizza::getById($tabcom[1]);
                    echo $pizza->getNom();
                    $taille=$tabcom[2];

                        switch($taille){
                             case "p":
                                echo " part ";
                                 $prixUnitaire = $pizza->getPrixPart();
                                break;

                             case "m":
                                    echo " moyen ";
                                    $prixUnitaire = $pizza->getPrixPetite();

                                    break;

                             case "g":
                                        echo " grande ";
                                        $prixUnitaire = $pizza-> getPrixGrande();
                                        break;

                        }
                        echo $prixUnitaire." quantité ".$valeur."<br>";
                }

        }
    }
}