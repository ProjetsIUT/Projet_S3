<?php

require_once (File::build_path(array('model','ModelExerciceClassique.php')));

Class ControllerExercice {
    
    protected static $object = 'Exercice';
    
    public static function choixExercice()
    {
    	$view = "choixExercice";
    	$pagetitle="Choix du type d'exercice - Agora";
        $path_array = array("view", "view.php");
        $PATH = File::build_path($path_array);
        require "$PATH";
    }
}