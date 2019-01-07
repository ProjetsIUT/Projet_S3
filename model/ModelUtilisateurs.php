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


    public function __construct($data = array()) {
	  if (!empty($data)) {
	    // If both $m, $c and $i are not NULL, 
	    // then they must have been supplied
	    // so fall back to constructor with 3 arguments
	    $this->loginUtilisateur= $data["loginUtilisateur"];
	    $this->mdpUtilisateur = $data["mdpUtilisateur"];
	    $this->prenomUtilisateur=$data["prenomUtilisateur"];
	    $this->nomUtilisateur=$data["nomUtilisateur"];
	    $this->emailUtilisateur=$data["emailUtilisateur"];
	    $this->codeEtablissement=$data["codeEtablissement"];    

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
        if ($mot_de_passe_chiffre === $u->get('mdpUtilisateur')) {
            return true;
        }
        
        return false;
    }
	  /*
    public function connect(){ //essayer de lancer une connexion 


		$req=Model::$pdo->prepare("SELECT loginUtilisateur, mdpUtilisateur, typeUtilisateur FROM agora_utilisateurs WHERE loginUtilisateur=:userName ");
		$req->execute(array('userName'=>$this->loginUtilisateur));

		$res=$req->fetch();

		$hash=Security::chiffrer($this->mdpUtilisateur);

		$correct=$res['mdpUtilisateur']===$hash;

		//$prenom=$res['prenomEtudiant'];

		if (!$res){
 
			return -1; //utilisateur non inscrit 	

		}else{

			if($correct){

			   session_start();	

			   $_SESSION["isLogedIn"]=true;
			   $_SESSION["login"]=$res['loginUtilisateur'];
			   $_SESSION["typeCompte"]=$res['typeUtilisateur'];


		       return 1;


			}else{

				return 0; //mauvais mot de passe

			}

		}


	}

	*/

}






?>
