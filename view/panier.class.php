<?php
class Panier{
    public function html(){
        //print_r($_SESSION);
        //print_r($_SESSION['panier']);
        //$panier=[];

       
        if(isset($_SESSION["ref_cli"])) {
            $client = Client::getClient($_SESSION["ref_cli"]);
            $email=$client->getEmail();
            $nomClient=$client->getNom();
            $prenom=$client->getPrenom();
            $adresse=$client->getAdresse(); 
            $tel=$client->getTel();
        }

   
        echo
        "
        <h1>Panier</h1>
        <div class='formulaire'>
        <form action='#' method='POST'>
";
if(isset($_SESSION["ref_cli"])) {
    echo "
            <label for='mail'>Email : </label>
            <span  placeholder='Votre email'>$email</span><br>

            <label for='nom'>Nom : </label>
            <span  placeholder='placeholder='Votre nom'>$nomClient</span><br>

            <label for='prenom'>Prénom : </label>
            <span  placeholder='placeholder='Votre nom'>$prenom</span><br>    
         
            <label for='adresse'>Adresse : </label>
            <span  placeholder='placeholder='Votre nom'>$adresse</span><br>  

            <label for='tel'>Téléphone : </label>
            <span  placeholder='placeholder='Votre nom'>$tel</span><br> 
     ";
}
    if(isset($_SESSION['panier'])) {
          $totalGeneral=0;
          foreach($_SESSION['panier'] as $cle => $valeur) {
              $tabcom=explode("_", $cle);
              $type=$tabcom[0];
              $id=$tabcom[1];
              $taille=$tabcom[2];
              $pizza=Pizza::getById($id);
              echo "<span  placeholder='placeholder='nombre'>$valeur</span> ";
              
              switch($taille) {
                  case 'p':
                    echo "<span  placeholder='placeholder='parts'>parts</span> ";
                      $prixUne=$pizza->getPrixPart();
                      break;
                  case 'g':
                    echo "<span  placeholder='placeholder='grande'>grande</span> ";
 
                      $prixUne=$pizza->getPrixGrande();
                      break;
                  case 'm':
                    echo "<span  placeholder='placeholder='petite'>petite</span> ";
 
                      $prixUne=$pizza->getPrixPetite();
                      break;
              }
              echo "pizza(s) ";
             echo $pizza->getNom();
              
              $total=$prixUne * $valeur;
              $totalGeneral+=$total;
              echo " au prix de $prixUne chacune, ce qui fait une somme de $total <br>";
          }
          echo "Soit un total de $totalGeneral";
      }
    
    echo "<button type='submit' value='S'inscrire'>Valider</button></form></div>";

    }
}