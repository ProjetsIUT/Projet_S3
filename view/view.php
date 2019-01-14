
<!DOCTYPE html>

<?php 
	
	if(isset($_SESSION['theme']) && $_SESSION['theme']!=0){

		$html = 'html_background_' . $_SESSION['theme'];

	}else{

		$html = 'html_background_1';

	}
	
	if (!isset($_SESSION['loginUtilisateur'])){

		$html = 'html_background_1';
	}

?>

<html id=<?php echo $html; ?>>
    <head>
		<link rel="icon" href="img/Agora_icone_finale_CR_JulieValentin.png" />
		<meta charset="utf-8" />
		<title><?php echo $pagetitle?></title>
			<link rel="stylesheet" type="text/css" href="./style.css">
	
<header>
				<?php
				if (Session::is_teacher()) {
					echo '<a href="index.php?controller=enseignants&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				else if (Session::is_student()) {
					echo '<a href="index.php?controller=etudiants&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				else if (Session::is_admin()) {
					echo '<a href="index.php?controller=administrateur&action=show_perso_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				} 
				else if (!isset($_SESSION['typeUtilisateur'])){
					echo '<a href="index.php?controller=utilisateurs&action=show_login_page" id="logo"><img src="img/Agora_logo_final_CR_JulieValentin_redimensionne.png" alt="LogoAgora"> </a>';
				}
				?>
				
				<nav>

					<?php 
					if(!Session::is_admin()) {
						echo '
						<ul>

						<li class="menu1"><a class="menu" href="index.php?controller=cours&action=list">Cours</a>
			
					

						</li>

						<li class="menu2"><a class="menu">Exercices</a> 

							<ul class="sous_menu">

								<li><a class="menu texte_sous_menu" href="index.php?controller=QCM&action=list">QCMs</a></li>
								<li><a class="menu texte_sous_menu" href="index.php?controller=ExerciceClassique&action=list">Classiques</a></li>

							</ul>

						</li>
						';
					}
						?>
						
						<?php

							if(Session::is_teacher()){

									echo'<li class="menu3"><a class="menu" href="./index.php?controller=notes&action=statsEnseignant">Statistiques</a>';

							}else if(Session::is_student()){

									echo'<li class="menu3"><a class="menu"  href="./index.php?controller=notes&action=statsEtud" >Statistiques</a>';
							}

							if(Session::is_teacher() && !Session::is_admin()){

									echo'<li class="menu4"><a class="menu" href="./index.php?controller=notes&action=list">Notes</a>';

							}else if(!Session::is_admin()){

									echo'<li class="menu4"><a class="menu"  href="./index.php?controller=notes&action=listByEtud">Notes</a>';
							}

						?>

					


						</li>

					
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

