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

     
      $this->nomCours= $data["nomCours"];
      $this->codeMatiere=$data["codeMatiere"];
      $this->acces=$data["acces"];
      $this->file=$data["file"];



    }


  }


  public function upload(){

    ini_set('upload_tmp_dir','./upload');

    $uploaddir = (File::build_path(array('data')));
    $uploadfile = $uploaddir . '/' . basename($_FILES['fichierCours']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['fichierCours']['tmp_name'], $uploadfile)) {
        echo "Le fichier est valide, et a été téléchargé
               avec succès. Voici plus d'informations :\n";
    } else {
        echo "Attaque potentielle par téléchargement de fichiers.
              Voici plus d'informations :\n";
    }

    echo 'Voici quelques informations de débogage :';
    print_r($_FILES);

    echo '</pre>';


  }

}  


?>