<?php
   class Carte {
      private Array $liste;
      public function __construct(Array $liste) {
         $this->liste = $liste;
      }

      public function html() {
        echo ' 
             <h1>Carte des pizzas</h1>
                <div class="carte">';
          foreach($this->liste as $pizza) {
             
             echo '
                 <div class="pizzacarte">
                 <div class="imgpizzacarte"><img src="./img/pizza_'.$pizza->getId().'.jpg" /></div>					
                 <h2>'.$pizza->getNom().'</h2>
                 <p>'.$pizza->getDescription().'</p>
                 <div class="prix">
                 <div class="tarifs">
                 ';
                 
                 if($pizza->getPrixPart() !== -1) {
                    echo
                     '   
                     <div>La Part = '.number_format($pizza->getPrixPart()/100,2).'€ </div><div>
                     <input type="number" placeholder="Quantité" min="1" max="8" id="qp_'.$pizza->getId().'_p"/>
                     <button class="btn" title="ajoutez au panier" onclick="ajoutPanier(\'qp_'.$pizza->getId().'_p\')"><i class="fas fa-shopping-basket"></i>
                     </button>
                     </div>
                     ';
                     }

                     if($pizza->getPrixPetite() !==-1){

                     
                     echo
                     '   <div>Moyenne = '.number_format($pizza->getPrixPetite()/100,2).'€ </div
                         ><div><input type="number" placeholder="Quantité" min="1" max="8" id="qp_'.$pizza->getId().'_m"/>
                         <button class="btn" title="ajoutez au panier" onclick="ajoutPanier(\'qp_'.$pizza->getId().'_m\')"><i class="fas fa-shopping-basket">
                         </i></button></div>
                     ';
                     }

                     if($pizza->getPrixGrande() !==-1){

                        echo'
                            <div>Grande = '.number_format($pizza->getPrixGrande()/100,2).'€ </div>
                            <div><input type="number" placeholder="Quantité" min="1" max="8" id="qp_'.$pizza->getId().'_g"/>
                            <button class="btn" title="ajoutez au panier" onclick="ajoutPanier(\'qp_'.$pizza->getId().'_g\')"><i class="fas fa-shopping-basket">
                            </i></button></div>
                        </div>
                    </div>
                </div>
                ';
                     }
          
            }

          echo '
          </div>
          ';
    }
   }