<?php
    class CommandeDB extends Database {
        private int $num_com=0;
        private string $dateCom="";
        private int $montant=0;
        private string $moy_pai="Au camion";
        private int $ref_cli=0;

        public function __construct($ref_cli=0) {
            $this->ref_cli = $ref_cli;
            $date = new DateTime();
            $this->dateCom = $date->format('Y-m-d');
            $requete = $pdo->prepare ("INSERT INTO commandespaiements (dateCom, date_trans, montant, moy_pai) VALUES (:dateCom, :dateCom, :montant, :moy_pai);");
            $requete->bindParam(":dateCom", $dateCom);
			$requete->bindParam(":date_trans", $dateCom);
			$requete->bindParam(":montant", $montant);
			$requete->bindParam(":moy_pai", $moy_pai);
			$requete->execute();
			$this->ref_cli = $this->lastInsertId();
			}

        public function ajoutLigne ($id, $taille, $quantite) {
            $requete = $pdo->prepare ("INSERT INTO ligne_commande (id, num_com, taille, quantite) VALUES (:id, :num_com, :taille, :quantite);");
            $requete->bindParam(":id", $id);
            $requete->bindParam(":num_com", $this->num_com);
			$requete->bindParam(":taille", $taille);
			$requete->bindParam(":quantite", $quantite);
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
