<?php
   class Historique {
      private Array $liste;
      public function __construct(Array $liste) {
         $this->liste = $liste;
      }

      public function html() {
         echo '<div class="histCommand">';
      //    echo '<pre>' , var_dump($this->liste) , '</pre>';
      //   echo ' <h1>test hist'.$this->nom.'</h1>';
          foreach($this->liste as $commande) {
             echo '
                <!--<p>Historique des commandes de '.$commande->getPrenom().' '.$commande->getNom().'</p-->
               <div>
               <div>Numéro de commande : '.$commande->getNum_Com().'</div>
               <div>Date de la commande : '.$commande->getDateCom().'</div>
               <div>Moyen de paiement : '.$commande->getMoy_pai().'</div>
               <div>Montant : '.number_format($commande->getMontant()/100,2).'€</div>
               </div>
             ';
          }
          echo '</div>';
    }
   }