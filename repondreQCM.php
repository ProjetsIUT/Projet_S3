<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<title>Maquette</title>
		 <link rel="stylesheet" href="style.css" />
	</head>
	<body>
	
		<header>
				<div id="logo"><img src="img/LogoHomepage3.png" alt="LOGO FICTIF"> </div>

				
				<nav>

						<div class="menu">
							Cours
						</div>
						<div class="menu">
							Exercices
						</div>
						<div class="menu">
							Statistiques
						</div>
						
						
				</nav>

				
				<div id="connexion"><a id="connexion_inscription">Connexion | Inscription</a></div>
		</header>
		<article id="page_repondreqcm">
			<form id="formulaire_repondreqcm" methode="get" action="repondreQCM.php">
				<p>Afficher le titre de l'exercice</p>
				<br>
				<p> Afficher l'énoncé ici </p>
				<br>
				<h4>Ce QCM n'a qu'une seule et unique réponse parmi les propositions suivantes :</h4>
				<div id="part_form">
					<br>
					<input type="radio" name="choix_multiple" value="proposition_1"/>
					<br>
					<input type="radio" name="choix_multiple" value="proposition_2"/>
					<br>
					<input type="radio" name="choix_multiple" value="proposition_3"/>
					<br>
					<input type="radio" name="choix_multiple" value="proposition_4"/>
					<br>
					<input type="hidden" name="champ_cache" id="champ_cache" value="reponse_juste">
					<br>
				</div>	
				<input type="submit" value="Soumettre ma réponse"/>
				<br>
			</form>
		</article>
	</body>
</html>
