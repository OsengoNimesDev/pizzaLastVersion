<?php

class Inscription {
    
    public function html()
    {
        $error = "";
        if (isset ($_SESSION["error"])) {
                $error = "<span class='msgerror'>";
                $error .= $_SESSION["error"];
                $error .= "</span><br>";
            }
        
        echo
        "
        <h1>Formulaire d'inscription</h1>
        <div class='formulaire'>
        <form action='validationCreation.html' method='POST'>

            <label for='mail'>Email : </label>
            <input type='email' name='email' placeholder='Entrez votre email' /><br>
            $error

            <label for='nom'>Nom : </label>
            <input type='text' name='nom' placeholder='Entrez votre nom' /><br>

            <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' placeholder='Entrez votre prénom' /><br>

            <label for='adresse'>Adresse : </label>
            <input type='text' name='adresse' placeholder='Entrez votre adresse' /><br>

            <label for='tel'>Téléphone : </label>
            <input type='text' name='telephone' placeholder='Entrez votre numéro de téléphone' /><br>

            <label for='password'>Mot de Passe : </label>
            <input type='password' name='password' placeholder='Entrez votre mot de passe' /><br>

            <label for='password'>Mot de Passe : </label>
            <input type='password' name='repassword' placeholder='Confirmez votre mot de passe' /><br>

            <input type='submit' value=\"S'inscrire\">
            <a href='http:connexion.html' > connexion </a>

        </form>
        
        </div>
        "; 
    }
}