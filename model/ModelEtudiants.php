<?php


require_once (File::build_path(array('model','Model.php')));

class ModelEtudiants extends Model {


	  protected static $primary = 'loginEtudiant';
  	  protected static $object = 'etudiants';
  	  
  	  private $loginEtudiant;
  	  private $nomEtudiant;
  	  private $prenomEtudiant;
  	  private $mdpEtudiant;
  	  private $emailEtudiant;
  	  private $anneeCourantEtudiant;
  	  private $SemestreCourantEtudiant;
  	  private $codeEtablissement;
  	  private $codeDepartement;


  // Getter générique (pas expliqué en TD)
  public function get($nom_attribut) {
    if (property_exists($this, $nom_attribut))
        return $this->$nom_attribut;
    return false;
  }

  // Setter générique (pas expliqué en TD)
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
	    $this->loginEtudiant= $data["loginEtudiant"];
	    $this->nomEtudiant = $data["nomEtudiant"];
	    $this->prenomEtudiant=$data["prenomEtudiant"];
	    $this->mdpEtudiant=$data["mdpEtudiant"];
	    $this->emailEtudiant=$data["emailEtudiant"];
	    $this->anneeCourantEtudiant=$data["anneeCourantEtudiant"];    
	    $this->SemestreCourantEtudiant=$data["SemestreCourantEtudiant"];
	    $this->codeEtablissement=$data["codeEtablissement"];
	    $this->codeDepartement=$data["codeDepartement"];





	  	}
   }

   public function connect(){ //essayer de lancer une connexion 


		$req=Model::$pdo->prepare("SELECT loginEtudiant, mdpEtudiant, prenomEtudiant FROM agora_etudiants WHERE loginEtudiant=:userName ");
		$req->execute(array('userName'=>$this->loginEtudiant));

		$res=$req->fetch();

		$correct=$this->mdpEtudiant==$res['mdpEtudiant'];
		//$correct=password_verify($password,$res['password']); //une fois le mdp haché

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


	}






}



?>
