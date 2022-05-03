<?php
    class HistCommande extends Database {
        private int $num_com=0;
        private string $dateCom="";
        private int $montant=0;
        private string $moy_pai="";
        private string $nom="";
        private string $prenom="";

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

        public function getNom() : string {
            return $this->nom; 
        }

        public function getPrenom() : string {
            return $this->prenom; 
        }
 
        public static function list() : Array {
            $dbh = new Database();
            $sql = "SELECT num_com, dateCom, montant, moy_pai, nom, prenom FROM commandespaiements INNER JOIN com_cli on com_cli.ref_cli = commandespaiements.ref_cli WHERE commandespaiements.ref_cli = $_SESSION[ref_cli] ORDER BY dateCom desc";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $list = $sth->fetchAll(PDO::FETCH_CLASS, "HistCommande");
            return $list;
        }
    }