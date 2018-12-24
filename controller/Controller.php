<?php

class Controller{

	protected static $object = "";

	public static function show_error(){
		$view="error";
		$pagetitle="Erreur - Agora";
		$error_code="Aucune action précisée";
		require (File::build_path(array('view', 'view.php')));
	}

	public static function errorAction() {
		$error_code = 'routeur : action inexistante !';
		$view = 'error';
		$pagetitle = 'Erreur';
		require (File::build_path(array('view', 'error.php')));
	}
	
	public static function errorClass() {
        $error_code = 'routeur : class demandé inexistante !';
	    $view = 'error';
	    $pagetitle = 'Erreur';
	    require (File::build_path(array('view', 'error.php')));
    }
}

?>