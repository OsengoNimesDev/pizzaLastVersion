<?php
class Panier{
    public function html(){
        print_r($_SESSION);
        $panier=[];
        if (isset($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $cle => $valeur) {
                    $tabcom=explode("_", $cle);
                    print_r($tabcom);
                    print_r(Pizza::getById($tabcom[1]));
                }
        }
    }
}