<?php
   class Accueil {
      public function html() {
         $password = '@z179W§m';
         $hash = password_hash($password, PASSWORD_DEFAULT);
         var_dump($hash);
       echo ' 
       <h1>Pizzeria de la plage</h1>
       <p class="description">Pizza cuite au feu de bois avec des produits locaux et bio. Vente sur place, à emporter ou en livraison.</p>
       <p>
           <a href="#" class=boutonCommande>Commander maintenant</a>
       </p>
         ';
      }
   }