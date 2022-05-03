<?php
// En cours de développement 
class Formulaire
{

    private bool $isConnect;

   
    public function html()
    {
        if (isset($_SESSION['id'])){

            header('Location: /index.html');
            // echo 'Vous etes connecté';

        } else {
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
        </form></div>

        '; 
        }
    }
}