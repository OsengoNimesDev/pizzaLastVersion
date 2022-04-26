<!-- prevoir la creation d'une table client dont le nom sera 'clients' -->
<!-- voir avec Loïc la création de son formulaire et ce qu'il retourne -->
<?php
	class Client { // voir si OK de faire 1 extends de Database
        // Les propriétés
		private int $id=0;
		private string $email=""; // DEVRA etre UNIQUE correspond à l'ID lors du login
		private string $motDePasse=""; // voir https://www.php.net/manual/fr/faq.passwords.php
		private string $nom="";
		private string $prenom="";
        
		// Les méthodes
        public function getID(){
            return $this->id;
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
		
		// fct constructeur d'1 client
		function Client($idClient){
			$requete;
			$resultat;
			$pdo = connectionBDD();
		    $requete = $pdo->prepare("SELECT * FROM clients WHERE id_client='".$idClient."'");
		    $requete->execute();
		    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
		    //print_r ($resultat);
		    $pdo = null; // pour deconnecter
		    if($resultat == true)
		    {	// voir bindParam pour simplification      
		        $this->id = $resultat['id_client'];
		        $this->email = $resultat['email'];
		        $this->motDePasse = $resultat['mot_de_passe'];
		        $this->nom = $resultat['nom'];		    
		        $this->prenom = $resultat['prenom'];
		    }
		}

		public static function inscription( $email, $motDePasse, $nom, $prenom){
			$retour = true;
			if($email == "" || $motDePasse == ""){
				$retour = false;
			}
			if ($retour)
			{
				// crypter mdp voir password_hash()
				$motDePasseCrypt =  md5("clientLambda".$motDePasse."lambada");
			    $pdo = connectionBDD();
			    $requete = $pdo->prepare("INSERT INTO clients VALUES(0, '".$email."', '".$motDePasseCrypt."', '".$nom."', '".$prenom."',  '0')"); 
			    $retour = $requete->execute();
			   //print_r($requete->errorInfo());    
			}
			return $retour;
		}
		public static function emailDejaUtilise($email){
			    $pdo = connectionBDD();
			    $requete = $pdo->prepare("SELECT id_client FROM clients WHERE email='".$email."'");
			    $requete->execute();
			    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
			    //print_r($resultat);
			    //test si email est déjà pris
			    if($resultat == true)
			    	return true;
			    else
			    	return false;
		}
		public static function connexion($email, $motDePasse, $varSession){					
			$requete;
			$resultat;
			$retour = false;
			$motDePasseCrypt;
			
			$motDePasseCrypt =  md5("clientLambda".$motDePasse."lambada");
		    $pdo = connectionBDD();
		    $requete = $pdo->prepare("SELECT id_client FROM clients WHERE email='".$email."' AND mot_de_passe='".$motDePasseCrypt."'");
		    $requete->execute();
		    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
		    //Si OK alors Client s'est deja enregistre
		    if($resultat == true)
		    {			      
		        $_SESSION[$varSession] = $resultat['id_client']; //voir variable session https://www.php.net/manual/en/book.session.php
		        $retour = true; //On retourne true si OK
		    }
		    else
		    {
		        $retour = false;
		    }
		    $pdo = null;
		    return $retour;
		} 
		//  on vire variables de sessions utilisé par la classe
		public static function deconnexion($varSession){			
			unset($_SESSION[$varSession]);
			if(isset($_SESSION[$varSession]))
				return false;
			else
				return true;
		}
		// Fct qui permet d'enregistrer le Client dans la bdd avec des modifications
		// Retourne false si la sauvegarde à échouée
		public function enregistrerClient(){
		    $pdo = connectionBDD();
		    $requete = $pdo->prepare("UPDATE clients 
				SET email = '".$this->email."',
		    		mot_de_passe = '".$this->motDePasse."', 
		    		nom = '".$this->nom."', 
		    		prenom ='".$this->prenom."', 
		    		WHERE id_client = '".$this->id."'");
		    $retour = $requete->execute();
		    //print_r($requete->errorInfo());			
			return $retour; // prevoir 1 msg en fct du retour de errorInfo voir https://www.php.net/manual/en/pdo.errorinfo.php
		}

	}
?>