<?php

class User extends Database
{
    private int $ref_cli = 0;
    private string $nom = "";
    private string $prenom = "";
    private string $adresse = "";
    private string $email = "";
    private string $tel = "";
    private string $pass = "";
    private  $vip = null;

    public function __construct($ref_cli, $nom, $prenom, $adresse, $email, $tel, $pass, $vip)
    {
        $this->ref_client = $ref_cli;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->tel = $tel;
        $this->pass = $pass;
        $this->vip = $vip;
    }


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
}