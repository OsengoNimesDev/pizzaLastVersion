<?php
class Panier{
    public function html(){
        // print_r($_SESSION);
        $panier=[];
        $somme=0;
        if (isset($_SESSION['panier'])) {
            echo '<div class="listCommand">';
            if (isset($_SESSION['ref_cli'])) {echo ' <h1>Le panier de '.$_SESSION["prenom"]." ".$_SESSION["nom"].'</h1>';}
            else {echo ' <h1>Votre panier</h1>';}
            echo '
            <div>
               <div>Nom de la Pizza</div>
               <div>Quantité</div>
               <div>Prix</div>';
                foreach ($_SESSION['panier'] as $cle => $valeur) {
                    $tabcom=explode("_", $cle);
                    // print_r($tabcom);
                    $pizza = Pizza::getById($tabcom[1]);
                    $nomPizza = $pizza->getNom();
                    $taille=$tabcom[2];

                        switch($taille){
                            case "p":
                                $taillePizza = "part";
                                $prixUnitaire = $pizza->getPrixPart();
                                break;

                             case "m":
                                $taillePizza = "petite";
                                $prixUnitaire = $pizza->getPrixPetite();
                                break;

                             case "g":
                                $taillePizza = "grande";
                                $prixUnitaire = $pizza-> getPrixGrande();
                                break;
                        }

                        $prixPizza=$prixUnitaire*$valeur;
                        $prixPizzaFormatee=number_format($prixPizza/100,2);
                        $somme += $prixPizza;

                        echo "
                            <div>$nomPizza</div>
                            <div>$valeur $taillePizza</div>
                            <div>$prixPizzaFormatee €</div>
                            ";
                }

                        $sommeFormatee=number_format($somme/100,2);
                echo "
                            <div class='totalPanier '>Montant total :</div>
                            <div>$sommeFormatee €</div>
                            ";
                echo '</div>';
                if (isset($_SESSION['ref_cli'])) {echo '<br><input type="submit" value="Valider la commande">';}
                else {echo '<br>Vous devez vous inscrire pour valider la commande : <input type="submit" value="S\'inscrire">';}
                echo '</div>';
        }
    }
}