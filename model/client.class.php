<!-- prevoir la creation d'une table client dont le nom sera 'clients' -->
<!-- voir avec Loïc la création de son formulaire et ce qu'il retourne -->
<?php
	class Client extends Database { // voir si OK de faire 1 extends de Database
        // Les propriétés
		private int $ref_cli=0;
		private string $email=""; // DEVRA etre UNIQUE correspond à l'ID lors du login
		private string $password=""; // voir https://www.php.net/manual/fr/faq.passwords.php
		private string $nom="";
		private string $prenom="";
        private string $adresse="";
        private string $tel="";
        private string $vip="";
        
		// Les méthodes
        public function getID(){
            return $this->ref_cli;
        }
		public function getEmail(){
			return $this->email;
		}
        public function getNom(){
            return $this->nom;
        }
        public function getPrenom(){
            return $this->prenom;
        }
		public function setEmail($newEmail){
			if($newEmail != "")
				$this->email = $newEmail;
		}
        public function setNom($newNom){
            $this->nom = $newNom;
        }
        public function setPrenom($newPrenom){
            $this->prenom = $newPrenom;
        }
        public function setMotDePasse($newPassword){
            $this->password = password_hash($newPassword);
        }
		
		public static function connexion($email, $motDePasse) {					
			$pdo = new Database();
		    $requete = $pdo->prepare("SELECT * FROM com_cli WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
		    // $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Client");
		    // $resultat = $requete->fetchObject("Client");
			return $requete->fetchObject("Client");
		}

		public function majModification($email, $motDePasse) : Array {					
			$requete;
			$resultat;
		    $requete = $this->prepare("SELECT * FROM com_cli WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
		    $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Client");
			$mdp = password_hash($motDePasse);
			$requete->bindParam(":nom", $nom);
			$requete->bindParam(":prenom", $prenom);
			$requete->bindParam(":password", $mdp);
		    if (sizeof($resultat)>0) 
			{
				$requete = $this->prepare("UPDATE com_cli SET nom=:nom, prenom=:prenom, password=:password");
			}
			else {
				$requete = $this->prepare("INSERT INTO com_cli (nom, prenom, password) VALUES (:nom, :prenom, :password)");
			}
			return [];
		}
		private function verifMotDePasse (string $motDePasse){
			return password_verify($motDePasse, $this->motDePasse);
		}
	}
?>