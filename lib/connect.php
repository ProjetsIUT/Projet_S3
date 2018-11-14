<?php


$userName=$_GET['login'];
$password=$_GET['password'];

$req=Model::$pdo->prepare("SELECT loginEtudiant, mdpEtudiant, prenomEtudiant FROM agora_etudiants WHERE loginEtudiant=:userName ");
$req->execute(array(
	'userName'=>$userName));

$res=$req->fetch();

$correct=$password==$res['mdpEtudiant'];
//$correct=password_verify($password,$res['password']); //une fois le mdp haché

$prenom=$res['prenomEtudiant'];
if (!$res){

	$code='error_user';
	require_once "login.php"; //utilisateur non inscrit 	

}else{

	if($correct){

	   session_start();	

	   $_SESSION["isLogedIn"]=true;
	   $_SESSION["login"]=$res['loginEtudiant'];
	   $_SESSION["prenomUtilisateur"]=$res['prenomEtudiant'];


       require_once "PagePerso.php"; //page perso


	}else{

		$code='error_mdp';
		require_once "login.php"; //mauvais mot de passe

	}

}


?>