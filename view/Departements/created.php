<div class=page_content>
<article id="page_connexion">
<div id="formulaire_connexion">
    <p>
	    Le département a bien été créée !
	    <br>
	    Vous allez être redirigé.
    </p>
</div>
<?php
        $redirection = 'index.php?controller=departements&action=readAll';
        header('Refresh: 3; url='.$redirection);
?>
</article>
</div>