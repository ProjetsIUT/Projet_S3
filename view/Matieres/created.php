<div class=page_content>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>
	    La matière a bien été créée !
	    <br>
	    Veuillez activer le compte via le lien reçu par mail. 
	    Vous allez être redirigé.
    </p>
</div>
<?php
        $redirection = 'index.php?controller=matieres&action=readAll';
        header('Refresh: 3; url='.$redirection);
?>
</article>
</div>