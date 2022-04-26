<?php

class Client extends Database
{
    private int $ref_cli = 0;
    private string $nom = "";
    private string $prenom = "";
    private string $adresse = "";
    private string $email = "";
    private string $tel = "";
    private string $pass = "";
    private  $vip = null;

    // public function __construct($ref_cli, $nom, $prenom, $adresse, $email, $tel, $pass, $vip)
    // {
    //     $this->ref_client = $ref_cli;
    //     $this->nom = $nom;
    //     $this->prenom = $prenom;
    //     $this->adresse = $adresse;
    //     $this->email = $email;
    //     $this->tel = $tel;
    //     $this->pass = $pass;
    //     $this->vip = $vip;
    // }


    public function getRef_cli(): int
    {
        return $this->ref_cli;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function getVip()
    {
        return $this->vip;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }


    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setTel(string $tel)
    {
        $this->tel = $tel;
    }

    public function setPass(string $pass)
    {
        $this->pass = $pass;
    }

    public function setVip(string $vip)
    {
        $this->vip = $vip;
    }

    public function saveUser()
    {

        if ($this->ref_cli == 0) {
            $sql = "INSERT INTO com_cli (nom, prenom, adresse, pass, email, tel, vip ) VALUES (:nom,:prenom,:adresse, :email, :tel, :pass, :vip)";
        } else {
            $sql =
                $sql = "UPDATE com_cli SET nom= :nom, prenom = :prenom, adresse = :adresse, email = :email, tel = :tel, pass = :pass, vip = :vip WHERE ref_cli = :ref_cli;";
        }
        $req = $this->prepare($sql);
        $req->bindParam(":nom", $this->nom);
        $req->bindParam(":prenom", $this->prenom);
        $req->bindParam(":adresse", $this->adresse);
        $req->bindParam(":email", $this->email);
        $req->bindParam(":tel", $this->tel);
        $req->bindParam(":pass", $this->pass);
        $req->bindParam(":vip", $this->vip);
        if ($this->ref_cli != 0) {
            $req->bindParam(":ref_cli", $this->ref_cli);
        }
        $req->execute();
    }

    public function connexion()
    {
        session_start([
            'cookie_lifetime' => 24400
        ]);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, 'password');
        if (isset($email) && isset($pass)) {

            $sql = "SELECT * FROM com_cli WHERE email = :email";
            $request = $this->prepare($sql);
            $request->bindParam(":email", $email);
            $request->execute();
            $result = $request->fetchAll(PDO::FETCH_CLASS, 'Client');

            if (sizeof($result) > 0) {
                // print_r($result[0]);
                return true;
            } else return false;
        } else {
            return false;
        }
    }
}