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
            if($newPassword != "")
                $this->motDePasse = md5("clientLambda".$newPassword."lambada");
                // methode depassé. voir plutot password_hash()
                // https://www.php.net/manual/fr/faq.passwords.php
        }
		
		public static function connexion($email, $motDePasse) : Array {					
			$requete;
			$resultat;
			$retour = false;
			$motDePasseCrypt;
			$pdo = new Database();
		    $requete = $pdo->prepare("SELECT * FROM compteClient WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
		    $resultat = $requete->fetchAll(PDO::FETCH_CLASS, "Client");
		    //Si OK alors Client s'est deja enregistre
		    if (sizeof($resultat)>0) 
			{
				$client=$resultat[0];
				if ($client->verifMotDePasse($motDePasse)){
					return $resultat;
				}
			}
			return [];
		} 
		private function verifMotDePasse (string $motDePasse){
			return true;
		}


		//  on vire variables de session utilisé par la classe
		// public static function deconnexion($varSession){			
		// 	unset($_SESSION[$varSession]); // voir comment virer ttes les vars de session
		// 	if(isset($_SESSION[$varSession]))
		// 		return false;
		// 	else
		// 		return true;
		// }
	}
?>