<?php

require_once (File::build_path(array('model','ModelCours.php')));

class ControllerCours {


	protected static $object = 'cours';

	public static function show_form_new(){

		$view="ajouterCours";
		$pagetitle="Ajouter un nouveau cours - Agora";
		require (File::build_path(array('view', 'view.php')));
		
	}

	public static function upload_cours(){


		$data=array("codeCours"=>uniqid(),"nomCours"=>$_POST['nomCours'],"codeMatiere"=>$_POST['nomMatiere'],"accesCours"=>$_POST['accesCours'],"fichierCours"=>"vide");
		$cours_temporaire = new ModelCours($data);
		$chemin_fichier_cours=$cours_temporaire->upload();
		$cours_temporaire->set("file",$chemin_fichier_cours);
		$data=array("codeCours"=>uniqid(),"nomCours"=>$_POST['nomCours'],"codeMatiere"=>$_POST['nomMatiere'],"accesCours"=>$_POST['accesCours'],"fichierCours"=>$chemin_fichier_cours);
		$cours=new ModelCours($data);
		$cours->save($data);

		$view="uploaded";
		$pagetitle="Votre cours a été enregistré - Agora";
		require(File::build_path(array('view','view.php')));


		
	}




}

?>