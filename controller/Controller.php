<?php

class Controller {

	protected static $object = "";

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
	
	public static function errorController() {
		$error_code = 'routeur : controller inexistant !';
		$view = 'error';
	    $pagetitle = 'Erreur';
	    require (File::build_path(array('view', 'error.php')));
	}
}

?>