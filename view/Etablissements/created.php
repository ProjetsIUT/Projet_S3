
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>
	    L'établissement a bien été créée !
        Vous allez être redirigé vers la liste des établissement
	    <br>
    </p>
</div>
<?php
        $redirection = 'index.php?controller=etablissements&action=readAll';
        header('Refresh: 3; url='.$redirection);
?>
</article>