<?php

require_once (File::build_path(array('model','ModelExerciceClassique.php')));
require_once (File::build_path(array('controller', 'Controller.php'))); 

Class ControllerExercice extends Controller{
    
    protected static $object = 'Exercice';
    
    public static function choixExercice()
    {
    	$type_e = $_GET['type'];

    

    	$view = "choixExercice";
    	$pagetitle="Choix du type d'exercice - Agora";
        $path_array = array("view", "view.php");
        $PATH = File::build_path($path_array);
        require "$PATH";
    }
}
?>