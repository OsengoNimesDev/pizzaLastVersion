<?php
// En cours de développement 
class Formulaire
{
    public function htmlConnexion()
    {
        echo
        '
        <h1>Formulaire de connexion</h1>
        <form action="verification.php" method="POST">

            <label for="mail"> Email : </label>
            <input type="email" name="mail" placeholder="Entrez votre email" /><br>

            <label for="password">Mot de Passe :</label>
            <input type="password" name="password" /><br>

            <input type="submit" value="Login">

        </form>
        ';
    }

    public function htmlInscription()
    {
    }
}