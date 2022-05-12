<?php
   class Historique {
      private Array $liste;
      public function __construct(Array $liste) {
         $this->liste = $liste;
      }

      public function html() {

         
         echo '<div class="histCommand">';
      echo ' <h1>Historique des commandes de '.$_SESSION["prenom"]." ".$_SESSION["nom"].'</h1>
            <div>
               <div>Numéro de commande</div>
               <div>Date de la commande</div>
               <div>Moyen de paiement</div>
               <div>Montant</div>';
          foreach($this->liste as $commande) {
             echo '
               <div>'.$commande->getNum_Com().'</div>
               <div>'.$commande->getDateCom().'</div>
               <div>'.$commande->getMoy_pai().'</div>
               <div>'.number_format($commande->getMontant()/100,2).'€</div>
               
             ';
          }
          echo '</div></div>';
    }
}