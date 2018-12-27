<!DOCTYPE html>

<html id=<?php if(isset($page_id)){ echo ($page_id); } ?>>
    <head>
		<meta charset="utf-8" />
		<title><?php echo $pagetitle?></title>
			<link rel="stylesheet" type="text/css" href="./style.css">
	
<header>
				<?php
				if (isset($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'enseignant') {
					echo '<a href="index.php?controller=enseignants&action=show_perso_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				}
				else if (isset($_SESSION['typeUtilisateur']) && $_SESSION['typeUtilisateur'] === 'etudiant') {
					echo '<a href="index.php?controller=etudiants&action=show_perso_page" id="logo"><img src="img/LogoHomepage3.png" alt="LogoAgora"> </a>';
				} 
				else if (!isset($_SESSION['typeUtilisateur'])){
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
	</head>

	<body >
	


		<?php


			$filepath = File::build_path(array("view", ucfirst(self::$object), "$view.php"));
			require $filepath;

		?>


	</body>
</html>

