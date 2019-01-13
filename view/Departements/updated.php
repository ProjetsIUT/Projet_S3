<article id="page_connexion">
<div id="formulaire_connexion">
<?php
    echo '<p> Le département de code '.htmlspecialchars($_GET['codeDepartement']).' a été mis à jour!
    <br>
    Vous allez être redirigé vers la page précédente.</p>
    ';

        $redirection = 'index.php?controller=departements&action=read&codeDepartement='.htmlspecialchars($_GET['codeDepartement']).'';
        header('Refresh: 3; url='.$redirection);

?>

</div>
</article>