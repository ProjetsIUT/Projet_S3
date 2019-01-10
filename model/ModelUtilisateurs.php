<?php

require_once (File::build_path(array('model','Model.php')));

class ModelUtilisateurs extends Model {

	  protected static $primary = 'loginUtilisateur';
  	  protected static $object = 'utilisateurs';

  	  private $loginUtilisateur;
  	  private $mdpUtilisateur;
  	  private $typeUtilisateur;
  	  private $nomUtilisateur;
  	  private $prenomUtilisateur;
  	  private $emailUtilisateur;
	  private $codeEtablissement;
	  private $nonce;

    public function __construct($data = array()) {
	  if (!empty($data)) {
	    // If both $m, $c and $i are not NULL, 
	    // then they must have been supplied
		// so fall back to constructor with 3 arguments
		if(isset($data["loginUtilisateur"])) {
			$this->loginUtilisateur= $data["loginUtilisateur"];
		}

		if(isset($data["prenomUtilisateur"];)) {
			$this->prenomUtilisateur=$data["prenomUtilisateur"];
		}

		if(isset($data["nomUtilisateur"];)) {
			$this->nomUtilisateur=$data["nomUtilisateur"];
		}

		if(isset($data["mdpUtilisateur"];)) {
			$this->mdpUtilisateur=$data["mdpUtilisateur"];
		}

		if(isset($data["emailUtilisateur"];)) {
			$this->emailUtilisateur=$data["emailUtilisateur"];
		}

		if(isset($data["codeEtablissement"];)) {
			$this->codeEtablissement=$data["codeEtablissement"];
		}
		
		if(isset($data["nonce"];)) {
			$this->nonce=$data["nonce"];
		}
	  	}
   	}

	public function get($nom_attribut) {
	    if (property_exists($this, $nom_attribut))
	        return $this->$nom_attribut;
	    return false;
	}


	public function set($nom_attribut, $valeur) {
	    if (property_exists($this, $nom_attribut))
	        $this->$nom_attribut = $valeur;
	    return false;
	}

	public static function checkPassword($loginUtilisateur, $mot_de_passe_chiffre) { 
        $u = static::select($loginUtilisateur);
        if($u) {
            if ($mot_de_passe_chiffre === $u->get('mdpUtilisateur')) {
                return true;
            }
        }
        else {
            return false;
        }
        return false;
	}
	
	public static function getUserByEmail($email) {
		$sql = 'SELECT * FROM agora_utilisateurs WHERE emailUtilisateur=:emailll;';
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"emailll" => $email,
		);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateurs');
		$tab_user = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_user)) {
			return false;
		}
		return $tab_user[0];
	}
	 
}


?>
