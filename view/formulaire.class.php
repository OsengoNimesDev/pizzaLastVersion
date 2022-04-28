<?php
// En cours de développement 
class Formulaire
{

    private bool $isConnect;

    public function __construct($isConnect)
    {
        $this->isConnect = $isConnect;
    }
    public function html()
    {

        if ($this->isConnect) {
            // echo 'Vous etes connecté';
            header('Location: /index.html');
        } else {
            echo
            '
        <h1>Formulaire de connexion</h1>
        <form action="connexion.html" method="POST">

            <label for="email"> Email : </label>
            <input type="email" name="email" placeholder="Entrez votre email" /><br>

            <label for="password">Mot de Passe :</label>
            <input type="password" name="password" /><br>

            <input type="submit" value="Login">

        </form>
        ';
        }
    }

    public function htmlInscription()
    {
    }
}