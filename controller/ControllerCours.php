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

	//	$view="uploaded";
	//	$pagetitle="Votre cours a été enregistré - Agora";
	//	require(File::build_path(array('view','view.php')));

		$data=array("nomCours"=>$_POST['nomCours'],"codeMatiere"=>$_POST['nomMatiere'],"acces"=>$_POST['accesCours'],"file"=>$_FILES["fichierCours"]['name']);

		$nouveau_cours = new ModelCours($data);

		$nouveau_cours->upload();



		
	}
}

?>