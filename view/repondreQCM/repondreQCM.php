
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
