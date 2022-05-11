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

            <label for='mail'>Email : </label>
            <input type='email' name='mail' placeholder='Entrez votre email' value='$email' /><br>

            <label for='nom'>Nom : </label>
            <input type='text' name='nom' placeholder='Entrez votre nom' value='$nomClient'/><br>

            <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' placeholder='Entrez votre prénom' value='$prenom' /><br>

            <label for='adresse'>Adresse : </label>
            <input type='text' name='adresse' placeholder='Entrez votre adresse' value='$adresse' /><br>

            <label for='tel'>Téléphone : </label>
            <input type='text' name='tel' placeholder='Entrez votre numéro de téléphone' value='$tel'  /><br>
    ";

    if(isset($_SESSION['panier'])) {
          $totalGeneral=0;
          foreach($_SESSION['panier'] as $cle => $valeur) {
              $tabcom=explode("_", $cle);
              $type=$tabcom[0];
              $id=$tabcom[1];
              $taille=$tabcom[2];
              $pizza=Pizza::getById($id);
              echo $valeur . " ";
              
              switch($taille) {
                  case 'p':
                      echo "part(s) ";
                      $prixUne=$pizza->getPrixPart();
                      break;
                  case 'g':
                      echo "grande(s) ";
                      $prixUne=$pizza->getPrixGrande();
                      break;
                  case 'm':
                      echo "petite(s) ";
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