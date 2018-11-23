<?php

class ControllerGeneral{


	protected static $object = "";


	public static function show_error(){

		$view="error";
		$pagetitle="Erreur - Agora";
		$error_code="Aucune action précisée";
		require (File::build_path(array('view', 'view.php')));
	}


}


?>