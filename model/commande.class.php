<?php
    class CommandeDB extends Database {
        private int $num_com=0;
        private string $dateCom="";
        private int $montant=0;
        private string $moy_pai="Au camion";
        private int $ref_cli;

        public function __construct($ref_cli=0, $somme=0) {
            $this->ref_cli = $ref_cli;
            $date = new DateTime();
            $this->dateCom = $date->format('Y-m-d');

            parent::__construct();
            $requete = $this->prepare ("INSERT INTO commandespaiements (dateCom, date_trans, montant, moy_pai, ref_cli) VALUES (:dateCom, :date_trans, :montant, :moy_pai, :ref_cli);");
            $requete->bindParam(":dateCom", $this->dateCom);
			$requete->bindParam(":date_trans", $this->dateCom);
			$requete->bindParam(":montant", $somme);
			$requete->bindValue(":moy_pai", "Au camion");
            $requete->bindParam(":ref_cli", $ref_cli);
			$requete->execute();
			$this->num_com = $this->lastInsertId();
			}

        public function ajouterLigne ($id, $taille, $quantite) {
            $requete = $this->prepare ("INSERT INTO ligne_commande (id, num_com, taille, quantite) VALUES (:id, :num_com, :taille, :quantite);");
            $requete->bindParam(":id", $id);
            $requete->bindParam(":num_com", $this->num_com);
			$requete->bindParam(":taille", $taille);
			$requete->bindParam(":quantite", $quantite);
            $requete->execute();
        }

        public function majPrix($prix) {
            $requete = $this->prepare ("UPDATE commandespaiements SET montant=:montant WHERE num_com=:num_com;");
            $requete->bindParam(":montant", $prix);
            $requete->bindParam(":num_com", $this->num_com);
            $requete->execute();
        }

        public function getNum_Com() : int {
            return $this->num_com; 
        }

        public function getDateCom() : string {
            $timestamp = strtotime($this->dateCom);
            $this->dateCom = date("d-m-Y", $timestamp);
            return $this->dateCom; 
        }

        public function getMontant() : int {
            return $this->montant; 
        }

        public function getMoy_pai() : string {
            return $this->moy_pai; 
        }
 
        public static function list() : Array {
            $dbh = new Database();
            $sql = "SELECT num_com, dateCom, montant, moy_pai FROM commandespaiements INNER JOIN com_cli on com_cli.ref_cli = commandespaiements.ref_cli WHERE commandespaiements.ref_cli = $_SESSION[ref_cli] ORDER BY dateCom desc";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $list = $sth->fetchAll(PDO::FETCH_CLASS, "CommandeDB");
            return $list;
        }
    }
