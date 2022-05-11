<?php
class Panier{
    public function __construct() {
       
    }
    public function html(){
        print_r($_SESSION);
        //print_r($_SESSION['panier']);
        $panier=[];
        if(isset($_SESSION['panier'])) {
            foreach($_SESSION['panier'] as $cle => $valeur) {
                $tabcom=explode("_", $cle);
                print_r($tabcom);
            }
           // $panier=explode("_", $_SESSION['panier']);
            
        }
        //print_r($panier);
    }
}