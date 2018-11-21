<?php

require_once (File::build_path(array('model','Model.php')));

class ModelCours extends Model{


	protected static $object = "cours";
	protected static $primary = "codeCours";


	private $codeCours;
	private $nomCours;
	private $codeMatiere;
	private $acces; //Privé ou public, à définir
	private $file;

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

      $this->codeCours=uniqid();
      $this->nomCours= $data["nomCours"];
      $this->codeMatiere=$data["codeMatiere"];
      $this->acces=$data["acces"];
      $this->file=$data["file"];



    }


  }


  public function upload(){

        
        //Traitement du fichier de correction
        if ($_FILES['fichierCours']['error'] > 0) $error_code = "Erreur lors du transfert du cours";
        $maxsize = 1048576;
        if ($_FILES['fichierCours']['size'] > $maxsize) $error_code = "Le fichier est trop volumineux. Veuillez sélectionner un fichier adapté à la limite imposée";
        
        $extensions_valides = array( 'pdf' , 'docx');
        //strrchr renvoie l'extension avec le point (« . »).
        //substr(chaine,1) ignore le premier caractère de chaine.
        //strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['fichierCours']['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ){
            $name = File::build_path(array('data',"cours/{$this->codeCours}.{$extension_upload}")); //on donne l'id de l'exercice comme nom de fichier
            $resultat = move_uploaded_file($_FILES['fichierCours']['tmp_name'],$name);
        }else{
            $error_code = "L'extension du fichier choisi est incorrecte. Veuillez sélectionner un fichier adapté au format imposé";
        }
        
        return $name;
  }

}  


?>