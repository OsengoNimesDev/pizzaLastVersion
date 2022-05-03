<!-- prevoir la creation d'une table client dont le nom sera 'clients' -->
<!-- voir avec Loïc la création de son formulaire et ce qu'il retourne -->
<?php
	class Client extends Database { // voir si OK de faire 1 extends de Database
        // Les propriétés
		private int $idClient=0;
		private string $email=""; // DEVRA etre UNIQUE correspond à l'ID lors du login
		private string $motDePasse=""; // voir https://www.php.net/manual/fr/faq.passwords.php
		private string $nom="";
		private string $prenom="";
        
		// Les méthodes
        public function getID(){
            return $this->idClient;
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
            $this->motDePasse = password_hash($newPassword);
        }
		
		public static function connexion($email, $motDePasse) {					
			$pdo = new Database();
		    $requete = $pdo->prepare("SELECT * FROM compteClient WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
		    // $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Client");
		    // $resultat = $requete->fetchObject("Client");
			return $requete->fetchObject("Client");
		}

		public function majModification($email, $motDePasse) : Array {					
			$requete;
			$resultat;
		    $requete = $this->prepare("SELECT * FROM compteClient WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
		    $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Client");
			$mdp = password_hash($motDePasse);
			$requete->bindParam(":nom", $nom);
			$requete->bindParam(":prenom", $prenom);
			$requete->bindParam(":motDePasse", $mdp);
		    if (sizeof($resultat)>0) 
			{
				$requete = $this->prepare("UPDATE compteClient SET nom=:nom, prenom=:prenom, motDePasse=:motDePasse");
			}
			else {
				$requete = $this->prepare("INSERT INTO compteClient (nom, prenom, motDePasse) VALUES (:nom, :prenom, :motDePasse)");
			}
			return [];
		}
		private function verifMotDePasse (string $motDePasse){
			return password_verify($motDePasse, $this->motDePasse);
		}
	}
?>