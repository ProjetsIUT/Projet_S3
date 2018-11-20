<?php
require_once (File::build_path(array('model','ModelQCM.php')));


class ControllerQCM{

 	protected static $object="QCM";

	public static function show_form_new(){

		$view="ajouterQCM";
		$pagetitle="Créer un nouvel exercice - Agora";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function save_qcm(){

		$array=array("codeQCM"=>$_GET["code"], "nomQCM"=>$_GET["nom"], "question"=>$_GET['enonce'], "proposition1"=>$_GET['proposition1', "proposition2"=>$_GET['proposition2'],"proposition3"=>$_GET['proposition3',"proposition4"=>$_GET['proposition4', "propositionCorrecte"=>$_GET['reponse_juste']);
		$new_qcm=new ModelQCM($array);

		$new_qcm->save(); 


	}

	

}

?>
