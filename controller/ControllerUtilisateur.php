<?php

class ControllerUtilisateur{

	protected static $object= 'utilisateur';

	public static function show_login_page(){

		$view='login';
		$pagetitle="Connexion - Agora";
		require (File::build_path(array('view', 'view.php')));

	}	

}

?>