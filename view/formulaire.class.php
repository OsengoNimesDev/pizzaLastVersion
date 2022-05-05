<?php
// En cours de développement 
class Formulaire {

    public function html()
    {
        echo
            '
        <h1>Formulaire de connexion</h1>
        <div class="formulaire">
        <form action="validationConnexion.html" method="POST">
            <label for="email"> Email : </label>
            <input type="email" name="email" placeholder="Entrez votre email" /><br>
            <label for="password">Mot de Passe :</label>
            <input type="password" name="password" /><br>
            <input id="submit" type="submit" value="Login">
            <a href="http:inscription.html" > Inscription </a>
        </form></div>
        '; 
    }

    public function htmlInscription()
    {
        echo
        "
        <h1>Formulaire d'inscription</h1>
        <form action='verification.php' method='POST'>

            <label for='mail'>Email : </label>
            <input type='email' name='mail' placeholder='Entrez votre email' /><br>

            <label for='nom'>Nom : </label>
            <input type='text' name='nom' placeholder='Entrez votre nom' /><br>

            <label for='prenom'>Prénom : </label>
            <input type='text' name='prenom' placeholder='Entrez votre prénom' /><br>

            <label for='adresse'>Adresse : </label>
            <input type='text' name='adresse' placeholder='Entrez votre adresse' /><br>

            <label for='tel'>Téléphone : </label>
            <input type='text' name='tel' placeholder='Entrez votre numéro de téléphone' /><br>

            <label for='password'>Mot de Passe : </label>
            <input type='text' name='password' placeholder='Entrez votre mot de passe' /><br>

            <label for='password'>Mot de Passe : </label>
            <input type='text' name='password' placeholder='Confirmez votre mot de passe' /><br>

            <button type='submit' value='S'inscrire'></button>
    


        </form>
        ";
    }
}