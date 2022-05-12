<?php
    class HistCommande extends Database {
        private int $num_com=0;
        private string $dateCom="";
        private int $montant=0;
        private string $moy_pai="";

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

        public function getElements() {
            $sql = "select lc.*, pizza.*  from commandespaiements
                    inner join com_cli on commandespaiements.ref_cli = com_cli.ref_cli
                    inner join ligne_commande on ligne_commande.num_com=cp.num_com
                    inner join pizza on pizza.id = lc.id
                    where cp.num_com=:num_com";
            $sth = $this->prepare($sql);
            $sth->execute();
            $sth->bindParam(":num_com", $this->num_com);
            $list = $sth->fetchAll(PDO::FETCH_CLASS);
            return $list;
        }
 
        public static function list() : Array {
            $dbh = new Database();
            $sql = "SELECT num_com, dateCom, montant, moy_pai FROM commandespaiements INNER JOIN com_cli on com_cli.ref_cli = commandespaiements.ref_cli WHERE commandespaiements.ref_cli = $_SESSION[ref_cli] ORDER BY dateCom desc";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $list = $sth->fetchAll(PDO::FETCH_CLASS, "HistCommande");
            return $list;
        }
    }
