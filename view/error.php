
<!DOCTYPE html>

<html id=<?php if(isset($page_id)){ echo ($page_id); } ?>>
    <head>
		<meta charset="utf-8" />
		<title>Erreur</title>
			<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
		<header>
				<?php
				if (isset($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'enseignant') {
					echo '<a href="index.php?controller=enseignants&action=show_perso_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				}
				else if (isset($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'etudiant') {
					echo '<a href="index.php?controller=etudiants&action=show_perso_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				}
				else if (isset($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'administrateur') {
					echo '<a href="index.php?controller=administrateur&action=show_perso_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				} 
				else if (!isset($_SESSION['typeUtilisateur'])) {
					echo '<a href="index.php?controller=Utilisateurs&action=show_login_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				}
				?>
				
				<nav>
					<a class="menu" href="index.php?controller=cours&action=list">Cours</a>
					<a class="menu" href="index.php?controller=QCM&action=show_form_new">Exercices</a>
					<a class="menu">Statistiques</a>
				</nav>

				<?php

				if(isset($_SESSION['typeUtilisateur'])) {
					echo '<div id="connexion" ><a href="index.php?controller=Utilisateurs&action=deconnected" id="connexion_inscription">Deconnexion</a></div>';
				}
				else {
					echo '<div id="connexion" ><a href="index.php?controller=Utilisateurs&action=show_login_page" id="connexion_inscription">Connexion</a></div>';
				}
				?>
		</header>

	<body>
		<article id="page_connexion">
			<div class="page_content">		
				<div class='div_error'>
					<br>
					<a> <?php echo $error_code?></a>
					<br>
					<a> Vous allez être redirigé vers l'accueil</a>

					 <?php 
						if(Session::is_student()){ //si c'est un étudiant 
							$redirection = './index.php?controller=etudiants&action=show_perso_page';
							header('Refresh: 3; url='.$redirection);
						}
						else if(Session::is_teacher()){ //si c'est un enseignant
							$redirection = './index.php?controller=enseignants&action=show_perso_page';
							header('Refresh: 3; url='.$redirection);
						}
						else if(Session::is_admin()){ //si c'est un admin
							$redirection = './index.php?controller=administrateur&action=show_perso_page';
							header('Refresh: 3; url='.$redirection);
						}
						else {
							$redirection = './index.php';
							header('Refresh: 3; url='.$redirection);
						} 
					?> 
					
				</div>
			</div>
		</article>	
	</body>
</html>


