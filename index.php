
<?php

session_start();
$DS = DIRECTORY_SEPARATOR;
$ROOT_FOLDER = __DIR__ . $DS . "lib";
require_once $ROOT_FOLDER . $DS . "File.php";
require_once $ROOT_FOLDER. $DS. 'Session.php'; 
$ROOT_FOLDER = __DIR__ . $DS . "controller";
require_once $ROOT_FOLDER .$DS . "routeur.php";

?> 
