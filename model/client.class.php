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
		
		/*
			Tentative de connexion à la base de données,
			depuis l'adresse email, avec contrôle du mot de passe
		*/
		public static function connexion($email, $motDePasse) {					
			$pdo = new Database();
		    $requete = $pdo->prepare("SELECT * FROM com_cli WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
			$client = $requete->fetchObject("Client");
			if ($client) {
				if (!$client->verifMotDePasse($motDePasse)) {
					return false;
				}
			}
			return $client;
		}

		/*
			Tentative d'inscription d'un nouveau client à la base de données
			Un échec sera détecté si l'adresse email existe déjà
		*/
		public static function inscription($email, $motDePasse, $nom, $prenom, $adresse, $tel) {
			$password = password_hash($motDePasse, PASSWORD_DEFAULT);					
			$pdo = new Database();
		    $requete = $pdo->prepare("INSERT INTO com_cli (nom, prenom, adresse, email, password, tel) VALUES (:nom, :prenom, :adresse, :email, :password, :tel)");
			$requete->bindParam(":nom", $nom);
			$requete->bindParam(":prenom", $prenom);
			$requete->bindParam(":adresse", $adresse);
			$requete->bindParam(":password", $password);
			$requete->bindParam(":tel", $tel);
			$requete->bindParam(":email", $email);
			try {
				$requete->execute();
				return $pdo->lastInsertId();
			} catch (Exception $e) {
				return false;
			}
		}

		/*
			Modification de l'identification par email et mot de passe
			pour le client.
			Si l'adresse email n'existe pas, un nouveau client est créé 
			mais avec la majeure partie des champs vides
		*/
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
		/*
			Contrôle du mot de passe saisi par comparaison avec celui 
			qui se trouve encrypté en hash dans la base de données 
		*/
		private function verifMotDePasse (string $motDePasse){
			return password_verify($motDePasse, $this->password);
		}

		/*
			Récupération du client depuis son ID
		*/
		public static function getById (int $id)
		{
			$dbh= new Database();
			$sql = "select * from com_cli where ref_cli=:id";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(":id", $id);
			$sth->execute();
			$pizza= $sth->fetchObject("Client");
			return $pizza;
		}

	}
