<?php


require_once (File::build_path(array('model','ModelUtilisateurs.php')));
require_once (File::build_path(array('lib','Security.php')));

class ModelEtudiants extends ModelUtilisateurs {


	  protected static $primary = 'loginEtudiant';
  	  protected static $object = 'etudiants';
  	  
  	  private $anneeCourantEtudiant;
  	  private $SemestreCourantEtudiant;
  	  private $codeDepartement;

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

  public function __construct($data = array()) {
	  if (!empty($data)) {
	    // If both $m, $c and $i are not NULL, 
	    // then they must have been supplied
	    // so fall back to constructor with 3 arguments
	    $this->anneeCourantEtudiant= $data["anneeCourantEtudiant"];
	    $this->SemestreCourantEtudiant = $data["SemestreCourantEtudiant"];
	    $this->codeDepartement=$data["codeDepartement"];

	  	}
   }

 /*  public function connect(){ //essayer de lancer une connexion 


		$req=Model::$pdo->prepare("SELECT loginEtudiant, mdpEtudiant, prenomEtudiant FROM agora_etudiants WHERE loginEtudiant=:userName ");
		$req->execute(array('userName'=>$this->loginEtudiant));

		$res=$req->fetch();

		$hash=Security::chiffrer($this->mdpEtudiant);

		$correct=$res['mdpEtudiant']===$hash;

		$prenom=$res['prenomEtudiant'];

		if (!$res){
 
			return -1; //utilisateur non inscrit 	

		}else{

			if($correct){

			   session_start();	

			   $_SESSION["isLogedIn"]=true;
			   $_SESSION["login"]=$res['loginEtudiant'];
			   $_SESSION["prenomUtilisateur"]=$res['prenomEtudiant'];


		       return 1;


			}else{

				return 0; //mauvais mot de passe

			}

		}


	}*/






}



?>
